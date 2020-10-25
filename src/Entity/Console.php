<?php

namespace App\Entity;

use App\Repository\ConsoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass=ConsoleRepository::class)
 * @Vich\Uploadable
 */
class Console extends AbstractDisplayableEntity
{
    /**
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var \DateTimeInterface
     * @ORM\Column(type="date")
     */
    private $releaseDate;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     * @Assert\Positive
     */
    private $releasePrice;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity=Game::class, mappedBy="consoles", fetch="EXTRA_LAZY")
     */
    private $games;

    /**
     * @Vich\UploadableField(mapping="consoles_images", fileNameProperty="thumbnail")
     * @var File|null
     */
    private $imageFile;

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
     * Get release date value
     *
     * @return \DateTimeInterface
     */
    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->releaseDate;
    }

    /**
     * Set release date value
     *
     * @param \DateTimeInterface $releaseDate
     * @return self
     */
    public function setReleaseDate(\DateTimeInterface $releaseDate): self
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    /**
     * Get release price value
     *
     * @return integer
     */
    public function getReleasePrice(): int
    {
        return $this->releasePrice;
    }

    /**
     * Set release price value
     *
     * @param integer $releasePrice
     * @return self
     */
    public function setReleasePrice(int $releasePrice): self
    {
        $this->releasePrice = $releasePrice;

        return $this;
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
     * Add game to collection
     *
     * @param Game $game
     * @return self
     */
    public function addGame(Game $game): self
    {
        if (!$this->games->contains($game)) {
            $this->games[] = $game;
            $game->addConsole($this);
        }

        return $this;
    }

    /**
     * Remove game of collection
     *
     * @param Game $game
     * @return self
     */
    public function removeGame(Game $game): self
    {
        if ($this->games->contains($game)) {
            $this->games->removeElement($game);
            $game->removeConsole($this);
        }

        return $this;
    }
}
