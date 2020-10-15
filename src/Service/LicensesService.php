<?php

namespace App\Service;

use App\Entity\License;
use App\Repository\LicenseRepository;
use App\Entity\Search\License as SearchLicense;

class LicensesService 
{
    private $repository;

    public function __construct(LicenseRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Undocumented function
     *
     * @return License
     */
    public function findAll(){
        return $this->repository->findAll();
    }

    public function findBySearchCriterias(SearchLicense $search){
        return $this->repository->findBySearchCriterias($search);
    }
}