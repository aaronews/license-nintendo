<?php

namespace App\Tests\Controller;

class LicenseControllerTest extends AbstractWebTestCase
{
    public function testList()
    {
        $crawler = $this->client->request('GET', $this->router->generate('licenses_list'));

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', $this->translator->trans('licenses.list.title'));
        $this->assertCount(5, $crawler->filter('.card.animated-card'));

        $crawler = $this->client->click($crawler->filter('.card.animated-card a')->eq(0)->link());
        $this->assertRouteSame('licenses_view', ['slug' => 'donkey-kong']);
    }
    
    public function testListFilter()
    {
        $this->client->request('GET', $this->router->generate('licenses_list'));
        $crawler = $this->client->submitForm('license[submit]', [
            'license[name]' => 'Zelda',
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertCount(1, $crawler->filter('.card.animated-card'));
        $this->assertSelectorTextContains('.card.animated-card h3', 'The Legend of Zelda');

        $crawler = $this->client->click($crawler->filter('.card.animated-card a')->eq(0)->link());
        $this->assertRouteSame('licenses_view', ['slug' => 'the-legend-of-zelda']);
    }

    public function testView()
    {
        $crawler = $this->client->request('GET', $this->router->generate('licenses_view', ['slug' => 'the-legend-of-zelda']));

        $this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('h1', 'The Legend of Zelda');
        $this->assertCount(2, $crawler->filter('h2'));
        $this->assertCount(4, $crawler->filter('.card.animated-card'));
        
        $btnMore = $crawler->filter('.license-best-games .btn-more');
        $this->assertCount(1, $btnMore);
        $crawler = $this->client->click($btnMore->eq(0)->link());
        $this->assertRouteSame('licenses_games', ['slug' => 'the-legend-of-zelda']);
    }

    public function testGames()
    {
        $crawler = $this->client->request('GET', $this->router->generate('licenses_games', ['slug' => 'the-legend-of-zelda']));

        $this->assertResponseIsSuccessful();
        
        $this->assertSelectorTextContains('h1', $this->translator->trans('licenses.games.title') . ' The Legend of Zelda');
        $this->assertCount(5, $crawler->filter('.card.animated-card'));
        
        $crawler = $this->client->click($crawler->filter('.card.animated-card a')->eq(0)->link());
        $this->assertRouteSame('games_view', ['slug' => 'the-legend-of-zelda-breath-of-the-wild']);
    }
}
