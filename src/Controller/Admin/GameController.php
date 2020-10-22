<?php

namespace App\Controller\Admin;

use App\Service\GamesService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/admin/games", name="admin_games_")
 */
class GameController extends AbstractController
{
    /**
     * @Route("/list", name="list")
     */
    public function list(GamesService $gamesService)
    {
        return $this->render('admin/game/list.html.twig', [
            'games' => $gamesService->findAll(array('releaseDate' => 'DESC'))
        ]);
    }

    /**
     * @Route("/add", name="add")
     */
    public function add(){
        return $this->render('admin/game/add.html.twig', [
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit", requirements={"id"="\d+"})
     */
    public function edit(){
        return $this->render('admin/game/edit.html.twig', [
        ]);
    }

    /**
     * @Route("/remove/{id}", name="remove", requirements={"id"="\d+"})
     */
    public function remove(){
        return $this->redirectToRoute('admin_games_list');
    }
}
