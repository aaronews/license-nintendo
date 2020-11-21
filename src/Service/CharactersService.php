<?php

namespace App\Service;

use App\Entity\Game;
use App\Entity\Character;
use App\Repository\CharacterRepository;

class CharactersService extends AbstractEntityService
{
    public function __construct(CharacterRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all characters of game
     *
     * @param Game $game
     * @return Character[]
     */
    public function getCharactersByGame(Game $game){
        return $this->repository->findCharactersByGame($game);
    }
}