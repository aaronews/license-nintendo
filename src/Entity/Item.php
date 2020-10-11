<?php

namespace App\Entity;

use App\Repository\ItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ItemRepository::class)
 */
class Item extends AbstractDisplayableEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=GameItem::class, mappedBy="item")
     */
    private $gameItems;

    public function __construct()
    {
        $this->gameItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $gameItem->setItem($this);
        }

        return $this;
    }

    public function removeGameItem(GameItem $gameItem): self
    {
        if ($this->gameItems->contains($gameItem)) {
            $this->gameItems->removeElement($gameItem);
            // set the owning side to null (unless already changed)
            if ($gameItem->getItem() === $this) {
                $gameItem->setItem(null);
            }
        }

        return $this;
    }
}
