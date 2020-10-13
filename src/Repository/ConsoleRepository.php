<?php

namespace App\Repository;

use App\Entity\Console;
use Doctrine\Persistence\ManagerRegistry;

class ConsoleRepository extends AbstractEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Console::class);
    }
}
