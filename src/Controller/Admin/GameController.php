<?php

namespace App\Controller\Admin;

use App\Entity\Game;
use App\Service\GamesService;
use App\Form\Games\AddGameType;
use App\Form\Games\EditGameType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


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
    public function add(GamesService $gameService, Request $request){
        $game = new Game();
        $form = $this->createForm(AddGameType::class, $game);
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){
            $gameService->saveEntity($game, false);
            $this->addFlash('success', 'admin.games.add.flash_success');
            $form = $this->createForm(AddGameType::class, new Game());
        }

        return $this->render('admin/game/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit", requirements={"id"="\d+"})
     */
    public function edit(Game $game, GamesService $gameService, Request $request){
        $form = $this->createForm(EditGameType::class, $game);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $gameService->saveEntity($game, true);
            $this->addFlash('success', 'admin.games.edit.flash_success');
        }
        return $this->render('admin/game/edit.html.twig', [
            'form' => $form->createView(),
            'game' => $game,
        ]);
    }

    /**
     * @Route("/remove/{id}", name="remove", requirements={"id"="\d+"})
     */
    public function remove(Game $game, GamesService $gameService){
        $gameService->removeEntity($game);
        $this->addFlash('success', 'admin.games.remove.flash_success');
        return $this->redirectToRoute('admin_games_list');
    }
}
