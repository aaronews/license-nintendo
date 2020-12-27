<?php

namespace App\Tests\Controller;

use App\Entity\User;

class UserControllerTest extends AbstractWebTestCase
{
    public function testSignUp()
    {
        $this->client->request('GET', $this->router->generate('sign_up'));

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', $this->translator->trans('users.signup.title'));
        $this->assertSelectorExists('form[name="sign_up"] input[name="sign_up[username]"]');
        $this->assertSelectorExists('form[name="sign_up"] input[name="sign_up[password]"]');
        $this->assertSelectorExists('form[name="sign_up"] input[name="sign_up[confirmPassword]"]');
    }
    
    public function testSignUpPost()
    {
        $userRepository = $this->entityManager->getRepository(User::class);
        $this->assertCount(2, $userRepository->findAll());

        $this->client->request('GET', $this->router->generate('sign_up'));
        $this->client->submitForm('sign_up[submit]', [
            'sign_up[username]' => 'email@gmail.com',
            'sign_up[password]' => 'Password1!',
            'sign_up[confirmPassword]' => 'Password1!',
        ]);
        
        $this->assertResponseRedirects($this->router->generate('homepage'));
        $crawler = $this->client->followRedirect();

        $this->assertCount(3, $userRepository->findAll());
        $this->assertCount(1, $crawler->filter('.custom-alert'));
    }

    public function testActivateUser()
    {
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['username' => 'user@gmail.com']);
        $this->assertFalse($user->getActive());
        $this->client->request('GET', $this->router->generate('activate_user', ['token' => $user->getToken()]));

        $this->assertResponseRedirects($this->router->generate('login'));

        $this->assertTrue($user->getActive());
        $this->assertNull($user->getToken());
    } 

    public function testActivateUserLogged()
    {
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['username' => 'admin@gmail.com']);
        $this->client->loginUser($user);
        $this->client->request('GET', $this->router->generate('activate_user', ['token' => $user->getToken()]));

        $this->assertResponseRedirects($this->router->generate('homepage'));
    }
}
