<?php

namespace App\Repository;

use App\Entity\Character;
use Doctrine\Persistence\ManagerRegistry;

class CharacterRepository extends AbstractEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Character::class);
    }
}
