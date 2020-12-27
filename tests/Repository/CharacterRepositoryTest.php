<?php

namespace App\Tests\Repository;

use App\Entity\Game;
use Doctrine\ORM\Query;
use App\Entity\Character;
use Doctrine\ORM\QueryBuilder;
use App\Repository\CharacterRepository;
use App\Entity\Search\Character as SearchCharacter;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CharacterRepositoryTest extends KernelTestCase
{
    /**
     * @var CharacterRepository
     */
    private $repository;

    /**
     * @var EntityManager
     */
    private $entityManager;

    protected function setUp(): void
    {
        $this->entityManager = self::bootKernel()->getContainer()->get('doctrine')->getManager();
        $this->repository = $this->entityManager->getRepository(Character::class);
    }

    public function testFindBySearchCriterias()
    {
        $search = new SearchCharacter();

        //name
        $search->setName('link');
        $this->assertInstanceOf(Query::class, $query = $this->repository->findBySearchCriterias($search));
        $this->assertSame($query->getResult()[0], $this->repository->findOneBy(['name' => 'Link']));

        //game
        $search
            ->setName(null)
            ->setGame($this->entityManager->getRepository(Game::class)->find(1))
        ;
        $this->assertInstanceOf(Query::class, $query = $this->repository->findBySearchCriterias($search));
        $this->assertCount(4, $characters = $query->getResult());
        $this->assertSame($characters[0], $this->repository->findOneBy(['name' => 'Cranky Kong']));

    }

    public function testCountAll()
    {
        $this->assertSame(22, $this->repository->countAll());
    }
    
    public function testFindAllSortByProperty()
    {
        $charactersQuery = $this->repository->findAllSortByProperty('id');
        $this->assertInstanceOf(QueryBuilder::class, $charactersQuery);
        $this->assertSame($charactersQuery->getQuery()->getResult()[0], $this->repository->find(1));
    }
    
    public function testCreateEntity()
    {
        $character = (new Character)
            ->setName('name')
            ->setGender('M')
            ->setDescription('description')
            ->setThumbnail('thumbnail')
            ->setSlug('slug')
        ;

        $this->assertSame(22, $this->repository->countAll());
        $this->repository->createEntity($character);
        $this->assertSame(23, $this->repository->countAll());
    }
    
    public function testUpdateEntity()
    {
        $this->assertSame(22, $this->repository->countAll());
        $this->repository->updateEntity($this->repository->find(1));
        $this->assertSame(22, $this->repository->countAll());
    }
}
