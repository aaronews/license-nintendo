<?php

namespace App\Repository;

use App\Entity\Game;
use App\Entity\GameItem;
use Doctrine\Persistence\ManagerRegistry;

class GameItemRepository extends AbstractEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GameItem::class);
    }

    /**
     * Get all items of game sort by name 
     *
     * @param Game $game
     * @return Item[]
     */
    public function findItemsByGame(Game $game){
        return $this
            ->createQueryBuilder('GI')
            ->join('GI.item', 'I')
            ->where('GI.game = :game')
            ->setParameter('game', $game)
            ->orderBy('I.name', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
}
