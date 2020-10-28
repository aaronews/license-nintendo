<?php

namespace App\Service;

use App\Entity\Game;
use App\Entity\Character;
use App\Repository\GameCharacterRepository;

class GameCharactersService extends AbstractEntityService
{
    public function __construct(GameCharacterRepository $repository)
    {
        $this->repository = $repository;
    }
}