<?php

namespace App\Test\Entity;

use App\Entity\Game;
use App\Entity\Character;
use App\Entity\GameCharacter;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class GameCharacterTest extends KernelTestCase
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
        $game = $this->entityManager->getRepository(GameCharacter::class)->find(1);
        $this->assertEquals(1, $game->getId());
        $this->assertInternalType('integer', $game->getId());
    }


    public function testGetThumbnail()
    {
        $game = $this->entityManager->getRepository(GameCharacter::class)->find(1);
        $this->assertInternalType('string', $game->getThumbnail());
    }

    public function testSetThumbnail()
    {
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $game->setThumbnail('123');
        $this->assertEquals('123', $game->getThumbnail());
    }

    public function testGetGame()
    {
        $gameCharacter = $this->entityManager->getRepository(GameCharacter::class)->find(1);
        $this->assertInstanceOf(Game::class, $gameCharacter->getGame());
    }

    public function testSetGame()
    {
        $gameCharacter = $this->entityManager->getRepository(GameCharacter::class)->find(1);
        $game = $this->entityManager->getRepository(Game::class)->find(2);
        $gameCharacter->setGame($game);
        $this->assertEquals($game, $gameCharacter->getGame());
    }

    public function testGetCurrentCharacter()
    {
        $gameCharacter = $this->entityManager->getRepository(GameCharacter::class)->find(1);
        $this->assertInstanceOf(Character::class, $gameCharacter->getCurrentCharacter());
    }

    public function testSetCurrentCharacter()
    {
        $gameCharacter = $this->entityManager->getRepository(GameCharacter::class)->find(1);
        $game = $this->entityManager->getRepository(Character::class)->find(2);
        $gameCharacter->setCurrentCharacter($game);
        $this->assertEquals($game, $gameCharacter->getCurrentCharacter());
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
        $this->entityManager = null;
    }

}