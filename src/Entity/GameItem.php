<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\GameItemRepository;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=GameItemRepository::class)
 * @Vich\Uploadable
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
     */
    private $thumbnail;

    /**
     * @Vich\UploadableField(mapping="game_items_images", fileNameProperty="thumbnail")
     * @var File|null
     */
    private $uploadThumbnail;

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
     * Get game value
     *
     * @return Game|null
     */
    public function getGame(): ?Game
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
     * @return Item|null
     */
    public function getItem(): ?Item
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
     * @return string|null
     */
    public function getThumbnail(): ?string
    {
        return $this->thumbnail;
    }

    /**
     * Set thumbnail value
     *
     * @param string|null $thumbnail
     * @return self
     */
    public function setThumbnail(?string $thumbnail): self
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    /**
     * Set imega file value
     *
     * @param File|null $uploadThumbnail
     * @return void
     */
    public function setUploadThumbnail(?File $uploadThumbnail): void
    {
        $this->uploadThumbnail = $uploadThumbnail;

        if($this->uploadThumbnail){
            $this->setUpdateAt(new \Datetime());
        }
    }

    /**
     * Get image file value
     *
     * @return File|null
     */
    public function getUploadThumbnail(): ?File
    {
        return $this->uploadThumbnail;
    }
}
