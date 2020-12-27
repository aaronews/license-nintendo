<?php

namespace App\Tests\Controller;

use App\Entity\User;

class SecurityControllerTest extends AbstractWebTestCase
{

    public function testLogin()
    {
        $this->client->request('GET', $this->router->generate('login'));

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', $this->translator->trans('security.login.title'));
        $this->assertSelectorExists('form[name="login"] input[name="username"]');
        $this->assertSelectorExists('form[name="login"] input[name="password"]');
        $this->assertSelectorExists('form[name="login"] input[name="_remember_me"]');
    } 

    public function testLoginPost()
    {
        $this->client->request('GET', $this->router->generate('login'));
        $this->client->submitForm('submit', [
            'username' => 'admin@gmail.com',
            'password' => 'admin',
        ]);

        $this->assertResponseRedirects($this->router->generate('homepage'));
        
        $crawler = $this->client->followRedirect();
        $this->assertCount(1, $crawler->filter('.navbar-collapse .nav-link[href="'.$this->router->generate('admin_dashboard').'"]'));
        $this->assertCount(1, $crawler->filter('.navbar-collapse .nav-link[href="'.$this->router->generate('logout').'"]'));
    } 

    public function testLoginLogged()
    {
        $this->client->loginUser($this->entityManager->getRepository(User::class)->findOneBy(['username' => 'admin@gmail.com']));
        $this->client->request('GET', $this->router->generate('login'));

        $this->assertResponseRedirects($this->router->generate('homepage'));
    }
}
