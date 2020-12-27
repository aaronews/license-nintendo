<?php

namespace App\Tests\Service;

use App\Entity\Game;
use Doctrine\ORM\Query;
use App\Entity\Console;
use App\Service\ConsolesService;
use App\Entity\Search\Console as SearchConsole;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ConsolesServiceTest extends KernelTestCase
{
    /**
     * @var ConsolesService
     */
    private $service;

    /**
     * @var EntityManager
     */
    private $entityManager;

    protected function setUp(): void
    {
        $this->entityManager = self::bootKernel()->getContainer()->get('doctrine')->getManager();
        $this->service = new ConsolesService($this->entityManager->getRepository(Console::class), $this->entityManager->getRepository(Game::class));
    }

    public function testHydrateSearch()
    {
        $name = 'name test';
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $releaseDateMax = (new \DateTime())->setDate(2020, 1, 1);
        $releaseDateMin = (new \DateTime())->setDate(2000, 12, 31);
        $releasePriceMax = 500;
        $releasePriceMin = 100;
        $searchData = [
            'name' => $name,
            'game' => $game,
            'releaseDateMax' => $releaseDateMax,
            'releaseDateMin' => $releaseDateMin,
            'releasePriceMax' => $releasePriceMax,
            'releasePriceMin' => $releasePriceMin,
        ];

        $search = $this->service->hydrateSearch($searchData, new SearchConsole());

        $this->assertSame($name, $search->getName());
        $this->assertSame($game, $search->getGame());
        $this->assertSame($releaseDateMax, $search->getReleaseDateMax());
        $this->assertSame($releaseDateMin, $search->getReleaseDateMin());
        $this->assertSame($releasePriceMax, $search->getReleasePriceMax());
        $this->assertSame($releasePriceMin, $search->getReleasePriceMin());
    }

    public function testSaveEntity()
    {
        $console = (new Console)
            ->setName('name')
            ->setDescription('description')
            ->setThumbnail('thumbnail')
            ->setSlug('slug')
            ->setReleasePrice(100)
            ->setReleaseDate(new \DateTime())
        ;

        $this->assertCount(14, $this->service->findAll());
        $this->service->saveEntity($console, false);
        $this->assertCount(15, $this->service->findAll());
        $this->service->saveEntity($console, true);
        $this->assertCount(15, $this->service->findAll());
    }

    public function testFindAll()
    {
        $this->assertCount(14, $consoles = $this->service->findAll());
        foreach($consoles as $console){
            $this->assertInstanceOf(Console::class, $console);
        }
    }

    public function testFindBy()
    {
        $this->assertCount(14, $consoles = $this->service->findBy());
        foreach($consoles as $console){
            $this->assertInstanceOf(Console::class, $console);
        }

        $this->assertCount(1, $consoles = $this->service->findBy(['name' => 'GameCube']));
        foreach($consoles as $console){
            $this->assertInstanceOf(Console::class, $console);
        }

        $this->assertEmpty($this->service->findBy(['name' => '123465']));
    }

    public function testFindOneBy()
    {
        $this->assertInstanceOf(Console::class, $this->service->findOneBy(['name' => 'GameCube']));
        $this->assertNull($this->service->findOneBy(['name' => '123456']));
    }

    public function testFindBySearchCriterias()
    {
        $search = new SearchConsole();

        //name
        $search->setName('cube');
        $this->assertInstanceOf(Query::class, $query = $this->service->findBySearchCriterias($search));
        $this->assertSame($query->getResult()[0], $this->service->findOneBy(['name' => 'GameCube']));

        //game
        $search
            ->setName(null)
            ->setGame($this->entityManager->getRepository(Game::class)->find(1))
        ;
        $this->assertInstanceOf(Query::class, $query = $this->service->findBySearchCriterias($search));
        $this->assertCount(2, $consoles = $query->getResult());
        $this->assertSame($consoles[0], $this->service->findOneBy(['name' => 'Nintendo 64']));

        //release date
        $search
            ->setGame(null)
            ->setReleaseDateMin((new \DateTime())->setDate(1995,1,1))
            ->setReleaseDateMax((new \DateTime())->setDate(2000,1,1))
        ;
        $this->assertInstanceOf(Query::class, $query = $this->service->findBySearchCriterias($search));
        $this->assertCount(2, $consoles = $query->getResult());
        $this->assertSame($consoles[0], $this->service->findOneBy(['name' => 'Game Boy Color']));
    }
}
