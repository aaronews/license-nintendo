<?php

namespace App\Entity\Search;

use App\Entity\Game;

class EntityInGame extends AbstractSearch
{

    /**
     * @var Game|null
     */
    private $game;

    /**
     * Get game value
     *
     * @return Game|null
     */
    public function getGame(): ?Game
    {
        return $this->game;
    }

    /**
     * Set game value
     *
     * @param Game|null $game
     * @return self
     */
    public function setGame(?Game $game): self
    {
        $this->game = $game;

        return $this;
    }

    /**
     * Convert entity to array
     *
     * @return array
     */
    public  function toArray(): array{
        return [
            'name' => $this->name,
            'game' => $this->game ? $this->game->getId() : null,
        ];
    }
}
