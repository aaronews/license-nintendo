<?php

namespace App\Tests\Controller\Admin;

use App\Entity\Character;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CharacterControllerTest extends AbstractAdminWebTestCase
{
    public function testListUnlogged()
    {
        $this->assertRedirectIfNotLogged('admin_characters_list');
    }

    public function testList()
    {
        $this->logUserAdmin();
        $crawler = $this->client->request('GET', $this->router->generate('admin_characters_list'));
        $this->assertResponseIsSuccessful();
        
        $this->assertSelectorTextContains('h1', $this->translator->trans('characters.list.title'));
        $this->assertCount(10, $crawler->filter('.list-group .list-group-item'));
        $this->assertSelectorExists('.list-group .list-group-item .dropdown-item:not(.remove-entity)');
        $this->assertSelectorExists('.list-group .list-group-item .dropdown-item.remove-entity');
    }
    public function testAddUnlogged()
    {
        $this->assertRedirectIfNotLogged('admin_characters_add');
    }
    
    public function testAdd()
    {
        $this->logUserAdmin();
        $this->client->request('GET', $this->router->generate('admin_characters_add'));
        $this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('h1', $this->translator->trans('admin.characters.add.title'));
        $this->assertSelectorExists('form[name="add_character"] input[name="add_character[uploadThumbnail]"]');
        $this->assertSelectorExists('form[name="add_character"] input[name="add_character[slug]"]');
        $this->assertSelectorExists('form[name="add_character"] input[name="add_character[name]"]');
        $this->assertSelectorExists('form[name="add_character"] select[name="add_character[gender]"]');
        $this->assertSelectorExists('form[name="add_character"] textarea[name="add_character[description]"]');
    }
    
    public function testAddPost()
    {
        $characterRepository = $this->entityManager->getRepository(Character::class);
        $this->assertCount(22, $characterRepository->findAll());

        $thumbnail = new UploadedFile(
            $this->getPathUpload() . DIRECTORY_SEPARATOR . 'thumbnail.png',
            'thumbnail.png',
            'image/png',
            null
        );
        
        $this->logUserAdmin();
        $this->client->request('GET', $this->router->generate('admin_characters_add'));
        $crawler = $this->client->submitForm('add_character[submit]', [
            'add_character[name]' => 'character test',
            'add_character[gender]' => 'M',
            'add_character[slug]' => 'character-slug',
            'add_character[description]' => 'character description',
            'add_character[uploadThumbnail]' => $thumbnail
        ]);
        
        $this->assertResponseIsSuccessful();
        $this->assertCount(1, $crawler->filter('.flash-message'));
        $this->assertCount(23, $characterRepository->findAll());

        $characterRepository->removeEntity($characterRepository->findOneBy(['name' => 'character test']));
    }

    public function testEditUnlogged()
    {
        $this->assertRedirectIfNotLogged('admin_characters_edit', ['id' => 1]);
    }
    
    public function testEdit()
    {
        $this->logUserAdmin();
        $this->client->request('GET', $this->router->generate('admin_characters_edit', ['id' => 1]));
        $this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('h1', $this->translator->trans('admin.characters.edit.title') . ' "Arbre Mojo"');
        $this->assertSelectorExists('form[name="edit_character"] input[name="edit_character[uploadThumbnail]"]');
        $this->assertSelectorExists('form[name="edit_character"] input[name="edit_character[slug]"]');
        $this->assertSelectorExists('form[name="edit_character"] input[name="edit_character[name]"]');
        $this->assertSelectorExists('form[name="edit_character"] select[name="edit_character[gender]"]');
        $this->assertSelectorExists('form[name="edit_character"] textarea[name="edit_character[description]"]');
        $this->assertSelectorExists('form[name="edit_character"] .current-thumbnail img');
    }
    
    public function testEditPost()
    {
        $characterRepository = $this->entityManager->getRepository(Character::class);
        $this->assertCount(22, $characterRepository->findAll());

        $thumbnail = new UploadedFile(
            $this->getPathUpload() . DIRECTORY_SEPARATOR . 'thumbnail.png',
            'thumbnail.png',
            'image/png',
            null
        );
        $publicUploadCharactersPath = getcwd() . '/public/img/uploads/characters';
        $publicUploadCharacters = scandir($publicUploadCharactersPath);
        $character = $characterRepository->find(1);
        $thumbnailName = $character->getThumbnail();
        $thumbnailPublicPath = $publicUploadCharactersPath . DIRECTORY_SEPARATOR . $thumbnailName;
        $thumbnailTestPath = $this->getPathUpload() . DIRECTORY_SEPARATOR . $thumbnailName;
        copy($thumbnailPublicPath, $thumbnailTestPath);

        $this->logUserAdmin();
        $this->client->request('GET', $this->router->generate('admin_characters_edit', ['id' => $character->getId()]));
        $crawler = $this->client->submitForm('edit_character[submit]', [
            'edit_character[name]' => 'character test',
            'edit_character[gender]' => 'M',
            'edit_character[slug]' => 'character-slug',
            'edit_character[description]' => 'character description',
            'edit_character[uploadThumbnail]' => $thumbnail
        ]);

        foreach(array_diff(scandir($publicUploadCharactersPath), $publicUploadCharacters) as $file){
            unlink($publicUploadCharactersPath . DIRECTORY_SEPARATOR . $file);
        }
        
        $this->assertResponseIsSuccessful();
        $this->assertCount(1, $crawler->filter('.flash-message'));
        $this->assertCount(22, $characterRepository->findAll()); 
        rename($thumbnailTestPath, $thumbnailPublicPath);
    }
}
