<?php

namespace App\Tests\Repository;

use App\Entity\Game;
use App\Entity\Genre;
use App\Entity\Console;
use App\Entity\License;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\EntityManager;
use App\Repository\GameRepository;
use App\Entity\Search\Game as SearchGame;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class GameRepositoryTest extends KernelTestCase
{
    /**
     * @var GameRepository
     */
    private $repository;

    /**
     * @var EntityManager
     */
    private $entityManager;

    protected function setUp(): void
    {
        $this->entityManager = self::bootKernel()->getContainer()->get('doctrine')->getManager();
        $this->repository = $this->entityManager->getRepository(Game::class);
    }

    public function testFindBySearchCriterias()
    {
        $search = new SearchGame();

        //name
        $search->setName('zelda');
        $this->assertInstanceOf(Query::class, $query = $this->repository->findBySearchCriterias($search));
        $this->assertSame($query->getResult()[0], $this->repository->findOneBy(['name' => 'The Legend of Zelda Breath of the Wild']));

        //license
        $search
            ->setName(null)
            ->setLicense($this->entityManager->getRepository(License::class)->find(1))
        ;
        $this->assertInstanceOf(Query::class, $query = $this->repository->findBySearchCriterias($search));
        $this->assertCount(4, $games = $query->getResult());
        $this->assertSame($games[0], $this->repository->findOneBy(['name' => 'Donkey Kong 64']));

        //console
        $search
            ->setLicense(null)
            ->setConsole($this->entityManager->getRepository(Console::class)->find(1))
        ;
        $this->assertInstanceOf(Query::class, $query = $this->repository->findBySearchCriterias($search));
        $this->assertCount(6, $games = $query->getResult());
        $this->assertSame($games[0], $this->repository->findOneBy(['name' => 'Donkey Kong Country'])); 

        //genre
        $search
            ->setConsole(null)
            ->setGenre($this->entityManager->getRepository(Genre::class)->find(1))
        ;
        $this->assertInstanceOf(Query::class, $query = $this->repository->findBySearchCriterias($search));
        $this->assertCount(12, $games = $query->getResult());
        $this->assertSame($games[0], $this->repository->findOneBy(['name' => 'Donkey Kong 64']));

        //release date
        $search
            ->setGenre(null)
            ->setReleaseDateMin((new \DateTime())->setDate(1995,1,1))
            ->setReleaseDateMax((new \DateTime())->setDate(2000,1,1))
        ;
        $this->assertInstanceOf(Query::class, $query = $this->repository->findBySearchCriterias($search));
        $this->assertCount(5, $games = $query->getResult());
        $this->assertSame($games[0], $this->repository->findOneBy(['name' => 'Donkey Kong 64']));

        //nb player
        $search
            ->setReleaseDateMin(null)
            ->setReleaseDateMax(null)
            ->setNbPlayersMax(2)
            ->setNbPlayersMin(1)
        ;
        $this->assertInstanceOf(Query::class, $query = $this->repository->findBySearchCriterias($search));
        $this->assertCount(24, $games = $query->getResult());
        $this->assertSame($games[0], $this->repository->findOneBy(['name' => 'Donkey Kong 64']));
    }

    public function testCountAll()
    {
        $this->assertSame(24, $this->repository->countAll());
    }
    
    public function testFindAllSortByProperty()
    {
        $gamesQuery = $this->repository->findAllSortByProperty('id');
        $this->assertInstanceOf(QueryBuilder::class, $gamesQuery);
        $this->assertSame($gamesQuery->getQuery()->getResult()[0], $this->repository->find(1));
    }
    
    public function testCreateEntity()
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

        $this->assertSame(24, $this->repository->countAll());
        $this->repository->createEntity($game);
        $this->assertSame(25, $this->repository->countAll());
    }
    
    public function testUpdateEntity()
    {
        $this->assertSame(24, $this->repository->countAll());
        $this->repository->updateEntity($this->repository->find(1));
        $this->assertSame(24, $this->repository->countAll());
    }
}
