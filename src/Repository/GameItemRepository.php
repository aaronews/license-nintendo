<?php

namespace App\Repository;

use App\Entity\GameItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GameItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method GameItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method GameItem[]    findAll()
 * @method GameItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GameItem::class);
    }

    // /**
    //  * @return GameItem[] Returns an array of GameItem objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GameItem
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
