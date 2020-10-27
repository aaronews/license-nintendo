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
     * Get all characters of game sort by name 
     *
     * @param Game $game
     * @return Item[]
     */
    public function getItemsByGame(Game $game){
        return $this->repository->findItemsByGame($game);
    }
}