<?php

namespace App\Controller;

use App\Entity\Game;
use App\Form\Search\GameType;
use App\Service\GamesService;
use App\Entity\Search\Game as SearchGame;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/games", name="games_")
 */
class GameController extends AbstractController
{
    /**
     * @Route("/list", name="list")
     */
    public function list(GamesService $gamesService, PaginatorInterface $paginator, Request $request)
    {        
        $search = new SearchGame();
        $form = $this->createForm(GameType::class, $search);
        $form->handleRequest($request);

        $games = $paginator->paginate(
            $gamesService->findBySearchCriterias($search),
            $request->query->getInt('page', 1), 
            10
        );
        
        return $this->render('game/list.html.twig', [
            'games' => $games,
            'searchForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/{slug}", name="view", requirements={"slug"="^[a-z0-9]+(\-{1}[a-z0-9]+)*$"})
     */
    public function view(Game $game)
    {
        return $this->render('game/view.html.twig', [
            'game' => $game
        ]);
    }
}
