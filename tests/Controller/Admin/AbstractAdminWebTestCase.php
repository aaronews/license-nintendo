<?php

namespace App\Tests\Controller\Admin;

use App\Entity\User;
use App\Tests\Controller\AbstractWebTestCase;

abstract class AbstractAdminWebTestCase extends AbstractWebTestCase
{
    /**
     * log user admin
     *
     * @return User
     */
    protected function logUserAdmin()
    {
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['username' => 'admin@gmail.com']);
        $this->client->loginUser($user);

        return $user;
    }

    protected function assertRedirectIfNotLogged($route, array $parameters = array())
    {
        $this->client->request('GET', $this->router->generate($route, $parameters));
        $this->assertResponseRedirects();
    }

    protected function getPathUpload(){
        return getcwd() . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . 'datas' . DIRECTORY_SEPARATOR . 'uploads';
    }
}