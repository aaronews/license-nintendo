<?php

namespace App\Entity\Search;

use App\Entity\Game;

class Character extends AbstractSearch
{
    /**
     * @var string|null
     */
    private $gender;

    /**
     * @var Game|null
     */
    private $game;

    /**
     * Get gender value
     *
     * @return string|null
     */
    public function getGender(): ?string
    {
        return $this->gender;
    }

    /**
     * Set gender value
     *
     * @param string|null $gender
     * @return self
     */
    public function setGender(?string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

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
}
