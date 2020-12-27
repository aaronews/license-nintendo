<?php

namespace App\Tests\Controller\Admin;

use App\Entity\Game;
use App\Entity\Item;
use App\Entity\Genre;
use App\Entity\Console;
use App\Entity\License;
use App\Entity\GameItem;
use App\Entity\Character;
use App\Entity\GameCharacter;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class GameControllerTest extends AbstractAdminWebTestCase
{
    public function testListUnlogged()
    {
        $this->assertRedirectIfNotLogged('admin_games_list');
    }

    public function testList()
    {
        $this->logUserAdmin();
        $crawler = $this->client->request('GET', $this->router->generate('admin_games_list'));
        $this->assertResponseIsSuccessful();
        
        $this->assertSelectorTextContains('h1', $this->translator->trans('games.list.title'));
        $this->assertCount(5, $crawler->filter('.list-group .list-group-item'));
        $this->assertCount(4, $crawler->filter('.list-group .list-group-item ')->eq(0)->filter('.dropdown-item'));
        $this->assertSelectorExists('.list-group .list-group-item .dropdown-item.remove-entity');
    }
    public function testAddUnlogged()
    {
        $this->assertRedirectIfNotLogged('admin_games_add');
    }
    
    public function testAdd()
    {
        $this->logUserAdmin();
        $crawler = $this->client->request('GET', $this->router->generate('admin_games_add'));
        $this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('h1', $this->translator->trans('admin.games.add.title'));
        $this->assertSelectorExists('form[name="add_game"] input[name="add_game[uploadThumbnail]"]');
        $this->assertSelectorExists('form[name="add_game"] input[name="add_game[uploadBackgroundDesktop]"]');
        $this->assertSelectorExists('form[name="add_game"] input[name="add_game[uploadBackgroundMobile]"]');
        $this->assertSelectorExists('form[name="add_game"] input[name="add_game[slug]"]');
        $this->assertSelectorExists('form[name="add_game"] input[name="add_game[name]"]');
        $this->assertSelectorExists('form[name="add_game"] textarea[name="add_game[description]"]');
        $this->assertSelectorExists('form[name="add_game"] textarea[name="add_game[history]"]');
        $this->assertSelectorExists('form[name="add_game"] select[name="add_game[license]"]');
        $this->assertSelectorExists('form[name="add_game"] input[name="add_game[nbPlayers]"]');
        $this->assertSelectorExists('form[name="add_game"] select[name="add_game[genres][]"]');
        $this->assertSelectorExists('form[name="add_game"] select[name="add_game[consoles][]"]');
        $this->assertSelectorExists('form[name="add_game"] input[name="add_game[backgroundPosition]"]');
        $this->assertSelectorExists('form[name="add_game"] input[name="add_game[firstBlockMinHeight]"]');
        $this->assertCount(3, $crawler->filter('form[name="add_game"] .preview-upload'));
    }
    
    public function testAddPost()
    {
        $gameRepository = $this->entityManager->getRepository(Game::class);
        $this->assertCount(24, $gameRepository->findAll());
        $pathUploadTest = $this->getPathUpload();

        $thumbnail = new UploadedFile(
            $pathUploadTest . DIRECTORY_SEPARATOR . 'thumbnail.png',
            'thumbnail.png',
            'image/png',
            null
        );

        $bkgDesktop = new UploadedFile(
            $pathUploadTest . DIRECTORY_SEPARATOR . 'background-desktop.png',
            'background-desktop.png',
            'image/png',
            null
        );

        $bkgMobile = new UploadedFile(
            $pathUploadTest . DIRECTORY_SEPARATOR . 'background-mobile.png',
            'background-mobile.png',
            'image/png',
            null
        );
        
        $this->logUserAdmin();
        $crawler = $this->client->request('GET', $this->router->generate('admin_games_add'));
        $form = $crawler->selectButton('add_game[submit]')->form([
            'add_game[name]' => 'game test',
            'add_game[slug]' => 'game-slug',
            'add_game[description]' => 'game description',
            'add_game[history]' => 'game histroy',
            'add_game[license]' => $this->entityManager->getRepository(License::class)->findOneBy(['name' => 'The Legend of Zelda'])->getId(),
            'add_game[releaseDate]' => '11/12/2000',
            'add_game[copiesSold]' => 1000000,
            'add_game[nbPlayers]' => '1',
            'add_game[backgroundPosition]' => 'center',
            'add_game[firstBlockMinHeight]' => 500,
            'add_game[uploadThumbnail]' => $thumbnail,
            'add_game[uploadBackgroundDesktop]' => $bkgDesktop,
            'add_game[uploadBackgroundMobile]' => $bkgMobile
        ]);
        $form->get('add_game[consoles]')->select($this->entityManager->getRepository(Console::class)->findOneBy(['name' => '3ds'])->getId());
        $form->get('add_game[genres]')->select($this->entityManager->getRepository(Genre::class)->findOneBy(['name' => 'Action'])->getId());
        $crawler = $this->client->submit($form);
        
        $this->assertResponseIsSuccessful();
        $this->assertCount(1, $crawler->filter('.flash-message'));
        $this->assertCount(25, $gameRepository->findAll());

        $gameRepository->removeEntity($gameRepository->findOneBy(['name' => 'game test']));
    }

    public function testEditUnlogged()
    {
        $this->assertRedirectIfNotLogged('admin_games_edit', ['id' => 1]);
    }
    
    public function testEdit()
    {
        $this->logUserAdmin();
        $crawler = $this->client->request('GET', $this->router->generate('admin_games_edit', ['id' => 1]));
        $this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('h1', $this->translator->trans('admin.games.edit.title') . ' "Donkey Kong 64"');
        
        $this->assertSelectorExists('form[name="edit_game"] input[name="edit_game[uploadThumbnail]"]');
        $this->assertSelectorExists('form[name="edit_game"] input[name="edit_game[uploadBackgroundDesktop]"]');
        $this->assertSelectorExists('form[name="edit_game"] input[name="edit_game[uploadBackgroundMobile]"]');
        $this->assertSelectorExists('form[name="edit_game"] input[name="edit_game[slug]"]');
        $this->assertSelectorExists('form[name="edit_game"] input[name="edit_game[name]"]');
        $this->assertSelectorExists('form[name="edit_game"] textarea[name="edit_game[description]"]');
        $this->assertSelectorExists('form[name="edit_game"] textarea[name="edit_game[history]"]');
        $this->assertSelectorExists('form[name="edit_game"] select[name="edit_game[license]"]');
        $this->assertSelectorExists('form[name="edit_game"] input[name="edit_game[nbPlayers]"]');
        $this->assertSelectorExists('form[name="edit_game"] select[name="edit_game[genres][]"]');
        $this->assertSelectorExists('form[name="edit_game"] select[name="edit_game[consoles][]"]');
        $this->assertSelectorExists('form[name="edit_game"] input[name="edit_game[backgroundPosition]"]');
        $this->assertSelectorExists('form[name="edit_game"] input[name="edit_game[firstBlockMinHeight]"]');
        $this->assertCount(3, $crawler->filter('form[name="edit_game"] .preview-upload'));
    }
    
    public function testEditPost()
    {
        $gameRepository = $this->entityManager->getRepository(Game::class);
        $this->assertCount(24, $gameRepository->findAll());
        $pathUploadTest = $this->getPathUpload();

        $thumbnail = new UploadedFile(
            $pathUploadTest . DIRECTORY_SEPARATOR . 'thumbnail.png',
            'thumbnail.png',
            'image/png',
            null
        );

        $bkgDesktop = new UploadedFile(
            $pathUploadTest . DIRECTORY_SEPARATOR . 'background-desktop.png',
            'background-desktop.png',
            'image/png',
            null
        );

        $bkgMobile = new UploadedFile(
            $pathUploadTest . DIRECTORY_SEPARATOR . 'background-mobile.png',
            'background-mobile.png',
            'image/png',
            null
        );

        $publicUploadGamesPath = getcwd() . '/public/img/uploads/games';
        $publicUploadGames = scandir($publicUploadGamesPath);
        $game = $gameRepository->find(1);
        $thumbnailName = $game->getThumbnail();
        $bkgDesktopName = $game->getBackgroundDesktop();
        $bkgMobileName = $game->getBackgroundMobile();
        

        $uploadEntity = [
            [
                'publicPath' => $publicUploadGamesPath . DIRECTORY_SEPARATOR . $thumbnailName,
                'testPath' => $pathUploadTest . DIRECTORY_SEPARATOR . $thumbnailName
            ],
            [
                'publicPath' => $publicUploadGamesPath . DIRECTORY_SEPARATOR . $bkgDesktopName,
                'testPath' => $pathUploadTest . DIRECTORY_SEPARATOR . $bkgDesktopName
            ],
            [
                'publicPath' => $publicUploadGamesPath . DIRECTORY_SEPARATOR . $bkgMobileName,
                'testPath' => $pathUploadTest . DIRECTORY_SEPARATOR . $bkgMobileName
            ],
        ];

        foreach($uploadEntity as $uploadData){
            copy($uploadData['publicPath'], $uploadData['testPath']);
        }

        $this->logUserAdmin();
        $crawler = $this->client->request('GET', $this->router->generate('admin_games_edit', ['id' => $game->getId()]));

        //get form and set values except for select fields
        $form = $crawler->selectButton('edit_game[submit]')->form([
            'edit_game[name]' => 'game test',
            'edit_game[slug]' => 'game-slug',
            'edit_game[description]' => 'game description',
            'edit_game[history]' => 'game histroy',
            'edit_game[license]' => $this->entityManager->getRepository(License::class)->findOneBy(['name' => 'The Legend of Zelda'])->getId(),
            'edit_game[releaseDate]' => '11/12/2000',
            'edit_game[copiesSold]' => 1000000,
            'edit_game[nbPlayers]' => '1',
            'edit_game[backgroundPosition]' => 'center',
            'edit_game[firstBlockMinHeight]' => 500,
            'edit_game[uploadThumbnail]' => $thumbnail,
            'edit_game[uploadBackgroundDesktop]' => $bkgDesktop,
            'edit_game[uploadBackgroundMobile]' => $bkgMobile
        ]);
        //set value of select fields
        $form->get('edit_game[consoles]')->select($this->entityManager->getRepository(Console::class)->findOneBy(['name' => '3ds'])->getId());
        $form->get('edit_game[genres]')->select($this->entityManager->getRepository(Genre::class)->findOneBy(['name' => 'Action'])->getId());
        $crawler = $this->client->submit($form);

        foreach(array_diff(scandir($publicUploadGamesPath), $publicUploadGames) as $file){
            unlink($publicUploadGamesPath . DIRECTORY_SEPARATOR . $file);
        }
        
        $this->assertResponseIsSuccessful();
        $this->assertCount(1, $crawler->filter('.flash-message'));
        $this->assertCount(24, $gameRepository->findAll()); 

        foreach($uploadEntity as $uploadData){
            rename($uploadData['testPath'], $uploadData['publicPath']);
        }
    }
    

    public function testManageCharactersUnlogged()
    {
        $this->assertRedirectIfNotLogged('admin_games_characters_manage', ['id' => 1]);
    }
    
    public function testManageCharacters()
    {
        $this->logUserAdmin();
        $crawler = $this->client->request('GET', $this->router->generate('admin_games_characters_manage', ['id' => 1]));
        $this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('h1', $this->translator->trans('admin.games.characters.manage.title') . ' : "Donkey Kong 64"');
        
        $this->assertSelectorExists('form[name="add_game_character"] select[name="add_game_character[currentCharacter]"]');
        $this->assertSelectorExists('form[name="add_game_character"] input[name="add_game_character[uploadThumbnail]"]');
        $this->assertCount(1, $crawler->filter('form[name="add_game_character"] .preview-upload'));
        $this->assertCount(4, $crawler->filter('.list-content .list-group .list-group-item'));
    }

    public function testManageCharactersPost()
    {
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $character = $this->entityManager->getRepository(Character::class)->findOneBy(['name' => 'Link']);
        $gameCharacterRepository = $this->entityManager->getRepository(GameCharacter::class);
        $this->assertCount(129, $gameCharacterRepository->findAll());

        $thumbnail = new UploadedFile(
            $this->getPathUpload() . DIRECTORY_SEPARATOR . 'thumbnail.png',
            'thumbnail.png',
            'image/png',
            null
        );
        
        $this->logUserAdmin();
        $crawler = $this->client->request('GET', $this->router->generate('admin_games_characters_manage', ['id' => $game->getId()]));
        $form = $crawler->selectButton('add_game_character[submit]')->form([
            'add_game_character[uploadThumbnail]' => $thumbnail,
        ]);
        $form->get('add_game_character[currentCharacter]')->select($character->getId());
        $crawler = $this->client->submit($form);
        
        $this->assertResponseIsSuccessful();
        $this->assertCount(1, $crawler->filter('.flash-message'));
        $this->assertCount(130, $gameCharacterRepository->findAll());

        $gameCharacterRepository->removeEntity($gameCharacterRepository->findOneBy(['currentCharacter' => $character, 'game' => $game]));
    }
    

    public function testManageItemsUnlogged()
    {
        $this->assertRedirectIfNotLogged('admin_games_items_manage', ['id' => 1]);
    }
    
    public function testManageItems()
    {
        $this->logUserAdmin();
        $crawler = $this->client->request('GET', $this->router->generate('admin_games_items_manage', ['id' => 1]));
        $this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('h1', $this->translator->trans('admin.games.items.manage.title') . ' : "Donkey Kong 64"');
        
        $this->assertSelectorExists('form[name="add_game_item"] select[name="add_game_item[item]"]');
        $this->assertSelectorExists('form[name="add_game_item"] input[name="add_game_item[uploadThumbnail]"]');
        $this->assertCount(1, $crawler->filter('form[name="add_game_item"] .preview-upload'));
        $this->assertCount(2, $crawler->filter('.list-content .list-group .list-group-item'));
    }

    public function testManageItemsPost()
    {
        $game = $this->entityManager->getRepository(Game::class)->find(1);
        $item = $this->entityManager->getRepository(Item::class)->findOneBy(['name' => 'Ocarina']);
        $gameItemRepository = $this->entityManager->getRepository(GameItem::class);
        $this->assertCount(111, $gameItemRepository->findAll());

        $thumbnail = new UploadedFile(
            $this->getPathUpload() . DIRECTORY_SEPARATOR . 'thumbnail.png',
            'thumbnail.png',
            'image/png',
            null
        );
        
        $this->logUserAdmin();
        $crawler = $this->client->request('GET', $this->router->generate('admin_games_items_manage', ['id' => $game->getId()]));
        $form = $crawler->selectButton('add_game_item[submit]')->form([
            'add_game_item[uploadThumbnail]' => $thumbnail,
        ]);
        $form->get('add_game_item[item]')->select($item->getId());
        $crawler = $this->client->submit($form);
        
        $this->assertResponseIsSuccessful();
        $this->assertCount(1, $crawler->filter('.flash-message'));
        $this->assertCount(112, $gameItemRepository->findAll());

        $gameItemRepository->removeEntity($gameItemRepository->findOneBy(['item' => $item, 'game' => $game]));
    }
}
