<?php

namespace App\Test\Entity;

use App\Entity\Game;
use App\Entity\Item;
use App\Entity\GameItem;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class GameItemTest extends KernelTestCase
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    protected function setUp(): void
    {
        $this->entityManager = self::bootKernel()->getContainer()->get('doctrine')->getManager();
    }

    public function testGetId()
    {
        $game = $this->entityManager->getRepository(GameItem::class)->find(1);
        $this->assertEquals(1, $game->getId());
        $this->assertInternalType('integer', $game->getId());
    }


    public function testGetThumbnail()
    {
        $game = $this->entityManager->getRepository(GameItem::class)->find(1);
        $this->assertInternalType('string', $game->getThumbnail());
    }

    public function testSetThumbnail()
    {
        $game = $this->entityManager->getRepository(GameItem::class)->find(1);
        $game->setThumbnail('123');
        $this->assertEquals('123', $game->getThumbnail());
    }

    public function testGetGame()
    {
        $gameItem = $this->entityManager->getRepository(GameItem::class)->find(1);
        $this->assertInstanceOf(Game::class, $gameItem->getGame());
    }

    public function testSetGame()
    {
        $gameItem = $this->entityManager->getRepository(GameItem::class)->find(1);
        $game = $this->entityManager->getRepository(Game::class)->find(2);
        $gameItem->setGame($game);
        $this->assertEquals($game, $gameItem->getGame());
    }

    public function testGetItem()
    {
        $gameItem = $this->entityManager->getRepository(GameItem::class)->find(1);
        $this->assertInstanceOf(Item::class, $gameItem->getItem());
    }

    public function testSetItem()
    {
        $gameItem = $this->entityManager->getRepository(GameItem::class)->find(1);
        $game = $this->entityManager->getRepository(Item::class)->find(2);
        $gameItem->setItem($game);
        $this->assertEquals($game, $gameItem->getItem());
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
        $this->entityManager = null;
    }

}