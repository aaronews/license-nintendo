<?php

namespace App\Tests\Controller\Admin;

use App\Entity\User;

class IndexControllerTest extends AbstractAdminWebTestCase
{
    public function testDashboardUnlogged()
    {
        $this->assertRedirectIfNotLogged('admin_dashboard');
    }
    public function testDashboard()
    {
        $this->logUserAdmin();
        $crawler = $this->client->request('GET', $this->router->generate('admin_dashboard'));

        $this->assertResponseIsSuccessful();
        $this->assertCount(5, $cards = $crawler->filter('.card'));

        $this->assertSame($cards->eq(0)->filter('.card-title')->text(), 'Consoles');
        $this->assertSame($cards->eq(0)->filter('.card-subtitle')->text(), '14');
        
        $this->assertSame($cards->eq(1)->filter('.card-title')->text(), 'Licences');
        $this->assertSame($cards->eq(1)->filter('.card-subtitle')->text(), '5');
        
        $this->assertSame($cards->eq(2)->filter('.card-title')->text(), 'Jeux');
        $this->assertSame($cards->eq(2)->filter('.card-subtitle')->text(), '24');
        
        $this->assertSame($cards->eq(3)->filter('.card-title')->text(), 'Objets');
        $this->assertSame($cards->eq(3)->filter('.card-subtitle')->text(), '22');
        
        $this->assertSame($cards->eq(4)->filter('.card-title')->text(), 'Personnages');
        $this->assertSame($cards->eq(4)->filter('.card-subtitle')->text(), '22');
    }
}
