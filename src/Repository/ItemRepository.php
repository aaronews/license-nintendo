<?php

namespace App\Repository;

use App\Entity\Game;
use App\Entity\Item;
use App\Entity\Search\Item as SearchItem;
use Doctrine\Persistence\ManagerRegistry;

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

    /**
     * Get all items of game sort by name
     *
     * @param Game $game
     * @return Item[]
     */
    public function findItemsByGame(Game $game){
        return $this
            ->createQueryBuilder('I')
            ->join('I.gameItems', 'GI')
            ->where('GI.game = :game')
            ->setParameter('game', $game)
            ->orderBy('I.name', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
}
