<?php

namespace App\Repository;

use App\Entity\Console;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Search\Console as SearchConsole;

class ConsoleRepository extends AbstractEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Console::class);
    }

    /**
     * Undocumented function
     *
     * @param SearchConsole $search
     * @return Query
     */
    public function findBySearchCriterias(SearchConsole $search){
        $query = $this
            ->createQueryBuilder('C')
            ->addOrderBy('C.name', 'ASC')
        ;

        if($name = $search->getName()){
            $query
                ->andWhere('C.name LIKE :name')
                ->setParameter('name', '%' . $name . '%')
            ;
        }

        if($game = $search->getGame()){
            $query
                ->join('C.games', 'G')
                ->andWhere('G.id = :gameId')
                ->setParameter('gameId', $game->getId())
            ;
        }

        if(($releaseDateMin = $search->getReleaseDateMin()) && ($releaseDateMax = $search->getReleaseDateMax())){
            $query
                ->andWhere('C.releaseDate BETWEEN :releaseDateMin AND :releaseDateMax')
                ->setParameter('releaseDateMin', $releaseDateMin)
                ->setParameter('releaseDateMax', $releaseDateMax)
            ;
        }

        if(($releasePriceMin = $search->getReleasePriceMin()) && ($releasePriceMax = $search->getReleasePriceMax())){
            $query
                ->andWhere('C.releasePrice BETWEEN :releasePriceMin AND :releasePriceMax')
                ->setParameter('releasePriceMin', $releasePriceMin)
                ->setParameter('releasePriceMax', $releasePriceMax)
            ;
        }

        return $query->getQuery();
    }
}
