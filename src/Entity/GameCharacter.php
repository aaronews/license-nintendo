<?php

namespace App\Entity;

use App\Repository\GameCharacterRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GameCharacterRepository::class)
 */
class GameCharacter extends AbstractEntity
{
    /**
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Game
     * @ORM\ManyToOne(targetEntity=Game::class, inversedBy="gameCharacters")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull
     */
    private $game;

    /**
     * @var Character
     * @ORM\ManyToOne(targetEntity=Character::class, inversedBy="gameCharacters")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull
     */
    private $currentCharacter;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull
     * @Assert\Image
     */
    private $thumbnail;

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
     * Get game value
     *
     * @return Game
     */
    public function getGame(): Game
    {
        return $this->game;
    }

    /**
     * Set game value
     *
     * @param Game $game
     * @return self
     */
    public function setGame(Game $game): self
    {
        $this->game = $game;

        return $this;
    }

    /**
     * Get character value
     *
     * @return Character
     */
    public function getCurrentCharacter(): Character
    {
        return $this->currentCharacter;
    }

    /**
     * Set character value
     *
     * @param Character $currentCharacter
     * @return self
     */
    public function setCurrentCharacter(Character $currentCharacter): self
    {
        $this->currentCharacter = $currentCharacter;

        return $this;
    }

    /**
     * Get thumbnail value
     *
     * @return string
     */
    public function getThumbnail(): string
    {
        return $this->thumbnail;
    }

    /**
     * Set thumbnail value
     *
     * @param string $thumbnail
     * @return self
     */
    public function setThumbnail(string $thumbnail): self
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }
}
