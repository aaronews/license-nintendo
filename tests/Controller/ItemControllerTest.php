<?php

namespace App\Tests\Controller;

class ItemControllerTest extends AbstractWebTestCase
{
    public function testList()
    {
        $crawler = $this->client->request('GET', $this->router->generate('items_list'));

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', $this->translator->trans('items.list.title'));
        $this->assertCount(8, $crawler->filter('.card.animated-card'));

        $crawler = $this->client->click($crawler->filter('.card.animated-card a')->eq(0)->link());
        $this->assertRouteSame('items_view', ['slug' => 'arc']);
    }

    public function testListFilter()
    {
        $this->client->request('GET', $this->router->generate('items_list'));
        $crawler = $this->client->submitForm('item[submit]', [
            'item[name]' => 'bombe',
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertCount(1, $crawler->filter('.card.animated-card'));
        $this->assertSelectorTextContains('.card.animated-card h3', 'Bombe');

        $crawler = $this->client->click($crawler->filter('.card.animated-card a')->eq(0)->link());
        $this->assertRouteSame('items_view', ['slug' => 'bombe']);
    }

    public function testView()
    {
        $crawler = $this->client->request('GET', $this->router->generate('items_view', ['slug' => 'arc']));

        $this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('h1', 'Arc');
        $this->assertCount(1, $crawler->filter('h2'));
        $this->assertCount(5, $crawler->filter('.card.animated-card'));
        
        $crawler = $this->client->click($crawler->filter('.card.animated-card a')->eq(0)->link());
        $this->assertRouteSame('games_view', ['slug' => 'the-legend-of-zelda-breath-of-the-wild']);
    }
}
