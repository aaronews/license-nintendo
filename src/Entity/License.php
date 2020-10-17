<?php

namespace App\Entity;

use App\Repository\LicenseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LicenseRepository::class)
 */
class License extends AbstractDisplayableEntity
{
    /**
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity=Game::class, mappedBy="license", fetch="EXTRA_LAZY")
     */
    private $games;

    public function __construct()
    {
        $this->games = new ArrayCollection();
    }

    /**
     * Get id value
     *
     * @return integer
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get list of games
     * 
     * @return Collection|Game[]
     */
    public function getGames(): Collection
    {
        return $this->games;
    }

    /**
     * Add a game of collection
     *
     * @param Game $game
     * @return self
     */
    public function addGame(Game $game): self
    {
        if (!$this->games->contains($game)) {
            $this->games[] = $game;
            $game->setLicense($this);
        }

        return $this;
    }

    /**
     * Remove a game of collection
     *
     * @param Game $game
     * @return self
     */
    public function removeGame(Game $game): self
    {
        if ($this->games->contains($game)) {
            $this->games->removeElement($game);
            // set the owning side to null (unless already changed)
            if ($game->getLicense() === $this) {
                $game->setLicense(null);
            }
        }

        return $this;
    }
}
