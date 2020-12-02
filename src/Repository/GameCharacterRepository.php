<?php

namespace App\Repository;

use App\Entity\Game;
use App\Entity\GameCharacter;
use App\Entity\Search\EntityInGame;
use Doctrine\Persistence\ManagerRegistry;

class GameCharacterRepository extends AbstractEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GameCharacter::class);
    }

    /**
     * Undocumented function
     *
     * @param EntityInGame $search
     * @return Query
     */
    public function findBySearchCriterias(EntityInGame $search){
        $query = $this->createQueryBuilder('GC');

        if($game = $search->getGame()){
            $query
                ->andWhere('GC.game = :game')
                ->setParameter('game', $game)
            ;
        }

        return $query->getQuery();
    }

    /**
     * Get all characaters of game sort by name
     *
     * @param Game $game
     * @param int|null $limit
     * @return Character[]
     */
    public function findCharactersByGame(Game $game, ?int $limit = null){
        $queryBuilder = $this
            ->createQueryBuilder('GC')
            ->join('GC.currentCharacter', 'C')
            ->where('GC.game = :game')
            ->setParameter('game', $game)
            ->orderBy('C.name', 'ASC')
        ;

        if($limit){
            $queryBuilder->setMaxResults($limit);
        }
        
        return $queryBuilder
            ->getQuery()
            ->getResult()
        ;
    }
}
