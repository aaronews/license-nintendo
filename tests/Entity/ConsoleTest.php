<?php

namespace App\Test\Entity;

use App\Entity\Game;
use App\Entity\Console;
use App\Entity\GameConsole;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\Collections\Collection;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ConsoleTest extends KernelTestCase
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
        $console = $this->entityManager->getRepository(Console::class)->find(1);
        $this->assertEquals(1, $console->getId());
        $this->assertInternalType('integer', $console->getId());
    }

    public function testGetGames()
    {
        $console = $this->entityManager->getRepository(Console::class)->find(1);
        $this->assertInstanceOf(Collection::class, $console->getGames());
    }

    public function testAddGame()
    {
        $console = $this->entityManager->getRepository(Console::class)->find(1);
        $this->assertEquals(6, $console->getGames()->count());
        $console->addGame(new Game());
        $this->assertEquals(7, $console->getGames()->count());
    }

    public function testRemoveGame()
    {
        $console = $this->entityManager->getRepository(Console::class)->find(1);
        $this->assertEquals(6, $console->getGames()->count());
        $console->removeGame($console->getGames()->get(0));
        $this->assertEquals(5, $console->getGames()->count());
    }

    public function testGetName()
    {
        $console = $this->entityManager->getRepository(Console::class)->find(1);
        $this->assertInternalType('string', $console->getName());
    }

    public function testSetName()
    {
        $console = $this->entityManager->getRepository(Console::class)->find(1);
        $console->setName('123');
        $this->assertEquals('123', $console->getName());
    }

    public function testGetDescription()
    {
        $console = $this->entityManager->getRepository(Console::class)->find(1);
        $this->assertInternalType('string', $console->getDescription());
    }

    public function testSetDescription()
    {
        $console = $this->entityManager->getRepository(Console::class)->find(1);
        $console->setDescription('123');
        $this->assertEquals('123', $console->getDescription());
    }

    public function testGetThumbnail()
    {
        $console = $this->entityManager->getRepository(Console::class)->find(1);
        $this->assertInternalType('string', $console->getThumbnail());
    }

    public function testSetThumbnail()
    {
        $console = $this->entityManager->getRepository(Console::class)->find(1);
        $console->setThumbnail('123');
        $this->assertEquals('123', $console->getThumbnail());
    }

    public function testGetSlug()
    {
        $console = $this->entityManager->getRepository(Console::class)->find(1);
        $this->assertInternalType('string', $console->getSlug());
    }

    public function testSetSlug()
    {
        $console = $this->entityManager->getRepository(Console::class)->find(1);
        $console->setSlug('123');
        $this->assertEquals('123', $console->getSlug());
    }

    public function testGetReleaseDate()
    {
        $console = $this->entityManager->getRepository(Console::class)->find(1);
        $this->assertInstanceOf(\DateTime::class, $console->getReleaseDate());
    }

    public function testSetReleaseDate()
    {
        $console = $this->entityManager->getRepository(Console::class)->find(1);
        $now = new \DateTime();
        $console->setReleaseDate($now);
        $this->assertEquals($now, $console->getReleaseDate());
    }

    public function testGetReleasePrice()
    {
        $console = $this->entityManager->getRepository(Console::class)->find(1);
        $this->assertInternalType('integer', $console->getReleasePrice());
    }

    public function testSetReleasePrice()
    {
        $console = $this->entityManager->getRepository(Console::class)->find(1);
        $console->setReleasePrice(666);
        $this->assertEquals(666, $console->getReleasePrice());
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
        $this->entityManager = null;
    }

}