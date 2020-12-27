<?php

namespace App\Tests\Repository;

use App\Entity\Game;
use Doctrine\ORM\Query;
use App\Entity\Character;
use App\Entity\GameCharacter;
use Doctrine\ORM\QueryBuilder;
use App\Entity\Search\EntityInGame;
use App\Repository\GameCharacterRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


class GameCharacterRepositoryTest extends KernelTestCase
{
    /**
     * @var GameCharacterRepository
     */
    private $repository;

    /**
     * @var EntityManager
     */
    private $entityManager;

    protected function setUp(): void
    {
        $this->entityManager = self::bootKernel()->getContainer()->get('doctrine')->getManager();
        $this->repository = $this->entityManager->getRepository(GameCharacter::class);
    }

    public function testFindBySearchCriterias()
    {
        $search = new EntityInGame();

        $search
            ->setGame($this->entityManager->getRepository(Game::class)->find(1))
        ;
        $this->assertInstanceOf(Query::class, $query = $this->repository->findBySearchCriterias($search));
        $this->assertCount(4, $query->getResult());

        $search
            ->setGame($this->entityManager->getRepository(Game::class)->find(5))
        ;
        $this->assertInstanceOf(Query::class, $query = $this->repository->findBySearchCriterias($search));
        $this->assertCount(5, $query->getResult());

    }

    public function testCountAll()
    {
        $this->assertSame(129, $this->repository->countAll());
    }
    
    public function testFindAllSortByProperty()
    {
        $gameCharactersQuery = $this->repository->findAllSortByProperty('id');
        $this->assertInstanceOf(QueryBuilder::class, $gameCharactersQuery);
        $this->assertSame($gameCharactersQuery->getQuery()->getResult()[0], $this->repository->find(1));
    }
    
    public function testCreateEntity()
    {
        $gameCharacter = (new GameCharacter)
            ->setGame($this->entityManager->getRepository(Game::class)->find(1))
            ->setCurrentCharacter($this->entityManager->getRepository(Character::class)->find(1))
            ->setThumbnail('thumbnail')
        ;

        $this->assertSame(129, $this->repository->countAll());
        $this->repository->createEntity($gameCharacter);
        $this->assertSame(130, $this->repository->countAll());
    }
    
    public function testUpdateEntity()
    {
        $this->assertSame(129, $this->repository->countAll());
        $this->repository->updateEntity($this->repository->find(1));
        $this->assertSame(129, $this->repository->countAll());
    }

    public function testFindCharactersByGame(){
        $gameRepository = $this->entityManager->getRepository(Game::class);
        $this->assertCount(4, $this->repository->findCharactersByGame($gameRepository->find(1)));
        $this->assertCount(5, $this->repository->findCharactersByGame($gameRepository->find(5)));
        $this->assertCount(2, $this->repository->findCharactersByGame($gameRepository->find(1), 2));
    }
}

