<?php

namespace App\Service;

use App\Entity\Game;
use App\Entity\Item;
use App\Repository\ItemRepository;

class ItemsService extends AbstractEntityService 
{
    public function __construct(ItemRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all characters of game
     *
     * @param Game $game
     * @return Item[]
     */
    public function getItemsByGame(Game $game){
        return $this->repository->findItemsByGame($game);
    }
}