<?php

namespace App\Tests\Service;

use App\Entity\Game;
use Doctrine\ORM\Query;
use App\Entity\Item;
use App\Service\ItemsService;
use App\Entity\Search\Item as SearchItem;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ItemsServiceTest extends KernelTestCase
{
    /**
     * @var ItemsService
     */
    private $service;

    /**
     * @var EntityManager
     */
    private $entityManager;

    protected function setUp(): void
    {
        $this->entityManager = self::bootKernel()->getContainer()->get('doctrine')->getManager();
        $this->service = new ItemsService($this->entityManager->getRepository(Item::class), $this->entityManager->getRepository(Game::class));
    }

    public function testHydrateSearch()
    {
        $name = 'name test';
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $searchData = [
            'name' => $name,
            'game' => $game,
        ];

        $search = $this->service->hydrateSearch($searchData, new SearchItem());

        $this->assertSame($name, $search->getName());
        $this->assertSame($game, $search->getGame());
    }

    public function testSaveEntity()
    {
        $item = (new Item)
            ->setName('name')
            ->setDescription('description')
            ->setThumbnail('thumbnail')
            ->setSlug('slug')
        ;

        $this->assertCount(22, $this->service->findAll());
        $this->service->saveEntity($item, false);
        $this->assertCount(23, $this->service->findAll());
        $this->service->saveEntity($item, true);
        $this->assertCount(23, $this->service->findAll());
    }

    public function testFindAll()
    {
        $this->assertCount(22, $items = $this->service->findAll());
        foreach($items as $item){
            $this->assertInstanceOf(Item::class, $item);
        }
    }

    public function testFindBy()
    {
        $this->assertCount(22, $items = $this->service->findBy());
        foreach($items as $item){
            $this->assertInstanceOf(Item::class, $item);
        }

        $this->assertCount(1, $items = $this->service->findBy(['name' => 'Arc']));
        foreach($items as $item){
            $this->assertInstanceOf(Item::class, $item);
        }

        $this->assertEmpty($this->service->findBy(['name' => '123465']));
    }

    public function testFindOneBy()
    {
        $this->assertInstanceOf(Item::class, $this->service->findOneBy(['name' => 'Arc']));
        $this->assertNull($this->service->findOneBy(['name' => '123456']));
    }

    public function testFindBySearchCriterias()
    {
        $search = new SearchItem();

        //name
        $search->setName('arc');
        $this->assertInstanceOf(Query::class, $query = $this->service->findBySearchCriterias($search));
        $this->assertSame($query->getResult()[0], $this->service->findOneBy(['name' => 'Arc']));

        //game
        $search
            ->setName(null)
            ->setGame($this->entityManager->getRepository(Game::class)->find(1))
        ;
        $this->assertInstanceOf(Query::class, $query = $this->service->findBySearchCriterias($search));
        $this->assertCount(2, $items = $query->getResult());
        $this->assertSame($items[0], $this->service->findOneBy(['name' => 'Banane']));
    }
}
