<?php

namespace App\Controller;

use App\Entity\License;
use App\Form\Search\LicenseType;
use App\Service\LicensesService;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Search\License as SearchLicense;
use App\Entity\Search\Game as SearchGame;
use App\Form\Search\GameType;
use App\Service\GamesService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/licenses", name="licenses_")
 */
class LicenseController extends AbstractController
{
    /**
     * @Route("/list", name="list")
     */
    public function list(LicensesService $licensesService, PaginatorInterface $paginator, Request $request)
    {
        $search = new SearchLicense();
        $form = $this->createForm(LicenseType::class, $search);
        $form->handleRequest($request);

        $licenses = $paginator->paginate(
            $licensesService->findBySearchCriterias($search),
            $request->query->getInt('page', 1), 
            10
        );

        return $this->render('license/list.html.twig', [
            'licenses' => $licenses,
            'searchForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/{slug}", name="view", requirements={"slug"="^[a-z0-9]+(\-{1}[a-z0-9]+)*$"})
     */
    public function view(License $license, GamesService $gamesService)
    {
        return $this->render('license/view.html.twig', [
            'license' => $license,
            'bestGames' => $gamesService->getBestGamesByLicense($license)
        ]);
    }

    /**
     * @Route("/{slug}/games", name="games", requirements={"slug"="^[a-z0-9]+(\-{1}[a-z0-9]+)*$"})
     */
    public function games(License $license, GamesService $gamesService, PaginatorInterface $paginator, Request $request)
    {
        return $this->render('license/games.html.twig', [
            'license' => $license
        ]);
    }
}
