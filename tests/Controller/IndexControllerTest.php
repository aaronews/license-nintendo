<?php

namespace App\Tests\Controller;

class IndexControllerTest extends AbstractWebTestCase
{
    public function testIndex()
    {
        $crawler = $this->client->request('GET', $this->router->generate('homepage'));

        $this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('h1', $this->translator->trans('homepage.licenses.title'));
        $this->assertCount(1, $crawler->filter('h2'));
        $this->assertCount(5, $crawler->filter('.card.animated-card'));

        $crawler = $this->client->click($crawler->filter('.card.animated-card a')->eq(0)->link());
        $this->assertRouteSame('licenses_view', ['slug' => 'donkey-kong']);
    }
}
