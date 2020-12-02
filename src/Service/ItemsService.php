<?php

namespace App\Service;

use App\Entity\Game;
use App\Entity\Item;
use App\Entity\Search\Item as SearchItem;
use App\Repository\GameRepository;
use App\Repository\ItemRepository;

class ItemsService extends AbstractEntityService 
{
    /**
     * @var GameRepository
     */
    private $gameRepository;

    public function __construct(ItemRepository $repository, GameRepository $gameRepository)
    {
        $this->repository = $repository;
        $this->gameRepository = $gameRepository;
    }

    /**
     * Hydrate search entity with array data
     *
     * @param array $data
     * @param SearchItem $search
     * @return SearchItem
     */
    public function hydrateSearch(array $data, SearchItem $search):SearchItem
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