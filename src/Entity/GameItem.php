<?php

namespace App\Entity;

use App\Repository\GameItemRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GameItemRepository::class)
 */
class GameItem extends AbstractEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Game::class, inversedBy="gameItems")
     * @ORM\JoinColumn(nullable=false)
     */
    private $game;

    /**
     * @ORM\ManyToOne(targetEntity=Item::class, inversedBy="gameItems")
     * @ORM\JoinColumn(nullable=false)
     */
    private $item;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $thumbnail;

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

    public function getItem(): ?Item
    {
        return $this->item;
    }

    public function setItem(?Item $item): self
    {
        $this->item = $item;

        return $this;
    }

    public function getThumbnail(): ?string
    {
        return $this->thumbnail;
    }

    public function setThumbnail(string $thumbnail): self
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }
}
