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
     * Get all characters of game
     *
     * @param Game $game
     * @param int|null $limit
     * @return Character[]
     */
    public function getCharactersByGame(Game $game, ?int $limit = null){
        return $this->repository->findCharactersByGame($game, $limit);
    }
}