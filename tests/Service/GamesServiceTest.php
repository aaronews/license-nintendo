<?php

namespace App\Tests\Service;

use App\Entity\Game;
use App\Entity\Genre;
use App\Entity\Console;
use App\Entity\License;
use Doctrine\ORM\Query;
use App\Service\GamesService;
use App\Entity\Search\Game as SearchGame;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class GamesServiceTest extends KernelTestCase
{
    /**
     * @var GamesService
     */
    private $service;

    /**
     * @var EntityManager
     */
    private $entityManager;

    protected function setUp(): void
    {
        $this->entityManager = self::bootKernel()->getContainer()->get('doctrine')->getManager();
        $this->service = new GamesService($this->entityManager->getRepository(Game::class), $this->entityManager->getRepository(Genre::class), $this->entityManager->getRepository(Console::class), $this->entityManager->getRepository(License::class));
    }

    public function testHydrateSearch()
    {
        $name = 'name test';
        $genre = $this->entityManager->getRepository(Genre::class)->find(1);
        $console = $this->entityManager->getRepository(Console::class)->find(1);
        $license = $this->entityManager->getRepository(License::class)->find(1);
        $releaseDateMax = (new \DateTime())->setDate(2020, 1, 1);
        $releaseDateMin = (new \DateTime())->setDate(2000, 12, 31);
        $nbPlayersMax = 1;
        $nbPlayersMin = 4;
        $searchData = [
            'name' => $name,
            'genre' => $genre,
            'console' => $console,
            'license' => $license,
            'nbPlayersMax' => $nbPlayersMax,
            'nbPlayersMin' => $nbPlayersMin,
            'releaseDateMax' => $releaseDateMax,
            'releaseDateMin' => $releaseDateMin,
        ];

        $search = $this->service->hydrateSearch($searchData, new SearchGame());

        $this->assertSame($name, $search->getName());
        $this->assertSame($genre, $search->getGenre());
        $this->assertSame($releaseDateMax, $search->getReleaseDateMax());
        $this->assertSame($releaseDateMin, $search->getReleaseDateMin());
        $this->assertSame($nbPlayersMax, $search->getNbPlayersMax());
        $this->assertSame($nbPlayersMin, $search->getNbPlayersMin());
        $this->assertSame($console, $search->getConsole());
        $this->assertSame($license, $search->getLicense());
    }

    public function testSaveEntity()
    {
        $game = (new Game)
            ->setName('name')
            ->setDescription('description')
            ->setHistory('hystory')
            ->setThumbnail('thumbnail')
            ->setSlug('slug')
            ->setNbPlayers(2)
            ->setReleaseDate(new \DateTime())
            ->setLicense($this->entityManager->getRepository(License::class)->find(1))
            ->setCopiesSold(1000000)
        ;

        $this->assertCount(24, $this->service->findAll());
        $this->service->saveEntity($game, false);
        $this->assertCount(25, $this->service->findAll());
        $this->service->saveEntity($game, true);
        $this->assertCount(25, $this->service->findAll());
    }

    public function testFindAll()
    {
        $this->assertCount(24, $games = $this->service->findAll());
        foreach($games as $game){
            $this->assertInstanceOf(Game::class, $game);
        }
    }

    public function testFindBy()
    {
        $this->assertCount(24, $games = $this->service->findBy());
        foreach($games as $game){
            $this->assertInstanceOf(Game::class, $game);
        }

        $this->assertCount(1, $games = $this->service->findBy(['name' => 'Donkey Kong 64']));
        foreach($games as $game){
            $this->assertInstanceOf(Game::class, $game);
        }

        $this->assertEmpty($this->service->findBy(['name' => '123465']));
    }

    public function testFindOneBy()
    {
        $this->assertInstanceOf(Game::class, $this->service->findOneBy(['name' => 'Donkey Kong 64']));
        $this->assertNull($this->service->findOneBy(['name' => '123456']));
    }

    public function testFindBySearchCriterias()
    {
        $search = new SearchGame();

        //name
        $search->setName('zelda');
        $this->assertInstanceOf(Query::class, $query = $this->service->findBySearchCriterias($search));
        $this->assertSame($query->getResult()[0], $this->service->findOneBy(['name' => 'The Legend of Zelda Breath of the Wild']));

        //license
        $search
            ->setName(null)
            ->setLicense($this->entityManager->getRepository(License::class)->find(1))
        ;
        $this->assertInstanceOf(Query::class, $query = $this->service->findBySearchCriterias($search));
        $this->assertCount(4, $games = $query->getResult());
        $this->assertSame($games[0], $this->service->findOneBy(['name' => 'Donkey Kong 64']));

        //console
        $search
            ->setLicense(null)
            ->setConsole($this->entityManager->getRepository(Console::class)->find(1))
        ;
        $this->assertInstanceOf(Query::class, $query = $this->service->findBySearchCriterias($search));
        $this->assertCount(6, $games = $query->getResult());
        $this->assertSame($games[0], $this->service->findOneBy(['name' => 'Donkey Kong Country'])); 

        //genre
        $search
            ->setConsole(null)
            ->setGenre($this->entityManager->getRepository(Genre::class)->find(1))
        ;
        $this->assertInstanceOf(Query::class, $query = $this->service->findBySearchCriterias($search));
        $this->assertCount(12, $games = $query->getResult());
        $this->assertSame($games[0], $this->service->findOneBy(['name' => 'Donkey Kong 64']));

        //release date
        $search
            ->setGenre(null)
            ->setReleaseDateMin((new \DateTime())->setDate(1995,1,1))
            ->setReleaseDateMax((new \DateTime())->setDate(2000,1,1))
        ;
        $this->assertInstanceOf(Query::class, $query = $this->service->findBySearchCriterias($search));
        $this->assertCount(5, $games = $query->getResult());
        $this->assertSame($games[0], $this->service->findOneBy(['name' => 'Donkey Kong 64']));

        //nb player
        $search
            ->setReleaseDateMin(null)
            ->setReleaseDateMax(null)
            ->setNbPlayersMax(2)
            ->setNbPlayersMin(1)
        ;
        $this->assertInstanceOf(Query::class, $query = $this->service->findBySearchCriterias($search));
        $this->assertCount(24, $games = $query->getResult());
        $this->assertSame($games[0], $this->service->findOneBy(['name' => 'Donkey Kong 64']));
    }

    public function testGetBestGamesByLicense()
    {
        $this->assertCount(4, $games = $this->service->getBestGamesByLicense($this->entityManager->getRepository(License::class)->find(1)));
        $this->assertSame($games[0], $this->service->findOneBy(['name' => 'Donkey Kong Country']));
        $this->assertSame($games[1], $this->service->findOneBy(['name' => 'Donkey Kong Country 2']));
        $this->assertSame($games[2], $this->service->findOneBy(['name' => 'Donkey Kong Country : Tropical Freeze']));
        $this->assertSame($games[3], $this->service->findOneBy(['name' => 'Donkey Kong 64']));
    }
}
