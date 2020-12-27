<?php

namespace App\Repository;

use Doctrine\ORM\Query;
use App\Entity\AbstractEntity;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

abstract class AbstractEntityRepository extends ServiceEntityRepository
{
    /**
     * Persist an entity in database
     *
     * @param AbstractEntity $entity
     * @return void
     */
    public function createEntity(AbstractEntity $entity)
    {
        $manager = $this->getEntityManager();
        $manager->persist($entity);
        $manager->flush();
    }

    /**
     * Update an entity in database
     *
     * @param AbstractEntity $entity
     * @return void
     */
    public function updateEntity(AbstractEntity $entity)
    {
        $this->getEntityManager()->flush();
    }

    /**
     * Remove an entity in database
     *
     * @param AbstractEntity $entity
     * @return void
     */
    public function removeEntity(AbstractEntity $entity)
    {
        $manager = $this->getEntityManager();
        $manager->remove($entity);
        $manager->flush();
    }

    /**
     * Find all entities sort by property is property exists in entity class
     *
     * @param string $property
     * @param string $sort
     * @return QueryBuilder|null
     */
    public function findAllSortByProperty(string $property, string $sort = 'ASC'){
        if(in_array($property, $this->getColumnNames())){
            return $this->createQueryBuilder('E')
                        ->orderBy('E.' . $property, $sort);
        }
        return null;
    }

    /**
     * Get colum names of entity table
     *
     * @return array
     */
    public function getColumnNames(){
        return $this->getEntityManager()->getClassMetadata($this->getEntityName())->getColumnNames();
    }

    /**
     * Return query without parameters
     * @return Query
     */
    public function getQueryForPagination(){
        return $this->createQueryBuilder('E')
        ->orderBy('E.name', 'ASC')
        ->getQuery();
    }

    /**
     * Count all entity
     *
     * @return integer
     */
    public function countAll(){
        return (int) $this
            ->createQueryBuilder('E')
            ->select('COUNT(E.id)')
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

}
