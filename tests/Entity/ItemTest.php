<?php

namespace App\Test\Entity;

use App\Entity\Item;
use App\Entity\GameItem;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\Collections\Collection;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ItemTest extends KernelTestCase
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
        $item = $this->entityManager->getRepository(Item::class)->find(1);
        $this->assertEquals(1, $item->getId());
        $this->assertInternalType('integer', $item->getId());
    }

    public function testGetGameItems()
    {
        $item = $this->entityManager->getRepository(Item::class)->find(1);
        $this->assertInstanceOf(Collection::class, $item->getGameItems());
    }

    public function testAddGameItem()
    {
        $item = $this->entityManager->getRepository(Item::class)->find(1);
        $this->assertEquals(5, $item->getGameItems()->count());
        $item->addGameItem(new GameItem());
        $this->assertEquals(6, $item->getGameItems()->count());
    }

    public function testRemoveGameItem()
    {
        $item = $this->entityManager->getRepository(Item::class)->find(1);
        $this->assertEquals(5, $item->getGameItems()->count());
        $item->removeGameItem($item->getGameItems()->get(0));
        $this->assertEquals(4, $item->getGameItems()->count());
    }

    public function testGetName()
    {
        $item = $this->entityManager->getRepository(Item::class)->find(1);
        $this->assertInternalType('string', $item->getName());
    }

    public function testSetName()
    {
        $item = $this->entityManager->getRepository(Item::class)->find(1);
        $item->setName('123');
        $this->assertEquals('123', $item->getName());
    }

    public function testGetDescription()
    {
        $item = $this->entityManager->getRepository(Item::class)->find(1);
        $this->assertInternalType('string', $item->getDescription());
    }

    public function testSetDescription()
    {
        $item = $this->entityManager->getRepository(Item::class)->find(1);
        $item->setDescription('123');
        $this->assertEquals('123', $item->getDescription());
    }

    public function testGetThumbnail()
    {
        $item = $this->entityManager->getRepository(Item::class)->find(1);
        $this->assertInternalType('string', $item->getThumbnail());
    }

    public function testSetThumbnail()
    {
        $item = $this->entityManager->getRepository(Item::class)->find(1);
        $item->setThumbnail('123');
        $this->assertEquals('123', $item->getThumbnail());
    }

    public function testGetSlug()
    {
        $item = $this->entityManager->getRepository(Item::class)->find(1);
        $this->assertInternalType('string', $item->getSlug());
    }

    public function testSetSlug()
    {
        $item = $this->entityManager->getRepository(Item::class)->find(1);
        $item->setSlug('123');
        $this->assertEquals('123', $item->getSlug());
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
        $this->entityManager = null;
    }

}