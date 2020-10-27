<?php

namespace App\Repository;

use App\Entity\Game;
use App\Entity\GameCharacter;
use Doctrine\Persistence\ManagerRegistry;

class GameCharacterRepository extends AbstractEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GameCharacter::class);
    }

    /**
     * Get all characters of game sort by name 
     *
     * @param Game $game
     * @return Character[]
     */
    public function findCharactersByGame(Game $game){
        return $this
            ->createQueryBuilder('GC')
            ->join('GC.currentCharacter', 'C')
            ->where('GC.game = :game')
            ->setParameter('game', $game)
            ->orderBy('C.name', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
}
