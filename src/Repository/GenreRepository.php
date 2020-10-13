<?php

namespace App\Repository;

use App\Entity\Genre;
use Doctrine\Persistence\ManagerRegistry;

class GenreRepository extends AbstractEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Genre::class);
    }
}
