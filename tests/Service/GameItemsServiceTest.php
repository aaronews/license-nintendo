<?php

namespace App\Tests\Service;

use App\Entity\Game;
use Doctrine\ORM\Query;
use App\Entity\GameItem;
use App\Entity\Item;
use App\Entity\Search\EntityInGame;
use App\Service\GameItemsService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class GameItemsServiceTest extends KernelTestCase
{
    /**
     * @var GameItemsService
     */
    private $service;

    /**
     * @var EntityManager
     */
    private $entityManager;

    protected function setUp(): void
    {
        $this->entityManager = self::bootKernel()->getContainer()->get('doctrine')->getManager();
        $this->service = new GameItemsService($this->entityManager->getRepository(GameItem::class));
    }

    public function testSaveEntity()
    {
        $gameItem = (new GameItem)
            ->setGame($this->entityManager->getRepository(Game::class)->find(1))
            ->setItem($this->entityManager->getRepository(Item::class)->find(1))
            ->setThumbnail('thumbnail')
        ;

        $this->assertCount(111, $this->service->findAll());
        $this->service->saveEntity($gameItem, false);
        $this->assertCount(112, $this->service->findAll());
        $this->service->saveEntity($gameItem, true);
        $this->assertCount(112, $this->service->findAll());
    }

    public function testFindAll()
    {
        $this->assertCount(111, $gameItems = $this->service->findAll());
        foreach($gameItems as $gameItem){
            $this->assertInstanceOf(GameItem::class, $gameItem);
        }
    }

    public function testFindBy()
    {
        $gameRepository = $this->entityManager->getRepository(Game::class);
        $this->assertCount(111, $gameItems = $this->service->findBy());
        foreach($gameItems as $gameItem){
            $this->assertInstanceOf(GameItem::class, $gameItem);
        }

        $this->assertCount(2, $gameItems = $this->service->findBy(['game' => $gameRepository->find(1)]));
        foreach($gameItems as $gameItem){
            $this->assertInstanceOf(GameItem::class, $gameItem);
        }

        $this->assertEmpty($this->service->findBy(['game' => $gameRepository->find(30)]));
    }

    public function testFindOneBy()
    {
        $gameRepository = $this->entityManager->getRepository(Game::class);
        $this->assertInstanceOf(GameItem::class, $this->service->findOneBy(['game' => $gameRepository->find(1)]));
        $this->assertNull($this->service->findOneBy(['game' => $gameRepository->find(30)]));
    }

    public function testFindBySearchCriterias()
    {
        $search = new EntityInGame();

        $search
            ->setGame($this->entityManager->getRepository(Game::class)->find(1))
        ;
        $this->assertInstanceOf(Query::class, $query = $this->service->findBySearchCriterias($search));
        $this->assertCount(2, $query->getResult());

        $search
            ->setGame($this->entityManager->getRepository(Game::class)->find(5))
        ;
        $this->assertInstanceOf(Query::class, $query = $this->service->findBySearchCriterias($search));
        $this->assertCount(4, $query->getResult());
    }

    public function testGetItemsByGame()
    {
        $gameRepository = $this->entityManager->getRepository(Game::class);
        $this->assertCount(2, $this->service->getItemsByGame($gameRepository->find(1)));
        $this->assertCount(4, $this->service->getItemsByGame($gameRepository->find(5)));
        $this->assertCount(1, $this->service->getItemsByGame($gameRepository->find(1), 1));
    }
}
