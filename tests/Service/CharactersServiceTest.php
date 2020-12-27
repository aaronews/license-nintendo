<?php

namespace App\Tests\Service;

use App\Entity\Game;
use Doctrine\ORM\Query;
use App\Entity\Character;
use App\Service\CharactersService;
use App\Entity\Search\Character as SearchCharacter;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CharactersServiceTest extends KernelTestCase
{
    /**
     * @var CharactersService
     */
    private $service;

    /**
     * @var EntityManager
     */
    private $entityManager;

    protected function setUp(): void
    {
        $this->entityManager = self::bootKernel()->getContainer()->get('doctrine')->getManager();
        $this->service = new CharactersService($this->entityManager->getRepository(Character::class), $this->entityManager->getRepository(Game::class));
    }

    public function testHydrateSearch()
    {
        $name = 'name test';
        $gender = 'gender test';
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $searchData = [
            'name' => $name,
            'gender' => $gender,
            'game' => $game,
        ];

        $search = $this->service->hydrateSearch($searchData, new SearchCharacter());

        $this->assertSame($name, $search->getName());
        $this->assertSame($gender, $search->getGender());
        $this->assertSame($game, $search->getGame());
    }

    public function testSaveEntity()
    {
        $character = (new Character)
            ->setName('name')
            ->setGender('M')
            ->setDescription('description')
            ->setThumbnail('thumbnail')
            ->setSlug('slug')
        ;

        $this->assertCount(22, $this->service->findAll());
        $this->service->saveEntity($character, false);
        $this->assertCount(23, $this->service->findAll());
        $this->service->saveEntity($character, true);
        $this->assertCount(23, $this->service->findAll());
    }

    public function testFindAll()
    {
        $this->assertCount(22, $characters = $this->service->findAll());
        foreach($characters as $character){
            $this->assertInstanceOf(Character::class, $character);
        }
    }

    public function testFindBy()
    {
        $this->assertCount(22, $characters = $this->service->findBy());
        foreach($characters as $character){
            $this->assertInstanceOf(Character::class, $character);
        }

        $this->assertCount(1, $characters = $this->service->findBy(['name' => 'Link']));
        foreach($characters as $character){
            $this->assertInstanceOf(Character::class, $character);
        }

        $this->assertEmpty($this->service->findBy(['name' => '123465']));
    }

    public function testFindOneBy()
    {
        $this->assertInstanceOf(Character::class, $this->service->findOneBy(['name' => 'Link']));
        $this->assertNull($this->service->findOneBy(['name' => '123456']));
    }

    public function testFindBySearchCriterias()
    {
        $search = new SearchCharacter();

        //name
        $search->setName('link');
        $this->assertInstanceOf(Query::class, $query = $this->service->findBySearchCriterias($search));
        $this->assertSame($query->getResult()[0], $this->service->findOneBy(['name' => 'Link']));

        //game
        $search
            ->setName(null)
            ->setGame($this->entityManager->getRepository(Game::class)->find(1))
        ;
        $this->assertInstanceOf(Query::class, $query = $this->service->findBySearchCriterias($search));
        $this->assertCount(4, $characters = $query->getResult());
        $this->assertSame($characters[0], $this->service->findOneBy(['name' => 'Cranky Kong']));
    }
}
