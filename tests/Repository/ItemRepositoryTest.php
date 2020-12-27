<?php

namespace App\Tests\Repository;

use App\Entity\Game;
use App\Entity\Item;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\EntityManager;
use App\Repository\ItemRepository;
use App\Entity\Search\Item as SearchItem;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ItemRepositoryTest extends KernelTestCase
{
    /**
     * @var ItemRepository
     */
    private $repository;

    /**
     * @var EntityManager
     */
    private $entityManager;

    protected function setUp(): void
    {
        $this->entityManager = self::bootKernel()->getContainer()->get('doctrine')->getManager();
        $this->repository = $this->entityManager->getRepository(Item::class);
    }

    public function testFindBySearchCriterias()
    {
        $search = new SearchItem();

        //name
        $search->setName('arc');
        $this->assertInstanceOf(Query::class, $query = $this->repository->findBySearchCriterias($search));
        $this->assertSame($query->getResult()[0], $this->repository->findOneBy(['name' => 'Arc']));

        //game
        $search
            ->setName(null)
            ->setGame($this->entityManager->getRepository(Game::class)->find(1))
        ;
        $this->assertInstanceOf(Query::class, $query = $this->repository->findBySearchCriterias($search));
        $this->assertCount(2, $items = $query->getResult());
        $this->assertSame($items[0], $this->repository->findOneBy(['name' => 'Banane']));

    }

    public function testCountAll()
    {
        $this->assertSame(22, $this->repository->countAll());
    }
    
    public function testFindAllSortByProperty()
    {
        $itemsQuery = $this->repository->findAllSortByProperty('id');
        $this->assertInstanceOf(QueryBuilder::class, $itemsQuery);
        $this->assertSame($itemsQuery->getQuery()->getResult()[0], $this->repository->find(1));
    }
    
    public function testCreateEntity()
    {
        $item = (new Item)
            ->setName('name')
            ->setDescription('description')
            ->setThumbnail('thumbnail')
            ->setSlug('slug')
        ;

        $this->assertSame(22, $this->repository->countAll());
        $this->repository->createEntity($item);
        $this->assertSame(23, $this->repository->countAll());
    }
    
    public function testUpdateEntity()
    {
        $this->assertSame(22, $this->repository->countAll());
        $this->repository->updateEntity($this->repository->find(1));
        $this->assertSame(22, $this->repository->countAll());
    }
}
