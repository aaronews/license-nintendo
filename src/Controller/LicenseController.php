<?php

namespace App\Controller;

use App\Form\Search\LicenseType;
use App\Service\LicensesService;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Search\License as SearchLicense;
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

        if($form->isSubmitted() && $form->isValid()){
        }else{

        }

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
}
