<?php

namespace App\Service;

use App\Entity\Game;
use App\Entity\GameCharacter;
use App\Entity\License;
use App\Entity\Search\Game as SearchGame;
use App\Repository\ConsoleRepository;
use App\Repository\GameRepository;
use App\Repository\GenreRepository;
use App\Repository\LicenseRepository;

class GamesService extends AbstractEntityService 
{
    /**
     * @var GenreRepository
     */
    private $genreRepository;

    /**
     * @var ConsoleRepository
     */
    private $consoleRepository;

    /**
     * @var LicenseRepository
     */
    private $licenseRepository;

    public function __construct(GameRepository $repository, GenreRepository	$genreRepository, ConsoleRepository	$consoleRepository, LicenseRepository $licenseRepository)
    {
        $this->repository = $repository;
        $this->genreRepository = $genreRepository;
        $this->consoleRepository = $consoleRepository;
        $this->licenseRepository = $licenseRepository;
    }

    /**
     * Return best games of license
     *
     * @param License $license
     * @return Games[]
     */
    public function getBestGamesByLicense(License $license)
    {
        return $this->repository->findBy(array('license' => $license), array('copiesSold' => 'DESC'), 4);
    }

    /**
     * Hydrate search entity with array data
     *
     * @param array $data
     * @param SearchGame $search
     * @return SearchGame
     */
    public function hydrateSearch(array $data, SearchGame $search):SearchGame
    {
        foreach($data as $key => $value){
            $repository = null;
            $setter = 'set' . ucfirst($key);
            switch($key){
                case 'genre':
                    $repository = $this->genreRepository;
                    break;
                case 'license':
                    $repository = $this->licenseRepository;
                    break;
                case 'console':
                    $repository = $this->consoleRepository;
                    break;
                default:
                    break;
            }
            
            if($repository && isset($data[$key])){
                $search->$setter(isset($data[$key]) ? $repository->find($data[$key]) : null);
            }else{
                $search->$setter($data[$key] ?? null);
            }
        }

        return $search;
    }
}