<?php

namespace App\Entity\Search;

class AbstractSearch
{
    /**
     * @var string|null
     */
    private $name;

    /**
     * @var string|null
     */
    private $orderBy;

    /**
     * @var string|null
     */
    private $orderWay;

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

    /**
     * Get order by value
     *
     * @return string|null
     */
    public function getOrderBy(): ?string
    {
        return $this->orderBy;
    }

    /**
     * Set order by value
     *
     * @param string|null $orderBy
     * @return self
     */
    public function setOrderBy(?string $orderBy): self
    {
        $this->orderBy = $orderBy;

        return $this;
    }

    /**
     * Get order way value
     *
     * @return string|null
     */
    public function getOrderWay(): ?string
    {
        return $this->orderWay;
    }

    /**
     * Set order way value
     *
     * @param string|null $orderWay
     * @return self
     */
    public function setOrderWay(?string $orderWay): self
    {
        $this->orderWay = $orderWay;

        return $this;
    }
}
