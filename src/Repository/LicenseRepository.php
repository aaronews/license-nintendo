<?php

namespace App\Repository;

use App\Entity\License;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Search\License as SearchLicense;

class LicenseRepository extends AbstractEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, License::class);
    }

    /**
     * Undocumented function
     *
     * @param SearchLicense $search
     * @return Query
     */
    public function findBySearchCriterias(SearchLicense $search){
        $query = $this->createQueryBuilder('L');

        if($name = $search->getName()){
            $query
                ->where('L.name LIKE :name')
                ->setParameter('name', '%' . $name . '%')
            ;
        }

        return $query->getQuery();
    }
}
