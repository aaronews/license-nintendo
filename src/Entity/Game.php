<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GameRepository::class)
 */
class Game extends AbstractDisplayableEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $history;

    /**
     * @ORM\Column(type="date")
     */
    private $releaseDate;

    /**
     * @ORM\Column(type="smallint")
     */
    private $nbPlayers;

    /**
     * @ORM\ManyToOne(targetEntity=License::class, inversedBy="games")
     * @ORM\JoinColumn(nullable=false)
     */
    private $license;

    /**
     * @ORM\ManyToMany(targetEntity=Console::class, inversedBy="games")
     */
    private $consoles;

    /**
     * @ORM\ManyToMany(targetEntity=Genre::class, inversedBy="games")
     */
    private $genres;

    /**
     * @ORM\OneToMany(targetEntity=GameItem::class, mappedBy="game")
     */
    private $gameItems;

    /**
     * @ORM\OneToMany(targetEntity=GameCharacter::class, mappedBy="game")
     */
    private $gameCharacters;

    public function __construct()
    {
        $this->consoles = new ArrayCollection();
        $this->genres = new ArrayCollection();
        $this->gameItems = new ArrayCollection();
        $this->gameCharacters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHistory(): ?string
    {
        return $this->history;
    }

    public function setHistory(string $history): self
    {
        $this->history = $history;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(\DateTimeInterface $releaseDate): self
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getNbPlayers(): ?int
    {
        return $this->nbPlayers;
    }

    public function setNbPlayers(int $nbPlayers): self
    {
        $this->nbPlayers = $nbPlayers;

        return $this;
    }

    public function getLicense(): ?License
    {
        return $this->license;
    }

    public function setLicense(?License $license): self
    {
        $this->license = $license;

        return $this;
    }

    /**
     * @return Collection|Console[]
     */
    public function getConsoles(): Collection
    {
        return $this->consoles;
    }

    public function addConsole(Console $console): self
    {
        if (!$this->consoles->contains($console)) {
            $this->consoles[] = $console;
        }

        return $this;
    }

    public function removeConsole(Console $console): self
    {
        if ($this->consoles->contains($console)) {
            $this->consoles->removeElement($console);
        }

        return $this;
    }

    /**
     * @return Collection|Genre[]
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(Genre $genre): self
    {
        if (!$this->genres->contains($genre)) {
            $this->genres[] = $genre;
        }

        return $this;
    }

    public function removeGenre(Genre $genre): self
    {
        if ($this->genres->contains($genre)) {
            $this->genres->removeElement($genre);
        }

        return $this;
    }

    /**
     * @return Collection|GameItem[]
     */
    public function getGameItems(): Collection
    {
        return $this->gameItems;
    }

    public function addGameItem(GameItem $gameItem): self
    {
        if (!$this->gameItems->contains($gameItem)) {
            $this->gameItems[] = $gameItem;
            $gameItem->setGame($this);
        }

        return $this;
    }

    public function removeGameItem(GameItem $gameItem): self
    {
        if ($this->gameItems->contains($gameItem)) {
            $this->gameItems->removeElement($gameItem);
            // set the owning side to null (unless already changed)
            if ($gameItem->getGame() === $this) {
                $gameItem->setGame(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|GameCharacter[]
     */
    public function getGameCharacters(): Collection
    {
        return $this->gameCharacters;
    }

    public function addGameCharacter(GameCharacter $gameCharacter): self
    {
        if (!$this->gameCharacters->contains($gameCharacter)) {
            $this->gameCharacters[] = $gameCharacter;
            $gameCharacter->setGame($this);
        }

        return $this;
    }

    public function removeGameCharacter(GameCharacter $gameCharacter): self
    {
        if ($this->gameCharacters->contains($gameCharacter)) {
            $this->gameCharacters->removeElement($gameCharacter);
            // set the owning side to null (unless already changed)
            if ($gameCharacter->getGame() === $this) {
                $gameCharacter->setGame(null);
            }
        }

        return $this;
    }
}
