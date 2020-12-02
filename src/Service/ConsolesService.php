<?php

namespace App\Service;

use App\Repository\GameRepository;
use App\Repository\ConsoleRepository;
use App\Entity\Search\Console as SearchConsole;

class ConsolesService extends AbstractEntityService
{
    /**
     * @var GameRepository
     */
    private $gameRepository;


    public function __construct(ConsoleRepository $repository, GameRepository $gameRepository)
    {
        $this->repository = $repository;
        $this->gameRepository = $gameRepository;
    }

    /**
     * Hydrate search entity with array data
     *
     * @param array $data
     * @param SearchConsole $search
     * @return SearchConsole
     */
    public function hydrateSearch(array $data, SearchConsole $search):SearchConsole
    {
        foreach($data as $key => $value){
            $repository = null;
            $setter = 'set' . ucfirst($key);
            switch($key){
                case 'game':
                    $repository = $this->gameRepository;
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