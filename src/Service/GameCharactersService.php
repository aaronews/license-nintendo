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

    /**
     * Get all characters of game sort by name 
     *
     * @param Game $game
     * @return Character[]
     */
    public function getCharactersByGame(Game $game){
        return $this->repository->findCharactersByGame($game);
    }
}