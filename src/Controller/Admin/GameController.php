<?php

namespace App\Controller\Admin;

use App\Entity\Game;
use App\Entity\GameItem;
use App\Entity\GameCharacter;
use App\Service\GamesService;
use App\Form\Games\AddGameType;
use App\Form\Games\EditGameType;
use App\Service\GameItemsService;
use App\Service\GameCharactersService;
use App\Form\Games\GameItems\AddGameItemType;
use Symfony\Component\HttpFoundation\Request;
use App\Form\Games\GameItems\EditGameItemType;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\Games\GameCharacters\AddGameCharacterType;
use App\Form\Games\GameCharacters\EditGameCharacterType;
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

    /**
     * @Route("/manage-characters/{id}", name="characters_manage", requirements={"id"="\d+"})
     */
    public function manageCharacters(Game $game, GameCharactersService $gameCharactersService, Request $request){
        $gameCharacter = new GameCharacter();
        $form = $this->createForm(AddGameCharacterType::class, $gameCharacter);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $gameCharactersService->saveEntity($gameCharacter->setGame($game), false);
            $this->addFlash('success', 'admin.games.characters.manage.flash_success');
            $form = $this->createForm(AddGameCharacterType::class, new GameCharacter());
        }

        return $this->render('admin/game/game-characters/manage.html.twig', [
            'form' => $form->createView(),
            'game' => $game,
            'gameCharacters' => $gameCharactersService->getCharactersByGame($game)
        ]);
    }

    /**
     * @Route("/manage-characters/edit/{id}", name="characters_edit", requirements={"id"="\d+"})
     */
    public function editCharacter(GameCharacter $gameCharacter, GameCharactersService $gameCharactersService, Request $request){
        $form = $this->createForm(EditGameCharacterType::class, $gameCharacter);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $gameCharactersService->saveEntity($gameCharacter, true);
            $this->addFlash('success', 'admin.games.characters.edit.flash_success');
        }

        return $this->render('admin/game/game-characters/edit.html.twig', [
            'form' => $form->createView(),
            'gameCharacter' => $gameCharacter,
        ]);
    }

    /**
     * @Route("/manage-characters/remove/{id}", name="characters_remove", requirements={"id"="\d+"})
     */
    public function removeCharacter(GameCharacter $gameCharacter, GameCharactersService $gameCharactersService){
        $gameCharactersService->removeEntity($gameCharacter);
        $this->addFlash('success', 'admin.games.characters.remove.flash_success');
        return $this->redirectToRoute('admin_games_characters_manage', array('id' => $gameCharacter->getGame()->getId()));
    }

    /**
     * @Route("/manage-items/{id}", name="items_manage", requirements={"id"="\d+"})
     */
    public function manageItems(Game $game, GameItemsService $gameItemsService, Request $request){
        $gameItem = new GameItem();
        $form = $this->createForm(AddGameItemType::class, $gameItem);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $gameItemsService->saveEntity($gameItem->setGame($game), false);
            $this->addFlash('success', 'admin.games.items.manage.flash_success');
            $form = $this->createForm(AddGameItemType::class, new GameItem());
        }

        return $this->render('admin/game/game-items/manage.html.twig', [
            'form' => $form->createView(),
            'game' => $game,
            'gameItems' => $gameItemsService->getItemsByGame($game)
        ]);
    }

    /**
     * @Route("/manage-items/edit/{id}", name="items_edit", requirements={"id"="\d+"})
     */
    public function editItem(GameItem $gameItem, GameItemsService $gameItemsService, Request $request){
        $form = $this->createForm(EditGameItemType::class, $gameItem);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $gameItemsService->saveEntity($gameItem, true);
            $this->addFlash('success', 'admin.games.items.edit.flash_success');
        }

        return $this->render('admin/game/game-items/edit.html.twig', [
            'form' => $form->createView(),
            'gameItem' => $gameItem,
        ]);
    }

    /**
     * @Route("/manage-items/remove/{id}", name="items_remove", requirements={"id"="\d+"})
     */
    public function removeItem(GameItem $gameItem, GameItemsService $gameItemsService){
        $gameItemsService->removeEntity($gameItem);
        $this->addFlash('success', 'admin.games.items.remove.flash_success');
        return $this->redirectToRoute('admin_games_items_manage', array('id' => $gameItem->getGame()->getId()));
    }
}
