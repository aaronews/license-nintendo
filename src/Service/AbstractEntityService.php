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
    public function findAll()
    {
        return $this->repository->findAll();
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
}