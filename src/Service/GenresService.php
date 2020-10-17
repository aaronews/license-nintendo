<?php

namespace App\Service;

use App\Repository\GenreRepository;

class GenresService extends AbstractEntityService
{
    public function __construct(GenreRepository $repository)
    {
        $this->repository = $repository;
    }
}