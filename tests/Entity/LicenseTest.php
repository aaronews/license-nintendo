<?php

namespace App\Test\Entity;

use App\Entity\Game;
use App\Entity\License;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\Collections\Collection;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class LicenseTest extends KernelTestCase
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
        $license = $this->entityManager->getRepository(License::class)->find(1);
        $this->assertEquals(1, $license->getId());
        $this->assertInternalType('integer', $license->getId());
    }

    public function testGetGames()
    {
        $license = $this->entityManager->getRepository(License::class)->find(1);
        $this->assertInstanceOf(Collection::class, $license->getGames());
    }

    public function testAddGame()
    {
        $license = $this->entityManager->getRepository(License::class)->find(1);
        $this->assertEquals(4, $license->getGames()->count());
        $license->addGame(new Game());
        $this->assertEquals(5, $license->getGames()->count());
    }

    public function testRemoveGame()
    {
        $license = $this->entityManager->getRepository(License::class)->find(1);
        $this->assertEquals(4, $license->getGames()->count());
        $license->removeGame($license->getGames()->get(0));
        $this->assertEquals(3, $license->getGames()->count());
    }

    public function testGetName()
    {
        $license = $this->entityManager->getRepository(License::class)->find(1);
        $this->assertInternalType('string', $license->getName());
    }

    public function testSetName()
    {
        $license = $this->entityManager->getRepository(License::class)->find(1);
        $license->setName('123');
        $this->assertEquals('123', $license->getName());
    }

    public function testGetDescription()
    {
        $license = $this->entityManager->getRepository(License::class)->find(1);
        $this->assertInternalType('string', $license->getDescription());
    }

    public function testSetDescription()
    {
        $license = $this->entityManager->getRepository(License::class)->find(1);
        $license->setDescription('123');
        $this->assertEquals('123', $license->getDescription());
    }

    public function testGetThumbnail()
    {
        $license = $this->entityManager->getRepository(License::class)->find(1);
        $this->assertInternalType('string', $license->getThumbnail());
    }

    public function testSetThumbnail()
    {
        $license = $this->entityManager->getRepository(License::class)->find(1);
        $license->setThumbnail('123');
        $this->assertEquals('123', $license->getThumbnail());
    }

    public function testGetSlug()
    {
        $license = $this->entityManager->getRepository(License::class)->find(1);
        $this->assertInternalType('string', $license->getSlug());
    }

    public function testSetSlug()
    {
        $license = $this->entityManager->getRepository(License::class)->find(1);
        $license->setSlug('123');
        $this->assertEquals('123', $license->getSlug());
    }

    public function testGetLogo()
    {
        $license = $this->entityManager->getRepository(License::class)->find(1);
        $this->assertInternalType('string', $license->getLogo());
    }

    public function testSetLogo()
    {
        $license = $this->entityManager->getRepository(License::class)->find(1);
        $license->setLogo('123');
        $this->assertEquals('123', $license->getLogo());
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
        $this->entityManager = null;
    }

}