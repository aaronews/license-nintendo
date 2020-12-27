<?php

namespace App\Tests\Service;

use App\Entity\Game;
use Doctrine\ORM\Query;
use App\Entity\License;
use App\Service\LicensesService;
use App\Entity\Search\License as SearchLicense;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class LicensesServiceTest extends KernelTestCase
{
    /**
     * @var LicensesService
     */
    private $service;

    protected function setUp(): void
    {
        $this->service = new LicensesService(self::bootKernel()->getContainer()->get('doctrine')->getManager()->getRepository(License::class));
    }

    public function testHydrateSearch()
    {
        $name = 'name test';
        $searchData = [
            'name' => $name,
        ];

        $search = $this->service->hydrateSearch($searchData, new SearchLicense());

        $this->assertSame($name, $search->getName());
    }

    public function testSaveEntity()
    {
        $license = (new License)
            ->setName('name')
            ->setDescription('description')
            ->setThumbnail('thumbnail')
            ->setSlug('slug')
        ;

        $this->assertCount(5, $this->service->findAll());
        $this->service->saveEntity($license, false);
        $this->assertCount(6, $this->service->findAll());
        $this->service->saveEntity($license, true);
        $this->assertCount(6, $this->service->findAll());
    }

    public function testFindAll()
    {
        $this->assertCount(5, $licenses = $this->service->findAll());
        foreach($licenses as $license){
            $this->assertInstanceOf(License::class, $license);
        }
    }

    public function testFindBy()
    {
        $this->assertCount(5, $licenses = $this->service->findBy());
        foreach($licenses as $license){
            $this->assertInstanceOf(License::class, $license);
        }

        $this->assertCount(1, $licenses = $this->service->findBy(['name' => 'Super Smash Bros']));
        foreach($licenses as $license){
            $this->assertInstanceOf(License::class, $license);
        }

        $this->assertEmpty($this->service->findBy(['name' => '123465']));
    }

    public function testFindOneBy()
    {
        $this->assertInstanceOf(License::class, $this->service->findOneBy(['name' => 'Super Smash Bros']));
        $this->assertNull($this->service->findOneBy(['name' => '123456']));
    }

    public function testFindBySearchCriterias()
    {
        $search = new SearchLicense();

        //name
        $search->setName('smash bros');
        $this->assertInstanceOf(Query::class, $query = $this->service->findBySearchCriterias($search));
        $this->assertSame($query->getResult()[0], $this->service->findOneBy(['name' => 'Super Smash Bros']));
    }
}
