<?php

namespace App\Repository;

use App\Entity\Game;
use App\Entity\GameItem;
use App\Entity\Search\EntityInGame;
use Doctrine\Persistence\ManagerRegistry;

class GameItemRepository extends AbstractEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GameItem::class);
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
     * Get all items of game sort by name
     *
     * @param Game $game
     * @param int|null $limit
     * @return Item[]
     */
    public function findItemsByGame(Game $game, ?int $limit = null){
        $queryBuilder = $this
            ->createQueryBuilder('GI')
            ->join('GI.item', 'I')
            ->where('GI.game = :game')
            ->setParameter('game', $game)
            ->orderBy('I.name', 'ASC')
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
