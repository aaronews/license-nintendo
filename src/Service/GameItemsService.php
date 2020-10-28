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
}