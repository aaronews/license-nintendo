<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/characters", name="characters_")
 */
class CharacterController extends AbstractController
{

    /**
     * @Route("/list", name="list")
     */
    public function list()
    {
        return $this->render('character/list.html.twig', [
        ]);
    }
}
