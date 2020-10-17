<?php

namespace App\Service;

use App\Repository\LicenseRepository;

class LicensesService extends AbstractEntityService
{
    public function __construct(LicenseRepository $repository)
    {
        $this->repository = $repository;
    }
}