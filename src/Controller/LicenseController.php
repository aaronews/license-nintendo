<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LicenseController extends AbstractController
{
    /**
     * @Route("/license", name="license")
     */
    public function index()
    {
        return $this->render('license/index.html.twig', [
            'controller_name' => 'LicenseController',
        ]);
    }
}
