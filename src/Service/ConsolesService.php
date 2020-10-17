<?php

namespace App\Service;

use App\Repository\ConsoleRepository;

class ConsolesService extends AbstractEntityService
{
    public function __construct(ConsoleRepository $repository)
    {
        $this->repository = $repository;
    }
}