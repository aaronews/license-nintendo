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
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $gender;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity=GameCharacter::class, mappedBy="currentCharacter", fetch="EXTRA_LAZY")
     */
    private $gameCharacters;

    public function __construct()
    {
        $this->gameCharacters = new ArrayCollection();
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
     * Get gender value
     *
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * Set gender value
     *
     * @param string $gender
     * @return self
     */
    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get list of games characters
     * 
     * @return Collection|GameCharacter[]
     */
    public function getGameCharacters(): Collection
    {
        return $this->gameCharacters;
    }

    /**
     * Add a game character of collection
     *
     * @param GameCharacter $gameCharacter
     * @return self
     */
    public function addGameCharacter(GameCharacter $gameCharacter): self
    {
        if (!$this->gameCharacters->contains($gameCharacter)) {
            $this->gameCharacters[] = $gameCharacter;
            $gameCharacter->setCurrentCharacter($this);
        }

        return $this;
    }

    /**
     * Remove a game character of collection
     *
     * @param GameCharacter $gameCharacter
     * @return self
     */
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

    /**
     * Get available genders values
     *
     * @return string[]
     */
    public static function getGenders(){
        return array('H', 'F');
    }
}
