<?php

namespace App\Test\Entity;

use App\Entity\Character;
use App\Entity\GameCharacter;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\Collections\Collection;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CharacterTest extends KernelTestCase
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
        $character = $this->entityManager->getRepository(Character::class)->find(1);
        $this->assertEquals(1, $character->getId());
        $this->assertInternalType('integer', $character->getId());
    }

    public function testGetGender()
    {
        $character = $this->entityManager->getRepository(Character::class)->find(1);
        $this->assertInternalType('string', $character->getGender());
    }

    public function testSetGender()
    {
        $character = $this->entityManager->getRepository(Character::class)->find(1);
        $this->assertEquals('N', $character->getGender());
        $character->setGender('F');
        $this->assertEquals('F', $character->getGender());
    }

    public function testGetGameCharacters()
    {
        $character = $this->entityManager->getRepository(Character::class)->find(1);
        $this->assertInstanceOf(Collection::class, $character->getGameCharacters());
    }

    public function testAddGameCharacter()
    {
        $character = $this->entityManager->getRepository(Character::class)->find(1);
        $this->assertEquals(3, $character->getGameCharacters()->count());
        $character->addGameCharacter(new GameCharacter());
        $this->assertEquals(4, $character->getGameCharacters()->count());
    }

    public function testRemoveGameCharacter()
    {
        $character = $this->entityManager->getRepository(Character::class)->find(1);
        $this->assertEquals(3, $character->getGameCharacters()->count());
        $character->removeGameCharacter($character->getGameCharacters()->get(0));
        $this->assertEquals(2, $character->getGameCharacters()->count());
    }

    public function testGetName()
    {
        $character = $this->entityManager->getRepository(Character::class)->find(1);
        $this->assertInternalType('string', $character->getName());
    }

    public function testSetName()
    {
        $character = $this->entityManager->getRepository(Character::class)->find(1);
        $character->setName('123');
        $this->assertEquals('123', $character->getName());
    }

    public function testGetDescription()
    {
        $character = $this->entityManager->getRepository(Character::class)->find(1);
        $this->assertInternalType('string', $character->getDescription());
    }

    public function testSetDescription()
    {
        $character = $this->entityManager->getRepository(Character::class)->find(1);
        $character->setDescription('123');
        $this->assertEquals('123', $character->getDescription());
    }

    public function testGetThumbnail()
    {
        $character = $this->entityManager->getRepository(Character::class)->find(1);
        $this->assertInternalType('string', $character->getThumbnail());
    }

    public function testSetThumbnail()
    {
        $character = $this->entityManager->getRepository(Character::class)->find(1);
        $character->setThumbnail('123');
        $this->assertEquals('123', $character->getThumbnail());
    }

    public function testGetSlug()
    {
        $character = $this->entityManager->getRepository(Character::class)->find(1);
        $this->assertInternalType('string', $character->getSlug());
    }

    public function testSetSlug()
    {
        $character = $this->entityManager->getRepository(Character::class)->find(1);
        $character->setSlug('123');
        $this->assertEquals('123', $character->getSlug());
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
        $this->entityManager = null;
    }

}