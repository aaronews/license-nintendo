<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ItemRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=ItemRepository::class)
 * @Vich\Uploadable
 */
class Item extends AbstractDisplayableEntity
{
    /**
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity=GameItem::class, mappedBy="item", fetch="EXTRA_LAZY")
     */
    private $gameItems;

    /**
     * @Vich\UploadableField(mapping="items_images", fileNameProperty="thumbnail")
     * @var File|null
     */
    private $imageFile;

    public function __construct()
    {
        $this->gameItems = new ArrayCollection();
    }

    /**
     * Get id value
     *
     * @return integer|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get list of game items
     * 
     * @return Collection|GameItem[]
     */
    public function getGameItems(): Collection
    {
        return $this->gameItems;
    }

    /**
     * Add a game item of collection
     *
     * @param GameItem $gameItem
     * @return self
     */
    public function addGameItem(GameItem $gameItem): self
    {
        if (!$this->gameItems->contains($gameItem)) {
            $this->gameItems[] = $gameItem;
            $gameItem->setItem($this);
        }

        return $this;
    }

    /**
     * Remove a game item of collection
     *
     * @param GameItem $gameItem
     * @return self
     */
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
