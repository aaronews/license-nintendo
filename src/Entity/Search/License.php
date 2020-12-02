<?php

namespace App\Entity\Search;

class License extends AbstractSearch
{

    /**
     * Convert entity to array
     *
     * @return array
     */
    public  function toArray(): array{
        return [
            'name' => $this->name,
        ];
    }
}
