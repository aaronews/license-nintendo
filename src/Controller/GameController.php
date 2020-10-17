<?php

namespace App\Controller;

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
    public function list(GamesService $itemsService, PaginatorInterface $paginator, Request $request)
    {
        $search = new SearchGame();
        $form = $this->createForm(GameType::class, $search);
        $form->handleRequest($request);

        $games = $paginator->paginate(
            $itemsService->findBySearchCriterias($search),
            $request->query->getInt('page', 1), 
            10
        );
        return $this->render('game/list.html.twig', [
            'games' => $games,
            'searchForm' => $form->createView()
        ]);
    }
}
