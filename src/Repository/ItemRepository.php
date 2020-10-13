<?php

namespace App\Repository;

use App\Entity\Item;
use Doctrine\Persistence\ManagerRegistry;

class ItemRepository extends AbstractEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Item::class);
    }
}
