<?php

namespace App\Tests\Service;

use App\Entity\Game;
use Doctrine\ORM\Query;
use App\Entity\GameCharacter;
use App\Entity\Character;
use App\Entity\Search\EntityInGame;
use App\Service\GameCharactersService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class GameCharactersServiceTest extends KernelTestCase
{
    /**
     * @var GameCharactersService
     */
    private $service;

    /**
     * @var EntityManager
     */
    private $entityManager;

    protected function setUp(): void
    {
        $this->entityManager = self::bootKernel()->getContainer()->get('doctrine')->getManager();
        $this->service = new GameCharactersService($this->entityManager->getRepository(GameCharacter::class));
    }

    public function testSaveEntity()
    {
        $gameCharacter = (new GameCharacter)
            ->setGame($this->entityManager->getRepository(Game::class)->find(1))
            ->setCurrentCharacter($this->entityManager->getRepository(Character::class)->find(1))
            ->setThumbnail('thumbnail')
        ;

        $this->assertCount(129, $this->service->findAll());
        $this->service->saveEntity($gameCharacter, false);
        $this->assertCount(130, $this->service->findAll());
        $this->service->saveEntity($gameCharacter, true);
        $this->assertCount(130, $this->service->findAll());
    }

    public function testFindAll()
    {
        $this->assertCount(129, $gameCharacters = $this->service->findAll());
        foreach($gameCharacters as $gameCharacter){
            $this->assertInstanceOf(GameCharacter::class, $gameCharacter);
        }
    }

    public function testFindBy()
    {
        $gameRepository = $this->entityManager->getRepository(Game::class);
        $this->assertCount(129, $gameCharacters = $this->service->findBy());
        foreach($gameCharacters as $gameCharacter){
            $this->assertInstanceOf(GameCharacter::class, $gameCharacter);
        }

        $this->assertCount(4, $gameCharacters = $this->service->findBy(['game' => $gameRepository->find(1)]));
        foreach($gameCharacters as $gameCharacter){
            $this->assertInstanceOf(GameCharacter::class, $gameCharacter);
        }

        $this->assertEmpty($this->service->findBy(['game' => $gameRepository->find(30)]));
    }

    public function testFindOneBy()
    {
        $gameRepository = $this->entityManager->getRepository(Game::class);
        $this->assertInstanceOf(GameCharacter::class, $this->service->findOneBy(['game' => $gameRepository->find(1)]));
        $this->assertNull($this->service->findOneBy(['game' => $gameRepository->find(30)]));
    }

    public function testFindBySearchCriterias()
    {
        $search = new EntityInGame();

        $search
            ->setGame($this->entityManager->getRepository(Game::class)->find(1))
        ;
        $this->assertInstanceOf(Query::class, $query = $this->service->findBySearchCriterias($search));
        $this->assertCount(4, $query->getResult());

        $search
            ->setGame($this->entityManager->getRepository(Game::class)->find(5))
        ;
        $this->assertInstanceOf(Query::class, $query = $this->service->findBySearchCriterias($search));
        $this->assertCount(5, $query->getResult());
    }

    public function testGetCharactersByGame()
    {
        $gameRepository = $this->entityManager->getRepository(Game::class);
        $this->assertCount(4, $this->service->getCharactersByGame($gameRepository->find(1)));
        $this->assertCount(5, $this->service->getCharactersByGame($gameRepository->find(5)));
        $this->assertCount(2, $this->service->getCharactersByGame($gameRepository->find(1), 2));
    }
}
