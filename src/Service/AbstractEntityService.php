<?php

namespace App\Service;

use Doctrine\ORM\Query;
use App\Entity\AbstractEntity;
use App\Entity\Search\AbstractSearch;
use App\Repository\AbstractEntityRepository;

abstract class AbstractEntityService{

    /**
     * @var AbstractEntityRepository
     */
    protected $repository;

    /**
     * Insert or update entity in database
     *
     * @param AbstractEntity $entity
     * @param boolean $exist
     * @return void
     */
    public function saveEntity(AbstractEntity $entity, bool $exist)
    {
        if($exist){
            $this->repository->updateEntity($entity);
        }else{
            $this->repository->createEntity($entity);
        }
        return;
    }

    /**
     * Remove enetity in database
     *
     * @param AbstractEntity $entity
     * @return void
     */
    public function removeEntity(AbstractEntity $entity)
    {
        $this->repository->removeEntity($entity);
        return;
    }

    /**
     * Finds all entities in the repository.
     *
     * @return AbstractEntity[]
     */
    public function findAll(array $sortOptions = array())
    {
        return $this->repository->findBy(array(), $sortOptions);
    }

    /**
     * Find entities by criterias
     *
     * @param AbstractSearch $search
     * @return Query
     */
    public function findBySearchCriterias(AbstractSearch $search){
        return $this->repository->findBySearchCriterias($search);
    }

    /**
     * Get columns list for sort
     *
     * @return array
     */
    public function getMappingFieldsForSort()
    {
        $columns = $this->repository->getColumnNames();
        
        $ignoreColumns = array('create_at','update_at','id');

        foreach($columns as $key => $column){
            if(in_array($column, $ignoreColumns)){
                unset($columns[$key]);
            }
        }
        return $columns;
    }
}