<?php

namespace App\Tests\Controller\Admin;

use App\Entity\License;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class LicenseControllerTest extends AbstractAdminWebTestCase
{
    public function testListUnlogged()
    {
        $this->assertRedirectIfNotLogged('admin_licenses_list');
    }

    public function testList()
    {
        $this->logUserAdmin();
        $crawler = $this->client->request('GET', $this->router->generate('admin_licenses_list'));
        $this->assertResponseIsSuccessful();
        
        $this->assertSelectorTextContains('h1', $this->translator->trans('licenses.list.title'));
        $this->assertCount(5, $crawler->filter('.list-group .list-group-item'));
        $this->assertSelectorExists('.list-group .list-group-item .dropdown-item:not(.remove-entity)');
        $this->assertSelectorExists('.list-group .list-group-item .dropdown-item.remove-entity');
    }
    public function testAddUnlogged()
    {
        $this->assertRedirectIfNotLogged('admin_licenses_add');
    }
    
    public function testAdd()
    {
        $this->logUserAdmin();
        $this->client->request('GET', $this->router->generate('admin_licenses_add'));
        $this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('h1', $this->translator->trans('admin.licenses.add.title'));
        $this->assertSelectorExists('form[name="add_license"] input[name="add_license[uploadThumbnail]"]');
        $this->assertSelectorExists('form[name="add_license"] input[name="add_license[slug]"]');
        $this->assertSelectorExists('form[name="add_license"] input[name="add_license[name]"]');
        $this->assertSelectorExists('form[name="add_license"] textarea[name="add_license[description]"]');
    }
    
    public function testAddPost()
    {
        $licenseRepository = $this->entityManager->getRepository(License::class);
        $this->assertCount(5, $licenseRepository->findAll());

        $thumbnail = new UploadedFile(
            $this->getPathUpload() . DIRECTORY_SEPARATOR . 'thumbnail.png',
            'thumbnail.png',
            'image/png',
            null
        );
        
        $this->logUserAdmin();
        $this->client->request('GET', $this->router->generate('admin_licenses_add'));
        $crawler = $this->client->submitForm('add_license[submit]', [
            'add_license[name]' => 'license test',
            'add_license[slug]' => 'license-slug',
            'add_license[description]' => 'license description',
            'add_license[uploadThumbnail]' => $thumbnail
        ]);
        
        $this->assertResponseIsSuccessful();
        $this->assertCount(1, $crawler->filter('.flash-message'));
        $this->assertCount(6, $licenseRepository->findAll());

        $licenseRepository->removeEntity($licenseRepository->findOneBy(['name' => 'license test']));
    }

    public function testEditUnlogged()
    {
        $this->assertRedirectIfNotLogged('admin_licenses_edit', ['id' => 1]);
    }
    
    public function testEdit()
    {
        $this->logUserAdmin();
        $this->client->request('GET', $this->router->generate('admin_licenses_edit', ['id' => 1]));
        $this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('h1', $this->translator->trans('admin.licenses.edit.title') . ' "Donkey Kong"');
        $this->assertSelectorExists('form[name="edit_license"] input[name="edit_license[uploadThumbnail]"]');
        $this->assertSelectorExists('form[name="edit_license"] input[name="edit_license[slug]"]');
        $this->assertSelectorExists('form[name="edit_license"] input[name="edit_license[name]"]');
        $this->assertSelectorExists('form[name="edit_license"] textarea[name="edit_license[description]"]');
        $this->assertSelectorExists('form[name="edit_license"] .current-thumbnail img');
    }
    
    public function testEditPost()
    {
        $licenseRepository = $this->entityManager->getRepository(License::class);
        $this->assertCount(5, $licenseRepository->findAll());
        $pathUploadTest = $this->getPathUpload();

        $thumbnail = new UploadedFile(
            $pathUploadTest . DIRECTORY_SEPARATOR . 'thumbnail.png',
            'thumbnail.png',
            'image/png',
            null
        );

        $logo = new UploadedFile(
            $pathUploadTest . DIRECTORY_SEPARATOR . 'logo.png',
            'logo.png',
            'image/png',
            null
        );

        $publicUploadLicensesPath = getcwd() . '/public/img/uploads/licenses';
        $publicUploadLicenses = scandir($publicUploadLicensesPath);
        $license = $licenseRepository->find(1);
        $thumbnailName = $license->getThumbnail();
        $logoName = $license->getLogo();
        

        $uploadEntity = [
            [
                'publicPath' => $publicUploadLicensesPath . DIRECTORY_SEPARATOR . $thumbnailName,
                'testPath' => $pathUploadTest . DIRECTORY_SEPARATOR . $thumbnailName
            ],
            [
                'publicPath' => $publicUploadLicensesPath . DIRECTORY_SEPARATOR . $logoName,
                'testPath' => $pathUploadTest . DIRECTORY_SEPARATOR . $logoName
            ],
        ];

        foreach($uploadEntity as $uploadData){
            copy($uploadData['publicPath'], $uploadData['testPath']);
        }


        $this->logUserAdmin();
        $this->client->request('GET', $this->router->generate('admin_licenses_edit', ['id' => $license->getId()]));
        $crawler = $this->client->submitForm('edit_license[submit]', [
            'edit_license[name]' => 'license test',
            'edit_license[slug]' => 'license-slug',
            'edit_license[description]' => 'license description',
            'edit_license[uploadThumbnail]' => $thumbnail,
            'edit_license[uploadLogo]' => $logo
        ]);

        foreach(array_diff(scandir($publicUploadLicensesPath), $publicUploadLicenses) as $file){
            unlink($publicUploadLicensesPath . DIRECTORY_SEPARATOR . $file);
        }
        
        $this->assertResponseIsSuccessful();
        $this->assertCount(1, $crawler->filter('.flash-message'));
        $this->assertCount(5, $licenseRepository->findAll()); 

        foreach($uploadEntity as $uploadData){
            rename($uploadData['testPath'], $uploadData['publicPath']);
        }
    }
}
