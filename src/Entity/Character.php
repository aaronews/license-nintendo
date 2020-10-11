<?php

namespace App\Entity;

use App\Repository\CharacterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CharacterRepository::class)
 * @ORM\Table(name="`character`")
 */
class Character extends AbstractDisplayableEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $gender;

    /**
     * @ORM\OneToMany(targetEntity=GameCharacter::class, mappedBy="currentCharacter")
     */
    private $gameCharacters;

    public function __construct()
    {
        $this->gameCharacters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

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
            $gameCharacter->setCurrentCharacter($this);
        }

        return $this;
    }

    public function removeGameCharacter(GameCharacter $gameCharacter): self
    {
        if ($this->gameCharacters->contains($gameCharacter)) {
            $this->gameCharacters->removeElement($gameCharacter);
            // set the owning side to null (unless already changed)
            if ($gameCharacter->getCurrentCharacter() === $this) {
                $gameCharacter->setCurrentCharacter(null);
            }
        }

        return $this;
    }
}
