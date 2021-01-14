<?php

namespace App\Repository;

use App\Entity\Game;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Search\Game as SearchGame;

class GameRepository extends AbstractEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Game::class);
    }

    /**
     * Undocumented function
     *
     * @param SearchGame $search
     * @return Query
     */
    public function findBySearchCriterias(SearchGame $search){
        $query = $this
            ->createQueryBuilder('G')
            ->addOrderBy('G.name', 'ASC')
        ;

        if($name = $search->getName()){
            $query
                ->andWhere('G.name LIKE :name')
                ->setParameter('name', '%' . $name . '%')
            ;
        }

        if($license = $search->getLicense()){
            $query
                ->andWhere('G.license = :license')
                ->setParameter('license', $license)
            ;
        }

        if($console = $search->getConsole()){
            $query
                ->join('G.consoles', 'C')
                ->andWhere('C.id = :consoleId')
                ->setParameter('consoleId', $console->getId())
            ;
        }

        if($genre = $search->getGenre()){
            $query
                ->join('G.genres', 'GE')
                ->andWhere('GE.id = :genreId')
                ->setParameter('genreId', $genre->getId())
            ;
        }

        if(($nbPlayersMin = $search->getNbPlayersMin()) && ($nbPlayersMax = $search->getNbPlayersMax())){
            $query
                ->andWhere('G.nbPlayers BETWEEN :nbPlayersMin AND :nbPlayersMax')
                ->setParameter('nbPlayersMin', $nbPlayersMin)
                ->setParameter('nbPlayersMax', $nbPlayersMax)
            ;
        }

        if(($releaseDateMin = $search->getReleaseDateMin()) && ($releaseDateMax = $search->getReleaseDateMax())){
            $query
                ->andWhere('G.releaseDate BETWEEN :releaseDateMin AND :releaseDateMax')
                ->setParameter('releaseDateMin', $releaseDateMin)
                ->setParameter('releaseDateMax', $releaseDateMax)
            ;
        }

        return $query->getQuery();
    }
}
