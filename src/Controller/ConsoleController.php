<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ConsoleController extends AbstractController
{
    /**
     * @Route("/console", name="console")
     */
    public function index()
    {
        return $this->render('console/index.html.twig', [
            'controller_name' => 'ConsoleController',
        ]);
    }
}
