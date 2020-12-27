<?php

namespace App\Tests\Twig;

use App\Entity\Game;
use App\Entity\Item;
use App\Entity\Console;
use App\Entity\License;
use App\Entity\Character;
use App\Twig\CountEntityExtension;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CountEntityExtensionTest extends KernelTestCase
{
    public function testCountEntity()
    {
        $countEntityExtension = new CountEntityExtension(self::bootKernel()->getContainer()->get('doctrine')->getManager());
        
        $this->assertSame(24, $countEntityExtension->countEntity(Game::class));
        $this->assertSame(5, $countEntityExtension->countEntity(License::class));
        $this->assertSame(14, $countEntityExtension->countEntity(Console::class));
        $this->assertSame(22, $countEntityExtension->countEntity(Item::class));
        $this->assertSame(22, $countEntityExtension->countEntity(Character::class));
    }
}
