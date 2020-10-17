<?php

namespace App\Service;

use App\Repository\GameRepository;

class GamesService extends AbstractEntityService 
{
    public function __construct(GameRepository $repository)
    {
        $this->repository = $repository;
    }
}