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
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Game::class, inversedBy="gameCharacters")
     * @ORM\JoinColumn(nullable=false)
     */
    private $game;

    /**
     * @ORM\ManyToOne(targetEntity=Character::class, inversedBy="gameCharacters")
     * @ORM\JoinColumn(nullable=false)
     */
    private $currentCharacter;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): self
    {
        $this->game = $game;

        return $this;
    }

    public function getCurrentCharacter(): ?Character
    {
        return $this->currentCharacter;
    }

    public function setCurrentCharacter(?Character $currentCharacter): self
    {
        $this->currentCharacter = $currentCharacter;

        return $this;
    }
}
