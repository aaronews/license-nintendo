<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\LicenseRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=LicenseRepository::class)
 * @Vich\Uploadable
 */
class License extends AbstractDisplayableEntity
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
     * @ORM\OneToMany(targetEntity=Game::class, mappedBy="license", fetch="EXTRA_LAZY")
     * @ORM\OrderBy({"releaseDate"="DESC"})
     */
    private $games;

    /**
     * @Vich\UploadableField(mapping="licenses_images", fileNameProperty="thumbnail")
     * @var File|null
     */
    private $uploadThumbnail;

    /**
     * @Vich\UploadableField(mapping="licenses_images", fileNameProperty="logo")
     * @var File|null
     */
    private $uploadLogo;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logo;

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
            $game->setLicense($this);
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
            // set the owning side to null (unless already changed)
            if ($game->getLicense() === $this) {
                $game->setLicense(null);
            }
        }

        return $this;
    }

    /**
     * Set logo file value
     *
     * @param File|null $uploadLogo
     * @return void
     */
    public function setUploadLogo(?File $uploadLogo): void
    {
        $this->uploadLogo = $uploadLogo;

        if($this->uploadLogo){
            $this->setUpdateAt(new \Datetime());
        }
    }

    /**
     * Get logo file value
     *
     * @return File|null
     */
    public function getUploadLogo(): ?File
    {
        return $this->uploadLogo;
    }

    /**
     * Get logo value
     *
     * @return string|null
     */
    public function getLogo(): ?string
    {
        return $this->logo;
    }

    /**
     * Set logo value
     *
     * @param string|null $logo
     * @return self
     */
    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }
}
