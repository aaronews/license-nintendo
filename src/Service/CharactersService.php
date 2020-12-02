<?php

namespace App\Service;

use App\Entity\Game;
use App\Entity\Character;
use App\Entity\Search\Character as SearchCharacter;
use App\Repository\CharacterRepository;
use App\Repository\GameRepository;

class CharactersService extends AbstractEntityService
{
    /**
     * @var GameRepository
     */
    private $gameRepository;

    public function __construct(CharacterRepository $repository, GameRepository $gameRepository)
    {
        $this->repository = $repository;
        $this->gameRepository = $gameRepository;
    }

    /**
     * Hydrate search entity with array data
     *
     * @param array $data
     * @param SearchCharacter $search
     * @return SearchCharacter
     */
    public function hydrateSearch(array $data, SearchCharacter $search):SearchCharacter
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