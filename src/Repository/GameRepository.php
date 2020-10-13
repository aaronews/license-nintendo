<?php

namespace App\Repository;

use App\Entity\Game;
use Doctrine\Persistence\ManagerRegistry;

class GameRepository extends AbstractEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Game::class);
    }
}
