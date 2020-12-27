<?php

namespace App\Tests\Controller\Admin;

use App\Entity\Item;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ItemControllerTest extends AbstractAdminWebTestCase
{
    public function testListUnlogged()
    {
        $this->assertRedirectIfNotLogged('admin_items_list');
    }

    public function testList()
    {
        $this->logUserAdmin();
        $crawler = $this->client->request('GET', $this->router->generate('admin_items_list'));
        $this->assertResponseIsSuccessful();
        
        $this->assertSelectorTextContains('h1', $this->translator->trans('items.list.title'));
        $this->assertCount(10, $crawler->filter('.list-group .list-group-item'));
        $this->assertSelectorExists('.list-group .list-group-item .dropdown-item:not(.remove-entity)');
        $this->assertSelectorExists('.list-group .list-group-item .dropdown-item.remove-entity');
    }
    public function testAddUnlogged()
    {
        $this->assertRedirectIfNotLogged('admin_items_add');
    }
    
    public function testAdd()
    {
        $this->logUserAdmin();
        $this->client->request('GET', $this->router->generate('admin_items_add'));
        $this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('h1', $this->translator->trans('admin.items.add.title'));
        $this->assertSelectorExists('form[name="add_item"] input[name="add_item[uploadThumbnail]"]');
        $this->assertSelectorExists('form[name="add_item"] input[name="add_item[slug]"]');
        $this->assertSelectorExists('form[name="add_item"] input[name="add_item[name]"]');
        $this->assertSelectorExists('form[name="add_item"] textarea[name="add_item[description]"]');
    }
    
    public function testAddPost()
    {
        $itemRepository = $this->entityManager->getRepository(Item::class);
        $this->assertCount(22, $itemRepository->findAll());

        $thumbnail = new UploadedFile(
            $this->getPathUpload() . DIRECTORY_SEPARATOR . 'thumbnail.png',
            'thumbnail.png',
            'image/png',
            null
        );
        
        $this->logUserAdmin();
        $this->client->request('GET', $this->router->generate('admin_items_add'));
        $crawler = $this->client->submitForm('add_item[submit]', [
            'add_item[name]' => 'item test',
            'add_item[slug]' => 'item-slug',
            'add_item[description]' => 'item description',
            'add_item[uploadThumbnail]' => $thumbnail
        ]);
        
        $this->assertResponseIsSuccessful();
        $this->assertCount(1, $crawler->filter('.flash-message'));
        $this->assertCount(23, $itemRepository->findAll());

        $itemRepository->removeEntity($itemRepository->findOneBy(['name' => 'item test']));
    }

    public function testEditUnlogged()
    {
        $this->assertRedirectIfNotLogged('admin_items_edit', ['id' => 1]);
    }
    
    public function testEdit()
    {
        $this->logUserAdmin();
        $this->client->request('GET', $this->router->generate('admin_items_edit', ['id' => 1]));
        $this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('h1', $this->translator->trans('admin.items.edit.title') . ' "Arc"');
        $this->assertSelectorExists('form[name="edit_item"] input[name="edit_item[uploadThumbnail]"]');
        $this->assertSelectorExists('form[name="edit_item"] input[name="edit_item[slug]"]');
        $this->assertSelectorExists('form[name="edit_item"] input[name="edit_item[name]"]');
        $this->assertSelectorExists('form[name="edit_item"] textarea[name="edit_item[description]"]');
        $this->assertSelectorExists('form[name="edit_item"] .current-thumbnail img');
    }
    
    public function testEditPost()
    {
        $itemRepository = $this->entityManager->getRepository(Item::class);
        $this->assertCount(22, $itemRepository->findAll());

        $thumbnail = new UploadedFile(
            $this->getPathUpload() . DIRECTORY_SEPARATOR . 'thumbnail.png',
            'thumbnail.png',
            'image/png',
            null
        );
        $publicUploadItemsPath = getcwd() . '/public/img/uploads/items';
        $publicUploadItems = scandir($publicUploadItemsPath);
        $item = $itemRepository->find(1);
        $thumbnailName = $item->getThumbnail();
        $thumbnailPublicPath = $publicUploadItemsPath . DIRECTORY_SEPARATOR . $thumbnailName;
        $thumbnailTestPath = $this->getPathUpload() . DIRECTORY_SEPARATOR . $thumbnailName;
        copy($thumbnailPublicPath, $thumbnailTestPath);

        $this->logUserAdmin();
        $this->client->request('GET', $this->router->generate('admin_items_edit', ['id' => $item->getId()]));
        $crawler = $this->client->submitForm('edit_item[submit]', [
            'edit_item[name]' => 'item test',
            'edit_item[slug]' => 'item-slug',
            'edit_item[description]' => 'item description',
            'edit_item[uploadThumbnail]' => $thumbnail
        ]);

        foreach(array_diff(scandir($publicUploadItemsPath), $publicUploadItems) as $file){
            unlink($publicUploadItemsPath . DIRECTORY_SEPARATOR . $file);
        }
        
        $this->assertResponseIsSuccessful();
        $this->assertCount(1, $crawler->filter('.flash-message'));
        $this->assertCount(22, $itemRepository->findAll()); 
        rename($thumbnailTestPath, $thumbnailPublicPath);
    }
}
