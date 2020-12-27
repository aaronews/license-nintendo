<?php

namespace App\Tests\Repository;

use App\Entity\Game;
use Doctrine\ORM\Query;
use App\Entity\Console;
use Doctrine\ORM\QueryBuilder;
use App\Repository\ConsoleRepository;
use App\Entity\Search\Console as SearchConsole;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


class ConsoleRepositoryTest extends KernelTestCase
{
    /**
     * @var ConsoleRepository
     */
    private $repository;

    /**
     * @var EntityManager
     */
    private $entityManager;

    protected function setUp(): void
    {
        $this->entityManager = self::bootKernel()->getContainer()->get('doctrine')->getManager();
        $this->repository = $this->entityManager->getRepository(Console::class);
    }

    public function testFindBySearchCriterias()
    {
        $search = new SearchConsole();

        //name
        $search->setName('cube');
        $this->assertInstanceOf(Query::class, $query = $this->repository->findBySearchCriterias($search));
        $this->assertSame($query->getResult()[0], $this->repository->findOneBy(['name' => 'GameCube']));

        //game
        $search
            ->setName(null)
            ->setGame($this->entityManager->getRepository(Game::class)->find(1))
        ;
        $this->assertInstanceOf(Query::class, $query = $this->repository->findBySearchCriterias($search));
        $this->assertCount(2, $consoles = $query->getResult());
        $this->assertSame($consoles[0], $this->repository->findOneBy(['name' => 'Nintendo 64']));

        //release date
        $search
            ->setGame(null)
            ->setReleaseDateMin((new \DateTime())->setDate(1995,1,1))
            ->setReleaseDateMax((new \DateTime())->setDate(2000,1,1))
        ;
        $this->assertInstanceOf(Query::class, $query = $this->repository->findBySearchCriterias($search));
        $this->assertCount(2, $consoles = $query->getResult());
        $this->assertSame($consoles[0], $this->repository->findOneBy(['name' => 'Game Boy Color']));

    }

    public function testCountAll()
    {
        $this->assertSame(14, $this->repository->countAll());
    }
    
    public function testFindAllSortByProperty()
    {
        $consolesQuery = $this->repository->findAllSortByProperty('id');
        $this->assertInstanceOf(QueryBuilder::class, $consolesQuery);
        $this->assertSame($consolesQuery->getQuery()->getResult()[0], $this->repository->find(1));
    }
    
    public function testCreateEntity()
    {
        $console = (new Console)
            ->setName('name')
            ->setDescription('description')
            ->setThumbnail('thumbnail')
            ->setSlug('slug')
            ->setReleaseDate(new \DateTime())
            ->setReleasePrice(666)
        ;

        $this->assertSame(14, $this->repository->countAll());
        $this->repository->createEntity($console);
        $this->assertSame(15, $this->repository->countAll());
    }
    
    public function testUpdateEntity()
    {
        $this->assertSame(14, $this->repository->countAll());
        $this->repository->updateEntity($this->repository->find(1));
        $this->assertSame(14, $this->repository->countAll());
    }
}
