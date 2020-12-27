<?php

namespace App\Tests\Controller;

use Symfony\Component\Routing\Router;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class AbstractWebTestCase extends WebTestCase
{

    /**
     * @var Router
     */
    protected  $router;
    
    /**
     * @var TranslatorInterface 
     */
    protected  $translator;
    
    /**
     * @var KernelBrowser 
     */
    protected  $client;
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    protected function setUp():void
    {
        $this->client = static::createClient();
        $this->router = $this->client->getContainer()->get('router');
        $this->translator = $this->client->getContainer()->get('translator');
        $this->entityManager = $this->client->getContainer()->get('doctrine')->getManager();
    }
}