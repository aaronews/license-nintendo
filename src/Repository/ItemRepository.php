<?php

namespace App\Repository;

use App\Entity\Item;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Search\Item as SearchItem;

class ItemRepository extends AbstractEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Item::class);
    }

    /**
     * Undocumented function
     *
     * @param SearchItem $search
     * @return Query
     */
    public function findBySearchCriterias(SearchItem $search){
        $query = $this->createQueryBuilder('I');

        if($name = $search->getName()){
            $query
                ->where('I.name LIKE :name')
                ->setParameter('name', '%' . $name . '%')
            ;
        }

        if($game = $search->getGame()){
            $query
                ->join('I.gameItems', 'IG')
                ->andWhere('IG.game = :game')
                ->setParameter('game', $game)
            ;
        }

        return $query->getQuery();
    }
}
