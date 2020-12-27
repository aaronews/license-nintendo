<?php

namespace App\Tests\Controller\Admin;

use App\Entity\Console;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ConsoleControllerTest extends AbstractAdminWebTestCase
{
    public function testListUnlogged()
    {
        $this->assertRedirectIfNotLogged('admin_consoles_list');
    }

    public function testList()
    {
        $this->logUserAdmin();
        $crawler = $this->client->request('GET', $this->router->generate('admin_consoles_list'));
        $this->assertResponseIsSuccessful();
        
        $this->assertSelectorTextContains('h1', $this->translator->trans('consoles.list.title'));
        $this->assertCount(10, $crawler->filter('.list-group .list-group-item'));
        $this->assertSelectorExists('.list-group .list-group-item .dropdown-item:not(.remove-entity)');
        $this->assertSelectorExists('.list-group .list-group-item .dropdown-item.remove-entity');
    }
    public function testAddUnlogged()
    {
        $this->assertRedirectIfNotLogged('admin_consoles_add');
    }
    
    public function testAdd()
    {
        $this->logUserAdmin();
        $this->client->request('GET', $this->router->generate('admin_consoles_add'));
        $this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('h1', $this->translator->trans('admin.consoles.add.title'));
        $this->assertSelectorExists('form[name="add_console"] input[name="add_console[uploadThumbnail]"]');
        $this->assertSelectorExists('form[name="add_console"] input[name="add_console[slug]"]');
        $this->assertSelectorExists('form[name="add_console"] input[name="add_console[name]"]');
        $this->assertSelectorExists('form[name="add_console"] textarea[name="add_console[description]"]');
        $this->assertSelectorExists('form[name="add_console"] input[name="add_console[releaseDate]"]');
        $this->assertSelectorExists('form[name="add_console"] input[name="add_console[releasePrice]"]');
    }
    
    public function testAddPost()
    {
        $consoleRepository = $this->entityManager->getRepository(Console::class);
        $this->assertCount(14, $consoleRepository->findAll());

        $thumbnail = new UploadedFile(
            $this->getPathUpload() . DIRECTORY_SEPARATOR . 'thumbnail.png',
            'thumbnail.png',
            'image/png',
            null
        );
        
        $this->logUserAdmin();
        $this->client->request('GET', $this->router->generate('admin_consoles_add'));
        $crawler = $this->client->submitForm('add_console[submit]', [
            'add_console[name]' => 'console test',
            'add_console[slug]' => 'console-slug',
            'add_console[description]' => 'console description',
            'add_console[releaseDate]' => '11/12/2020',
            'add_console[releasePrice]' => '100',
            'add_console[uploadThumbnail]' => $thumbnail
        ]);
        
        $this->assertResponseIsSuccessful();
        $this->assertCount(1, $crawler->filter('.flash-message'));
        $this->assertCount(15, $consoleRepository->findAll());

        $consoleRepository->removeEntity($consoleRepository->findOneBy(['name' => 'console test']));
    }

    public function testEditUnlogged()
    {
        $this->assertRedirectIfNotLogged('admin_consoles_edit', ['id' => 1]);
    }
    
    public function testEdit()
    {
        $this->logUserAdmin();
        $this->client->request('GET', $this->router->generate('admin_consoles_edit', ['id' => 1]));
        $this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('h1', $this->translator->trans('admin.consoles.edit.title') . ' "3DS"');
        $this->assertSelectorExists('form[name="edit_console"] input[name="edit_console[uploadThumbnail]"]');
        $this->assertSelectorExists('form[name="edit_console"] input[name="edit_console[slug]"]');
        $this->assertSelectorExists('form[name="edit_console"] input[name="edit_console[name]"]');
        $this->assertSelectorExists('form[name="edit_console"] textarea[name="edit_console[description]"]');
        $this->assertSelectorExists('form[name="edit_console"] input[name="edit_console[releaseDate]"]');
        $this->assertSelectorExists('form[name="edit_console"] input[name="edit_console[releasePrice]"]');
        $this->assertSelectorExists('form[name="edit_console"] .current-thumbnail img');
    }
    
    public function testEditPost()
    {
        $consoleRepository = $this->entityManager->getRepository(Console::class);
        $this->assertCount(14, $consoleRepository->findAll());

        $thumbnail = new UploadedFile(
            $this->getPathUpload() . DIRECTORY_SEPARATOR . 'thumbnail.png',
            'thumbnail.png',
            'image/png',
            null
        );
        $publicUploadConsolesPath = getcwd() . '/public/img/uploads/consoles';
        $publicUploadConsoles = scandir($publicUploadConsolesPath);
        $console = $consoleRepository->find(1);
        $thumbnailName = $console->getThumbnail();
        $thumbnailPublicPath = $publicUploadConsolesPath . DIRECTORY_SEPARATOR . $thumbnailName;
        $thumbnailTestPath = $this->getPathUpload() . DIRECTORY_SEPARATOR . $thumbnailName;
        copy($thumbnailPublicPath, $thumbnailTestPath);

        $this->logUserAdmin();
        $this->client->request('GET', $this->router->generate('admin_consoles_edit', ['id' => $console->getId()]));
        $crawler = $this->client->submitForm('edit_console[submit]', [
            'edit_console[name]' => 'console test',
            'edit_console[slug]' => 'console-slug',
            'edit_console[description]' => 'console description',
            'edit_console[releaseDate]' => '11/12/2020',
            'edit_console[releasePrice]' => '100',
            'edit_console[uploadThumbnail]' => $thumbnail
        ]);

        foreach(array_diff(scandir($publicUploadConsolesPath), $publicUploadConsoles) as $file){
            unlink($publicUploadConsolesPath . DIRECTORY_SEPARATOR . $file);
        }
        
        $this->assertResponseIsSuccessful();
        $this->assertCount(1, $crawler->filter('.flash-message'));
        $this->assertCount(14, $consoleRepository->findAll()); 
        rename($thumbnailTestPath, $thumbnailPublicPath);
    }
}
