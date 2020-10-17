<?php

namespace App\Service;

use App\Repository\CharacterRepository;

class CharactersService extends AbstractEntityService
{
    public function __construct(CharacterRepository $repository)
    {
        $this->repository = $repository;
    }
}