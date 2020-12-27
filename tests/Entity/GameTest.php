<?php

namespace App\Test\Entity;

use App\Entity\Game;
use App\Entity\Item;
use App\Entity\Genre;
use App\Entity\Console;
use App\Entity\License;
use App\Entity\GameItem;
use App\Entity\GameCharacter;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\Collections\Collection;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class GameTest extends KernelTestCase
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
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $this->assertEquals(1, $game->getId());
        $this->assertInternalType('integer', $game->getId());
    }

    public function testGetName()
    {
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $this->assertInternalType('string', $game->getName());
    }

    public function testSetName()
    {
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $game->setName('123');
        $this->assertEquals('123', $game->getName());
    }

    public function testGetDescription()
    {
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $this->assertInternalType('string', $game->getDescription());
    }

    public function testSetDescription()
    {
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $game->setDescription('123');
        $this->assertEquals('123', $game->getDescription());
    }

    public function testGetThumbnail()
    {
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $this->assertInternalType('string', $game->getThumbnail());
    }

    public function testSetThumbnail()
    {
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $game->setThumbnail('123');
        $this->assertEquals('123', $game->getThumbnail());
    }

    public function testGetSlug()
    {
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $this->assertInternalType('string', $game->getSlug());
    }

    public function testSetSlug()
    {
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $game->setSlug('123');
        $this->assertEquals('123', $game->getSlug());
    }

    public function testGetHistory()
    {
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $this->assertInternalType('string', $game->getHistory());
    }

    public function testSetHistory()
    {
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $game->setHistory('123');
        $this->assertEquals('123', $game->getHistory());
        $game->setHistory(null);
        $this->assertNull($game->getHistory());
    }

    public function testGetReleaseDate()
    {
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $this->assertInstanceOf(\DateTime::class, $game->getReleaseDate());
    }

    public function testSetReleaseDate()
    {
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $now = new \DateTime();
        $game->setReleaseDate($now);
        $this->assertEquals($now, $game->getReleaseDate());
    }

    public function testGetNbPlayers()
    {
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $this->assertInternalType('integer', $game->getNbPlayers());
    }

    public function testSetNbPlayers()
    {
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $game->setNbPlayers(4);
        $this->assertEquals(4, $game->getNbPlayers());
    }

    public function testGetLicense()
    {
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $this->assertInstanceOf(License::class, $game->getLicense());
    }

    public function testSetLicense()
    {
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $licence = $this->entityManager->getRepository(License::class)->find(2);
        $game->setLicense($licence);
        $this->assertEquals($licence, $game->getLicense());
    }

    public function testGetConsoles()
    {
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $this->assertInstanceOf(Collection::class, $game->getConsoles());
    }

    public function testAddConsole()
    {
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $this->assertEquals(2, $game->getConsoles()->count());
        $game->addConsole(new Console());
        $this->assertEquals(3, $game->getConsoles()->count());
    }

    public function testRemoveConsole()
    {
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $this->assertEquals(2, $game->getConsoles()->count());
        $game->removeConsole($game->getConsoles()->get(0));
        $this->assertEquals(1, $game->getConsoles()->count());
    }

    public function testGetGenres()
    {
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $this->assertInstanceOf(Collection::class, $game->getGenres());
    }

    public function testAddGenre()
    {
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $this->assertEquals(2, $game->getGenres()->count());
        $game->addGenre(new Genre());
        $this->assertEquals(3, $game->getGenres()->count());
    }

    public function testRemoveGenre()
    {
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $this->assertEquals(2, $game->getGenres()->count());
        $game->removeGenre($game->getGenres()->get(0));
        $this->assertEquals(1, $game->getGenres()->count());
    }

    public function testGetGameItems()
    {
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $this->assertInstanceOf(Collection::class, $game->getGameItems());
    }

    public function testAddGameItem()
    {
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $this->assertEquals(2, $game->getGameItems()->count());
        $game->addGameItem(new GameItem());
        $this->assertEquals(3, $game->getGameItems()->count());
    }

    public function testRemoveGameItem()
    {
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $this->assertEquals(2, $game->getGameItems()->count());
        $game->removeGameItem($game->getGameItems()->get(0));
        $this->assertEquals(1, $game->getGameItems()->count());
    }

    public function testGetGameCharacters()
    {
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $this->assertInstanceOf(Collection::class, $game->getGameCharacters());
    }

    public function testAddGameCharacter()
    {
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $this->assertEquals(4, $game->getGameCharacters()->count());
        $game->addGameCharacter(new GameCharacter());
        $this->assertEquals(5, $game->getGameCharacters()->count());
    }

    public function testRemoveGameCharacter()
    {
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $this->assertEquals(4, $game->getGameCharacters()->count());
        $game->removeGameCharacter($game->getGameCharacters()->get(0));
        $this->assertEquals(3, $game->getGameCharacters()->count());
    }

    public function testGetCopiesSold()
    {
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $this->assertInternalType('integer', $game->getCopiesSold());
    }

    public function testSetCopiesSold()
    {
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $game->setCopiesSold(666);
        $this->assertEquals(666, $game->getCopiesSold());
    }

    public function testGetBackgroundDesktop()
    {
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $this->assertInternalType('string', $game->getBackgroundDesktop());
    }

    public function testSetBackgroundDesktop()
    {
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $game->setBackgroundDesktop('123');
        $this->assertEquals('123', $game->getBackgroundDesktop());
    }
    
    public function testGetBackgroundMobile()
    {
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $this->assertInternalType('string', $game->getBackgroundMobile());
    }

    public function testSetBackgroundMobile()
    {
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $game->setBackgroundMobile('123');
        $this->assertEquals('123', $game->getBackgroundMobile());
    }
    
    public function testGetBackgroundPosition()
    {
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $this->assertInternalType('string', $game->getBackgroundPosition());
    }

    public function testSetBackgroundPosition()
    {
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $game->setBackgroundPosition('center');
        $this->assertEquals('center', $game->getBackgroundPosition());
    }

    public function testGetFirstBlockMinHeight()
    {
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $this->assertInternalType('integer', $game->getFirstBlockMinHeight());
    }

    public function testSetFirstBlockMinHeight()
    {
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $game->setFirstBlockMinHeight(500);
        $this->assertEquals(500, $game->getFirstBlockMinHeight());
    }

    public function testGetAfterBottom()
    {
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $this->assertInternalType('integer', $game->getAfterBottom());
    }

    public function testSetAfterBottom()
    {
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $game->setAfterBottom(-250);
        $this->assertEquals(-250, $game->getAfterBottom());
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
        $this->entityManager = null;
    }

}