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
}
