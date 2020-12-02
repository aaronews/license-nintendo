<?php

namespace App\Entity\Search;

use App\Entity\Genre;
use App\Entity\Console;
use App\Entity\License;
use Symfony\Component\Validator\Constraints as Assert;

class Game extends AbstractSearch
{
    /**
     * @var \DateTimeInterface|null
     * @Assert\Expression(
     *     "!this.getReleaseDateMax()",
     *     message="errors.form.game.release_date.is_required_if_max_set"
     * )
     * @Assert\LessThanOrEqual(propertyPath="releaseDateMax", message="errors.form.game.release_date.lower_to_max")
     */
    private $releaseDateMin;
    
    /**
     * @var \DateTimeInterface|null
     * @Assert\Expression(
     *     "!this.getReleaseDateMin()",
     *     message="errors.form.game.release_date.is_required_if_min_set"
     * )
     * @Assert\GreaterThanOrEqual(propertyPath="releaseDateMin", message="errors.form.game.release_date.greather_to_min")
     */
    private $releaseDateMax;

    /**
     * @var integer|null
     * @Assert\Expression(
     *     "!this.getNbPlayersMax()",
     *     message="errors.form.game.player_numbers.is_required_if_max_set"
     * )
     * @Assert\Positive
     * @Assert\LessThanOrEqual(propertyPath="nbPlayersMax", message="errors.form.game.player_numbers.lower_to_max")
     */
    private $nbPlayersMin;

    /**
     * @var integer|null
     * @Assert\Expression(
     *     "!this.getNbPlayersMin()",
     *     message="errors.form.game.player_numbers.is_required_if_min_set"
     * )
     * @Assert\Positive
     * @Assert\GreaterThanOrEqual(propertyPath="nbPlayersMin", message="errors.form.game.player_numbers.greather_to_min")
     */
    private $nbPlayersMax;

    /**
     * @var License|null
     */
    private $license;

    /**
     * @var Console|null
     */
    private $console;

    /**
     * @var Genre|null
     */
    private $genre;

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
     * Get maximum player numbers value
     *
     * @return integer|null
     */
    public function getNbPlayersMin(): ?int
    {
        return $this->nbPlayersMin;
    }

    /**
     * Set maximum player numbers value
     *
     * @param integer|null $nbPlayersMin
     * @return self
     */
    public function setNbPlayersMin(?int $nbPlayersMin): self
    {
        $this->nbPlayersMin = $nbPlayersMin;

        return $this;
    }

    /**
     * Get maximum player numbers value
     *
     * @return integer|null
     */
    public function getNbPlayersMax(): ?int
    {
        return $this->nbPlayersMax;
    }

    /**
     * Set maximum player numbers value
     *
     * @param integer|null $nbPlayersMax
     * @return self
     */
    public function setNbPlayersMax(?int $nbPlayersMax): self
    {
        $this->nbPlayersMax = $nbPlayersMax;

        return $this;
    }
    
    /**
     * Get license value
     *
     * @return License|null
     */
    public function getLicense(): ?License
    {
        return $this->license;
    }

    /**
     * Set license value
     *
     * @param License|null $license
     * @return self
     */
    public function setLicense(?License $license): self
    {
        $this->license = $license;

        return $this;
    }
    
    /**
     * Get console value
     *
     * @return Console|null
     */
    public function getConsole(): ?Console
    {
        return $this->console;
    }

    /**
     * Set console value
     *
     * @param Console|null $console
     * @return self
     */
    public function setConsole(?Console $console): self
    {
        $this->console = $console;

        return $this;
    }
    
    /**
     * Get genre value
     *
     * @return Genre|null
     */
    public function getGenre(): ?Genre
    {
        return $this->genre;
    }

    /**
     * Set genre value
     *
     * @param Genre|null $genre
     * @return self
     */
    public function setGenre(?Genre $genre): self
    {
        $this->genre = $genre;

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
            'genre' => $this->genre ? $this->genre->getId() : null,
            'console' => $this->console ? $this->console->getId() : null,
            'license' => $this->license ? $this->license->getId() : null,
            'nbPlayersMax' => $this->nbPlayersMax,
            'nbPlayersMin' => $this->nbPlayersMin,
            'releaseDateMax' => $this->releaseDateMax,
            'releaseDateMin' => $this->releaseDateMin,
        ];
    }
}
