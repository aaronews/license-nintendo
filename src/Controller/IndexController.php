<?php

namespace App\Controller;

use App\Service\LicensesService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(LicensesService $licensesService)
    {
        return $this->render('index/index.html.twig', [
            'licenses' => $licensesService->findAll()
        ]);
    }
}
