<?php

namespace App\Tests\Repository;

use App\Entity\License;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\EntityManager;
use App\Repository\LicenseRepository;
use App\Entity\Search\License as SearchLicense;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class LicenseRepositoryTest extends KernelTestCase
{
    /**
     * @var LicenseRepository
     */
    private $repository;

    /**
     * @var EntityManager
     */
    private $entityManager;

    protected function setUp(): void
    {
        $this->entityManager = self::bootKernel()->getContainer()->get('doctrine')->getManager();
        $this->repository = $this->entityManager->getRepository(License::class);
    }

    public function testFindBySearchCriterias()
    {
        $search = (new SearchLicense())
            ->setName('zelda')
        ;

        $this->assertInstanceOf(Query::class, $query = $this->repository->findBySearchCriterias($search));
        $this->assertSame($query->getResult()[0], $this->repository->findOneBy(['name' => 'The Legend of Zelda']));

        $search->setName('smash');
        $this->assertInstanceOf(Query::class, $query = $this->repository->findBySearchCriterias($search));
        $this->assertSame($query->getResult()[0], $this->repository->findOneBy(['name' => 'Super Smash Bros']));

    }

    public function testCountAll()
    {
        $this->assertSame(5, $this->repository->countAll());
    }
    
    public function testFindAllSortByProperty()
    {
        $licensesQuery = $this->repository->findAllSortByProperty('id');
        $this->assertInstanceOf(QueryBuilder::class, $licensesQuery);
        $this->assertSame($licensesQuery->getQuery()->getResult()[0], $this->repository->find(1));
    }
    
    public function testCreateEntity()
    {
        $license = (new License)
            ->setName('name')
            ->setDescription('description')
            ->setThumbnail('thumbnail')
            ->setLogo('logo')
            ->setSlug('slug')
        ;

        $this->assertSame(5, $this->repository->countAll());
        $this->repository->createEntity($license);
        $this->assertSame(6, $this->repository->countAll());
    }
    
    public function testUpdateEntity()
    {
        $this->assertSame(5, $this->repository->countAll());
        $this->repository->updateEntity($this->repository->find(1));
        $this->assertSame(5, $this->repository->countAll());
    }
}
