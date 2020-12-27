<?php

namespace App\Tests\Repository;

use App\Entity\Game;
use Doctrine\ORM\Query;
use App\Entity\Item;
use App\Entity\GameItem;
use Doctrine\ORM\QueryBuilder;
use App\Entity\Search\EntityInGame;
use App\Repository\GameItemRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class GameItemRepositoryTest extends KernelTestCase
{
    /**
     * @var GameItemRepository
     */
    private $repository;

    /**
     * @var EntityManager
     */
    private $entityManager;

    protected function setUp(): void
    {
        $this->entityManager = self::bootKernel()->getContainer()->get('doctrine')->getManager();
        $this->repository = $this->entityManager->getRepository(GameItem::class);
    }

    public function testFindBySearchCriterias()
    {
        $search = new EntityInGame();

        $search
            ->setGame($this->entityManager->getRepository(Game::class)->find(1))
        ;
        $this->assertInstanceOf(Query::class, $query = $this->repository->findBySearchCriterias($search));
        $this->assertCount(2, $query->getResult());

        $search
            ->setGame($this->entityManager->getRepository(Game::class)->find(5))
        ;
        $this->assertInstanceOf(Query::class, $query = $this->repository->findBySearchCriterias($search));
        $this->assertCount(4, $query->getResult());

    }

    public function testCountAll()
    {
        $this->assertSame(111, $this->repository->countAll());
    }
    
    public function testFindAllSortByProperty()
    {
        $gameItemsQuery = $this->repository->findAllSortByProperty('id');
        $this->assertInstanceOf(QueryBuilder::class, $gameItemsQuery);
        $this->assertSame($gameItemsQuery->getQuery()->getResult()[0], $this->repository->find(1));
    }
    
    public function testCreateEntity()
    {
        $gameItem = (new GameItem)
            ->setGame($this->entityManager->getRepository(Game::class)->find(1))
            ->setItem($this->entityManager->getRepository(Item::class)->find(1))
            ->setThumbnail('thumbnail')
        ;

        $this->assertSame(111, $this->repository->countAll());
        $this->repository->createEntity($gameItem);
        $this->assertSame(112, $this->repository->countAll());
    }
    
    public function testUpdateEntity()
    {
        $this->assertSame(111, $this->repository->countAll());
        $this->repository->updateEntity($this->repository->find(1));
        $this->assertSame(111, $this->repository->countAll());
    }

    public function testFindItemsByGame(){
        $gameRepository = $this->entityManager->getRepository(Game::class);
        $this->assertCount(2, $this->repository->findItemsByGame($gameRepository->find(1)));
        $this->assertCount(4, $this->repository->findItemsByGame($gameRepository->find(5)));
        $this->assertCount(1, $this->repository->findItemsByGame($gameRepository->find(1), 1));
    }
}
