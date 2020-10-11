<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass
 */
abstract class AbstractEntity
{

    /**
     * @ORM\Column(type="datetime")
     */
    private $createAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updateAt;

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->createAt;
    }

    /**
     * @ORM\PrePersist
     * @return self
     */
    public function setCreateAt(): self
    {
        $this->createAt = new \DateTime();

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->updateAt;
    }

    /**
     * @ORM\PreUpdate
     * @return self
     */
    public function setUpdateAt(): self
    {
        $this->updateAt = new \DateTime();

        return $this;
    }
}
