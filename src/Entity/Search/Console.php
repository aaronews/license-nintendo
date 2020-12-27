<?php

namespace App\Entity\Search;

use App\Entity\Game;
use Symfony\Component\Validator\Constraints as Assert;

class Console extends AbstractSearch
{
    /**
     * @var \DateTimeInterface|null
     * @Assert\LessThanOrEqual(propertyPath="releaseDateMax", message="errors.form.console.release_date.lower_to_max")
     */
    private $releaseDateMin;
    
    /**
     * @var \DateTimeInterface|null
     * @Assert\GreaterThanOrEqual(propertyPath="releaseDateMin", message="errors.form.console.release_date.greather_to_min")
     */
    private $releaseDateMax;

    /**
     * @var integer|null
     * @Assert\Positive
     * @Assert\LessThanOrEqual(propertyPath="releasePriceMax", message="errors.form.console.release_price.lower_to_max")
     */
    private $releasePriceMin;

    /**
     * @var integer|null
     * @Assert\Positive
     * @Assert\GreaterThanOrEqual(propertyPath="releasePriceMin", message="errors.form.console.release_price.greather_to_min")
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

    /**
     * Convert entity to array
     *
     * @return array
     */
    public  function toArray(): array{
        return [
            'name' => $this->name,
            'game' => $this->game ? $this->game->getId() : null,
            'releaseDateMax' => $this->releaseDateMax,
            'releaseDateMin' => $this->releaseDateMin,
            'releasePriceMax' => $this->releasePriceMax,
            'releasePriceMin' => $this->releasePriceMin,
        ];
    }
}
