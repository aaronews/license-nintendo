<?php

namespace App\Controller;

use App\Service\LicencesService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(LicencesService $licencesService)
    {
        return $this->render('index/index.html.twig', [
            'licences' => $licencesService->findAll()
        ]);
    }
}
