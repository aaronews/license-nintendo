<?php

namespace App\Tests\Controller;

use App\Entity\Game;

class CharacterControllerTest extends AbstractWebTestCase
{
    public function testList()
    {
        $crawler = $this->client->request('GET', $this->router->generate('characters_list'));

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', $this->translator->trans('characters.list.title'));
        $this->assertCount(8, $crawler->filter('.card.animated-card'));

        $crawler = $this->client->click($crawler->filter('.card.animated-card a')->eq(0)->link());
        $this->assertRouteSame('characters_view', ['slug' => 'arbre-mojo']);
    }

    public function testListFilter()
    {
        $this->client->request('GET', $this->router->generate('characters_list'));
        $crawler = $this->client->submitForm('character[submit]', [
            'character[name]' => 'lin',
            'character[gender]' => 'M',
            'character[game]' => $this->entityManager->getRepository(Game::class)->findOneBy(['name' => 'The Legend of Zelda Breath of the Wild'])->getId(),
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertCount(1, $crawler->filter('.card.animated-card'));
        $this->assertSelectorTextContains('.card.animated-card h3', 'Link');

        $crawler = $this->client->click($crawler->filter('.card.animated-card a')->eq(0)->link());
        $this->assertRouteSame('characters_view', ['slug' => 'link']);
    }

    public function testView()
    {
        $crawler = $this->client->request('GET', $this->router->generate('characters_view', ['slug' => 'link']));

        $this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('h1', 'Link');
        $this->assertCount(1, $crawler->filter('h2'));
        $this->assertCount(10, $crawler->filter('.card.animated-card'));
        
        $crawler = $this->client->click($crawler->filter('.card.animated-card a')->eq(0)->link());
        $this->assertRouteSame('games_view', ['slug' => 'super-smash-bros']);
    }
}
