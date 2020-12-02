<?php

namespace App\Service;

use App\Repository\LicenseRepository;
use App\Entity\Search\License as SearchLicense;

class LicensesService extends AbstractEntityService
{
    public function __construct(LicenseRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Hydrate search entity with array data
     *
     * @param array $data
     * @param SearchLicense $search
     * @return SearchLicense
     */
    public function hydrateSearch(array $data, SearchLicense $search):SearchLicense
    {
        foreach($data as $key => $value){
            $setter = 'set' . ucfirst($key);
            $search->$setter($data[$key] ?? null);
        }

        return $search;
    }
}