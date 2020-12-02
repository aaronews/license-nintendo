<?php

namespace App\Controller;

use App\Entity\License;
use App\Service\GamesService;
use App\Form\Search\LicenseType;
use App\Service\LicensesService;
use App\Entity\AbstractDisplayableEntity;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Search\License as SearchLicense;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/licenses", name="licenses_")
 */
class LicenseController extends AbstractController
{
    /**
     * @Route("/list", name="list")
     */
    public function list(LicensesService $licensesService, PaginatorInterface $paginator, Request $request, SessionInterface $session)
    {
        $search = new SearchLicense();
        $form = $this->createForm(LicenseType::class, $search);
        $form->handleRequest($request);
        $page = $request->query->getInt('page', 1);

        if($form->isSubmitted()){
            if($form->isValid()){
                $page = 1;
                $session->set('licenseSearchData', $form->getData($search)->toArray());
            }else{
                $search = new SearchLicense();
            }
        }elseif($session->has('licenseSearchData')){
            $licensesService->hydrateSearch($session->get('licenseSearchData'), $search);
            $form->setData($search);
        }

        $licenses = $paginator->paginate(
            $licensesService->findBySearchCriterias($search),
            $page, 
            8
        );

        return $this->render('license/list.html.twig', [
            'licenses' => $licenses,
            'searchForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/{slug}", name="view", requirements={"slug"=AbstractDisplayableEntity::SLUG_PATTERN})
     */
    public function view(License $license, GamesService $gamesService)
    {
        return $this->render('license/view.html.twig', [
            'license' => $license,
            'bestGames' => $gamesService->getBestGamesByLicense($license)
        ]);
    }

    /**
     * @Route("/{slug}/games", name="games", requirements={"slug"=AbstractDisplayableEntity::SLUG_PATTERN})
     */
    public function games(License $license, GamesService $gamesService, PaginatorInterface $paginator, Request $request)
    {
        return $this->render('license/games.html.twig', [
            'license' => $license
        ]);
    }
}
