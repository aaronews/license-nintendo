<?php

namespace App\Service;

use App\Entity\Game;
use App\Entity\Item;
use App\Repository\GameItemRepository;

class GameItemsService extends AbstractEntityService
{
    public function __construct(GameItemRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all items of game
     *
     * @param Game $game
     * @param int|null $limit
     * @return Item[]
     */
    public function getItemsByGame(Game $game, ?int $limit = null){
        return $this->repository->findItemsByGame($game, $limit);
    }
}