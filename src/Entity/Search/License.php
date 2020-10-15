<?php

namespace App\Entity\Search;

class License
{
    /**
     * @var string|null
     */
    private $name;

    /**
     * Get name of license
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set name of license
     *
     * @param string|null $name
     * @return self
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
