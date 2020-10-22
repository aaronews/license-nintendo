<?php

namespace App\Entity;

use App\Repository\GenreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=GenreRepository::class)
 */
class Genre
{
    /**
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\NotNull
     * @Assert\Length(
     *      min=3,
     *      max=255,
     *      minMessage="errors.form.genr.name.to_short",
     *      maxMessage="errors.form.common.name.to_long"
     * )
     */
    private $name;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity=Game::class, mappedBy="genres", fetch="EXTRA_LAZY")
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
     * Get name value
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set name value
     *
     * @return string
     */
    public function setName(string $name): self
    {
        $this->name = $name;

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
     * Add a game of collection
     *
     * @param Game $game
     * @return self
     */
    public function addGame(Game $game): self
    {
        if (!$this->games->contains($game)) {
            $this->games[] = $game;
            $game->addGenre($this);
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
            $game->removeGenre($this);
        }

        return $this;
    }
}
