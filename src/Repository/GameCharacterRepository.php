<?php

namespace App\Repository;

use App\Entity\GameCharacter;
use Doctrine\Persistence\ManagerRegistry;

class GameCharacterRepository extends AbstractEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GameCharacter::class);
    }
}
