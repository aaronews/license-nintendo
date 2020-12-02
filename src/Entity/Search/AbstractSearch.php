<?php

namespace App\Entity\Search;

abstract class AbstractSearch
{
    /**
     * @var string|null
     */
    protected $name;

    /**
     * Get name value
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set name value
     *
     * @param string|null $name
     * @return self
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    abstract public  function toArray(): array;
}
