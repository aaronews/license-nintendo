<?php

namespace App\Repository;

use App\Entity\GameItem;
use Doctrine\Persistence\ManagerRegistry;

class GameItemRepository extends AbstractEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GameItem::class);
    }
}
