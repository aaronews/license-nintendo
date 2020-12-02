<?php

namespace App\Controller;

use App\Entity\Game;
use App\Form\Search\GameType;
use App\Service\GamesService;
use App\Service\GameItemsService;
use App\Service\GameCharactersService;
use App\Entity\AbstractDisplayableEntity;
use App\Entity\Search\Game as SearchGame;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/games", name="games_")
 */
class GameController extends AbstractController
{
    /**
     * @Route("/list", name="list")
     */
    public function list(GamesService $gamesService, PaginatorInterface $paginator, Request $request, SessionInterface $session)
    {      
        $search = new SearchGame();
        $form = $this->createForm(GameType::class, $search);
        $form->handleRequest($request);
        $page = $request->query->getInt('page', 1);

        if($form->isSubmitted()){
            if($form->isValid()){
                $page = 1;
                $session->set('gameSearchData', $form->getData($search)->toArray());
            }else{
                $search = new SearchGame();
            }
        }elseif($session->has('gameSearchData')){
            $gamesService->hydrateSearch($session->get('gameSearchData'), $search);
            $form->setData($search);
        }

        $games = $paginator->paginate(
            $gamesService->findBySearchCriterias($search),
            $page, 
            8
        );
        
        return $this->render('game/list.html.twig', [
            'games' => $games,
            'searchForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/{slug}", name="view", requirements={"slug"=AbstractDisplayableEntity::SLUG_PATTERN})
     */
    public function view(Game $game, GameCharactersService $gameCharactersService, GameItemsService $gameItemsService)
    {
        return $this->render('game/view.html.twig', [
            'game' => $game,
            'characters' => $gameCharactersService->getCharactersByGame($game, 4),
            'items' => $gameItemsService->getItemsByGame($game, 4),
        ]);
    }

    /**
     * @Route("/{slug}/characters", name="characters", requirements={"slug"=AbstractDisplayableEntity::SLUG_PATTERN})
     */
    public function characters(Game $game, GameCharactersService $gameCharactersService){
        return $this->render('game/characters.html.twig', [
            'game' => $game,
            'characters' => $gameCharactersService->getCharactersByGame($game),
        ]);
    }

    /**
     * @Route("/{slug}/items", name="items", requirements={"slug"=AbstractDisplayableEntity::SLUG_PATTERN})
     */
    public function items(Game $game, GameItemsService $gameItemsService){
        return $this->render('game/items.html.twig', [
            'game' => $game,
            'items' => $gameItemsService->getItemsByGame($game),
        ]);
    }
}
