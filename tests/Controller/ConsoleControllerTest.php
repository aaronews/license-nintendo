<?php

namespace App\Tests\Controller;

use App\Entity\Game;

class ConsoleControllerTest extends AbstractWebTestCase
{
    public function testList()
    {
        $crawler = $this->client->request('GET', $this->router->generate('consoles_list'));

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', $this->translator->trans('consoles.list.title'));
        $this->assertCount(8, $crawler->filter('.card.animated-card'));

        $crawler = $this->client->click($crawler->filter('.card.animated-card a')->eq(0)->link());
        $this->assertRouteSame('consoles_view', ['slug' => '3ds']);
    }

    public function testListFilter()
    {
        $this->client->request('GET', $this->router->generate('consoles_list'));
        $crawler = $this->client->submitForm('console[submit]', [
            'console[name]' => 'game',
            'console[game]' => $this->entityManager->getRepository(Game::class)->findOneBy(['name' => 'The Legend of Zelda Wind Waker'])->getId(),
            'console[releasePriceMin]' => '100',
            'console[releasePriceMax]' => '300',
            'console[releaseDateMin]' => '01/01/2000',
            'console[releaseDateMax]' => '01/01/2005',
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertCount(1, $crawler->filter('.card.animated-card'));
        $this->assertSelectorTextContains('.card.animated-card h3', 'GameCube');

        $crawler = $this->client->click($crawler->filter('.card.animated-card a')->eq(0)->link());
        $this->assertRouteSame('consoles_view', ['slug' => 'gamecube']);
    }

    public function testView()
    {
        $crawler = $this->client->request('GET', $this->router->generate('consoles_view', ['slug' => '3ds']));

        $this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('h1', '3DS');
        $this->assertCount(1, $crawler->filter('h2'));
        $this->assertCount(6, $crawler->filter('.card.animated-card'));
        
        $crawler = $this->client->click($crawler->filter('.card.animated-card a')->eq(0)->link());
        $this->assertRouteSame('games_view', ['slug' => 'donkey-kong-country']);
    }
}
