<?php

namespace App\Service;

use App\Repository\LicenseRepository;

class LicencesService 
{
    private $repository;

    public function __construct(LicenseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function findAll(){
        return $this->repository->findAll();
    }
}