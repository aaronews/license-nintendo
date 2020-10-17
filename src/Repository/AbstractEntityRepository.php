<?php

namespace App\Repository;

use App\Entity\AbstractEntity;
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
     * @return AbstractEntity[]|null
     */
    public function findAllSortByProperty(string $property, string $sort = 'ASC'){
        if(in_array($property, $this->getEntityManager()->getClassMetadata($this->getEntityName())->getColumnNames())){
            return $this->createQueryBuilder('E')
                        ->orderBy('E.' . $property, $sort);
        }
        return null;
    }

}
