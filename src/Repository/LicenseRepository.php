<?php

namespace App\Repository;

use App\Entity\License;
use Doctrine\Persistence\ManagerRegistry;

class LicenseRepository extends AbstractEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, License::class);
    }
}
