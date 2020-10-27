<?php

namespace App\Service;

use App\Entity\Game;
use App\Entity\GameCharacter;
use App\Entity\License;
use App\Repository\GameRepository;

class GamesService extends AbstractEntityService 
{
    public function __construct(GameRepository $repository)
    {
        $this->repository = $repository;
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

    public function getMappingFieldsForSort()
    {
        $columns = parent::getMappingFieldsForSort();
        $ignoreColumns = array('description','thumbnail','slug', 'history');
        $sortOptions = array();

        foreach($columns as $column){
            if(!in_array($column, $ignoreColumns)){
                $sortOptions['games.fields.' . $column] = $column;
            }
        }
        
        return $sortOptions;
    }
}