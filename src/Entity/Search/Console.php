<?php

namespace App\Entity\Search;

use App\Entity\Game;

class Console extends AbstractSearch
{
    /**
     * @var \DateTimeInterface|null
     */
    private $releaseDateMin;
    
    /**
     * @var \DateTimeInterface|null
     */
    private $releaseDateMax;

    /**
     * @var integer|null
     */
    private $releasePriceMin;

    /**
     * @var integer|null
     */
    private $releasePriceMax;

    /**
     * @var Game|null
     */
    private $game;

    /**
     * Get release date minimum value
     *
     * @return \DateTimeInterface|null
     */
    public function getReleaseDateMin(): ?\DateTimeInterface
    {
        return $this->releaseDateMin;
    }

    /**
     * Set release date minimum value
     *
     * @param \DateTimeInterface|null $releaseDateMin
     * @return self
     */
    public function setReleaseDateMin(?\DateTimeInterface $releaseDateMin): self
    {
        $this->releaseDateMin = $releaseDateMin;

        return $this;
    }

    /**
     * Get release date maximum value
     *
     * @return \DateTimeInterface|null
     */
    public function getReleaseDateMax(): ?\DateTimeInterface
    {
        return $this->releaseDateMax;
    }

    /**
     * Set release date maximum value
     *
     * @param \DateTimeInterface|null $releaseDateMax
     * @return self
     */
    public function setReleaseDateMax(?\DateTimeInterface $releaseDateMax): self
    {
        $this->releaseDateMax = $releaseDateMax;

        return $this;
    }

    /**
     * Get release price minimum value
     *
     * @return integer|null
     */
    public function getReleasePriceMin(): ?int
    {
        return $this->releasePriceMin;
    }

    /**
     * Set release price minimum value
     *
     * @param integer|null $releasePriceMin
     * @return self
     */
    public function setReleasePriceMin(?int $releasePriceMin): self
    {
        $this->releasePriceMin = $releasePriceMin;

        return $this;
    }

    /**
     * Get release price maximum value
     *
     * @return integer|null
     */
    public function getReleasePriceMax(): ?int
    {
        return $this->releasePriceMax;
    }

    /**
     * Set release price maximum value
     *
     * @param integer|null $releasePriceMax
     * @return self
     */
    public function setReleasePriceMax(?int $releasePriceMax): self
    {
        $this->releasePriceMax = $releasePriceMax;

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
