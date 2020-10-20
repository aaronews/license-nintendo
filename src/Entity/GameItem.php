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
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Game
     * @ORM\ManyToOne(targetEntity=Game::class, inversedBy="gameItems")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull
     */
    private $game;

    /**
     * @var Item
     * @ORM\ManyToOne(targetEntity=Item::class, inversedBy="gameItems")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull
     */
    private $item;

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
     * Get item value
     *
     * @return Item
     */
    public function getItem(): Item
    {
        return $this->item;
    }

    /**
     * Set item value
     *
     * @param Item $item
     * @return self
     */
    public function setItem(Item $item): self
    {
        $this->item = $item;

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
