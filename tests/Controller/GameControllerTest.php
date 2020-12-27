<?php

namespace App\Tests\Controller;

use App\Entity\Genre;
use App\Entity\Console;
use App\Entity\License;

class GameControllerTest extends AbstractWebTestCase
{
    public function testList()
    {
        $crawler = $this->client->request('GET', $this->router->generate('games_list'));

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', $this->translator->trans('games.list.title'));
        $this->assertCount(8, $crawler->filter('.card.animated-card'));

        $crawler = $this->client->click($crawler->filter('.card.animated-card a')->eq(0)->link());
        $this->assertRouteSame('games_view', ['slug' => 'donkey-kong-64']);
    }
    
    public function testListFilter()
    {
        $this->client->request('GET', $this->router->generate('games_list'));
        $crawler = $this->client->submitForm('game[submit]', [
            'game[name]' => 'Zelda',
            'game[license]' => $this->entityManager->getRepository(License::class)->findOneBy(['name' => 'The Legend of Zelda'])->getId(),
            'game[genre]' => $this->entityManager->getRepository(Genre::class)->findOneBy(['name' => 'Action'])->getId(),
            'game[console]' => $this->entityManager->getRepository(Console::class)->findOneBy(['name' => '3ds'])->getId(),
            'game[nbPlayersMin]' => '1',
            'game[nbPlayersMax]' => '2',
            'game[releaseDateMin]' => '01/01/2000',
            'game[releaseDateMax]' => '01/01/2005',

        ]);

        $this->assertResponseIsSuccessful();
        $this->assertCount(1, $crawler->filter('.card.animated-card'));
        $this->assertSelectorTextContains('.card.animated-card h3', 'The Legend of Zelda Majora\'s Mask');

        $crawler = $this->client->click($crawler->filter('.card.animated-card a')->eq(0)->link());
        $this->assertRouteSame('games_view', ['slug' => 'the-legend-of-zelda-majoras-mask']);
    }

    public function testView()
    {
        $crawler = $this->client->request('GET', $this->router->generate('games_view', ['slug' => 'the-legend-of-zelda-breath-of-the-wild']));

        $this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('h1', 'The Legend of Zelda Breath of the Wild');
        $this->assertCount(4, $crawler->filter('h2'));
        
        $this->assertCount(4, $crawler->filter('.game-items .card.animated-card'));
        $btnMore = $crawler->filter('.game-items .btn-more');
        $this->assertCount(1, $btnMore);
        $crawler = $this->client->click($btnMore->eq(0)->link());
        $this->assertRouteSame('games_items', ['slug' => 'the-legend-of-zelda-breath-of-the-wild']);

        $crawler = $this->client->back();
        $this->assertRouteSame('games_view', ['slug' => 'the-legend-of-zelda-breath-of-the-wild']);

        $this->assertCount(4, $crawler->filter('.game-character .card.animated-card'));
        $btnMore = $crawler->filter('.game-character .btn-more');
        $this->assertCount(1, $btnMore);
        $crawler = $this->client->click($btnMore->eq(0)->link());
        $this->assertRouteSame('games_characters', ['slug' => 'the-legend-of-zelda-breath-of-the-wild']);
    }

    public function testCharacters()
    {
        $crawler = $this->client->request('GET', $this->router->generate('games_characters', ['slug' => 'the-legend-of-zelda-breath-of-the-wild']));

        $this->assertResponseIsSuccessful();
        
        $this->assertSelectorTextContains('h1', str_replace('%GAME_NAME%', 'The Legend of Zelda Breath of the Wild', $this->translator->trans('games.characters.title')));
        $this->assertCount(5, $crawler->filter('.card.animated-card'));
        
        $crawler = $this->client->click($crawler->filter('.card.animated-card a')->eq(0)->link());
        $this->assertRouteSame('characters_view', ['slug' => 'arbre-mojo']);
    }

    public function testItems()
    {
        $crawler = $this->client->request('GET', $this->router->generate('games_items', ['slug' => 'the-legend-of-zelda-breath-of-the-wild']));

        $this->assertResponseIsSuccessful();
        
        $this->assertSelectorTextContains('h1', str_replace('%GAME_NAME%', 'The Legend of Zelda Breath of the Wild', $this->translator->trans('games.items.title')));
        $this->assertCount(5, $crawler->filter('.card.animated-card'));
        
        $crawler = $this->client->click($crawler->filter('.card.animated-card a')->eq(0)->link());
        $this->assertRouteSame('items_view', ['slug' => 'arc']);
    }
}
