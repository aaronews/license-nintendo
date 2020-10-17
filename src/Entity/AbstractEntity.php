<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass
 * @ORM\HasLifecycleCallbacks
 */
abstract class AbstractEntity
{

    /**
     * @var \DateTimeInterface
     * @ORM\Column(type="datetime")
     */
    private $createAt;

    /**
     * @var \DateTimeInterface
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updateAt;

    /**
     * Get create date value
     *
     * @return \DateTimeInterface
     */
    public function getCreateAt(): \DateTimeInterface
    {
        return $this->createAt;
    }

    /**
     * Set create date value
     * 
     * @ORM\PrePersist
     * @return self
     */
    public function setCreateAt(): self
    {
        $this->createAt = new \DateTime();

        return $this;
    }

    /**
     * Get update date value
     *
     * @return \DateTimeInterface|null
     */
    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->updateAt;
    }

    /**
     * Set update date value
     * 
     * @ORM\PreUpdate
     * @return self
     */
    public function setUpdateAt(): self
    {
        $this->updateAt = new \DateTime();

        return $this;
    }
}
