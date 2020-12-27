<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Game;
use App\Entity\Item;
use App\Entity\User;
use App\Entity\Genre;
use App\Entity\Console;
use App\Entity\License;
use App\Entity\GameItem;
use App\Entity\Character;
use App\Entity\GameCharacter;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    
    
    public function load(ObjectManager $manager)
    {
        /**
         * User
         */
        $userAdmin = new User();
        $userAdmin
            ->setPassword($this->passwordEncoder->encodePassword($userAdmin, 'admin'))
            ->setUsername('admin@gmail.com')
            ->setActive(true)
            ->setToken('123aec5b3502942fe24597941b51bcfd5ef38026')
            ->setRoles(['ROLE_USER', 'ROLE_ADMIN'])
        ;
        $manager->persist($userAdmin);
        
        $userNotActivate = new User();
        $userNotActivate
            ->setPassword($this->passwordEncoder->encodePassword($userNotActivate, 'admin'))
            ->setUsername('user@gmail.com')
            ->setActive(false)
            ->setToken('b34aec5b3502942fe24597941b51bcfd5ef38026')
            ->setRoles(['ROLE_USER'])
        ;
        $manager->persist($userNotActivate);

        /**
         * License
         */
        $licenseDonkeyKong = new License();
        $licenseDonkeyKong
            ->setName('Donkey Kong')
            ->setSlug('donkey-kong')
            ->setDescription('La saga Donkey Kong met en scène une famille de signes, les Kong, dont le personnage principale de la majorité des jeux est Donkey Kong.<br/><br/>On peut y retrouver plusieurs style de jeux tels que des jeux de plateforme avec la série des Donkey Kong Country, ou la famille Kong est confronté aux Kremlings dirigés par King K. Rool, dont les motivations de ce dernier va évoluer entre chaque jeux. Il y a également des jeux de courses avec Donkey Kong Jet Race et Diddy Kong Racing.')
            ->setThumbnail('dk-5fb5693658be7516189029.jpg')
            ->setLogo('563-5636826-donkey-kong-logo-png-download-donkey-kong-logo-5fc3cbc39d821721656460.png')
        ;
        $manager->persist($licenseDonkeyKong);
        
        $licensePokemon = new License();
        $licensePokemon
            ->setName('Pokémon')
            ->setSlug('pokemon')
            ->setDescription("Les jeux Pokémon principaux sont des RPG mettent en scène un(e) jeune adolescent(e), souhaitant devenir maître de la ligue Pokémon. Pour ce faire il va quitter son village natal et choisir son premier Pokémon et partir à la conquête des badges d'arène afin de pour accéder à la ligue. Tout aux long des jeux le joueur pourra agrandir son équipe de combat pour avoir jusqu'à 6 Pokémons. Dans certain de ces jeux, on plus du l'objectif ultime qu'est la ligue, le personnage principale sera mêlé à une intrigue parallèle impliquant un groupe de personnes mal intentionné se faisant appelé \"Team\", la plus célébré d'entre elles est la Team Rocket faisait du trafic de Pokémon pour les revendre aux plus offrant ou les utiliser à leurs propres fins.<br/><br/>D'autres jeux sont également disponible dans l'univers de Pokémon, comme les Pokémon Ranger, les Pokémon Donjon Mystère, Détective Pikachu ou encore Pokémon Snap.")
            ->setThumbnail('pokemon-5fb569547bd06476306870.png')
            ->setLogo(null)
        ;
        $manager->persist($licensePokemon);
        
        $licenseSuperMario = new License();
        $licenseSuperMario
            ->setName('Super Mario')
            ->setSlug('super-mario')
            ->setDescription("Super Mario met en scène le célèbre plombier moustachu créer par Shigeru Miyamoto : Mario. Les jeux de la franchise Super Mario a rassemblé beaucoup de jeux différents au fil du temps. Les plus célèbres sont les jeux de plateforme, dont le premier est Super Mario Bros. sortie sur la Famicom au Japon et sur la NES pour le reste du monde.<br/><br/>Ces jeux mettent en scène une intrigue simple,  Mario va devoir sauvé la princesse Peach qui s'est fait kidnappée par le roi des Koopa : Bowser. Pour cela Mario va devoir traverser une série de niveaux divers et variés, dans lesquels il va devoir affronter des ennemis et réussir les phase de plateformes.")
            ->setThumbnail('mario-5fb5694646524909207033.png')
            ->setLogo('1280px-mario-series-logo.svg-5fbead61ac717116881969.png')
        ;
        $manager->persist($licenseSuperMario);
        
        $licenseSuperSmashBros = new License();
        $licenseSuperSmashBros
            ->setName('Super Smash Bros')
            ->setSlug('super-smash-bros')
            ->setDescription("Super Smash Bros met en scène les personnages de l'univers Nintendo ainsi que d'autres issus de licence d'éditeur tiers dans des jeux de combats et plateforme. On pourra donc y voir Link et Bowser affronter King K. Rool et Pikachu lors d'un macth. Tout comme les combattants, les terrains de combat sont tirés  des jeux de la franchise Nintendo. A dur est a mesure de la sortie des jeux, de nouveaux personnage vienne se rajouter au casting, ils ne sont pas tous jouable sur tout les jeux. Seul Smash Bros Ultimate à réunit l'intégralité des combattants qui sont apparu dans les anciens jeux, tout en rajoutant des nouveaux.<br/><br/>Dans certains jeux, un mode aventure est disponible, racontant un scénario inédit impliquant tout les combattant. Ce mode est d'ailleurs un des moyen pour débloquer les combattants, car ils ne sont pas tous disponibles au début du jeu.")
            ->setThumbnail('super-smash-5fb5697b5ccef738622013.png')
            ->setLogo(null)
        ;
        $manager->persist($licenseSuperSmashBros);
        
        $licenseZelda = new License();
        $licenseZelda
            ->setName('The Legend of Zelda')
            ->setSlug('the-legend-of-zelda')
            ->setDescription("Les jeux The Legend of Zelda nous raconte l'histoire de Link, un jeune garçon (ou jeune adulte, selon les jeux) devant se battre contre les forces du mal, représentées par l'Avatar du néant puis par Ganondorf, sa réincarnation. Pour l'aider dans sa quête, il pourra compter sur Zelda princesse du royaume d'Hyrule, réincarnation de la déesse Hylia. Et divers objets qu'il aura pu récupérer durant son périple.  Ces trois personnages possèdent chacun un fragment de la Triforce. Triangle d'or permettant de réaliser le vœux de celui qui la touche. Zelda possède celle de la sagesse, Link celle du courage et Ganondorf celle de la force.<br/><br/>Les jeux de cette licence sont des action-RPG où Link va devoir évoluer à travers le royaume d'Hyrule et se confronter à des donjons remplis d'énigmes et de monstres. La structure classique de ces jeux est la suivante : exploration dans Hyrule, entrer dans le donjon, découverte de l'objet du donjon nous permettant de de l'explorer intégralement, vaincre le boss du donjon et ainsi de suite. C'est depuis Breath of the Wild que la formule a changée. En effet, depuis cet opus en mode ouvert, les joueurs sont libres de faire se qu'ils veulent, du moment qu'ils auront terminés la zone servant de tutoriel.")
            ->setThumbnail('zelda-5fb5699f586e5726330774.png')
            ->setLogo('logo-5fbeace408f0e929946582.svg')
        ;
        $manager->persist($licenseZelda);

        /**
         * Consoles
         */
        $console3ds = new Console();
        $console3ds
            ->setName('3DS')
            ->setSlug('3ds')
            ->setThumbnail('3ds-5fb562b742606269920968.png')
            ->setReleasePrice(220)
            ->setReleaseDate((new DateTime())->setDate(2011, 3, 25))
            ->setDescription("La Nintendo 3DS est une console portable de Nintendo sortie entre février et mars 2011 dans le monde. Elle succède à la Nintendo DS et possède une rétrocompatibilité avec les jeux de la DS. <br/><br/>Cette console possède deux écrans : celui du bas est tactile, et celui du haut affiche des graphismes en 3D sans lunettes (l'intensité de la 3D est réglable avec une molette). Elle dispose également de deux caméras à l'arrière, pour prendre des photos en 3D, et d'une caméra en façade. Un joystick a été ajouté à la classique croix directionnelle, et une carte SD de 2 Go est fournie avec la console.<br/><br/>La Nintendo 3DS a connu plusieurs déclinaisons : la Nintendo 3DS XL, sortie le 28 juillet 2012 en Europe ; la Nintendo 2DS, sortie le 12 octobre 2013 ; la New Nintendo 3DS (et XL), sortie le 13 février 2015 en Europe et la New Nintendo 2DS XL, sortie le 28 juillet 2017 en Europe.")
        ;
        $manager->persist($console3ds);
        
        $consoleDsLite = new Console();
        $consoleDsLite
            ->setName('Nintendo DS Lite')
            ->setSlug('nintendo-ds-lite')
            ->setThumbnail('ds-lite-5fd1417e2297e905125204.png')
            ->setReleasePrice(150)
            ->setReleaseDate((new DateTime())->setDate(2006, 6, 23))
            ->setDescription("La Nintendo DS Lite est la version redessinée de la Nintendo DS. Annoncée pour la première fois le 26 janvier 2006 et sortie le 2 mars 2006 au Japon, le 11 juin 2006 aux États-Unis et le 23 juin 2006 en Europe.<br/><br/>Comparer à sa grand sœur, cette console est plus petite, possède des écrans plus lumineux et contrastés, une meilleur autonomie, plus de coloris, un réglage de volume plus précis, un port Game Boy Advance moins profond se qui laisse dépasser légèrement la cartouche et un bouton <i>Power</i> avec un système à glissière placé sur le côté droit de la console.")
        ;
        $manager->persist($consoleDsLite);
        
        $consoleDs = new Console();
        $consoleDs
            ->setName('Nintendo DS')
            ->setSlug('nintendo-ds')
            ->setThumbnail('ds-5fb56332972b1568888636.png')
            ->setReleasePrice(145)
            ->setReleaseDate((new DateTime())->setDate(2005, 3, 11))
            ->setDescription("La Nintendo DS, DS pour Dual Screen, est une console portable créée par Nintendo, sortie fin 2004 au Japon et en Amérique du Nord et en 2005 en Europe. Elle est équipée de plusieurs fonctions auparavant rares, voire inédites dans le domaine du jeu vidéo portable, telles que deux écrans rétro-éclairés simultanément dont un écran tactile, un microphone, deux ports cartouche (un pour les jeux Nintendo DS, un autre pour les cartouches de jeu Game Boy Advance et les accessoires), deux haut-parleurs compatibles surround (virtuel), ou encore le Wi-Fi intégré.<br/><br/>À l'origine, l'idée était de mettre sur le marché une machine pour faire patienter les joueurs en attendant une nouvelle version de la Game Boy. Le 13 novembre 2003, Nintendo a annoncé qu'il allait sortir une nouvelle console pour 2004. Le 20 janvier 2004, la console a été annoncée sous le nom de code Nintendo DS (Developer's System), le nom de code a été changé en Nitro en mars 2004. Mais elle obtient son nom et aspect définit le 28 juillet 2004, DS veut désormais dire Dual Screen.")
        ;
        $manager->persist($consoleDs);
        
        $consoleDsi = new Console();
        $consoleDsi
            ->setName('Nintendo DSI')
            ->setSlug('nintendo-dsi')
            ->setThumbnail('dsi-5fd140fb564f4404001264.png')
            ->setReleasePrice(170)
            ->setReleaseDate((new DateTime())->setDate(2009, 4, 3))
            ->setDescription("La Nintendo DSi (Le i se prononce « Aïe », référence aux caméras) est une console de jeu Nintendo succédant à la Nintendo DS Lite, sortie le 1er novembre 2008 au Japon, en Europe le 3 avril 2009 et en Amérique du Nord le 5 avril 2009.<br/><br/>Deux caméras sont disponibles, un lecteur de cartes SD, un navigateur web Opera intégré et un lecteur audio supportant uniquement le format AAC. Les photos prises pourront alors être modifiées à l'aide de l'écran tactile et être sauvegardées sur une carte SD. Elle possède aussi une mémoire interne, afin de télécharger divers programmes via le Nintendo DSiWare à l'aide des Nintendo Points.<br/><br/>Le design de la DSi est très similaire à celui de la DS Lite et les jeux de la DS et de la DS Lite sont compatibles mais plus ceux de la Game Boy Advance. En effet, afin de rendre la console plus fine et plus légère que la DS Lite, l'emplacement pour cartouches Game Boy Advance a été supprimé.")
        ;
        $manager->persist($consoleDsi);
        
        $consoleGba = new Console();
        $consoleGba
            ->setName('Game Boy Advance')
            ->setSlug('game-boy-advance')
            ->setThumbnail('gameboy-advance-5fd140e3205fa712367960.png')
            ->setReleasePrice(130)
            ->setReleaseDate((new DateTime())->setDate(2001, 6, 22))
            ->setDescription("La Game Boy Advance (abrégée en GBA) est une console de jeux vidéo portable créée par Nintendo en 2001. Elle dispose d'un écran couleur et d'un processeur 32-bits, ce qui en faisait à sa sortie la console portable la plus performante.<br/><br/>Descendante de la Game Boy Color, elle offre des performances légèrement supérieures aux consoles de salon 16 bits. La GBA n'étant pas zonée, il est possible de jouer à des jeux américains et japonais sur une console européenne. De plus, le faible coût de développement des jeux pour consoles portables fait que de nombreuses productions sortent sur Game Boy Advance.<br/><br/>La possibilité de jouer à quatre, parfois avec une seule cartouche de jeu, en reliant les Game Boy Advance entre elles est un autre point fort. Son gros point faible bien qu'il existe des accessoires pour compenser ce défaut est l'absence de rétro-éclairage, rendant l'affichage très sombre. C'est l'un des points qui ont amené Nintendo à sortir la Game Boy Advance SP, un modèle disposant d'un écran éclairé par le biais de diodes sur ses côtés.")
        ;
        $manager->persist($consoleGba);
        
        $consoleGb = new Console();
        $consoleGb
            ->setName('Game Boy')
            ->setSlug('game-boy')
            ->setThumbnail('gameboy-5fd141d1b76ee940658168.png')
            ->setReleasePrice(90)
            ->setReleaseDate((new DateTime())->setDate(1990, 9, 28))
            ->setDescription("Avec une si grande puissance contenue dans un si petit boîtier, cette petite console révolutionna le jeu vidéo à sa sortie au Japon en 1989. Depuis lors, cette console de poche a été vendue à plus de 100 millions d'exemplaires, offrant aux joueurs du monde entier la possibilité de jouer à leurs jeux favoris - comme Tetris, Super Mario et Pokémon - quel que soit l'endroit où ils se trouvent.<br/><br/>Malgré une qualité graphique minimaliste, la Game Boy a su s'imposer grâce à de nombreux atouts : petite taille, prix bas, grande autonomie et catalogue de jeux aussi riche que varié. Le succès de la machine conduira Nintendo à utiliser la marque Game Boy pour plusieurs de ses successeurs, dont la Game Boy Color, en 1998, et la Game Boy Advance, en 2001.")
        ;
        $manager->persist($consoleGb);
        
        $consoleGbc = new Console();
        $consoleGbc
            ->setName('Game Boy Color')
            ->setSlug('game-boy-color')
            ->setThumbnail('gameboy-color-5fd140e72e606149551200.png')
            ->setReleasePrice(75)
            ->setReleaseDate((new DateTime())->setDate(1998, 11, 23))
            ->setDescription("La Game Boy Color, abrégé GBC, est la console de jeux vidéo portable succédant à la Game Boy. Elle incorpore un écran couleur à peine plus grand que celui de la Game Boy. En revanche, son processeur est deux fois plus rapide, et sa mémoire deux fois plus grande. Elle également est rétrocompatible avec tous les jeux Game Boy de première génération.<br/><br/>C'est à l'automne 1998 que la GBC sort au Japon, en Amérique, et en Europe. Le succès est immense car la console progresse graphiquement tout en restant à 100 % rétrocompatible. Il faut dire aussi que sa sortie coïncide avec le phénomène mondial des jeux Pokémon.")
        ;
        $manager->persist($consoleGbc);
        
        $consoleGameCube = new Console();
        $consoleGameCube
            ->setName('GameCube')
            ->setSlug('gamecube')
            ->setThumbnail('gamecube-5fb565c731ba4751659452.png')
            ->setReleasePrice(199)
            ->setReleaseDate((new DateTime())->setDate(2002, 5, 3))
            ->setDescription("La Nintendo GameCube est une console de jeux vidéo de salon crée par Nintendo, sortie en 2001 (2002 en Europe). Elle fut en concurrence avec la PlayStation 2 de Sony, la Xbox de Microsoft et la Dreamcast de Sega, qui forment ensemble la sixième génération de consoles de jeux vidéo.<br/><br/>Lors de l'E3 1999, Howard Lincoln, président de Nintendo of America, annonce que Nintendo est en train de développer une console sous le nom de \"Project Dolphin\" et parle d'une sortie mondiale fin 2000. C'est donc le 24 août 2000 que la machine est officiellement présentée avec son nouveau nom, la GameCube, durant le Nintendo Space World.  Nintendo annonce sa sortie pour juillet 2001 au Japon et pour octobre de la même année aux États-Unis. Finalement la console ne sortira que le 14 septembre 2001 au Japon, le 18 novembre 2001 aux États-Unis et le 3 mai 2002 en Europe.<br/><br/>Elle a pu profiter de nombreux jeux issus des licences fortes de Nintendo, comme Zelda Twlight Princess, Mario Sunshine, Metroid Prime et Star Fox : Adventure. Malgré cela elle, fait partie d'une des consoles de salon Nintendo s'attend le moins bien vendu.")
        ;
        $manager->persist($consoleGameCube);
        
        $consoleNes = new Console();
        $consoleNes
            ->setName('Nintendo Entertainment System (NES)')
            ->setSlug('nintendo-entertainment-system')
            ->setThumbnail('nes-5fd141035a2d6611313839.png')
            ->setReleasePrice(391)
            ->setReleaseDate((new DateTime())->setDate(1987, 10, 27))
            ->setDescription("La Nintendo Entertainment System, par abréviation NES, est une console de jeux vidéo de génération 8 bits fabriquée par Nintendo et distribuée à partir de 1985 (1987 en Europe). Son équivalent japonais est la Family Computer , ou Famicom, est sortie quelques années avant, en 1983.<br/><br/>La console connut un succès mondial, ce qui aida à redynamiser l'industrie du jeu vidéo après le krach du jeu vidéo de 1983, et ce qui fixa les normes pour les consoles suivantes, du game design aux procédures de gestion. Super Mario Bros. fut le jeu le plus vendu sur la console. Son succès fut tel que ce jeu justifiait bien souvent l'achat de la console à lui tout seul, devenant ainsi un killer game.")
        ;
        $manager->persist($consoleNes);
        
        $consoleN64 = new Console();
        $consoleN64
            ->setName('Nintendo 64')
            ->setSlug('nintendo-64')
            ->setThumbnail('nintendo-64-5fd140f0e3402653460981.png')
            ->setReleasePrice(204)
            ->setReleaseDate((new DateTime())->setDate(1997, 9 ,1))
            ->setDescription("La Nintendo 64 également connue sous les noms Ultra 64 ou Project Reality lors de son développement est la 3eme console de salon de Nintendo. Sortie en 1997 en Europe en collaboration avec Silicon Graphics, elle fut la dernière console de la cinquième géneration a être sortie.<br/><br/>La Nintendo 64 a certaines particularités : c'est une console 64 bits contrairement a la Saturn ou la Playstation, ses concurrentes qui sont des consoles 32 bits. L'entreprise a préféré utiliser un support cartouche plus rentable pour Nintendo mais plus contraignant et plus cher que le support CD. Elle innove en utilisant un stick analogique sur sa manette qui se révélera indispensable pour les jeux en 3D, elle était également la première console a disposer de 4 ports manettes pour les jeux multijoueur.<br/><br/>Cette console à permit à Nintendo d'engager la transition de la 2D à la 3D de nombreuses de ces licences de jeux. Comme Mario, avec Mario 64 ; Zelda avec Zelda Ocarina of Time et Zelda Majorés Mask ou encore Star Fox avec Star Fox 64.")
        ;
        $manager->persist($consoleN64);
        
        $consoleSnes = new Console();
        $consoleSnes
            ->setName('Super Nintendo Entertainment System (SNES)')
            ->setSlug('super-nintendo-entertainment-system')
            ->setThumbnail('snes-5fd1410d414f9150702818.png')
            ->setReleasePrice(294)
            ->setReleaseDate((new DateTime())->setDate(1992, 4, 11))
            ->setDescription("La Super Nintendo Entertainment System (couramment abrégée Super NES ou SNES ou encore Super Nintendo), ou Super Famicom au Japon, est une console de jeux vidéo du constructeur japonais Nintendo commercialisée à partir de novembre 1990. En Amérique du Nord, la console est sortie avec une apparence différente.<br/><br/>Conçue pour rivaliser avec la PC-Engine de NEC, et  la Mega Drive de Sega, la Super NES se vendra mieux que ses rivales et Nintendo va se réaffirmer comme le leader sur le marché japonais des consoles. Au lancement, elle fut vendue en pack avec deux manettes et Super Mario World et accompagnée par quatre jeux optionnels : F-Zero, Super R-Type, Super Tennis et Super Soccer. À partir d'octobre 1992, la Super Nintendo sera vendue au choix soit seule, soit avec Super Mario World, soit avec Street Fighter 2, soit avec le Super Scope.")
        ;
        $manager->persist($consoleSnes);
        
        $consoleSwitch = new Console();
        $consoleSwitch
            ->setName('Nintendo Switch')
            ->setSlug('nintendo-switch')
            ->setThumbnail('switch-5fd1410837d76945564003.png')
            ->setReleasePrice(330)
            ->setReleaseDate((new DateTime())->setDate(2017, 3, 3))
            ->setDescription("La Nintendo Switch est une console succédant à la Wii U. Il s'agit de la première console hybride mise en vente de l'histoire, c'est-à-dire pouvant aussi bien faire office de console de salon que de console portable. Annoncée le 17 mars 2015 au cours d'une conférence de presse, présentée officiellement le 20 octobre 2016 et montrée plus en détail le 17 janvier 2017 lors d'une présentation en direct, elle est sortie mondialement le 3 mars 2017.<br/><br/>La console est officialisée sous le nom \"NX\" le 17 Mars 2015. Selon Satoru Iwata, cette console ne devra pas juste être un remplacement de la Wii U ou la 3DS. Une présentation est diffusée le 20 Octobre 2016, elle montre les fonctionnalités basiques de la console : Les pads détachables, la modularité entre console de salon et console portable et dévoile également le nom officiel : La Nintendo Switch<br/><br/>Le 27 Octobre 2016, le président de Nintendo annonce qu'une présentation vidéo aura lieu le 13 Janvier 2017 révélera de nombreux détails comme la date exacte de sortie et les jeux en développement ainsi que ceux présent pour sa sortie, comme : 1-2 Switch et The Legend of Zelda Breath of the Wild.")
        ;
        $manager->persist($consoleSwitch);
        
        $consoleWii = new Console();
        $consoleWii
            ->setName('Wii')
            ->setSlug('wii')
            ->setThumbnail('wii-5fd141131cdbd747794225.png')
            ->setReleasePrice(249)
            ->setReleaseDate((new DateTime())->setDate(2006, 12, 8))
            ->setDescription("La Wii est une console de jeux de salon sortie en 2006. Console de la septième génération, tout comme la Xbox 360 et la PlayStation 3 avec lesquelles elle est en rivalité, la Wii est la console de salon la plus vendue de sa génération avec 101,63 millions d'exemplaires écoulés en 2016. Elle a comme particularité d'utiliser un accéléromètre capable de détecter la position, l'orientation et les mouvements dans l'espace de la manette.<br/><br/>La console est officiellement annoncée le 11 mai 2004 par Satoru Iwata (président de Nintendo à ce moment là) lors de la conférence de presse précédant l'E3. La version définitive de la Wii ainsi que certains jeux sont dévoilés le 9 mai 2006 pendant la conférence Nintendo pré E3 2006. En dehors du Japon, la console sera vendue en paquetage promotionnel avec le jeu Wii Sports. Où le joueur pourras pratiquer 5 sports et expérimenter la technologie de détection des mouvements de la console. Cette même détection serra amélioré par le biais du \"Wii Motion Plus\", accessoire se greffant à la manette de la Wii.")
        ;
        $manager->persist($consoleWii);
        
        $consoleWiiU = new Console();
        $consoleWiiU
            ->setName('Wii U')
            ->setSlug('wii-u')
            ->setThumbnail('wiiu-5fd140de64a34381017053.png')
            ->setReleasePrice(349)
            ->setReleaseDate((new DateTime())->setDate(2012, 11, 30))
            ->setDescription("La Wii U est une console de salon succédant à la Wii. Elle est sortie le 18 novembre 2012 en Amérique du Nord, le 30 novembre 2012 en Europe et le 8 décembre 2012 au Japon. Première console de la huitième génération à sortir, elle est en concurrence avec la PlayStation 4 et la Xbox One.<br/><br/>La console est annoncée le 7 juin 2011, durant l'E3 2011. La Wii U est la première console de salon à proposer une manette avec un écran tactile intégré, le Wii U GamePad. Les deux principales nouveautés de la console sont apportées par celui-ci. D'une part, le Wii U GamePad permet de continuer une partie, grâce à son écran intégré, même lorsque la télévision n'est pas disponible (fonctionnalité non présente sur tous les jeux). D'autre part en complément de manettes Wii, le contrôleur offre en multijoueur une expérience de jeu dite d'« informations asymétriques », c'est-à-dire que les joueurs ne disposent pas nécessairement des mêmes informations sur le GamePad par rapport à une manette et un écran de télévision traditionnels. Enfin, il s'agit de la première console de Nintendo à pouvoir générer des graphismes en haute définition.<br/><br/>La console a souffert dès son lancement d'un manque de jeux, avec des nouvelles sorties trop espacées. La firme japonaise a cependant accru les ventes de sa console grâce au lancement le 30 mai 2014 du jeu Mario Kart 8 et de nombreuses exclusivités comme Super Smash Bros. for Wii U, Bayonetta 2 et Captain Toad: Treasure Tracker notamment. La Wii U a atteint les 10 millions d'exemplaires fin juillet 2015. Au 30 septembre 2016, la console atteint le nombre de 13,6 millions d'unités vendues, un chiffre décevant par rapport à ses concurrentes (PS4 et Xbox One) et aux ventes de sa prédécesseur, la Wii. Ces chiffres décevants de la Wii U ont ainsi poussé Nintendo à arrêter sa production en 2017, soit seulement 4 ans après sa sortie, afin de lancer une nouvelle console : la Nintendo Switch.")
        ;
        $manager->persist($consoleWiiU);

        /**
         * Genre
         */
        $genreAction = new Genre();
        $genreAction->setName('Action');
        $manager->persist($genreAction);
        
        $genreAventure = new Genre();
        $genreAventure->setName('Aventure');
        $manager->persist($genreAventure);
        
        $genrePlateforme = new Genre();
        $genrePlateforme->setName('Plateforme');
        $manager->persist($genrePlateforme);
        
        $genreRpg = new Genre();
        $genreRpg->setName('RPG');
        $manager->persist($genreRpg);
        
        $genreCombat = new Genre();
        $genreCombat->setName('Combat');
        $manager->persist($genreCombat);

        /**
         * Character
         */
        $characterArbreMojo = new Character();
        $characterArbreMojo
            ->setName('Arbre Mojo')
            ->setSlug('arbre-mojo')
            ->setThumbnail('arbre-mojo-5fd622fc4cbd4599316255.png')
            ->setDescription("L'Arbre Mojo est un personnage à part de la série, apparu dans Ocarina of Time et The Wind Waker. Esprit de la Terre et de la Forêt, le Vénérable Arbre Mojo a traversé les âges depuis la création d’Hyrule, et en connaît ainsi toutes les légendes. Il est le gardien des Kokiris et des Fées dans Ocarina of Time, ainsi que de la forêt où ils habitent, et donc des Korogus de l’Île aux Forêts dans The Wind Waker, étant pour ainsi dire leurs descendants.<br/><br/>Il est également le gardien de l’épée de Légende dans Breath of the Wild, ainsi que le protecteur des Korogus. Cent ans auparavant, c’est visiblement dans les Bois perdus que Zelda a trouvé refuge, probablement dans le but de replacer l’épée de Légende dans son socle afin de lui redonner son énergie. Lorsqu’elle voudra confier un message pour Link, celui-ci lui répondra avec un sourire qu’un « message de cette importance » se doit d’être remis en personne, bien qu’à la fin du jeu ce message n'ait toujours pas été remis au Héros, ni par Zelda, ni par l’Arbre Mojo.")
            ->setGender('N');
        $manager->persist($characterArbreMojo);
        
        $characterBowser = new Character();
        $characterBowser
            ->setName('Bowser')
            ->setSlug('bowser')
            ->setThumbnail('bowser-5fd61111090a3604354902.png')
            ->setDescription("Bowser, de son nom complet Roi Bowser Koopa Sr., est le principal antagoniste de l'Univers de Mario, et le boss final de beaucoup de jeux de la franchise. Il est le roi des Koopa, mais beaucoup d'autres espèces lui obéissent, et forme une grande armée pour l'aider à conquérir le Royaume Champignon. Il a un fils du nom de Bowser Jr..<br/><br/>Sa principale activité consiste à enlever la princesse du Royaume Champignon afin de pouvoir régner sur le royaume, ce qui fait de lui l'ennemi principal de Mario et ses amis.<br/><br/>À l'instar du Dr. Eggman ou encore de Ganondorf, il est l'un des méchants les plus reconnaissables du monde des jeux vidéos.")
            ->setGender('M');
        $manager->persist($characterBowser);
        
        $characterCrankyKong = new Character();
        $characterCrankyKong
            ->setName('Cranky Kong')
            ->setSlug('cranky-kong')
            ->setThumbnail('kranky-kong-5fb56d3dd92cc784085255.png')
            ->setDescription("Cranky Kong, aussi appelé Donkey Kong Sr., est un personnage de la franchise Donkey Kong. D'abord antagoniste de la série face à Mario  (qui se nommait Jumpman sur arcade), il finit par vieillir et par prendre sa retraite. Il est le plus âgé de la famille Kong, étant le père de Donkey Kong Jr. et le grand-père de l'actuel Donkey Kong. Il est aussi veuf depuis le décès de sa femme Wrinkly Kong. Cranky Kong est aujourd'hui un personnage secondaire, et grâce à son expérience, il guide son petit-fils le long de ses aventures, malgré son caractère grincheux.<br/><br/>Sur arcade, Cranky a exercé le métier de kidnappeur de princesse, il a capturé sans relâche Pauline, combattu Mario ou bien s'est fait aider par son fils, Donkey Kong Jr. Comme il le dit lui-même dans les Donkey Kong Country, il était trop vieux pour continuer cela et a décidé de prendre sa retraite")
            ->setGender('M');
        $manager->persist($characterCrankyKong);
        
        $characterDiddyKong = new Character();
        $characterDiddyKong
            ->setName('Diddy Kong')
            ->setSlug('diddy-kong')
            ->setThumbnail('diddy-kong-5fd611aa1e040292395040.png')
            ->setDescription("Diddy Kong est un personnage de jeu vidéo créé en 1994 par la société britannique Rare pour le jeu Donkey Kong Country sur Super Nintendo.<br/><br/>Petit singe agile vivant paisiblement dans la jungle Kongo, sur l'île de Donkey Kong, son plus grand rêve est de devenir une vraie star de jeux vidéo à l'instar de son maître spirituel et meilleur ami, Donkey Kong, dont il est le fidèle acolyte et qui l'initie au métier. Dans Donkey Kong Country alors qu'une nuit d'orage éclatait, il devait surveiller le trésor de bananes du clan mais se fait maîtriser par les Kremlings mené par King K. Rool et enfermer dans un tonneau. Il décidera alors d'accompagner DK dans son périple pour réparer son erreur.")
            ->setGender('M');
        $manager->persist($characterDiddyKong);
        
        $characterDixieKong = new Character();
        $characterDixieKong
            ->setName('Dixie Kong')
            ->setSlug('dixie-kong')
            ->setThumbnail('dixie-kong-5fd611dacb759237817713.png')
            ->setDescription("Dixie Kong est un personnage féminin de la série Donkey Kong. Celle-ci est la copine de Diddy Kong, la grande sœur de Tiny Kong et la cousine de Chunky Kong et Kiddy Kong. Elle apparaît la première fois dans le jeu Donkey Kong Country 2: Diddy's Kong Quest, puis dans de nombreux autres jeux des franchises Donkey Kong et Mario en tant que personnage jouable. Elle réapparaît dans Donkey Kong Country: Tropical Freeze en tant que personnage jouable.")
            ->setGender('F');
        $manager->persist($characterDixieKong);
        
        $characterDonkeyKong = new Character();
        $characterDonkeyKong
            ->setName('Donkey Kong')
            ->setSlug('donkey-kong')
            ->setThumbnail('donkey-kong-5fd6121a7ccf4347120374.png')
            ->setDescription("Donkey Kong est un personnage récurrent des spin-off de la franchise Mario, apparaissant également dans sa propre série de jeux Donkey Kong.<br/><br/>Bien qu’il soit le principal personnage de la série, Donkey Kong a été capturé plus d’une fois. En effet, nous devions le secourir des griffes de King K. Rool dans Donkey Kong Country 2: Diddy’s Kong Quest ainsi que dans Donkey Kong Country 3: Dixie’s Double Trouble. Par ailleurs, outre ses poings, Donkey Kong a pu utiliser une arme à feu crachant des noix de coco dans le jeu Donkey Kong 64 afin de mettre un terme aux nouveaux plans de King K. Rool.<br/><br/>Le Donkey Kong que nous connaissons aujourd’hui n’a pas toujours été celui par lequel nous avons appris à aimer la série. En effet, dans le tout premier Donkey Kong, le singe que nous devions combattre afin de sauver Pauline était celui que nous connaissons aujourd’hui sous le nom de Cranky Kong.")
            ->setGender('M');
        $manager->persist($characterDonkeyKong);
        
        $characterDracaufeu = new Character();
        $characterDracaufeu
            ->setName('Dracaufeu')
            ->setSlug('dracaufeu')
            ->setThumbnail('dracaufeu-5fd6141260d08421886607.png')
            ->setDescription("Dracaufeu est un dragon (ou un dinosaure si on se réfère à son nom japonais), de type Feu et Vol de la première génération des jeux Pokemon. On le retrouve sur les jaquettes des jeux Pokémon Rouge et Pokémon Rouge Feu.<br/><br/>Pokémon noble, il n'attaque pas les plus faibles que lui et cherche toujours des adversaires plus forts. Après un combat difficile ou s'il est en colère, sa flamme s'intensifie et devient blanche-bleue. Dracaufeu est aussi réputé pour avoir un sale caractère. Il crache d'impressionnants jets de flammes, et ses ailes lui permettent de voler à 1400 mètres d'altitude. Cependant, si son dresseur possède assez de détermination pour lui prouver que c'est lui le maître, il peut devenir extrêmement puissant.")
            ->setGender('N');
        $manager->persist($characterDracaufeu);
        
        $characterEvolie = new Character();
        $characterEvolie
            ->setName('Evolie')
            ->setSlug('evolie')
            ->setThumbnail('evolie-5fd6141884e08711372383.png')
            ->setDescription("Évoli est un Pokémon mammalien, canin et quadrupède avec une fourrure principalement brune. Le bout de sa queue broussailleuse et son gros col de fourrure sont de couleur crème. Il a de petites jambes minces avec trois petits orteils et un coussinet rose à chaque patte. Évoli a des yeux marron, de longues oreilles pointues et un petit nez noir. On trouve rarement ce Pokémon à l'état sauvage, et plus souvent dans les villes et les zones urbaines. Cependant, on dit qu'Évoli a une structure génétique irrégulière qui lui permet de s'habituer à tous types d'environnements. Il peut évoluer en huit formes différentes à ce jour, selon son environnement.<br/><br/>Motofumi Fujiwara, responsable de la création des premiers sprites de ce Pokémon, souhaitait une créature qui ne soit pas inspirée d'un animal réel en particulier. Le design d'Évoli est basé sur de vagues souvenirs de son enfance, durant laquelle il avait vu une créature indéfinissable en forêt. Il reconnaît cependant que l'apparence finale du Pokémon est à mi chemin entre un chat touffu et un chien")
            ->setGender('N');
        $manager->persist($characterEvolie);
        
        $characterGanondorf = new Character();
        $characterGanondorf
            ->setName('Ganondorf')
            ->setSlug('ganondorf')
            ->setThumbnail('ganondorf-5fd6141f93430719921123.png')
            ->setDescription("Ganondorf, est l'antagoniste le plus connu de la série Zelda. Il est présent dans la saga depuis The Legend of Zelda sous sa forme bestiale, Ganon. Il apparaît la première fois sous sa forme humaine dans Ocarina of Time, bien qu'elle ait été mentionnée dans A Link to the Past.<br/><br/>Ganondorf pourrait être la réincarnation de la haine de l'Avatar du Néant, qui maudit les descendants de Link et Zelda à la fin du jeu. À la fin de Skyward Sword, l'Avatar du Néant, suite à sa défaite face à Link, lance une malédiction qui va lui permettre de se réincarner éternellement tout en gardant le même esprit de haine qui va maudire les descendants de Link et Zelda.")
            ->setGender('M');
        $manager->persist($characterGanondorf);
        
        $characterHarmonie = new Character();
        $characterHarmonie
            ->setName('Harmonie')
            ->setSlug('harmonie')
            ->setThumbnail('harmonie-5fd61524b11dc987899370.png')
            ->setDescription("Harmonie est un personnage récurrent qui est apparut pour la première fois dans Super Mario Galaxy. C'est une figure puissante, dont le rôle est d'élever les Lumas, pour qui elle est une mère adoptive, et de protéger l'univers contre tous les dangers.<br/><br/>En tant que vigie des étoiles, Harmonie est décrite comme étant calme et réservée. Elle ne sourit que peu et parle avec un ton mélancolique, très monotone. Malgré tout, elle considère les étoiles comme sa famille et est aimante envers les Lumas. Elle aide Mario à sauver Peach des griffes de Bowser, tout en lui permettant d'utiliser l'observatoire de la comète à sa guise.Son histoire, débloquée à la librairie de l'observatoire, se découpe en neuf chapitres qui révèlent son chemin de petite fille à protectrice de l'univers.")
            ->setGender('F');
        $manager->persist($characterHarmonie);
        
        $characterKingKRool = new Character();
        $characterKingKRool
            ->setName('King K. Rool')
            ->setSlug('king-k-rool')
            ->setThumbnail('king-k-rool-5fd615e898ec2900602585.png')
            ->setDescription("King K. Rool, est le souverain malveillant des Kremlings et le méchant principal de la franchise Donkey Kong, ainsi que l'ennemi juré de Donkey Kong et de ses alliés. Le Roi K. Rool a essayé à plusieurs reprises de voler le stock de bananes des Kongs pour des raisons inconnues, bien qu'il ait été suggéré qu'il prenne le trésor pour faire mourir de faim les Kongs, en plus de bien aimer les bananes. Il a même kidnappé des membres de la famille Kong à diverses occasions.<br/><br/>La peau de K. Rool est vert clair. Il a un œil plus grand que l'autre, injecté de sang, des bras musclés, et il est habituellement montré avec des dents aiguisées. Il porte une cape rouge et une couronne d'or. Depuis Donkey Kong: King of Swing, un rubis bleu attache l'avant de sa cape. Jusqu'à Donkey Kong 64, King K. Rool porte une armure dorée sur le ventre et a une longue queue. Ces détails ont étés repris dans Super Smash Bros. Ultimate, bien que la queue soit plus courte.")
            ->setGender('M');
        $manager->persist($characterKingKRool);
        
        $characterLink = new Character();
        $characterLink
            ->setName('Link')
            ->setSlug('link')
            ->setThumbnail('link-5fd616beb1eaa432595002.png')
            ->setDescription("Link est le nom que porte le héros de la série The Legend of Zelda. Il est reconnaissable au premier coup d'oeil à sa tunique et son bonnet vert (bien qu'il débute avec d'autres vêtements dans certains épisodes), et à la caractéristique de ne pas prononcer une seule parole pendant toute l'aventure. Détenteur de la Triforce du Courage et descendant des chevaliers Hyliens, comme en témoignent ses oreilles pointues, il prend également en une occasion notable (Majora's Mask) l'apparence propre à d'autres races d'Hyrule, à l'aide de masques qui le métamorphosent.<br/><br/>Il est généralement admis qu'en dehors des suites directes, chaque jeu Zelda met en scène un Link différent, ancêtre ou descendant de celui d'un autre épisode. Certaines de ses incarnations sont restées célèbres sous un titre particulier - citons notamment le Héros du Temps d'Ocarina of Time ou le Héros du Vent de The Wind Waker. L'âge de Link varie en fonction du jeu où il apparait, pouvant aller de petit enfant à jeune adulte ; si certains membres de sa famille, font parfois partie du scénario, une constante dans la série est d'en faire un orphelin.<br/><br/>Débutant le plus souvent son aventure comme un habitant ordinaire de son village natal, Link doit traverser des donjons remplis d'énigmes, triompher de puissants ennemis, maîtriser des armes de légende et mettre la main sur des reliques sacrées pour vaincre Ganondorf (ou, selon les épisodes, les autres ennemis qui se dressent sur son chemin) et sauver la Princesse Zelda.")
            ->setGender('M');
        $manager->persist($characterLink);
        
        $characterLuigi = new Character();
        $characterLuigi
            ->setName('Luigi')
            ->setSlug('luigi')
            ->setThumbnail('lungi-5fd6176f53533399407867.png')
            ->setDescription("Luigi est le petit frère de Mario. Il est plus grand, plus maigre, saute plus haut et a aussi d'autres talents cachés, apparaissant pour la première fois dans Mario Bros.<br/><br/>Luigi est décrit comme timide et peureux, cependant il sait faire preuve de courage et surmonte toujours ses peurs quand ses amis sont en danger. Il est aussi très naïf, s'étant facilement fait avoir par le faux concours du Roi Boo. Il est également dit qu'il est plus intelligent que son frère aîné. Il est également montré dans Paper Mario : La Porte Millénaire qu'il est assez arrogant, se mettant toujours en valeur à chaque histoire qu'il raconte.<br/><br/>Le célèbre plombier vert s'appelait au départ \"Mario 2\", mais il a été réclamé qu'un véritable prénom différent de celui de son frère lui soit donné. L'équipe de Nintendo lui donnera donc par la suite le nom de Luigi.")
            ->setGender('M');
        $manager->persist($characterLuigi);
        
        $characterMario = new Character();
        $characterMario
            ->setName('Mario')
            ->setSlug('mario')
            ->setThumbnail('mario-5fd6180863ed1458681600.png')
            ->setDescription("Mario est le personnage principal de la série Mario. Il a été créé par le concepteur japonais Shigeru Miyamoto et sert aussi de mascotte principale de Nintendo.<br/><br/>Il fait sa première apparition en tant que protagoniste dans le jeu d'arcade Donkey Kong, sorti en 1981, appelé \"Jumpman\" par les joueurs. Il possède son nom définitif à partir de Mario Bros. Depuis Super Mario Bros, ses plus notables capacités sont son saut, avec lequel il bat la plupart de ses ennemis, et sa capacité à changer de taille et de pouvoir avec divers éléments, tels que le Super champignon ou la Fleur de feu.<br/><br/>Les jeux dans lesquels il est présent ont dépeint Mario comme un personnage silencieux avec une personnalité distincte, ce qui lui permet de s'adapter à différents genres et rôles. Dans la plupart des jeux, il est le héros qui part à l'aventure pour sauver la Princesse Peach kidnappée par le roi Bowser, mais il a été montré en faisant d'autres activités, comme de la course et du sport.")
            ->setGender('M');
        $manager->persist($characterMario);
        
        $characterMidona = new Character();
        $characterMidona
            ->setName('Midona')
            ->setSlug('midona')
            ->setThumbnail('midona-5fb56d77e0bf8339894655.png')
            ->setDescription("Dans Twilight Princess, Midona est la Princesse du Royaume du Crépuscule et donc du peuple des Twili. Elle accompagne également Link pendant toute son aventure, lui prodiguant des conseils à des moments clés du jeu et grimpant sur son dos lorsqu'il est transformé en loup. Grâce à ses pouvoirs, le héros peut vaincre les Agents du Crépuscule et se téléporter via les portails qu'ils ont ouverts.<br/><br/>Son apparence la plus connue est le fruit de la malédiction lancée par Xanto ; ce n'est qu'à la fin du jeu qu'elle reprend sa forme Twili, humanoïde. Midona est notable pour son caractère moqueur et malicieux, qui cache au final un personnage attachant. Elle a d'ailleurs été bien reçue par les critiques de Twilight Princess, à la sortie du jeu.")
            ->setGender('F');
        $manager->persist($characterMidona);
        
        $characterPeach = new Character();
        $characterPeach
            ->setName('Peach')
            ->setSlug('peach')
            ->setThumbnail('peach-5fd618a7c009e529147766.png')
            ->setDescription("La princesse Peach est un personnage principal de la franchise Mario. Créée par Shigeru Miyamoto, elle est la princesse du Royaume Champignon et joue souvent le rôle de la demoiselle en détresse quand son territoire est attaqué par Bowser et son armée. Son enlèvement est d'ailleurs très souvent la raison des aventures de Mario. Elle était auparavant connue sous le nom de Princesse Toadstool en dehors du Japon jusqu'en 1996, lorsque le nom de \"Peach\" fut mentionné dans Yoshi's Safari.<br/><br/>Peach est une jeune fille très gentille et toujours de bonne humeur.  Elle est calme et généreuse, toujours à vouloir faire le bien autour d'elle. Peu importe la situation, qu'elle soit enlevée par Bowser ou qu'elle est en danger, elle est sûre que Mario la sauvera. Elle est également naïve et peureuse toutefois, sa couardise disparaît lorsqu'il s'agit d'êtres qui lui sont chers : on citera notamment son aventure pour délivrer les frères Mario de Bowser dans Super Princess Peach.")
            ->setGender('F');
        $manager->persist($characterPeach);
        
        $characterPikachu = new Character();
        $characterPikachu
            ->setName('Pikachu')
            ->setSlug('pikachu')
            ->setThumbnail('pikachu-5fd6196335a4a240621701.png')
            ->setDescription("Pikachu est un Pokémon souris de type électrique apparu dès la première génération. En tant que partenaire de Sacha, héros du dessin animé tiré du jeu, il est le plus célèbre des Pokémon et la mascotte officielle de la licence.<br/><br/>Pikachu est inspiré du pika, un petit mammifère proche de la famille des lièvres et des lapins, qui se distingue par ses petites oreilles rondes et son cri qui ressemble à un sifflement strident. Ses poches d’électricité sont inspirées des abajoues que certains rongeurs, dont l’écureuil, utilisent pour stocker de la nourriture.<br/><br/>Le dessin animé montre que Pikachu, à l’état sauvage, vit en groupe dans les régions boisées. Les Pikachu communiquent entre eux en utilisant des couinements et en frottant leurs queues. Il peut nuancer ses décharges électriques et peut libérer de l’électricité à partir de ses joues, mais également à partir de sa queue, qui agit comme un paratonnerre.")
            ->setGender('N');
        $manager->persist($characterPikachu);
        
        $characterProfChen = new Character();
        $characterProfChen
            ->setName('Professeur Chen')
            ->setSlug('professeur-chen')
            ->setThumbnail('prof-chen-5fd61a1c3a84e703624572.png')
            ->setDescription("Le Professeur Samuel Chen est un professeur Pokémon mondialement renommé, originaire de la région de Kanto, où il réside au Bourg Palette. À ce titre, il remet leur Pokémon de départ aux jeunes souhaitant devenir dresseurs de Pokémon. Il offre le choix entre Bulbizarre, Salamèche et Carapuce, ou parfois entre Pikachu et Évoli. Il s'occupe aussi de remettre le Pokédex à ces dresseurs, ce qu'il fait également pour ceux de Johto.<br/><br/>Il est à l'heure actuelle le personnage étant apparu dans le plus de jeux Pokémon. Pour certaines régions où le joueur se voit offert le Pokémon de départ et le Pokédex par un autre professeur, comme Sinnoh, il améliore ce Pokédex en lui donnant l'option nationale.")
            ->setGender('M');
        $manager->persist($characterProfChen);
        
        $characterRed = new Character();
        $characterRed
            ->setName('Red')
            ->setSlug('red')
            ->setThumbnail('red-5fd61af096909677548809.png')
            ->setDescription("Red est le nom généralement donné au personnage masculin incarné par le joueur dans Pokémon Rouge, Bleu et Jaune et Pokémon Rouge Feu et Vert Feuille. Seul choix possible dans les jeux de la première génération, il s'est vu doté d'un alter-égo féminin en la personne de Leaf dans les rééditions sorties sur Game Boy Advance. Le fait d'incarner l'un fait disparaître l'autre de l'histoire. Il est considéré parmi les fans comme le vrai emblème principal de la saga entière.<br/><br/>Red est également l'ultime défi se présentant au joueur dans Pokémon Or, Argent et Cristal et dans Pokémon Or HeartGold et Argent SoulSilver, où il peut être combattu au Mont Argenté après une victoire contre les huit champions de la région de Kanto. Il est également le dresseur le plus puissant de la saga. Red a fait une apparition remarquée en tant que combattant dans Super Smash Bros. Brawl sur Nintendo Wii sous le nom « Dresseur de Pokémon ». Il ne se bat pas directement, mais envoie au combat trois Pokémon : Carapuce, Herbizarre et Dracaufeu.")
            ->setGender('M');
        $manager->persist($characterRed);
        
        $characterRoiHyrule = new Character();
        $characterRoiHyrule
            ->setName('Roi d\'Hyrule')
            ->setSlug('roi-dhyrule')
            ->setThumbnail('roi-dhyrule-5fd61bcba86a4280727816.png')
            ->setDescription("Le Roi d’Hyrule est un personnage récurrent à la série Legend of Zelda. Pourtant, bien que son nom soit énoncé dans beaucoup d’épisodes de la saga, le Roi d’Hyrule n’est apparu que très rarement. On ressent tout du moins sa présence sur l’univers de la série, étant le père de la princesse Zelda.<br/><br/>Il est apparu pour la première fois dans le prologue de The Adventure of Link et dernièrement, dans Breath of the Wild, Roham Bosphoramus Hyrule, le dernier roi du royaume d’Hyrule. C’est un père très dur avec sa fille, lui reprochant de ne pas pouvoir réveiller son pouvoir, et tenant des propos très sévères avec elle, notamment en lui disant que la cour la considère comme une “princesse ratée”. C’est lui qui réunira les Prodiges et qui choisira Link comme garde personnel de la princesse. Il sera tué lors du retour de Ganon. Son fantôme attendra le retour de Link au Plateau du Prélude. Quand le Héros se réveille enfin, amnésique, il se présente comme un vieil homme normal, et le guidera vers les quatre premiers sanctuaires. Une fois cette formalité accomplie, il lui révèlera sa véritable identité. Il lui fera alors un résumé de sa situation passée, et le guidera vers Impa, puis lui remettra la paravoile, avant de disparaître. Il réapparaitra à la fin du jeu, observant Link et Zelda en compagnie des fantômes des Prodiges.")
            ->setGender('M');
        $manager->persist($characterRoiHyrule);
        
        $characterYoshi = new Character();
        $characterYoshi
            ->setName('Yoshi')
            ->setSlug('yoshi')
            ->setThumbnail('yoshi-5fb56dee393fe928300393.png')
            ->setDescription("Yoshi est un personnage qui fait parti de l'espèce des Yoshis vivant sur l'île des Yoshis. Il est apparu pour la première fois dans Super Mario World et accompagne Mario et ses amis dans plusieurs jeux. Il sert généralement de monture à Mario mais peut être aussi au centre de certains jeux dont il est le personnage principale.<br/><br/>Yoshi se caractérise par sa capacité à sauter très haut et de pouvoir planer quelques seconde une fois en l'air. Il peut également gober des ennemis et le transformer en œuf qu'il peut utiliser comme projectiles")
            ->setGender('M');
        $manager->persist($characterYoshi);
        
        $characterZelda = new Character();
        $characterZelda
            ->setName('Zelda')
            ->setSlug('zelda')
            ->setThumbnail('zelda-5fd61f809c133645632726.png')
            ->setDescription("La Princesse Zelda, membre de la famille royale d'Hyrule et à qui la série doit son nom, est un des personnages principaux de la plupart des épisodes. Étant généralement kidnappée ou menacée par un être maléfique - Ganon ou autre - au début du jeu, c'est pour la sauver que Link part à l'aventure. À l'image du héros, son âge varie d'un épisode à l'autre, de petite fille à jeune femme. Dans certains opus, elle fait preuve d'habiletés particulières comme la magie, la télépathie voire la capacité de prédire le futur. La Princesse Zelda détient également la Triforce de la Sagesse. Elle prend également un rôle très particulier dans Skyward Sword, puisqu'elle s'avère être la réincarnation humaine de la déesse Hylia.<br/><br/>Breath of the Wild offre aussi une Zelda assez différente de ce que l’on était habitués à voir dans la série: on y voit une Zelda assaillie de doutes, n’arrivant pas à la hauteur de ce que l’on attend d’elle. Et lorsqu’enfin, elle accède à son pouvoir, Link est aux limites de la mort. Elle se retrouve alors seule face à Ganon, et se sacrifiera pendant un siècle entier, se faisant volontairement avalé par Ganon, tout cela pour son peuple.")
            ->setGender('F');
        $manager->persist($characterZelda);

        /**
         * Items
         */
        $itemArc = new Item();
        $itemArc
            ->setName('Arc')
            ->setSlug('arc')
            ->setThumbnail('arc-5fd1365008d04557491838.png')
            ->setDescription("L'arc apparaît dans tous les jeux à l'exception de The Adventure of Link et des Oracles. Dans la plupart des jeux Zelda, l'arc peut être amélioré ou combiné avec des bombes , Link peut obtenir des flèches magiques et des carquois plus grands. Parfois même, c'est la princesse Zelda qui se sert de cet arc durant le combat final où elle assiste Link avec des flèches de lumières.");
        $manager->persist($itemArc);
        
        $itemBalleSmash = new Item();
        $itemBalleSmash
            ->setName('Balle smash')
            ->setSlug('balle-smash')
            ->setThumbnail('balle-smash-5fb569df09177703546552.png')
            ->setDescription("La Balle Smash est un objet qui est apparu pour la première fois dans Super Smash Bros. Brawl. Quand on brise cet objet, on peut déclencher un Smash final. Il est possible de perdre la Balle Smash si le personnage accumule trop de dégâts avant l'utilisation. Elle peut aussi disparaitre au bout d'un moment.");
        $manager->persist($itemBalleSmash);
        
        $itemBanane = new Item();
        $itemBanane
            ->setName('Banane')
            ->setSlug('banane')
            ->setThumbnail('banana-5fd133f105911049614057.png')
            ->setDescription("Dans la série des jeux Donkey Kong la banane sert le collectable dans le niveau, au même titre que les pièces dans les jeux Mario. Dans les jeux Smash Bros et Mario Kart c'est un objet permettant de faire glisser les combattants/karts quand ils entre en contact avec.");
        $manager->persist($itemBanane);
        
        $itemBombe = new Item();
        $itemBombe
            ->setName('Bombe')
            ->setSlug('bombe')
            ->setThumbnail('bombe-5fd133f52718f752764965.png')
            ->setDescription("Les bombes sont présentes dans tous les jeux, sauf The Adventure of Link. Elles sont généralement obtenues au début de chaque jeu, et stockées dans un sac de Bombes. Depuis leur première apparition, elles ont gardé une apparence similaire, jusqu'à Twilight Princess, où elles ont reçu une apparence plus réaliste. Elles servent principalement à briser des murs fragiles afin de révéler des passages secrets. Dans certains jeux il est possible de la combiner à l'arc afin de tirer des flèches explosives.");
        $manager->persist($itemBombe);
        
        $itemBouclierHylien = new Item();
        $itemBouclierHylien
            ->setName('Bouclier Hylien')
            ->setSlug('bouclier-hylien')
            ->setThumbnail('bouclier-hylien-5fd133fa8d604917922370.png')
            ->setDescription("Le Bouclier d'Hylia ou bouclier Hylien est le bouclier récurrent et emblématique de la série. Avec l'épée de Légende, ce bouclier est un véritable symbole de la série. Il arbore les motifs de la Triforce et du célestrier vermeil de Link dans Skyward Sword. C'est un bouclier indestructible que peut résister à toutes les attaques, contrairement aux boucliers en bois qu'on obtient dans le début des jeux Zelda. Seul exception dans Breath of the Wild où tout les équipements sont destructibles, mais il reste tout de même le bouclier le plus résistant du jeu.");
        $manager->persist($itemBouclierHylien);
        
        $item1up = new Item();
        $item1up
            ->setName('Champignon 1UP')
            ->setSlug('champignon-1up')
            ->setThumbnail('1up-5fd134ddb271e974290509.png')
            ->setDescription("Le champignon 1UP est un des objets principaux de la série Super Mario. C'est un champignon de couleur verte qui, une fois ramassé, donne une vie supplémentaire. Il peut aussi ranimer un personnage évanoui dans les jeux de rôle.");
        $manager->persist($item1up);
        
        $itemMasterSword = new Item();
        $itemMasterSword
            ->setName('Épée de Légende')
            ->setSlug('epee-de-legende')
            ->setThumbnail('master-sword-5fd1341580ea9657500925.png')
            ->setDescription("L’Épée de Légende, aussi appelée Excalibur ou Master Sword, est l'épée la plus emblématique de la série des Zelda. Elle sert à repousser le mal, ou plus généralement repousser Ganon, mais aussi à acquérir de nouveaux pouvoirs. Elle est souvent associée avec le Bouclier d'Hylia. Dans Skyward Sword on découvre son origine et comment celle-ci est passée de épée divine à épée de légende grâce aux trois flammes sacrées et la bénédiction de la déesse Hylia.");
        $manager->persist($itemMasterSword);
        
        $itemFleurFeu = new Item();
        $itemFleurFeu
            ->setName('Fleur de feu')
            ->setSlug('fleur-de-feu')
            ->setThumbnail('fleur-feu-5fd13406aede3965493880.png')
            ->setDescription("La fleur de feu est un des objets les plus récurrents de la franchise Mario. C'est une fleur à tête ovale de couleur jaune, orange et rouge avec des yeux globuleux, apparue pour la première fois dans Super Mario Bros.<br/><br/>Elle permet à Mario de se transformer en Mario de feu pour lancer des boules enflammées qui blessent les ennemis. Il s'agit du troisième bonus inventé dans les jeux Mario, et c'est le deuxième objet le plus récurrent après le super champignon.");
        $manager->persist($itemFleurFeu);
        
        $itemMarteau = new Item();
        $itemMarteau
            ->setName('Marteau')
            ->setSlug('marteau')
            ->setThumbnail('marteau-5fd1340b5ce5e751544641.png')
            ->setDescription("Dans les jeux Paper Mario, le marteau est l'une des deux attaques principales que Mario pourra utiliser avec le saut.<br/><br/>Dans les jeux Smash Bros, le marteau est une arme de frappe. Une fois attrapé, le joueur se met à frapper rapidement avec, sans arrêt, pour quelques instants . Si un adversaire le touche, il sera éjecté et souffrira de 22% dommages (30% dans Smash Bros. 64), ce qui le rend l'une des armes les plus \"effrayantes\" de la série.");
        $manager->persist($itemMarteau);
        
        $itemMasterBall = new Item();
        $itemMasterBall
            ->setName('Master Ball')
            ->setSlug('master-ball')
            ->setThumbnail('masterball-5fd13410d223a557209532.png')
            ->setDescription("La Master Ball est la ball de capture ultime. Celle-ci permet d'attraper à coup sûr un Pokémon. Elle est souvent donné par un personnage principal dans les jeux et n'est pas achetable. Elle est donc unique et implique de bien choisir sur quel pokemon l'utiliser.");
        $manager->persist($itemMasterBall);
        
        $itemNoixMojo = new Item();
        $itemNoixMojo
            ->setName('Noix mojo')
            ->setSlug('noix-mojo')
            ->setThumbnail('noix-mojo-5fd1343ca0af1128660838.png')
            ->setDescription("Les Noix Mojo sont des objets présents dans Ocarina of Time, Majora's Mask et également dans la série Super Smash Bros. Selon les jeux elles permettent de paralyser/étourdir des ennemis.");
        $manager->persist($itemNoixMojo);
        
        $itemOcarina = new Item();
        $itemOcarina
            ->setName('Ocarina')
            ->setSlug('ocarina')
            ->setThumbnail('ocarina-5fd1344161b2c727688460.png')
            ->setDescription("L'ocarina fait parti des nombreux instruments de musique présents dans les jeux Zelda. Ce dernier à un rôle centrale dans les jeux Ocarina of Time et Majora's Mask où Link va devoir jouer des mélodies afin de débloquer des passages ou réinitialiser le compte à rebours avant un game over.");
        $manager->persist($itemOcarina);
        
        $itemPiece = new Item();
        $itemPiece
            ->setName('Pièce')
            ->setSlug('piece')
            ->setThumbnail('piece-5fd1344735a05832045954.png')
            ->setDescription("Les pièces sont la principale monnaie dans le Royaume Champignon. Elles apparaissent dans presque toute la franchise Mario. Les pièces ont des effets différents selon les jeux : dans les opus de plates-formes, elles augmentent le score, et après en avoir amassé un certain nombre, les pièces donnent des vies. Dans les jeux de rôle, elles servent à acheter différents objets.");
        $manager->persist($itemPiece);
        
        $itemPokeBall = new Item();
        $itemPokeBall
            ->setName('Poké ball')
            ->setSlug('pokeball')
            ->setThumbnail('pokeball-5fd1344b4ae2c058822543.png')
            ->setDescription("La Poké Ball est une Ball apparue dans Pokémon Rouge et Vert. C'est la Ball « de base » qui permet de capturer des Pokemons afin de pouvoir les avoir dans son équipe, et elle est présente dans tous les jeux de la série principale. Elle représente également le logo de la licence Pokemon.");
        $manager->persist($itemPokeBall);
        
        $itemPotion = new Item();
        $itemPotion
            ->setName('Potion')
            ->setSlug('potion')
            ->setThumbnail('potion-5fd135750aebd359915206.png')
            ->setDescription("La potion permet de rendre jusqu'à 20 points de vie à un Pokémon de votre équipe. On peut l'utiliser en combat ou bien en dehors. Dans toutes les générations, la Potion peut être obtenue dans les Boutiques Pokémon.");
        $manager->persist($itemPotion);
        
        $itemRappel = new Item();
        $itemRappel
            ->setName('Rappel')
            ->setSlug('rappel')
            ->setThumbnail('rappel-5fd134559cb23772082721.png')
            ->setDescription("Le Rappel est un objet de soin apparu dans la première génération. Lorsqu'il est utilisé sur un Pokémon K.O. (en combat ou bien en dehors), cet objet le réanime et lui redonne la moitié de ses PV max. Dans toutes les générations, le Rappel peut être acheté dans la plupart des Boutiques Pokémon.");
        $manager->persist($itemRappel);
        
        $itemReceptaclesCoeur = new Item();
        $itemReceptaclesCoeur
            ->setName('Réceptacles de Cœur')
            ->setSlug('receptacles-de-coeur')
            ->setThumbnail('receptacle-coeur-5fd13459b42fc576102619.png')
            ->setDescription("Les Réceptacles de Cœur constituent la barre de vie de Link. Plus il en collecte, plus sa barre de vie est grande. Ils sont traditionnellement visibles en haut à gauche de l'écran. Ils sont rouges, mais quand Link se fait toucher, la couleur disparaît au minimum d'un quart, voire d'un réceptacle entier. En général, l'aventure commence avec trois réceptacles de cœurs et le maximum de réceptacles qu'il peut avoir dépend des jeux. On obtient des réceptacles après avoir vaincu un boss et, dans la plupart des jeux, après avoir récolté quatre quarts de cœurs ou cinq fragments de cœurs (selon les jeux), qui sont soit cachés, soit donnés après avoir accompli une quête annexe.");
        $manager->persist($itemReceptaclesCoeur);
        
        $itemSuperChampi = new Item();
        $itemSuperChampi
            ->setName('Super champignon')
            ->setSlug('super-champignon')
            ->setThumbnail('champi-5fd1345da9ac1728567867.png')
            ->setDescription("Le Super champignon, parfois abrégé Super champi, est un champignon rouge et blanc avec des yeux globuleux. C'est un objet très récurrent de la série Super Mario.
            <br/><br/>La plupart du temps, le Super champignon fait grandir le joueur, lui permettant de détruire les briques avec sa tête et de résister à une attaque sans mourir. C'est l'objet le plus emblématique de toute la série.");
        $manager->persist($itemSuperChampi);
        
        $itemSuperEtoile = new Item();
        $itemSuperEtoile
            ->setName('Super étoile')
            ->setSlug('super-etoile')
            ->setThumbnail('etoile-5fd13462de6fd148158244.png')
            ->setDescription("Les super étoiles sont des objets apparaissant dans plusieurs jeux de la franchise Mario. Lorsque Mario entre en contact avec une super étoile, il devient invincible. <br/><br/>Dans les Mario Galaxy et Mario 64 la super étoile sert d'objectif à atteindre pour terminer un niveau. Dans Mario Odyssey elle remplace les lunes qu'on doit collecter dans le niveau du royaume Champignon.");
        $manager->persist($itemSuperEtoile);
        
        $itemTonneau = new Item();
        $itemTonneau
            ->setName('Tonneau')
            ->setSlug('tonneau')
            ->setThumbnail('tauneaux-5fd1346704855159073162.png')
            ->setDescription("Le tonneau est une arme que Donkey Kong utilise pour anéantir Mario dans le jeu d'arcade Donkey Kong. Depuis, ils ont été publiés dans de nombreux jeux Donkey Kong et Mario, mais ils sont plus fréquents dans les jeux Donkey Kong. Les tonneaux peuvent être ramassés et utilisées pour attaquer les kremlings, les koopas et d'autres ennemis.");
        $manager->persist($itemTonneau);
        
        $itemTriforce = new Item();
        $itemTriforce
            ->setName('Triforce')
            ->setSlug('triforce')
            ->setThumbnail('triforce-5fd1346b31add767640534.png')
            ->setDescription("La Triforce une relique sacrée qui apparaît tout au long de la saga The Legend of Zelda. Elle est composée de trois triangles d'or sacrés nommés Triforce de la Force (triangle du haut, associé à Ganondorf), Triforce de la Sagesse (triangle de gauche, associé à Zelda), et Triforce du Courage (triangle de droite, associé à Link).<br/><br/>Elle n'est pas toujours présente dans les jeux mais est souvent évoquée. Cette relique est le but ultime de Ganondorf, car quiconque touche la Triforce verra l'un de ses vœux exaucé. Mais ce dernier n'a jamais réussit à l'obtenir, seul Link et Zelda ont déjà réussit à réunir les trois fragment dans certains jeux et eu ainsi la possibilité de réaliser un vœu.");
        $manager->persist($itemTriforce);
        
        $itemTropheAide = new Item();
        $itemTropheAide
            ->setName('Trophée aide')
            ->setSlug('trophee-aide')
            ->setThumbnail('trophee-aide-5fd1346ff1dbc654645143.png')
            ->setDescription("Le Trophée aide est un objet apparaissant dans la saga Smash Bros depuis Super Smash Bros. Brawl. Une fois qu'un Trophée Aide est attrapé, un personnage aléatoire apparaît rapidement pour venir aider le combattant. Il fonctionne donc de la même façon qu'une Poké Ball. Avant Ultimate, seul un Trophée aide peut apparaître à la fois. Ce jeu permet aussi de gagner des points en mettant K.O. les Trophées aide combattant physiquement.");
        $manager->persist($itemTropheAide);

        /**
         * Game
         */
        $gameDk64 = new Game();
        $gameDk64
            ->setName('Donkey Kong 64')
            ->setSlug('donkey-kong-64')
            ->setNbPlayers(1)
            ->setReleaseDate((new DateTime())->setDate(1999, 11, 22))
            ->setLicense($licenseDonkeyKong)
            ->setDescription("Donkey Kong 64 est un jeu de plates-formes en 3D similaire à Super Mario 64 et à Banjo-Kazooie. Le jeu propose un mode solo et un mode multijoueur.<br/><br/>L'essentiel du mode solo implique la collecte de différents objets tels que des pièces, des bananes, des armes, des clefs et des plans4. L'objectif principal du jeu est de collecter les bananes d'or réparties sur l'île de Donkey Kong et à travers les huit niveaux que composent le jeu, l'île de Donkey Kong étant une passerelle vers ces niveaux5. Pour y arriver, le joueur doit résoudre des énigmes ou réussir des mini-jeux4,6. Donkey Kong, tout comme les quatre autres personnages jouables, peut courir, sauter, nager, grimper aux arbres et s'accrocher à des cordes, en plus de pouvoir faire des attaques au corps à corps pour se défendre des ennemis.<br/><br/>Le joueur commencera par jouer Donkey Kong et au courant de l'aventure, il débloquera  d'autres personnages jouables, qui lui permettent d'accéder à de nouvelles sections auparavant inaccessibles des niveaux ou à résoudre de nouvelles énigmes. En effet, ces personnages - au nombre de cinq, y compris Donkey Kong qui est disponible dès le début - ont tous des capacités qui leur sont propres. Donkey Kong peut entre-autres déterrer des médailles bananes enfoui sous des parcelles de terre, Chunky Kong peut soulever de lourds rochers, Tiny Kong peut rétrécir afin de se faufiler dans un passage étroit, Diddy Kong peut voler à l'aide d'un réacteur dorsal et Lanky Kong peut s'envoler ou se déplacer sur les mains vers de nouvelles sections des niveaux.")
            ->setHistory("King K. Rool a prévu un nouveau plan pour détruire l'île de Donkey Kong avec son laser, le Blast-O-Matic. Mais celui-ci tombe en panne après une collision qui fait s'échouer le bateau de K. Rool en face de l'île de Donkey Kong. Pour gagner du temps, il enlève des membres de la famille Kong et les enferme. Il vole ensuite la réserve de bananes d'or de Donkey Kong. Après que Donkey Kong ait libéré ses compagnons, ils s'unissent pour récupérer les bananes d'or et vaincre King K. Rool et son armée de Kremlings.")
            ->setCopiesSold(3000000)
            ->setThumbnail('donkey-kong-64-5fb57da9649c1331467022.jpg')
            ->setBackgroundDesktop('donkey-kong-64-bkg-5fd002d696ce3537537397.jpg')
            ->setBackgroundMobile('donkey-kong-64-bkg-mobile-5fd006c62059b891301526.jpg')
            ->setBackgroundPosition('left 20% top 20%')
            ->setFirstBlockMinHeight(600)
            ->setAfterBottom(-347)
        ;
        $gameDk64
            ->addConsole($consoleN64)
            ->addConsole($consoleWiiU)
        ;
        $gameDk64
            ->addGenre($genreAction)
            ->addGenre($genreAventure)
        ;
        $manager->persist($gameDk64);

        $gameDkCountry = new Game();
        $gameDkCountry
            ->setName('Donkey Kong Country')
            ->setSlug('donkey-kong-country')
            ->setNbPlayers(1)
            ->setReleaseDate((new DateTime())->setDate(1994, 11, 21))
            ->setLicense($licenseDonkeyKong)
            ->setDescription("Au début des années 1990, Rare est surtout connu pour la série de jeux Battletoads, ainsi que pour quelques jeux plus anecdotiques. Mais l'entreprise est très médiatisée entre 1993 et 1994, tout d'abord pour le jeu Killer Instinct, prétendument prévu sur la Nintendo 64 que Nintendo édite sur Super Nintendo à la surprise générale, mais aussi pour le développement de Donkey Kong Country. Aucune image du jeu ni aucune information sur celui-ci ne filtrent avant le Consumer Electronics Show de 1994 se déroulant à Chicago, c'est d'ailleurs la révélation du salon cette année-là.<br/><br/>Donkey Kong Country sort en novembre 1994 à l'internationale. L'accueil de Donkey Kong Country par la presse spécialisée lors de sa sortie en novembre 1994 est une très grande réussite, le jeu reçoit à l'époque des louanges de la part des critiques, comme lors des rééditions du titre ou des rétrospectives qui lui sont consacrées, dans lesquelles il est également encensé.")
            ->setHistory("Dans le cadre de son parcours initiatique, Donkey Kong demande à son neveu Diddy Kong, de monter la garde toute la nuit sur son stock de bananes. Diddy Kong est en poste dans l'arbre de la famille Kong, situé sur l'île tropicale luxuriante Donkey Kong Island, mais un orage terrible fait rage, et, très peu rassuré, il regrette son sort, connaissant tous les dangers qui peuvent survenir. Le stock de bananes de Donkey Kong est le plus gros de l'île, voire du monde, et des ennemis comme les Kremlings sont très envieux. Tout à coup, Diddy entend des bruits dans la jungle et entr'aperçoit des Kremlings, qu'il affronte en effectuant son attaque en roue. Malheureusement, Diddy est rapidement submergé par le nombre d'assaillants, puis assommé par Klump, un puissant Kremling, qui l'enferme dans un tonneau et le lance dans les buissons. Pendant la nuit, les Kremlings dérobent tout le stock de bananes, et, chargés de leur fardeau lâchement volé, disparaissent dans la jungle, laissant tomber derrière eux des bananes sur le sol tout au long du chemin. <br/><br/>Au petit matin, Donkey Kong se réveille, et son grand-père Cranky Kong lui signale que la caverne où sont conservées les bananes est maintenant vide. Ils se rendent également compte que Diddy Kong a disparu. En voyant les nombreuses traces de pas dans la grotte, Donkey Kong devine rapidement que les Kremlings sont responsables. Il décide de partir à la recherche du stock de bananes en suivant les bananes tombées du butin des Kremlings, en espérant également trouver Diddy Kong sur son chemin. Le duo reconstitué traverse l'île et rencontre divers animaux qui vont les aider, comme Rambi, Expresso, Enguarde, Winky, et Squawks, mais aussi plusieurs membres de la famille Kong. Après de nombreuses confrontations avec les Kremlings et une progression à travers les différentes zones de l'île, Donkey Kong arrive finalement sur le vaisseau pirate, où le chef des Kremlings attend avec les réserves de bananes de la famille Kong. Après à sa défaite, Donkey Kong récupère le stock de bananes.")
            ->setCopiesSold(9000000)
            ->setThumbnail('donkey-kong-country-5fb582230a42a374640346.jpg')
            ->setBackgroundDesktop('donkey-kong-country-bkg-5fd00d9ff1266865210627.jpg')
            ->setBackgroundMobile('donkey-kong-country-bkg-mobile-5fd00e4a761e4306064937.jpg')
            ->setBackgroundPosition('center right')
            ->setFirstBlockMinHeight(500)
            ->setAfterBottom(-297)
        ;
        $gameDkCountry
            ->addConsole($console3ds)
            ->addConsole($consoleGba)
            ->addConsole($consoleGbc)
            ->addConsole($consoleWii)
            ->addConsole($consoleWiiU)
            ->addConsole($consoleSnes)
            ->addConsole($consoleSwitch)
        ;
        $gameDkCountry
            ->addGenre($genrePlateforme)
        ;
        $manager->persist($gameDkCountry);
        
        $gameDkCountryTropcial = new Game();
        $gameDkCountryTropcial
            ->setName('Donkey Kong Country : Tropical Freeze')
            ->setSlug('donkey-kong-country-tropical-freeze')
            ->setNbPlayers(1)
            ->setReleaseDate((new DateTime())->setDate(2014, 2, 21))
            ->setLicense($licenseDonkeyKong)
            ->setDescription("Le jeu a été annoncé lors d'un Nintendo Direct diffusé lors de l'E3 2013 le 11 juin 2013. Le jeu est développé par Retro Studios ; Kensuke Tanabe, qui avait travaillé sur Super Mario Bros. 2, est le producteur et David Wise, compositeur de Donkey Kong Country et Diddy Kong Racing, est responsable de la musique du jeu. Initialement prévue pour novembre 2013, Nintendo annonce le 1er octobre 2013 le report de la sortie du jeu. Le jeu est finalement commercialisé le 13 février 2014 au Japon, le 21 février en Europe et en Amérique du Nord.")
            ->setHistory("L'île de Donkey Kong a été envahie par des vikings du nord appelés les Frigoths menés par leur chef Sire Frighorrifik (Sire Fredrik au Québec) et ceux-ci la pillent et terrorisent les habitants. Donkey Kong et Diddy Kong et toute leur famille s'en vont pour la libérer")
            ->setCopiesSold(4000000)
            ->setThumbnail('donkey-kong-country-tropical-freeze-5fb5851713ca3497364005.jpg')
            ->setBackgroundDesktop('donkey-kong-country-tropical-freeze-bkg-5fd00159a69d2744657535.jpg')
            ->setBackgroundMobile('donkey-kong-country-tropical-freeze-bkg-mobile-5fd000f8e5159535351220.jpg')
            ->setBackgroundPosition('center top 20%')
            ->setFirstBlockMinHeight(500)
            ->setAfterBottom(-297)
        ;
        $gameDkCountryTropcial
            ->addConsole($consoleWiiU)
            ->addConsole($consoleSwitch)
        ;
        $gameDkCountryTropcial
            ->addGenre($genrePlateforme)
            ->addGenre($genreAction)
        ;
        $manager->persist($gameDkCountryTropcial);
        
        $gameDkCountry2 = new Game();
        $gameDkCountry2
            ->setName('Donkey Kong Country 2')
            ->setSlug('donkey-kong-country-2')
            ->setNbPlayers(1)
            ->setReleaseDate((new DateTime())->setDate(1995, 12, 14))
            ->setLicense($licenseDonkeyKong)
            ->setDescription("Le développement de Donkey Kong Country 2: Diddy's Kong Quest est réalisé par Rare et débute rapidement après la sortie de Donkey Kong Country en novembre 1994. Après le très gros succès de ce dernier - près de 9 millions de jeux ont été écoulés, une suite peut être rapidement envisagée. L'équipe commence à travailler sur celle-ci avant même le succès retentissant de DKC, notamment car elle sait qu'il y a de nombreuses choses qu'elle n'a pu intégrer dans le premier opus et qu'elle aimerait présenter dans une suite. La volonté initiale de la création de celle-ci émane donc en premier lieu de Rare et de ses employés, mais le succès rapide de Donkey Kong Country permet de confirmer le lancement officiel du projet. L'équipe profite de toute l'expérience professionnelle acquise lors de la création du premier jeu et est entièrement reconduite. En réponse aux reproches des joueurs plus âgés, le niveau de difficulté est remonté, le jeu est donc plus difficile que son prédécesseur. Selon le site web Unseen 64, le jeu est d'abord envisagé sur Virtual Boy. Toutefois, l'échec de cette console pousse l'équipe à sortir le jeu sur Super Nintendo.<br/><br/>Donkey Kong Country 2: Diddy's Kong Quest sort en Amérique du Nord le 20 novembre 19951, le 21 novembre au Japon et en Europe à partir du 14 décembre 19951. Une adaptation sur Game Boy Advance est annoncée mi-décembre 2003 pour le second trimestre de l'année 2004. Elle est éditée sous le titre Donkey Kong Country 2 le 25 juin 2004 en Europe, le 1er juillet 2004 au Japon et le 15 novembre 2004 en Amérique du Nord.")
            ->setHistory("Sur Galion de la galère, un bateau de pirate, Diddy Kong découvre une note écrite qui fait état de la capture de Donkey Kong par Kaptain K. Rool. Contre sa libération, ce dernier exige le stock de bananes de la famille Kong qu'il n'a pu obtenir dans le jeu précédent. Diddy et Dixie Kong tentent par la suite de le délivrer et, dans ce but, partent tous deux à l'aventure sur l'Île aux crocodiles.<br/><br/>Aidés dans leur quête par de nombreux animaux, ils finissent par affronter Kaptain K. Rool et le vaincre, ce après quoi celui-ci s'échappe alors que le duo découvre la nouvelle zone « Monde perdu ». Dans celle-ci, une sorte de volcan où un geyser se situe au cœur de l'Île aux crocodiles, ils combattent à nouveau Kaptain K. Rool et réussissent à le terrasser. Alors que l'île sombre au fond de l'eau, Kaptain K. Rool s'échappe sur un petit bateau.")
            ->setCopiesSold(5150000)
            ->setThumbnail('donkey-kong-country-2-5fb582e37b407082289472.jpg')
            ->setBackgroundDesktop('donkey-kong-country-2-bkg-5fd009f92e858389355030.jpg')
            ->setBackgroundMobile('donkey-kong-country-2-bkg-mobile-5fd00bc8ba0c6576527158.jpg')
            ->setBackgroundPosition('center')
            ->setFirstBlockMinHeight(500)
            ->setAfterBottom(-297)
        ;
        $gameDkCountry2
            ->addConsole($consoleWiiU)
            ->addConsole($consoleWii)
            ->addConsole($consoleSnes)
            ->addConsole($console3ds)
        ;
        $gameDkCountry2
            ->addGenre($genreAction)
            ->addGenre($genreAventure)
        ;
        $manager->persist($gameDkCountry2);
        
        $gamePaperMario = new Game();
        $gamePaperMario
            ->setName('Paper Mario : La Porte Millénaire')
            ->setSlug('paper-mario-la-porte-millenaire')
            ->setNbPlayers(1)
            ->setReleaseDate((new DateTime())->setDate(2004, 11, 12))
            ->setLicense($licenseSuperMario)
            ->setDescription("Paper Mario : La Porte Millénaire sorti sur GameCube en 2004. Il succède a Paper Mario, sorti sur Nintendo 64. Edité par Intelligent Systems, ce deuxième opus de la série Paper Mario se caractérise par un mélange entre un univers papier 2D et 3D. A la différence des jeux Mario classiques qui sont des jeux de plateforme, les Paper Mario sont des RPG, avec pour ce jeu là propose des combats au tour par tour.")
            ->setHistory("Alors que la Princesse Peach fait un voyage avec Papy Champi, ils se retrouvent dans une ville du nom de Port-Lacanaïe. La princesse, ayant réussi à échapper à la surveillance de Papy Champi, fait la rencontre d'une marchande qui vend un coffre. Personne n'ayant auparavant réussi à ouvrir ce coffre, la vendeuse dit à Peach qu'elle pourrait obtenir son contenu si elle réussissait à l'ouvrir. Le coffre s'ouvre sous les mains de la princesse et celle-ci constate qu'il y a une carte à l'intérieur. Excitée à l'idée d'une chasse au trésor, elle envoie cette carte à Mario et l'invite à la rejoindre.<br/><br/>Mario se rend à Port-Lacanaïe mais, à son arrivé il se fait attaquer par un homme disant faire partie des Mégacruxis et qu'il recherche des « gemmes étoiles ». Après avoir réussi à lui échapper, lui et Goomélie, sa nouvelle coéquipière, retrouvent Papy Champi qui leur explique que la princesse a disparue. Suite à cela ils décident de rendre visite au profésseur Goostein, afin d'en savoir plus sur la fameuse carte que Peach a envoyé à Mario. Ce dernier leur explique qu'elle permet de trouver le trésor légendaire de Port-Lacanaïe, qui est caché dans les sous-sols de la ville derrière la Porte Millénaire. Cependant, cette porte est scellée et le seul moyen de l'ouvrir est de réunir les sept gemmes étoiles. Mario part donc en quête des sept gemmes étoiles et de la princesse Peach.")
            ->setCopiesSold(2250000)
            ->setThumbnail('paper-mario-porte-millenaire-5fb58d7c510b4950364229.jpg')
            ->setBackgroundDesktop('paper-mario-2-bkg-5fcff13d02aed118187926.jpg')
            ->setBackgroundMobile('paper-mario-2-bkg-mobile-5fcff1fc169aa603238359.jpg')
            ->setBackgroundPosition('center top 40%')
            ->setFirstBlockMinHeight(600)
            ->setAfterBottom(-347)
        ;
        $gamePaperMario
            ->addConsole($consoleGameCube)
        ;
        $gamePaperMario
            ->addGenre($genreAction)
            ->addGenre($genreRpg)
        ;
        $manager->persist($gamePaperMario);
        
        $gamePokemonEmeraude = new Game();
        $gamePokemonEmeraude
            ->setName('Pokémon Émeraude')
            ->setSlug('pokemon-emeraude')
            ->setNbPlayers(1)
            ->setReleaseDate((new DateTime())->setDate(2005, 10, 21))
            ->setLicense($licensePokemon)
            ->setDescription("Pokémon Émeraude est le cinquième jeu de la série sorti sur Game Boy Advance. C'est le successeur de Pokémon Rubis et Saphir, la « troisième version », comparable à Pokémon Jaune et Cristal. Cette version est sorti sur GBA au Japon le 16 septembre 2004, le 30 avril 2005 en Amérique du Nord, et le 21 octobre 2005 en Europe, après Pokémon Rouge Feu et Vert Feuille. Pokémon Émeraude est l'amélioration graphique de Pokémon Rubis et Saphir sur Game Boy Advance. Certaines espèces complémentaires aux autres versions, ainsi que quelques nouveautés comme la possibilité de capturer Groudon et Kyogre après la Ligue, d'avoir le choix entre Latias et Latios, l'animation des Pokémons au début du combat, ou encore l'ajout de la Zone de combat ont été rajoutées au jeu initial. Le Pokémon mascotte du jeu est Rayquaza, le Pokémon légendaire des cieux.")
            ->setHistory("Le joueur incarne un jeune dresseur en provenance de Johto et dont la famille a déménagé à Bourg-en-Vol, une petite bourgade de la région de Hoenn, afin que le père, Norman, puisse assurer ses fonctions de champion de l'arène de Clémenti-Ville. Peu de temps après son installation, le joueur fait la rencontre du Professeur Seko, en mauvaise posture puisque poursuivi par un Zigzaton. En choisissant son Pokémon de départ pour lui venir en aide, il fait son premier choix dans une aventure qui l'amènera à affronter une multitude de dresseurs, remporter des badges d'arène pour finalement affronter le conseil des 4 afin de devenir maître Pokemon.<br/><br/>Durant sa quête il rencontre les Teams Aqua et Magma dont l'objectif et de modifier le climat de la région Hoen à l'aide des Pokémons légendaires Kyogre et Groudon qui contrôle respectivement la pluie et la chaleur. Ces deux Teams vont reussir à les reveiller jusqu'alors endormies et les contrôler à l'aides des orbes bleu et rouge. Mais une fois reveillés les Pokemons s'enfuis et vont se confronter afin de savoir qui aura la mainmise sur le climat de la région. Pour enpécher cela, le joueur ira au Pilier Céleste afin d'y trouver Rayquaza, le Pokemon légendaire des cieux afin que celui-ci empêche la guerre entreKyogre et Groudon.")
            ->setCopiesSold(6320000)
            ->setThumbnail('pokemon-emeraude-5fb58e3513dff454279513.jpg')
            ->setBackgroundDesktop('pokemon-emeraude-bkg-5fcfd505ba469060846264.jpg')
            ->setBackgroundMobile('pokemon-emeraude-bkg-mobile-5fcfd742bfeb4652720341.jpg')
            ->setBackgroundPosition('top right 30%')
            ->setFirstBlockMinHeight(600)
            ->setAfterBottom(-347)
        ;
        $gamePokemonEmeraude
            ->addConsole($consoleGba)
        ;
        $gamePokemonEmeraude
            ->addGenre($genreRpg)
        ;
        $manager->persist($gamePokemonEmeraude);
        
        $gamePokemonEpee = new Game();
        $gamePokemonEpee
            ->setName('Pokémon Épée et Bouclier')
            ->setSlug('pokemon-epee-et-bouclier')
            ->setNbPlayers(1)
            ->setReleaseDate((new DateTime())->setDate(2019, 11, 15))
            ->setLicense($licensePokemon)
            ->setDescription("Durant l'E3 2017, alors même que Pokémon : Let's Go, Pikachu et Let's Go, Évoli n'avaient pas encore été annoncés, Tsunekazu Ishihara avait fait une brève apparition au travers d'une vidéo où il parlait de Pokkén Tournament DX. À la fin de cette vidéo, il souhaitait rassurer les joueurs : un jeu Pokémon de la série principale était déjà en préparation, mais il ne fallait pas en attendre d'information avant au moins un an.<br/><br/>Le 30 mai 2018, The Pokémon Company a donné une conférence de presse. Pokémon Quest et Pokémon : Let's Go, Pikachu et Let's Go, Évoli y ont été confirmés, puis le président de la firme a dévoilé que le nouveau jeu sortirait bien lors de la deuxième moitié de 2019. Il précise alors que le jeu avait commencé à être développé avant même que la Nintendo Switch ne sorte (avant mars 2017, donc). Il est également précisé que le gameplay du jeu sera similaire à celui des jeux ayant précédé Pokémon : Let's Go, Pikachu et Let's Go, Évoli.<br/><br/>Lors d'une interview de Junichi Masuda donnée dans le magazine Famitsu sorti le 6 juin 2018, il est confirmé que le jeu sera graphiquement plus élaboré que son prédécesseur. Il souhaite par ailleurs permettre le transfert de Pokémon entre ces deux jeux. Le 31 juillet 2018, Nintendo fait un compte-rendu trimestriel : dans celui-ci, il est indiqué que le jeu sortira entre septembre et décembre 2019.<br/><br/>Pokémon Épée et Bouclier ont été annoncés lors du Pokémon Direct du 27 février 2019, à l'occasion du 'Pokémon Day'. L'annonce a été faite par Tsunekazu Ishihara, président de The Pokémon Company. Une bande-annonce a été montrée, dévoilant ainsi la nouvelle région et les Pokémon de départ. L'annonce a été suivie par la création d'un site dédié aux jeux.<br/><br/>Les jeux sont disponibles en neuf langues différentes : le français, l'allemand, l'anglais, le coréen, l'espagnol, l'italien, le japonais, et le chinois traditionnel et simplifié.<br/><br/>Lors du Treehouse qui a suivi le Nintendo Direct de l'E3 2019, Junichi Masuda a annoncé que seuls les Pokémon du Pokédex régional de Galar peuvent être transférés dans ces versions, les autres Pokémon étant absents des données des jeux, provoquant un mouvement de colère des fans.")
            ->setHistory("Le protagoniste débute son aventure dans la ville de Paddoxton, dans le sud de la région de Galar. Alors qu'il regarde un combat Pokémon retransmis à la télévision de Tarak, le maître invaincu de la Ligue Pokémon, son ami et rival Nabil le rejoint afin de débuter leur voyage dans la région en quête du titre de Maître Pokémon. Avant cela, les deux dresseurs doivent chercher Tarak, qui se révèle être le frère de Nabil, à la gare de Brasswick, ville adjacente à la ville de départ.<br/><br/>Après avoir récupéré Tarak à la gare de Brasswick, le joueur et son rival se voient alors attribués leur « Pokémon de départ », parmi Ouistempo, Flambino et Larméléon. Alors sur le point de débuter leur voyage, les deux protagonistes sont interrompus par un Moumouton s'étant introduit dans la Forêt de Sleepwood, endroit normalement interdit, qu'ils décident de sauver. Cependant, au milieu de la brume recouvrant cet endroit mystérieux, les dresseurs sont confrontés à un Pokémon mystérieux semblable à une illusion. Finalement sauvés par Tarak, le joueur et son rival se dirigent vers le laboratoire Pokémon de la ville de Brasswick pour recevoir leur Pokédex.<br/><br/>La professeur Magnolia étant absente, les protagonistes se rendent chez cette dernière, afin de lui faire part de leurs situations. Les deux dresseurs y entreprennent également un combat au terme duquel ils trouvent des Étoiles Vœux leur permettant d'obtenir un Poignet Dynamax de la part de la professeure. Ils y obtiennent également une lettre de recommandation de la part de Tarak, leur permettant alors de participer au Défi des Arènes. Ayant toutes les clés en main, ils peuvent alors se rendre à la ville de Motorby pour participer à l'inauguration du Défi des Arènes.<br/><br/>Arrivés à destination, le joueur et son rival font la connaissance de la Team Yell, venue encourager Rosemary, une jeune dresseuse participant également au Défi des Arènes. Ils y voient également Travis, un dresseur recommandé par le Président de la Ligue Pokémon, nommé Shehroz.<br/><br/>Le joueur entame alors une quête à travers Galar, capturant des Pokémon sauvages, les entraînant et combattant avec ceux des autres dresseurs Pokémon. Au cours de ce périple, il affronte huit Champions d'Arène, auxquels il peut lancer un défi uniquement en relevant une mission choisie par ces derniers dans leurs arènes spécifiques. Ces arènes, semblables à des stades, sont réparties à Greenbury, Skifford, Motorby, Old Chister, Corrifey, Ludester, Smashings et Kickenham. Se trouvant sur des Sources d'Énergie, il y est possible d'utiliser le phénomène Dynamax.<br/><br/>Après avoir vaincu les huit Champions d'Arène et obtenu les huit badges, le joueur se voit attribué une médaille symbolisant sa victoire lors du Défi des Arènes. Il peut alors se rendre à Winscor afin de participer aux Poké Masters et pour avoir une chance de participer au Match Ultime contre Tarak. Pour cela, le dresseur doit participer au Tournoi des Médaillés rassemblant l'ensemble des dresseurs étant sortis vainqueurs du Défi des Arènes. Le vainqueur de ce tournoi peut alors participer au Tournoi des Champions rassemblant sept des huit Champions d'Arène de Galar. Le gagnant de ce tournoi a alors l'opportunité de lancer un défi au Maitre de la Ligue.<br/><br/>Cependant, tout au cours de son périple, le dresseur essayera de faire la lumière sur le phénomène Dynamax à l'aide de Sonya, cette dernière essayant de décripter l'histoire de la région de Galar afin d'obtenir de nouvelles informations. Il devra également résoudre les problèmes posés par le conglomérat Macro Cosmos, détenu par le président Shehroz, ainsi que ceux causés par les héritiers du trône de Galar, qui n'apprécient pas que leurs ancêtres aient été relégués au second plan lors des découvertes effectuées par Sonya (l'assistante et petite-fille de la professeure de la région) sur l'histoire de Galar.")
            ->setCopiesSold(19000000)
            ->setThumbnail('pokzmon-epee-5fb5921a6539e751947375.jpg')
            ->setBackgroundDesktop('pokemon-epee-bkg-5fceb4f93720c484936381.jpg')
            ->setBackgroundMobile('pokemon-epee-bkg-mobile-5fceb6d52ac43000132719.jpg')
            ->setBackgroundPosition('center')
            ->setFirstBlockMinHeight(600)
            ->setAfterBottom(-347)
        ;
        $gamePokemonEpee
            ->addConsole($consoleSwitch)
        ;
        $gamePokemonEpee
            ->addGenre($genreRpg)
        ;
        $manager->persist($gamePokemonEpee);
        
        $gamePokemonPlatine = new Game();
        $gamePokemonPlatine
            ->setName('Pokémon Platine')
            ->setSlug('pokemon-platine')
            ->setNbPlayers(1)
            ->setReleaseDate((new DateTime())->setDate(2009, 5, 22))
            ->setLicense($licensePokemon)
            ->setDescription("Pokémon version platine est la version complémentaire à Pokémon Diamant et Perle. Elle est sorti au Japon le 13 septembre 2008, en Amérique du Nord le 22 mars 2009 et en Europe le 22 mai 2009. Tout comme dans les versions jaune, cristal ou émeraude, il est possible de capturer les Pokémon légendaires de Pokémon Diamant et de Pokémon Perle. Le joueur peut ainsi capturer à la fois Dialga et Palkia ainsi que Giratina, la mascotte du jeu. La version intègre également l'ajout de différentes formes des Pokémon Giratina, Shaymin et Motisma.<br/><br/>Certains lieux, telles les arènes du jeu ou les centres Pokémon ont été remaniés, l'apparence du héros a été revue, la difficulté a été relevée, de nouveaux personnages ont fait leur apparition notamment dans la Team Galaxie qui joue un rôle plus important. Une nouvelle zone de combat fait également son apparition dans le jeu.")
            ->setHistory("Le joueur a le choix entre un personnage féminin (Aurore) et un personnage masculin (Louka). L'aventure débute par sa mère le prévient que son rival vient de passer et le cherche. Le joueur part à sa recherche, et se rendent tout deux au Lac Colère. Cependant, en marchant dans les hautes herbes, le joueur se fait attaquer par un Pokémon sauvage. Il choisit alors son premier Pokémon dans la mallette du Professeur Sorbier, parmi Tortipouss, Tiplouf et Ouisticram.<br/><br/>Le joueur commence sa quête des huit badge d'arène afin de pouvoir acceder à la ligue Pokémon et combattre le Maître, Cynthia. Durant son periple il fera la rencontre de la Team Galaxie, voulant créer un nouvel univers « purifié ». Après avoir obtenu son 6e bagde, le Professeur Sorbier demande à voir le joueur à la bibliothèque de Joliberges. En y arrivant, des secousses se font sentir en provenance du Lac Courage : la Team Galaxie a fait exploser le lac afin de capture l'un Pokémons légendaire someillant au fond du lac : Créhelf, Créfollet et Créfadet. Le joueur va donc affronter les trois commandants de la Team Galaxie : Jupiter, Mars et Saturne dans les lacs Colère, Savoir et Vérité.<br/><br/>Une fois que le joueur a battu les trois commandants, il se rend au bâtiment de la Team Galaxie se trouvant à Voilaroc, où il retrouve Hélio, le chef de la Team Galaxie. Ce dernier le défie en combat et après sa défaite, part pour les Colonnes Lances. Avant de le rejoindre, le héros se rend au sous-sol du bâtiment pour libérer Créhelf, Créfollet et Créfadet.<br/><br/>Le joueur emprunte les entrailles du Mont Couronné et finit par arriver aux Colonnes Lances. Là se trouve Hélio, accompagné de Mars et Jupiter. Le héros s'allie donc avec son rival pour battre les deux Commandants. Mais Hélio accomplit son plan et fait apparaître Dialga et Palkia les Pokémons légendaires contrôllant respectivement le temps et l'espace, et leur demande de créer un nouvel univers. Cependant, Giratina le Pokémon régnant en maître sur le monde Distorsion apparaît alors en créant un passage vers ce dernier et apportant Hélios avec lui. Le joueur s'infiltre dans le Monde Distorsion et y découvre un paysage défiant les lois de la physique, composé de sections de plancher séparées en angle de 90°. Arrivé au bout de ce monde, le joueur rencontre Giratina qui doit être vaincu dans sa forme originelle afin de pouvoir revenir dans le monde réel.<br/><br/>Une fois le huitième et dernier Badge obtenu, le joueur se met en route pour la Route Victoire. Après l'avoir traversée, il affronte son rival, puis fait face au Conseil 4 et le Maître, Cynthia.")
            ->setCopiesSold(7690000)
            ->setThumbnail('pokemon-platine-5fb58eb6aeacb714469820.jpg')
            ->setBackgroundDesktop('pokemon-platine-bkg-5fcfd17b535fc948110155.jpg')
            ->setBackgroundMobile(null)
            ->setBackgroundPosition('center top 40%')
            ->setFirstBlockMinHeight(500)
            ->setAfterBottom(-297)
        ;
        $gamePokemonPlatine
            ->addConsole($consoleDsi)
            ->addConsole($consoleDs)
            ->addConsole($consoleDsLite)
        ;
        $gamePokemonPlatine
            ->addGenre($genreRpg)
        ;
        $manager->persist($gamePokemonPlatine);
        
        $gamePokemonRfVf = new Game();
        $gamePokemonRfVf
            ->setName('Pokémon Rouge Feu/Vert Feuille')
            ->setSlug('pokemon-rouge-feu-vert-feuille')
            ->setNbPlayers(1)
            ->setReleaseDate((new DateTime())->setDate(2004, 10, 1))
            ->setLicense($licensePokemon)
            ->setDescription("Pokémon Rouge Feu et Pokémon Vert Feuille sont des remakes des jeux vidéo Pokémon Rouge et Bleu. Les jeux ont été élaborés par Game Freak et édités par Nintendo pour la Game Boy Advance, et ont été les premiers titres compatibles avec l'adaptateur sans fil Game Boy Advance, qui était fourni avec les jeux. Le jeu est sorti au Japon le 29 janvier 2004, en Amérique du Nord le 7 septembre 2004 et en Europe le 1er octobre 2004.<br/><br/>Les jeux disposent de tous les Pokémon des jeux originaux sur Game Boy, ce qui permet à beaucoup de ces Pokémon d'être obtenus pour la première fois dans la nouvelle génération, étant donné que les jeux Game Boy et Game Boy Color sont incompatibles avec les jeux Game Boy Advance. Les deux jeux sont indépendants mais ont en grande partie la même intrigue. Celle-ci se déroule dans le monde de Kanto et suit la progression du héros dans sa quête pour devenir maître Pokémon.")
            ->setHistory("Le joueur incarne un jeune garçon ou une jeune fille bien décidé à devenir maître Pokémon. Le Professeur Chen lui offre son 1er Pokémon de son choix pour qu'il obtienne les 8 badges de la région, qu'il complète le Pokédex et qu'il batte la Team Rocket. Le scénario est globalement le même que dans les jeux Pokémon Rouge et Bleu. Il y a néanmoins quelques des différences :<ul><li>Après avoir battu Pierre à Argenta, un assistant du Professeur Chen donne au joueur les chaussures de sport.</li><li>Après avoir battu Auguste à Cramois'Île, Léo demande au joueur de venir avec lui aux Îles Sevii pour rencontrer le professeur Ciléo.</li><li>Le niveau de chaque membre du Conseil 4 a baissé de 2 la première fois que le joueur les combat. De plus, ce Conseil 4 voit ses Pokémon renforcés de 12 niveaux exactement avec un nouveau Pokémon pour chaque membre (sauf pour Aldo, car ses deux Onix ont évolué en Steelix) après que le joueur a fini la quête des Îles Sevii.</li><li>Les évenements du Roc Nombri et de l'Île Aurore sont présents.</li><li>Blue ne traite le joueur de minable que lorsqu'il l'affronte la première fois dans le laboratoire du professeur Chen et lors de son affrontement après le Conseil des 4.</li></ul>")
            ->setCopiesSold(12000000)
            ->setThumbnail('pokemon-rf-vf-5fb590dbc46cc172019815.png')
            ->setBackgroundDesktop('pokemon-rf-vf-bkg-5fcfda583ceb2937915028.jpg')
            ->setBackgroundMobile(null)
            ->setBackgroundPosition('center top 20%')
            ->setFirstBlockMinHeight(650)
            ->setAfterBottom(-372)
        ;
        $gamePokemonRfVf
            ->addConsole($consoleGba)
        ;
        $gamePokemonRfVf
            ->addGenre($genreRpg)
        ;
        $manager->persist($gamePokemonRfVf);
        
        $gamePokemonSoleil = new Game();
        $gamePokemonSoleil
            ->setName('Pokémon Soleil et Lune')
            ->setSlug('pokemon-soleil-et-lune')
            ->setNbPlayers(1)
            ->setReleaseDate((new DateTime())->setDate(2016, 11, 23))
            ->setLicense($licensePokemon)
            ->setDescription("Pokémon Soleil et Pokémon Lune sont deux jeux vidéo de rôle de la série Pokémon développés par Game Freak sous la direction de Junichi Masuda. Ils ont été annoncés le 26 février 2016, le 27 février au Japon, vingt ans jour pour jour après la sortie du premier jeu, Pokémon Bleu et Rouge.<br/><br/>Développés pour la Nintendo 3DS et disponibles en neuf langues, ces deux jeux sont sortis le 18 novembre 2016 internationalement, puis le 23 novembre 2016 en Europe.")
            ->setHistory("Le jeu se déroule dans la région insulaire et paradisiaque d'Alola, inspirée de l'île d'Oahu, dans l'archipel d'Hawaï. Cette région est composée de quatre îles, ainsi que d’une île artificielle, le paradis Æther. Chacune des îles naturelles est sous la surveillance de Pokémon protecteurs, appelés les Toko ; vénérés par les habitants, ce sont eux aussi qui choisissent les doyens. La première île est Mele-mele, où le héros a déménagé, et son protecteur est Tokorico ; la seconde île est Akala, dont le Pokémon protecteur est Tokopiyon ; la troisième, Ula-Ula, dont le Pokémon protecteur est Tokotoro ; la dernière s'appelle Poni, dont le Pokémon Protecteur est Tokopisco.<br/><br/>L'histoire débute par le déménagement du personnage principal de la région de Kanto vers celle d'Alola. Il y rencontre d'autres enfants et adultes le poussant à réaliser le « Tour des Îles », une épreuve équivalente à la collecte des badges dans les précédents jeux de la série.<br/><br/>Le joueur fait rapidement la rencontre de Lilie, que l'on voit s'échapper du Paradis Æther lors de la cinématique d'ouverture. Il lui vient en aide quand, sur le pont du Sentier de Mahalo, son Cosmog nommé \"Doudou\" sort de son sac et se fait attaquer par des Piafabec sauvages. Le joueur protège Doudou, mais à cause de la puissante attaque de ce dernier le pont cède, et c'est seulement grâce à l'intervention du Pokémon gardien de l'île, Tokorico, que les deux sont sauvés. Le Pokémon Tutélaire s'enfuit, et laisse derrière lui une Gemme Lumière.<br/><br/>Deux scientifiques Pokémon apparaissent dans ce jeu : le professeur Euphorbe, ainsi que Raphaël Chen, le cousin du professeur Chen de Pokémon Rouge et Bleu, qui s'intéresse aux formes régionales de certains Pokémon. La « Team » ennemie de cette génération se nomme la Team Skull et a pour chef Guzma.")
            ->setCopiesSold(16000000)
            ->setThumbnail('pokemon-soleil-lune-5fb591b953c58438901190.jpg')
            ->setBackgroundDesktop('pokemon-sl-bkg-5fceb81523102788004573.jpg')
            ->setBackgroundMobile('pokemon-sl-bkg-mobile-5fcebaed17eaa043158429.jpg')
            ->setBackgroundPosition('center top 20%')
            ->setFirstBlockMinHeight(500)
            ->setAfterBottom(-297)
        ;
        $gamePokemonSoleil
            ->addConsole($console3ds)
        ;
        $gamePokemonSoleil
            ->addGenre($genreRpg)
        ;
        $manager->persist($gamePokemonSoleil);
        
        $gameMario64 = new Game();
        $gameMario64
            ->setName('Super Mario 64')
            ->setSlug('super-mario-64')
            ->setNbPlayers(1)
            ->setReleaseDate((new DateTime())->setDate(1997, 3, 1))
            ->setLicense($licenseSuperMario)
            ->setDescription("Le développement de Super Mario 64 dure moins de 2 ans. Cependant, il a été dit que le producteur et directeur Shigeru Miyamoto a déjà imaginé un Mario en 3D plus de cinq ans avant, en travaillant sur Star Wing. Le développement débute par la création des personnages et du système de caméra. Au début, Miyamoto et les autres développeurs ne sont pas sûrs de la direction que le jeu doit prendre, et ils passent ainsi plusieurs mois à sélectionner une vue et un rendu approprié. Le concept original était un jeu avec des chemins linéaires comme dans un jeu en 3D isométrique, avant qu'ils ne décident de faire un jeu en 3D libre. L'équipe de développement porte beaucoup d'attention aux mouvements de Mario et, avant que les niveaux ne soient créés, teste déjà les animations de Mario sur une simple grille. Le premier scénario de test — visant à essayer les contrôles et la simulation physique, surnommé ainsi en référence au processeur MIPS de la Nintendo 64. Cette scène est toujours présente dans le jeu final en tant que mini-jeu.<br/><br/>Shigeru Miyamoto a déclaré que la philosophie de conception directrice derrière Super Mario 64 était d'inclure « plus de détails » que dans les jeux antérieurs à la Nintendo 64. Le jeu est également caractérisé par le fait qu'il comporte plus de casse-têtes que les jeux précédents de la série Mario. Il a été développé parallèlement avec The Legend of Zelda: Ocarina of Time, mais comme ce dernier sortira plusieurs années plus tard, quelques casse-têtes ont été enlevés du jeu et utilisés pour Super Mario 64.<br/><br/>Super Mario 64 est présenté pour la première fois au Nintendo Space World en novembre 1995, préparant le lancement médiatique de la Nintendo 64.  Il sortira  au Japon et aux États-Unis en 1996 puis en Europe en 1997. Un remake sur Nintendo DS sort en 2005 et une version Nintendo 64 sur la console virtuelle Wii en 2006. Le 18 septembre 2020, Super Mario 64 ressort sur Nintendo Switch dans une compilation de trois jeux en 3D de la série Super Mario, Super Mario 3D All-Stars.<br/><br/>Le jeu eu un immense succès critique et commercial. Il s’écoule à plus de onze millions d’exemplaires à travers le monde. C'est le jeu le plus vendu de la Nintendo 64 et de la cinquième génération de consoles. Il est considéré comme l’un des titres les plus marquants de l’histoire du jeu vidéo et une grande référence pour la cinquième génération de console. Il est acclamé comme révolutionnaire, en particulier pour son système de caméra dynamique et l’utilisation novatrice du contrôle analogique. Il redéfinit le jeu de plates-formes, établissant un nouveau standard pour le genre, de la même façon que Super Mario Bros. en 1985. Le jeu a également été une référence pour tous les jeux de plateformes en 3D qui ont suivi. Super Mario 64 a été listé comme l'un des jeux les plus influents de tous les temps par GameSpot et GameDaily. Ce dernier remarque « qu'il a défini l'expérience de la plateforme en 3D, influençant de nombreux concepteurs de jeu à créer leur propre offre ».")
            ->setHistory("Super Mario 64 débute par une lettre de la princesse Peach qui a invité Mario à manger un gâteau qu'elle a préparé dans son château. Cependant, une fois rentré dans le château, Mario découvre que Bowser a fait prisonnière la princesse ainsi que ses serviteurs en utilisant le pouvoir des 120 étoiles du château.<br/><br/>La plupart des peintures du château sont des portes vers d'autres mondes, dans lesquels les serviteurs de Bowser gardent les étoiles. Mario cherche ces portes dans le château pour entrer dans ces mondes et récupérer les étoiles. Il obtient l'accès à de nouvelles pièces lorsqu'il obtient suffisament d'étoiles, et il devra affronter Bowser à trois reprises dans des niveaux spéciaux. Vaincre Bowser les deux premières fois permet à Mario d'obtenir une clef vers un autre niveau du château, tandis que le dernier combat permet de libérer Peach. Cette dernière récompensera Mario en lui préparant le gâteau qu'elle lui avait promis.")
            ->setCopiesSold(8500000)
            ->setThumbnail('mario-64-5fb58972ebf55670984573.jpeg')
            ->setBackgroundDesktop('mario-64-bkg-5fcff5586a463427632745.jpg')
            ->setBackgroundMobile('smas-sm64-1242x2208-1-5fcff69d52020244517791.jpg')
            ->setBackgroundPosition('left bottom 20%')
            ->setFirstBlockMinHeight(650)
            ->setAfterBottom(-372)
        ;
        $gameMario64
            ->addConsole($consoleN64)
            ->addConsole($consoleSwitch)
            ->addConsole($consoleWii)
            ->addConsole($consoleWiiU)
            ->addConsole($consoleDsLite)
            ->addConsole($consoleDs)
            ->addConsole($consoleDsi)
        ;
        $gameMario64
            ->addGenre($genrePlateforme)
            ->addGenre($genreAction)
        ;
        $manager->persist($gameMario64);
        
        $gameMarioBros3 = new Game();
        $gameMarioBros3
            ->setName('Super Mario Bros 3')
            ->setSlug('super-mario-bros-3')
            ->setNbPlayers(1)
            ->setReleaseDate((new DateTime())->setDate(1988, 10, 23))
            ->setLicense($licenseSuperMario)
            ->setDescription("Le développement de Super Mario Bros. 3 est assuré par Nintendo EAD et dure plus de deux ans. Shigeru Miyamoto est à la tête des concepteurs et des développeurs, avec lesquels il travaille de façon très proche pendant les phases initiale et finale du développement. Il encourage une grande liberté dans l'échange d'idées à l'intérieur de l'équipe, et considère que les idées intrigantes et originales sont la clé du succès d'un jeu vidéo.<br/><br/>Le jeu est conçu pour des joueurs de niveaux très variés. Les pièces bonus et les vies sont abondamment présentes dans les premiers mondes, tandis que les mondes suivants offrent des défis plus compliqués destinés aux joueurs expérimentés. Il est initialement prévu que Mario puisse se changer en centaure, mais cette transformation est ensuite abandonnée et remplacée par celle en raton laveur qui permet à Mario de voler temporairement. En plus des ennemis tirés des épisodes précédents comme les Goombas et les Koopas Troopas, de nouveaux ennemis font leur apparition dans Super Mario Bros.. Ces derniers sont en partie inspirés par de véritables expériences vécues par Miyamoto et le reste de l'équipe. Par exemple, l'idée de Chomp, une tête de chien enchaînée, vient d'une mauvaise expérience qu'a eue Miyamoto avec un chien lorsqu'il était enfant. Les sbires de Bowser ont chacun leurs propres apparence et personnalité ; en guise d'hommage à leurs efforts, Miyamoto se base sur sept de ses programmeurs pour les concevoir. Les noms des Koopalings sont plus tard changés pour ressembler à des noms de célébrités occidentales de la musique, telles que Ludwig van Beethoven ou Iggy Pop, pour l'internationalisation anglaise.<br/><br/>Super Mario Bros. 3 est commercialisé le 23 octobre 1988 au Japon. La même année, une pénurie de puces ROM, avec la préparation de Nintendo of America d'une version de Super Mario Bros. 2 pour les joueurs occidentaux (la version japonaise est jugée trop difficile), empêchent Nintendo de sortir Super Mario Bros. 3 et d'autres jeux en Amérique du Nord dans les délais prévus. En Europe, le jeu est commercialisé dès le 29 août 1991.")
            ->setHistory("Grâce aux frères Mario, la princesse Peach a été sauvée des griffes de Bowser dans Super Mario Bros. Pour se venger, le roi Koopa envoie ses sept sbires koopa,les Koopalings, à différents endroits du royaume. Ceux-ci attaquent chacun un roi avec leur bateau volant, lui volent son sceptre magique et le transforment en animal. Les frères plombiers partent ainsi à la rescousse des sept souverains.<br/><br/>Après avoir terminé leur lourde tâche, les deux héros reçoivent une lettre via le roi du Pays des Tuyau. Celle-ci vient de Bowser, qui a kidnappé la princesse. Les frères se rendent donc dans un ultime monde, le Pays Obscure, où réside le roi maléfique.")
            ->setCopiesSold(18000000)
            ->setThumbnail('super-mario-bros-3-5fb58c30b8a97710272855.jpg')
            ->setBackgroundDesktop('mario-bros-3-bkg-5fcff7f186149355842655.jpg')
            ->setBackgroundMobile('mario-bros-3-bkg-mobile-5fcffa8ac687b303964112.jpg')
            ->setBackgroundPosition('center')
            ->setFirstBlockMinHeight(480)
            ->setAfterBottom(-287)
        ;
        $gameMarioBros3
            ->addConsole($consoleSnes)
            ->addConsole($consoleNes)
            ->addConsole($consoleGba)
        ;
        $gameMarioBros3
            ->addGenre($genrePlateforme)
        ;
        $manager->persist($gameMarioBros3);
        
        $gameMarioGalaxy = new Game();
        $gameMarioGalaxy
            ->setName('Super Mario Galaxy')
            ->setSlug('super-mario-galaxy')
            ->setNbPlayers(1)
            ->setReleaseDate((new DateTime())->setDate(2007, 11, 16))
            ->setLicense($licenseSuperMario)
            ->setDescription("Super Mario Galaxy est développé par Nintendo EAD Tokyo, un studio ouvert en 2003 encore peu expérimenté, ne s'étant chargé que de Donkey Kong Jungle Beat. Son développement est dirigé par Yoshiaki Koizumi, qui s'est déjà chargé en partie de la réalisation de Super Mario 64 et Super Mario Sunshine, les deux épisodes précédents de la série principale de Mario. Le développement débute à la fin de l'année 2004 après la sortie de Jungle Beat, quand Shigeru Miyamoto estime qu'un nouveau grand jeu Mario doit être mis sur les rails.<br/><br/>Shigeru Miyamoto explique avoir eu l'idée d'un environnement sphérique en regardant tourner un hamster dans sa roue. Mais selon Koizumi, l'idée originale n'était pas de réaliser un jeu qui se déroule dans l'espace ; le concept d'environnement sphérique a d'abord été imaginé, puis l'environnement spatial est venu tout naturellement. Petit à petit, le concept évolue et après avoir été confrontée à de nombreux problèmes de développement de la caméra à cause du concept de gravité, l'équipe trouve un compromis qui permet de ne pas imposer au joueur de gérer la caméra manuellement. Miyamoto est très proche de l'équipe de développement tout au long du projet. Chaque nouvelle idée reçoit validation ou suggestion d'amélioration de la part du créateur de la série. Il est même fait en sorte que le jeu développé à Tokyo soit accessible à Kyoto en temps réel. Comme Miyamoto est parfois peu clair dans l'expression de son sentiment vis-à-vis du jeu, Koizumi doit en quelque sorte servir d'interprète pour l'équipe de développement.<br/><br/>Le jeu est prévu pour sortir en même temps que la Wii, puis Miyamoto promet de le sortir dans les six mois suivants sa sortie. Mais le développement prend du retard. En effet, les développeurs tiennent à peaufiner le jeu jusqu'à l'excellence, au point qu'ils projettent de fermer le studio de Tokyo si le jeu est mal accueilli par la critique. Le jeu est finalement présenté dans sa version aboutie sous le nom de Super Mario Galaxy le 9 mai lors de l'E3 2006 à Los Angeles, où Nintendo présente également sa Wii. La presse est particulièrement étonnée de la qualité visuelle du titre, ce à quoi la série n'est pas spécialement habituée. Le travail graphique sur les lumières, les transparences, la résolution des textures et des effets graphiques avancés sont appréciés. <br/><br/>Le jeu sortira sur la console Wii par Nintendo en novembre 2007 et aura droit à une version sur la Nintendo Switch en septembre 2020 dans la collection Super Mario 3D All-Stars, au Japon, en Amérique du Nord et en Europe.")
            ->setHistory("La Princesse Peach invite Mario à une fête dans son château, disant avoir un cadeau à lui donner. En effet, tous les cents ans, une comète passe dans le ciel et une fête est organisée pour l'occasion dans tout le Royaume Champignon. Un morceau de ladite comète contenant un bébé Luma est tombé du ciel et la brigade Toad l'a trouvé. Peach a donc décidé de l'offrir à Mario, malheureusement, elle se fait capturer par Bowser au cours de la soirée. Il emporte avec lui la princesse et son château ainsi que les 120 étoiles de puissance. Le plombier tente de la sauver en vain, il est finalement vaincu par Kamek, qui l'envoie dans l'espace.<br/><br/>Mario se réveille sur le portail cosmique en compagnie de trois lapins. Le bébé Luma que la Princesse Peach prévoyait d’offrir à Mario a eu le temps de s’échapper et de rejoindre Harmonie, la gardienne de l'univers, veillant sur celui-ci depuis l'Observatoire de la Comète. Cette dernière explique à Mario que Bowser à amener Peach au coeur de l'univers et que pour la rejoindre il va falloir réunir les super et grandes étoiles afin de redonner de l'énergie à l'observatoire et qu'il puisse voyager.")
            ->setCopiesSold(12800000)
            ->setThumbnail('mario-galaxy-5fb58a48b4591047889558.jpg')
            ->setBackgroundDesktop('mario-galaxy-bkg-5fcfe7598fee6691921283.jpg')
            ->setBackgroundMobile('mario-galaxy-bkg-mobile-5fcfe67eb797c867999864.jpg')
            ->setBackgroundPosition('center')
            ->setFirstBlockMinHeight(600)
            ->setAfterBottom(-347)
        ;
        $gameMarioGalaxy
            ->addConsole($consoleWii)
            ->addConsole($consoleSwitch)
        ;
        $gameMarioGalaxy
            ->addGenre($genrePlateforme)
        ;
        $manager->persist($gameMarioGalaxy);
        
        $gameMarioOdyssey = new Game();
        $gameMarioOdyssey
            ->setName('Super Mario Odyssey')
            ->setSlug('super-mario-odyssey')
            ->setNbPlayers(1)
            ->setReleaseDate((new DateTime())->setDate(2017, 10, 27))
            ->setLicense($licenseSuperMario)
            ->setDescription("Le développement du jeu commence après la sortie de Super Mario 3D World fin 2013, et est confié à la même équipe. Sous la direction de Kenta Motokura, l'équipe doit trouver des concepts qui rejoignent l'idée directrice de la série : le « thème de la surprise ». L'équipe découvre par exemple que lancer un chapeau est une action amusante à faire avec les manettes Joy-Con, et en fait la mécanique de base du jeu avec la capture par chapeau. L'équipe crée un certain nombre de prototypes plus ou moins originaux, et les intègre tous aux différents mondes du jeu. L'équipe privilégie un pays par rapport aux autres lors du développement : New Donk City. Les développeurs choisissent Pauline, un personnage qui apparaît aux côtés de Mario dans Donkey Kong, pour être la maire de ce monde. Une place toute particulière est donnée à la nostalgie dans le jeu, par exemple avec les costumes qui peuvent être achetés, dont les costumes de Mario's Picross et Super Mario Maker26.<br/><br/>Avec ce jeu, Miyamoto a déclaré vouloir revenir aux origines de la série en 3D, à savoir Super Mario 64 et Super Mario Sunshine. La volonté du jeu est de se rapprocher de la cible principale des jeux Mario, s'éloignant des jeux récents qui ciblaient les joueurs amateurs.<br/><br/>La liberté importante du joueur dans Super Mario Odyssey crée un défi supplémentaire pour les développeurs du jeu, qui veulent lui faire vérifier tout ce qui attire son attention et trouver des objets et défis secrets en permanence. Shigeru Miyamoto, le créateur de la série, ne fait pas partie du développement en tant que tel, mais est producteur exécutif et l'équipe fait appel à lui en tant que consultant. Ses retours sont très spécifiques, souvent critiques, mais relèvent de la suggestion plutôt que de l'ultimatum et il est remarqué pour ses encouragements.<br/><br/>Les premières images du jeu sont dévoilées le 20 octobre 2016 lors d'une présentation des fonctionnalités de la Nintendo Switch. Le jeu est ensuite officialisé le 13 janvier 2017 au cours de la présentation en direct de la console. Le jeu fait sa sortie mondiale le 27 octobre 2017. À cette occasion, des amiibo de Mario, Bowser et Peach habillés pour un mariage sont commercialisés. Nintendo sort enfin un coffret en édition limitée, qui inclut la Switch avec deux Joy-Cons de la couleur du chapeau de Mario, un étui de voyage pour la console, et un code de téléchargement du jeu.")
            ->setHistory("Le jeu ouvre sur un affrontement entre Mario et Bowser sur la forteresse volante de ce dernier. Mario finit par se faire éjecter loin du Royaume Champignon et Bowser écrase la casquette de Mario avant de s'en aller afin de se marier avec la princesse Peach.<br/><br/>Peu de temps après, Mario se réveille sur une colline avant de tomber nez à nez avec un petit fantôme portant un chapeau. Celui-ci s'enfuit, mais Mario le rattrape. Après avoir compris que Mario ne lui veut pas de mal, le fantôme se présente. Il se révèle être un Chapiforme nommé Cappy. Il lui explique aussi que son village a été attaqué par Bowser et que ce dernier a capturé sa sœur Tiara. Mario accepte de l'aider, et Cappy prend alors la forme de sa casquette. En quête d'un vaisseau pour pourchasser le Roi des Koopas, le duo traverse le Pays des Chapeaux et escalade la Chapitour, le grand bâtiment surplombant la zone, où le plombier découvre qu'il peut chapimorphoser les ennemis grâce à son nouveau complice. Après avoir atteint le sommet de la tour, Mario et Cappy tombent sur les Broodals, qui leur expliquent qu'ils sont les ordonnateurs du mariage de Bowser et Peach. Après un affrontement contre Topper, Mario se dirige vers le Pays des Chutes en prenant possession d'une borne gzzzt et c'est là que l'aventure commence vraiment.<br/><br/>Mario et Cappy vont réparer un vaisseau à l'aide de lune (équivalent aux étoiles de Mario 64 et aux soleils de Sunshine) : l'Odyssée, afin de parcourir le monde à la poursuite de Bowser qui réunit divers objets en vue de son mariage avec la princesse Peach.")
            ->setCopiesSold(18060000)
            ->setThumbnail('mario-odyssey-5fb58b3fb8205434147376.jpg')
            ->setBackgroundDesktop('mario-odyssey-bkg-5fcfe20d8eeb5532994553.jpg')
            ->setBackgroundMobile('mario-odyssey-bkg-mobile-5fcfdf0ce1e6e708640164.jpg')
            ->setBackgroundPosition('top left 5%')
            ->setFirstBlockMinHeight(700)
            ->setAfterBottom(-397)
        ;
        $gameMarioOdyssey
            ->addConsole($consoleSwitch)
        ;
        $gameMarioOdyssey
            ->addGenre($genreAction)
            ->addGenre($genrePlateforme)
        ;
        $manager->persist($gameMarioOdyssey);
        
        $gameSmashBros = new Game();
        $gameSmashBros
            ->setName('Super Smash Bros')
            ->setSlug('super-smash-bros')
            ->setNbPlayers(1)
            ->setReleaseDate((new DateTime())->setDate(1999, 12, 17))
            ->setLicense($licenseSuperSmashBros)
            ->setDescription("Super Smash Bros. est développé durant l'année 1998 par HAL Laboratory, studio de développement appartenant à Nintendo. Masahiro Sakurai est intéressé par la création d'un jeu de combat pour quatre joueurs. En manque d'idées, ses premiers essais sont basés sur des personnages simplistes et quelconques. Il présente son projet à Satoru Iwata, qui l'aide à continuer ; cependant, Sakurai sait que les jeux de combat ne se vendaient pas bien : il se doit donc de concevoir un jeu suffisamment original. Sa première idée fut d'inclure des personnages célèbres de Nintendo et de les faire combattre. Pensant ne pas pouvoir obtenir la permission, Sakurai crée un prototype du jeu sans l'accord des développeurs et ne les en informe qu'après que le jeu fut bien avancé. Pour son prototype, il a utilisé les personnages de Mario, Donkey Kong, Samus et Fox. L'idée a par la suite été approuvée.<br/><br/>Super Smash Bros. bénéficie d'un petit budget et de peu de promotion, et est prévu à la base pour ne sortir qu'au Japon ; mais devant son immense succès, Nintendo prend la décision de le diffuser dans d'autres pays.<br/><br/>Super Smash Bros. a reçu des critiques généralement positives ; les reproches qu'on lui a adressés portaient souvent sur le mode solo. Les reproches faits au jeu ont par exemple porté sur son système de score, difficile à suivre. De plus, le mode solo a été critiqué en raison de son niveau de difficulté mal ajusté et de son manque de fonctionnalités. Super Smash Bros. a bénéficié d'un important succès commercial, et a rapidement reçu le label Choix des Joueurs. En 2008, 1,97 million d'exemplaires avaient été vendus au Japon et 2,93 millions aux États-Unis.")
            ->setHistory(null)
            ->setCopiesSold(5550000)
            ->setThumbnail('super-smash-bros-5fb599042c320083879590.jpg')
            ->setBackgroundDesktop('ss64-bkg-5fceafab02d78655362446.jpg')
            ->setBackgroundMobile('ss64-bkg-mobile-5fceadc97b5e8579977165.jpg')
            ->setBackgroundPosition('center top')
            ->setFirstBlockMinHeight(400)
            ->setAfterBottom(-247)
        ;
        $gameSmashBros
            ->addConsole($consoleN64)
            ->addConsole($consoleWii)
        ;
        $gameSmashBros
            ->addGenre($genreCombat)
        ;
        $manager->persist($gameSmashBros);
        
        $gameSmashBros4 = new Game();
        $gameSmashBros4
            ->setName('Super Smash Bros 4')
            ->setSlug('super-smash-bros-4')
            ->setNbPlayers(1)
            ->setReleaseDate((new DateTime())->setDate(2014, 11, 28))
            ->setLicense($licenseSuperSmashBros)
            ->setDescription("Le développement du jeu est annoncé sur Nintendo 3DS et Wii U par Masahiro Sakurai lors de l'E3 2011 alors que celui-ci n'était pas encore commencé. En effet, l'équipe de Sakurai voulait dans un premier temps terminer son autre projet, Kid Icarus: Uprising, sorti en mars 2012. Pour la version Nintendo 3DS, Sakurai indique sa volonté de proposer une expérience davantage « individuelle ». Cela se présente sous la forme de personnages customisés transférables sur la version Wii U. Sakurai s'est également exprimé sur la possibilité d'inclure de nouveaux personnages de Nintendo et un personnage de Capcom dans ces opus.<br/><br/>
            Le 23 janvier 2013, lors d'un Nintendo Direct, Nintendo annonce la présentation du jeu à l'E3 2013 sous sa forme Nintendo 3DS et Wii U. Au cours de l'E3 2013, Sakurai affirme qu'aucun contenu additionnel n'est prévu à cette date, et que les deux jeux pourraient avoir des dates de sorties différentes du fait des limitations techniques rencontrées, notamment concernant l'ajout des Ice Climbers dans la version Nintendo 3DS. Ces limitations rendent impossible la transformation d'un personnage lors d'un combat, d'où la séparation des personnages Zelda et Sheik ou d'aller sur Miiverse ou le Navigateur Web pendant que le jeu est en cours d'utilisation. De même, la console redémarre lorsque le jeu est quitté. Ces derniers problèmes sont résolus sur New Nintendo 3DS du fait de sa nouvelle architecture, plus puissante.<br/><br/>
            Lors d'une interview donnée à Joystiq en juin 2013, Sakurai déclare qu'il n'y aura pas de multiplate-forme entre les deux versions vu que la majorité des stages sont différents dans les deux jeux. Cependant, il annonce la possibilité de transférer les personnalisations des personnages entre les deux versions. En avril 2014, lors d'un Nintendo Direct dédié au jeu, Nintendo annonce la sortie du jeu en été 2014 pour la version Nintendo 3DS et en hiver 2014 pour la version Wii U. <br/><br/>Super Smash Bros. for Nintendo 3DS est commercialisé le 13 septembre 2014 au Japon, le 3 octobre 2014 en Europe et en Amérique du Nord. Cette version profite d'une offre groupée avec une Nintendo 3DS aux couleurs du jeu en Europe et en Amérique du Nord. Super Smash Bros. for Wii U est commercialisé le 21 novembre 2014 en Amérique du Nord, le 28 novembre 2014 en Europe et le 6 décembre 2014 au Japon, avec la possibilité de pré-télécharger la version numérique à partir du 12 novembre. Cette version dispose d'une offre groupée comprenant une manette GameCube aux couleurs de la série et un adaptateur permettant de connecter ces manettes sur Wii U ou d'une offre avec la figurine amiibo de Mario.")
            ->setHistory(null)
            ->setCopiesSold(12900000)
            ->setThumbnail('super-mario-bros-wiiu-5fb598790e2da417027851.jpg')
            ->setBackgroundDesktop('sswiiu-bkg-5fcea43885261856376975.jpg')
            ->setBackgroundMobile('sswiiu-bkg-mobile-5fcea4b507a87746075942.jpg')
            ->setBackgroundPosition('center top')
            ->setFirstBlockMinHeight(600)
            ->setAfterBottom(600)
        ;
        $gameSmashBros4
            ->addConsole($consoleWiiU)
            ->addConsole($console3ds)
        ;
        $gameSmashBros4
            ->addGenre($genreCombat)
        ;
        $manager->persist($gameSmashBros4);
        
        $gameSmashBrosBrawl = new Game();
        $gameSmashBrosBrawl
            ->setName('Super Smash Bros Brawl')
            ->setSlug('super-smash-bros-brawl')
            ->setNbPlayers(1)
            ->setReleaseDate((new DateTime())->setDate(2008, 6, 8))
            ->setLicense($licenseSuperSmashBros)
            ->setDescription("Lors de la conférence de presse du pré-E3 2005, le président de Nintendo Satoru Iwata annonce que le prochain Super Smash Bros. sera bientôt en développement pour leur prochaine console. L'annonce est une surprise pour Sakurai, qui a quitté HAL Laboratory en 2003. Il n'a pas été informé que Nintendo avait l'intention de faire un autre titre Smash, malgré le fait qu'Iwata ait dit à Sakurai peu de temps après sa démission que si un nouveau Smash devait être développé, il voudrait que Sakurai soit à nouveau le réalisateur. Ce n'est qu'après la conférence qu'Iwata demande à Sakurai une rencontre privée avec lui, où il l'invite à participer au développement de Brawl en tant que réalisateur.Satoru Iwata lui a proposé de devenir le réalisateur, et s'il refusait, Nintendo développerait un remake de Super Smash Bros. Melee. Sakurai accepte de devenir réalisateur et le développement du jeu commence en octobre 20052, lorsque Nintendo ouvre un nouveau bureau a Tokyo juste pour sa production.<br/><br/>Le jeu est absent lors du dévoilement de la Wii à la conférence de presse du pré-E3 2006. Le jour suivant, le mercredi 10 mai 2006, sa première bande annonce est dévoilée à l'E3 et après la conférence de presse, Nintendo annonce officiellement le nom du jeu, Super Smash Bros. Brawl. Dans une interview avec IGN, Sakurai déclare que la détection de mouvements permise par la Wii ne sera pas utilisée, car son équipe a trouvé trop éprouvant d'inclure cette fonctionnalité pour autant de personnages.<br/><br/>À la conférence de Nintendo à l'E3 2007, le président de Nintendo of America Reginald Fils-Aime annonce que Super Smash Bros. Brawl sortira le 3 décembre 2007 en Amérique. Cependant, deux mois avant la sortie annoncée, l'équipe de développement demande plus de temps pour travailler sur le jeu. Durant la conférence de Nintendo le 10 octobre 2007, le président Iwata annonce le retard. Le 11 octobre 2007, George Harrison de Nintendo of America annonce que Super Smash Bros. Brawl sortira le 10 février 2008 en Amérique du Nord. Le 15 janvier 2008, la sortie officielle est retardée d'une semaine jusqu'au 31 janvier 2008 au Japon, et près d'un mois en Amérique jusqu'au 9 mars 2008. Le 24 avril 2008, Nintendo of Europe confirme que Brawl sortira le 27 juin 2008 en Europe. De même, Nintendo of Australia annonce le 15 mai 2008 que la date de sortie en Australie serait le 26 juin 2008.")
            ->setHistory("Tabbou, un être mystérieux vivant dans le monde Subspatial, souhaite que le monde des combattants soit absorbé par le sien pour y vivre. Cependant, il est incapable de quitter son monde. Il décide alors d'agir d'une autre façon. Créa-Main, maître du monde des combattants, est alors victime du contrôle de Tabbou et de ses chaînes de lumière. En se faisant passer pour lui, il forme alors une armée et donne des Canon obscurs à ses recrues, Wario, Bowser, Ganondorf et le Roi Dadidou.<br/><br/>Tabbou a observé la technologie de l'Île antique, qui fonctionne avec une armée de robots. Il décide alors d'y faire construire les Bombes subspatiales. Le chef de ses robots accepte à contrecœur de suivre les ordres pour protéger ses semblables et prend l'identité du Ministre Antique.<br/><br/>Tabbou a également observé Mr. Game & Watch et la particularité de son corps, avec laquelle il souhaite fabriqué la Matière d'ombre. Mr. Game & Watch, qui ne sait pas faire la différence entre le bien et le mal, accepte de collaborer sans réfléchir aux conséquences. Il souhaite aussi se servir de l'Halberd, le vaisseau de Meta Knight, pour en faire le vaisseau de l'armée. Il attaque alors son dirigeant, qui est incapable de lutter seule contre une armée entière, en sachant que le Roi Dadidou s'en prend à lui pendant le combat.<br/><br/>Le Roi Dadidou, en revanche, découvre plus tard l'existence de Tabbou et son pouvoir de transformer les combattants en Trophées. Il décide alors de quitter l'armée et d'agir en créant une broche permettant de ranimer un combattant pétrifié une fois arrivée au bout de son sablier. Il souhaite alors obtenir des combattants chez lui pour pouvoir vaincre Tabbou.")
            ->setCopiesSold(13100000)
            ->setThumbnail('super-mario-bros-brawl-5fb5977eaa598005443162.jpg')
            ->setBackgroundDesktop('ssbb-bkg-5fcea83473068666628716.jpg')
            ->setBackgroundMobile(null)
            ->setBackgroundPosition('center bottom 25%')
            ->setFirstBlockMinHeight(500)
            ->setAfterBottom(-297)
        ;
        $gameSmashBrosBrawl
            ->addConsole($consoleWii)
        ;
        $gameSmashBrosBrawl
            ->addGenre($genreCombat)
        ;
        $manager->persist($gameSmashBrosBrawl);
        
        $gameSmashBrosMelee = new Game();
        $gameSmashBrosMelee
            ->setName('Super Smash Bros Melee')
            ->setSlug('super-smash-bros-melee')
            ->setNbPlayers(1)
            ->setReleaseDate((new DateTime())->setDate(2002, 5, 24))
            ->setLicense($licenseSuperSmashBros)
            ->setDescription("Suite au succès du précédent épisode sur Nintendo 64, Nintendo demande une suite à Hal Laboratory, afin d'accompagner la sortie de leur prochaine console, la Gamecube. La sortie prévue en même temps que le lancement de la console ne laissa alors que 13 mois à l'équipe pour développer le jeu. La pression était énorme, d'autant plus que pour Masahiro Sakurai, le créateur de la série, il existait un enjeu supplémentaire. Super Smash Bros. avait permis de poser son concept de jeu de combat, donc Melee en tant que suite, devrait le dépasser en tout point. Les délais étaient telles qu'il a passé ses 13 mois sans aucun jour de congé, travaillant parfois 40 heures d'affilée pour aller dormir pendant 4h. Il s'est ainsi évanoui au travail, et a dû être transporté à l'hôpital avant de revenir. Pour Nintendo, l'enjeu était également de taille, au delà d'une suite à Super Smash Bros, il s'agissait surtout de montrer toute la puissance du Gamecube, d'où la demande de réaliser une vidéo entièrement en motion video afin de la présenter à l'E3 2001. Cette vidéo servira ensuite d'intro au titre final.<br/><br/>Il est l'un des premiers jeux sortis sur la Nintendo GameCube et est révélateur de l'amélioration des graphismes depuis la Nintendo 64. Les développeurs voulaient honorer les débuts de la GameCube en faisant une séquence d'ouverture qui attirerait l'attention des gens sur les graphismes. Pour faire cette séquence, Hal Laboratory travaillait à Tokyo avec trois entreprises de graphisme différentes. Sur leur site officiel, les développeurs postaient des captures d'écran et des informations sur le moteur physique et les détails du jeu, en notant les changements par rapport à son prédécesseur.<br/><br/>Nintendo présente le jeu à l'E3 en 2001 via une démo jouable. L'exposition majeure suivante du jeu a lieu en août 2001 au Nintendo Space World, où Nintendo a exposé une autre démo jouable améliorée par rapport à la précédente de l'E3. Nintendo a d'ailleurs organisé un tournoi pour les fans, dans lequel ils pouvaient gagner une GameCube et Super Smash Bros. Melee. Avant la sortie du titre, le site officiel japonais du jeu subissait des mises à jour hebdomadaires, avec des captures d'écran et des profils de personnages disponibles. Nintendo a suivi cette tendance avec Super Smash Bros. Brawl : Masahiro Sakurai, le développeur du jeu, a fait des mises à jour quotidiennes sur le site officiel. Il sortira le 21 Novembre en 2001 au Japon et le 2 Décembre en Amérique du Nord, et le 24 Mai en 2002 en Europe.")
            ->setHistory(null)
            ->setCopiesSold(7140000)
            ->setThumbnail('super-mario-bros-melee-5fb597e240d34978783333.jpg')
            ->setBackgroundDesktop('ssm-bkg-5fceab266dfba171796904.jpg')
            ->setBackgroundMobile('ssm-bkg-mobile-5fceab4607fff933908406.jpg')
            ->setBackgroundPosition('center')
            ->setFirstBlockMinHeight(500)
            ->setAfterBottom(-297)
        ;
        $gameSmashBrosMelee
            ->addConsole($consoleGameCube)
        ;
        $gameSmashBrosMelee
            ->addGenre($genreCombat)
        ;
        $manager->persist($gameSmashBrosMelee);
        
        $gameSmashBrosUltimate = new Game();
        $gameSmashBrosUltimate
            ->setName('Super Smash Bros Ultimate')
            ->setSlug('super-smash-bros-ultimate')
            ->setNbPlayers(1)
            ->setReleaseDate((new DateTime())->setDate(2018, 12, 7))
            ->setLicense($licenseSuperSmashBros)
            ->setDescription("Bien que le projet ait démarré en décembre 2015 en même temps que les derniers combattants additionnels de Super Smash Bros. 4, le jeu a été officiellement annoncé pour la première fois à travers une bande-annonce lors du Nintendo Direct du 8 mars 2018 sous le nom de Super Smash Bros.. Le titre complet est révélé lors de l'E3, le 12 juin 2018. Le développement a officiellement pris fin le 15 novembre 2018. Le développement des DLC a débuté une fois le jeu sorti, soit, le 7 décembre 2018.<br/><br/>Alors qu'il avait émis des doutes quant à sa participation dans le développement de la licence après Super Smash Bros. 4, Masahiro Sakurai, le créateur de la série, a finalement annoncé faire partie de l'équipe de développement du jeu. Lors du Super Smash Bros. Ultimate Direct du 1er novembre 2018, Nintendo a annoncé que cinq lots de contenu téléchargeable sont développés pour le jeu, contenant chacun un personnage inédit ainsi qu'un stage et quelques pistes audio pour les accompagner. Le premier personnage à être annoncé en tant que contenu additionnel est le personnage principal du jeu Persona, Joker.")
            ->setHistory("La créature inconnue Kilaire a envahi le monde de Super Smash Bros. grâce à un plan ingénieux. Elle réussit à créer des clones des combattants contrôlés de force par les Esprits, soumis à Kilaire.<br/><br/>Lors d'une razzia, Kilaire attaqua les combattants avec des copies de Créa-Main. Celles-ci lancèrent des rayons sur les combattants, qui cherchèrent à les éviter. Seul Kirby réussit à s'échapper à temps, Shulk l'ayant prévenu grâce à sa vision, lui permettant de fuir sur une Étoile Warp. Tous les autres combattants tombèrent sous la domination de Kilaire.<br/><br/>Cependant, Kilaire n'était pas le seul à vouloir faire main basse sur l'univers Smash Bros. Tapi dans les ténèbres, le monstre Sumbra avait lui aussi des visées sur ces lieux, et il projetait lui aussi de les dominer. Aussi, lorsque Kirby et les combattants qu'il avait sauvé affaiblirent suffisamment Kilaire, Sumbra profita de la position de faiblesse de son concurrent et prit le contrôle de tous les combattants encore sous l'emprise de Kilaire, et se mit lui aussi à créer des clones.")
            ->setCopiesSold(20000000)
            ->setThumbnail('smash-bros-ultimate-5fb596ff7663f805500106.jpg')
            ->setBackgroundDesktop('ssu-bkg-5fce9fb58f5f8690361198.jpg')
            ->setBackgroundMobile('smash-bros-5fcea0e87f678896130482.jpg')
            ->setBackgroundPosition('center')
            ->setFirstBlockMinHeight(400)
            ->setAfterBottom(-247)
        ;
        $gameSmashBrosUltimate
            ->addConsole($consoleSwitch)
        ;
        $gameSmashBrosUltimate
            ->addGenre($genreAction)
            ->addGenre($genreCombat)
        ;
        $manager->persist($gameSmashBrosUltimate);
        
        $gameZeldaBotw = new Game();
        $gameZeldaBotw
            ->setName('The Legend of Zelda Breath of the Wild')
            ->setSlug('the-legend-of-zelda-breath-of-the-wild')
            ->setNbPlayers(1)
            ->setReleaseDate((new DateTime())->setDate(2017, 3, 3))
            ->setLicense($licenseZelda)
            ->setDescription("C’est à l’E3 2014 que les premières images du futur Breath of the Wild apparaissent devant les yeux des fans, alors fascinés par ce qu’ils voient. La direction artistique est très éloignée de celle de la démo technique de 2011 et se rapproche plus du style de Skyward Sword, très coloré et lumineux. Le trailer, réalisé avec le moteur du jeu, met en scène Link sur un cheval, au milieu d’une vaste plaine, en train de fuir puis affronter une créature robotique - dont le nom de Gardien sera plus tard dévoilé. Pendant plus d’un an, le jeu se fait désirer : toujours pas de nom définitif et une sortie vaguement estimée à 2015, nous n’en saurons pas plus avant le mois de novembre 2015.<br/><br/>C’est lors de la réunion des investisseurs chez Nintendo qui a eu lieu le 27 avril 2016 que cette énième échéance est encore une fois repoussée à l’année suivante, afin que Zelda Wii U puisse bénéficier d’une sortie sur la Switch, la nouvelle console de Nintendo, qui sera présentée plus tard que prévu. Ce qui nous amène à l’E3 2016 où un premier vrai trailer du jeu est dévoilé. Le 13 janvier 2017, Nintendo avait donné rendez-vous à ses fans à cinq heures de matin (heure française) pour la présentation de la Nintendo Switch. mais a anoncé que le jeu sortirait bien le 3 mars 2017 en même temps que la Switch.")
            ->setHistory("«<i>Depuis les temps les plus reculés, l'histoire de la famille royale d'Hyrule est intimement liée à celle du Fléau, ce monstre que l'on nomme Ganon. Chaque fois qu'il s'abat sur Hyrule, un jeune garçon et la princesse du royaume, l'âme du Héros et le sang de la Déesse, s'allient pour restaurer la paix.  [...]</i> » tel est la légende racontée dans le royaume d'Hyrule depuis la nuit des temps.<br/><br/>Le Fléau s'est éveillé il y a 100 ans et réussit a ravager le royaume d'Hyrule en prenant le contrôle des gardiens et des créatures divines, des machines issus de la technologie Sheikah, créées pour aider le héros et la princesse dans leur tâche. Grâce à cela Ganon à réussit à mettre en échec Link et Zelda, c'est derniers tentant de fuir le chaos, se font rattraper par les horde de gardiens et Link finit par tomber au combat. Zelda l'envoie au sanctuaire de la renaissance afin qu'il puisse guérir, pendant ce temps, la princesse retourne au château d'Hyrule afin de retenir Ganon dans le chateau d'Hyrule<br/><br/>Le début du jeux commence au réveil de Link, après 100 ans de sommeil en cryostase. Guidé par un vieil homme qui se révèle être le spectre roi d'Hyrule, Link va se diriger vers Cocorico où Impa va le guider dans sa quête pour retrouver ses souvenirs et terrasser le Fléau.")
            ->setCopiesSold(21000000)
            ->setThumbnail('zelda-botw-5fb599a450f60909521607.jpg')
            ->setBackgroundDesktop('zelda-botw-bkg-5fce88f6072a9508435212.jpg')
            ->setBackgroundMobile('zelda-botw-bkg-mobile-5fce8a7ebe193221065653.jpg')
            ->setBackgroundPosition('center top')
            ->setFirstBlockMinHeight(550)
            ->setAfterBottom(-322)
        ;
        $gameZeldaBotw
            ->addConsole($consoleSwitch)
        ;
        $gameZeldaBotw
            ->addGenre($genreAction)
            ->addGenre($genreAventure)
        ;
        $manager->persist($gameZeldaBotw);
        
        $gameZeldaMajora = new Game();
        $gameZeldaMajora
            ->setName('The Legend of Zelda Majora\'s Mask')
            ->setSlug('the-legend-of-zelda-majoras-mask')
            ->setNbPlayers(1)
            ->setReleaseDate((new DateTime())->setDate(2000, 11, 17))
            ->setLicense($licenseZelda)
            ->setDescription("Comment succéder à Ocarina of Time et son succès sans précédent : c’est la difficile question à laquelle Eiji Aonuma et son équipe doivent répondre au début du développement du jeu qui allait devenir Majora’s Mask.<br/><br/>En mai 1999, le magazine japonais Famitsu parle de l’arrivée prochaine sur l’archipel de l’extension d’Ocarina of Time pour le 64DD : c’est le projet Ura Zelda, finalement annulé vu le manque d’engouement pour le périphérique et qui refera surface plus tard sous les traits de Master Quest. Toujours est-il qu’il y a un temps une confusion entre ce Ura Zelda et le Zelda Gaiden (Gaiden désignant en gros une histoire complémentaire), qui apparaît en août 1999 au Nintendo Space World. C’est bien ce Zelda Gaiden qui deviendra Majora’s Mask. C’est à ce SpaceWorld 1999 qu’on peut pour la première fois apercevoir des éléments caractéristiques du jeu, tels que Bourg-Clocher ou le Masque Goron. C’est là les prémices de tout le système de masques du jeu final, chacun conférant à Link une habileté particulière et certains permettant même de le changer en Mojo, Goron ou Zora, modifiant du coup radicalement la façon dont on contrôle le personnage.<br/><br/>Le jeu utilise l’Expansion Pak de la Nintendo 64 : ainsi, bien que les graphismes et le moteur soient directement repris d’Ocarina of Time, divers éléments d’ordre technique comme la distance d’affichage, les détails des textures ou le nombre de personnages à l’écran sont améliorés. C’est en mars 2000 que le titre définitif du jeu, Majora’s Mask, est officiellement annoncé. Le jeu est finalement lancé en mai au Japon, en octobre en Amérique du Nord et le 17 novembre 2000 en Europe. Beaucoup s’attendaient à voir le jeu se retrouver dans l’ombre de son prédécesseur Ocarina of Time, mais les critiques sont largement positives.<br/><br/>Il n’en reste pas moins que par ses choix audacieux pour ce qui est de l’ambiance et de la progression de l’aventure, Majora’s Mask est de nature à diviser. La lune menaçante qui pèse en permanence sur le joueur et le décompte fatidique des 72 heures qui poursuit inlassablement sa course rend le jeu très sombre. Les uns se réjouissent de cette ambiance apocalyptique si nouvelle pour Zelda, tandis que d’autres trouvent plus difficile de rentrer dans le jeu. Le fort accent mis sur les quêtes annexes est parfois jugé être trop au détriment de l’aventure principale, même si globalement il s’agit plutôt d’un point fort apprécié de Majora’s Mask. Le monde de Termina et ses habitants sont en apparence très semblables à l’Hyrule d’Ocarina of Time, mais comme vus au travers d’un étrange miroir. On croit être en terrain connu, mais tout est en même temps clairement différent.")
            ->setHistory("Après avoir vaincu Ganondorf, Link part dans une quête secrète pour retrouver un ancien ami (sûrement Navi) et son périple l'amène à croiser un Skull Kid au fin fond des bois Perdus. Ce dernier lui vole sa jument, Epona, ainsi que l'ocarina du Temps, avant de s'enfuir. En partant à sa poursuite, notre héros tombe dans un monde parallèle à Hyrule : Termina, et il fait la connaissance de Taya, fée de compagnie de Skull Kid, qui a été séparée de son frère Tael et qui souhaite le retrouver, en s'alliant d'abord temporairement à Link.<br/><br/>Dans un premier temps, transformé par Skull Kid en Peste Mojo, Link apprend des habitants de Termina que la lune va s'écraser sur la terre et qu'il ne dispose que de trois jours pour stopper l'apocalypse. Apocalypse provoquée par Skull Kid, qui possède d'ailleurs un étrange masque : le masque de Majora. En premier lieu, Link remet la main sur son ocarina du Temps, et Taya décide de continuer à l'accompagner dans sa quête, car Skull Kid est en train de devenir fou et elle veut l'arrêter. Ils devront alors remettre la main sur le masque de Majora, à la requête du vendeur de Masques, et ce en collectant les masques des boss du jeu, pour réveiller les quatre Géants.")
            ->setCopiesSold(6360000)
            ->setThumbnail('zelda-mm-5fb59b1c0d712404305844.jpg')
            ->setBackgroundDesktop('bkg-5fca132a1199c501841953.jpg')
            ->setBackgroundMobile('mm-bkg-mobile-5fca36e2937dd275524400.jpg')
            ->setBackgroundPosition('left 30% center')
            ->setFirstBlockMinHeight(550)
            ->setAfterBottom(-322)
        ;
        $gameZeldaMajora
            ->addConsole($consoleWiiU)
            ->addConsole($consoleWii)
            ->addConsole($consoleN64)
            ->addConsole($consoleGameCube)
            ->addConsole($console3ds)
        ;
        $gameZeldaMajora
            ->addGenre($genreAction)
            ->addGenre($genreAventure)
        ;
        $manager->persist($gameZeldaMajora);
        
        $gameZeldaOcarina = new Game();
        $gameZeldaOcarina
            ->setName('The Legend of Zelda Ocarina of Time')
            ->setSlug('the-legend-of-zelda-ocarina-of-time')
            ->setNbPlayers(1)
            ->setReleaseDate((new DateTime())->setDate(1998, 12, 11))
            ->setLicense($licenseZelda)
            ->setDescription("En 1995, la série Zelda s’apprête à amorcer le plus grand tournant de son histoire. La Nintendo 64 fait partout parler d’elle et fin novembre de cette année, elle est pour la première fois montrée au public en version jouable. Mais même avec un bond technologique aussi important que le passage à la 3D comme argument, ce sont avant tout les jeux qui décident du destin d’une machine. Deux gros projets sont alors développés en parallèle par Nintendo EAD, chacun chargé de réinventer une série populaire de la société pour la 3D : Super Mario 64 et Zelda 64, bientôt connu sous le nom d’Ocarina of Time. Chacun des deux jeux est révélé au Nintendo Space World de décembre 1995 au travers d’une première démo technique : c’est l’occasion de voir un Link encore peu détaillé et proche des anciens épisodes en combat contre un chevalier métallique.<br/><br/>Au début de son développement, Ocarina of Time est pensé par Miyamoto comme un jeu à la première personne : il croyait que cela permettrait mieux au joueur d’appréhender les vastes décors du jeu, et aux développeurs de se focaliser sur la création des ennemis et environnements. Cette vision est balayée quand le ressort principal du jeu est introduit, à savoir la présence d’un Link enfant ET d’un Link adulte séparés par sept ans mais liés par l’Ocarina du Temps. Miyamoto se dit en effet qu’il sera alors nécessaire que Link apparaisse bel et bien à l’écran.<br/><br/>Ce n’est que fin 1998 qu’Ocarina of Time est lancé partout dans le monde, après une attente quasi insoutenable de trois ans qui aura notamment nécessité la mise en place d’une opération spéciale permettant d’obtenir une cartouche dorée par précommande. Ocarina of Time est l’un des jeux vidéo les plus acclamés par la presse de tous les temps ; certains le considèrent comme le meilleur jeu jamais créé. Une étiquette sans doute un peu cliché et amplifiée par le mythe créé autour du jeu, mais impossible de ne pas en voir les raisons : Ocarina a su faire passer la formule Zelda dans l’ère de la 3D sans en ruiner le gameplay — et c’est une transition très délicate —, à l’image de Super Mario 64 ou Metroid Prime pour leurs séries respectives.<br/><br/>Réédité en 2003 sur GameCube, avec sa version Master Quest, pour la sortie de The Wind Waker, puis sur la Console Virtuelle de la Wii en 2007, le jeu fera enfin l’objet en juin 2011 d’un remake sur la Nintendo 3DS, alors toute récente sur le marché.<br/><br/>Le fait qu’Ocarina of Time raconte l’origine du Royaume d’Hyrule et se passe chronologiquement avant tous les autres Zelda sortis précédemment contribue à lui donner ce côté mythe fondateur de la série, plus encore que The Legend of Zelda et A Link to the Past. Un nombre incalculable d’éléments de l’univers du jeu sont repris dans les Zelda ultérieurs et son système de combat est toujours d’application huit ans plus tard, certes dans une version plus ou moins améliorée dans Twilight Princess. Qu’on le préfère aux autres Zelda 3D ou non, la série est ce qu’elle est aujourd’hui grâce à Ocarina of Time, impossible de le nier !")
            ->setHistory("Link vit dans la forêt kokiri. Les autres enfants ont une fée sauf lui. Un jour l'Arbre Mojo envoie une fée pour réveiller Link. Ce dernier convoque Link, pour lui expliquer qu'il ne vient pas de la forêt, comme les autres Kokiris qui peuplent celle-ci, et qu'il a une quête à accomplir : sauver Hyrule d'un vil cavalier du désert qui désire s'emparer de la Triforce. C'est alors que commence sa quête. Il reçoit de l'Arbre Mojo la pierre ancestrale de la forêt, qu'il doit remettre à la princesse d'Hyrule, Zelda. Celle-ci lui demande de ramener deux autres pierres qui permettront de desceller la porte du temple du Temps à l'aide de l'ocarina du temps.<br/><br/>Une fois réunies, Link entonne le chant du Temps avec l'ocarina du Temps devant le piédestal des trois pierres Ancestrales. La porte du Temps s'ouvre alors et Link se retrouve dans la pièce où se trouve L'épée de Légende. Il s'en approche et la retire de son socle. Il rencontre Rauru, l'un des sept sages protecteurs de la Triforce qui lui apprend que l'épée avait endormi son âme pendant sept années, durant lesquelles le vil Ganondorf a envahi Hyrule… Link est devenu plus grand et plus puissant. Il pourra ainsi voyager dans le temps en insérant l'épée de Légende dans son socle de granit pour rajeunir ou en la retirant pour passer à l'âge adulte. À l'âge adulte, Link ne peut plus utiliser certains objets de son enfance mais en revanche, il peut monter une jument, Epona. L'épée de Légende est une lame purificatrice repoussant les forces obscures. Les êtres du mal ne peuvent donc pas la toucher et seul le Héros du Temps peut la retirer de son socle. Sa quête est maintenant d'éveiller les six autres sages d'Hyrule pour battre Ganondorf, guidé par le mystérieux Sheik.")
            ->setCopiesSold(13220000)
            ->setThumbnail('zelda-ott-5fb59bd788e18759375590.jpg')
            ->setBackgroundDesktop('zelda-oot-bkg-5fce9b30da4b3457700665.jpg')
            ->setBackgroundMobile('zelda-oot-bkg-mobile-5fce9b30dc269261950173.jpg')
            ->setBackgroundPosition('center')
            ->setFirstBlockMinHeight(500)
            ->setAfterBottom(-297)
        ;
        $gameZeldaOcarina
            ->addConsole($console3ds)
            ->addConsole($consoleWiiU)
            ->addConsole($consoleWii)
            ->addConsole($consoleN64)
            ->addConsole($consoleGameCube)
        ;
        $gameZeldaOcarina
            ->addGenre($genreAction)
            ->addGenre($genreAventure)
        ;
        $manager->persist($gameZeldaOcarina);
        
        $gameZeldaTp = new Game();
        $gameZeldaTp
            ->setName('The Legend of Zelda Twilight Princess')
            ->setSlug('the-legend-of-zelda-twilight-princess')
            ->setNbPlayers(1)
            ->setReleaseDate((new DateTime())->setDate(2006, 12, 8))
            ->setLicense($licenseZelda)
            ->setDescription("Mai 2004. Les joueurs ont maintenant largement eu le temps de retourner The Wind Waker dans tous les sens et arrivent déjà les premières interrogations quant au futur de la série : on parle depuis déjà un moment d’un « The Wind Waker 2 » dans la veine du précédent épisode. Nintendo tient à cette époque sa conférence dans le cadre de l’E3. Tout à la fin de la conférence, Reggie Fils-Aime revient sur scène pour une dernière surprise sur GameCube… Pas sûr que l’annonce d’un nouveau jeu ait jamais provoqué autant d’enthousiasme que celle-ci : les journalistes hurlent de joie tandis qu’un Link adulte, dans un style photoréaliste, traverse une plaine sur le dos d’Epona, affronte des ennemis montés sur des sangliers et fait face à un immense boss de feu, dans une ambiance générale qui n’est pas sans rappeler le Seigneur des Anneaux.<br/><br/>Début 2006, il est officiellement annoncé que le jeu pourra tirer profit des contrôles de la Wii. À l’E3, il est annoncé que le jeu sortira en deux versions. Une démo permet de s’essayer aux contrôles nouvellement implantés, notamment viser l’écran pour tirer à l’arc à flèches ou mimer le geste de jeter une canne à pêche à l’eau ; l’épée ne sera cependant gérée par les mouvements de Wiimote que par après, étant alors cantonnée au bouton B. En septembre 2006, avec une énième série de screenshots et une vidéo de plus à la clé, la date de sortie définitive du jeu est fixée, coïncidant avec le lancement de la Wii sur les trois territoires, en novembre en Amérique du Nord et en décembre au Japon et en Europe.<br/><br/>Twilight Princess reçoit d’excellentes critiques à sa sortie, tant de la part de la presse que parmi les fans. Assez vite, on constate cependant une certaine déception chez certains, que ce soit parce que les attentes étaient trop hautes après un développement si suivi, ou bien peut-être parce que le produit final manque un peu du souffle épique des premiers trailers. Le jeu est souvent accusé de se retrouver dans l’ombre d’Ocarina of Time à force d’avoir tant voulu le dépasser, trop classique et figé dans les codes de la série.")
            ->setHistory("Niché au cœur d’idylliques pâturages, à la pointe sud du royaume d’Hyrule, se trouve le village de Toal. La vie y est principalement tournée vers l’élevage de chèvres. Parmi les bergers, il y a le meilleur cavalier du village, un jeune homme qui rêve d’en devenir un jour le chef. Ce jeune homme s’appelle Link…<br/><br/>Link a gagné le respect des autres habitants et est considéré comme un leader par les enfants du village. En plus de ses tâches de berger, il prend des leçons d’escrime auprès de Moï, le maître d’armes du village, et est devenu très apprécié des enfants en leur montrant les techniques qu’il a apprises. Mais un jour, lors d’une de ses démonstrations, un singe fait soudain son apparition. « Hé ! c’est le singe qui n’arrête pas de jouer des tours aux villageois ! Attrapons-le ! » crient les enfants en se lançant à la poursuite du quadrumane. Link pénètre alors à son tour dans la forêt à la suite des enfants. Là, il se voit contraint d’affronter de multiples monstres dans sa quête pour libérer l’un des enfants, retenu prisonnier dans une cage avec le singe.<br/><br/>Pourtant, la forêt avait toujours été un endroit sûr…<br/><br/>Le jour suivant est très important pour Link. Sur les recommandations de Moï, le chef du village lui a donné pour mission d’aller remettre un cadeau au Château d’Hyrule, et c’est aujourd’hui qu’il doit se mettre en route. Mais alors que Link revient de son travail à la bergerie, Epona, sa jument, se blesse. Cette blessure provoque la colère d’Iria, l’amie d’enfance de Link. Furieuse, elle emmène Epona avec elle. Iria soigne bientôt la blessure d’Epona à la source de l’Esprit, mais sa colère ne diminue pas malgré tous les efforts de Link pour la calmer.<br/><br/>Colin, un jeune garçon qui idolâtre Link, intervient et explique à Iria les événements de la veille. Quand elle entend ce récit, sa colère disparaît… « Reste prudent et fais attention à toi, d’accord ? Reviens sain et sauf », dit Iria, montrant ainsi ses véritables sentiments à l’égard de Link.<br/><br/>Mais à ce moment-là…<br/><br/>Des monstres chevauchant de gigantesques sangliers font violemment irruption et se ruent sur Link et ses compagnons ! Pris par surprise par cet assaut et désarmé, Link est assommé par l’un des monstres. Quand il revient à lui, il réalise que les monstres ont disparu…<br/><br/>… et qu’ils ont emmené avec eux Colin et Iria…")
            ->setCopiesSold(9800000)
            ->setThumbnail('zelda-tp-5fb59c548293c673486534.jpg')
            ->setBackgroundDesktop('zelda-tp-bkg-5fce919d45875809315104.jpg')
            ->setBackgroundMobile('zelda-tp-bkg-mobile-5fce90323bb8a038171967.jpg')
            ->setBackgroundPosition('center top 20%')
            ->setFirstBlockMinHeight(650)
            ->setAfterBottom(-372)
        ;
        $gameZeldaTp
            ->addConsole($consoleGameCube)
            ->addConsole($consoleWii)
            ->addConsole($consoleWiiU)
        ;
        $gameZeldaTp
            ->addGenre($genreAction)
            ->addGenre($genreAventure)
        ;
        $manager->persist($gameZeldaTp);
        
        $gameZeldaWw = new Game();
        $gameZeldaWw
            ->setName('The Legend of Zelda Wind Waker')
            ->setSlug('the-legend-of-zelda-wind-waker')
            ->setNbPlayers(1)
            ->setReleaseDate((new DateTime())->setDate(2003, 5, 3))
            ->setLicense($licenseZelda)
            ->setDescription("L’histoire de The Wind Waker est étroitement liée à celle de sa plateforme, la GameCube, que Nintendo révèle au monde entier lors de son salon privé, le Nintendo Spaceworld, en 2000. En marge de cette annonce, les journalistes peuvent découvrir une démo technique qui consiste en un duel en temps réel entre Link et Ganondorf. Un an plus tard, au Spaceworld 2001, Nintendo propose en effet la bande-annonce du premier Zelda GameCube, mais dans un style graphique radicalement différent de celui auquel on pouvait s’attendre : le cel-shading rend le jeu semblable à un dessin animé interactif à des années-lumière du look photoréaliste que la démo technique laissait présager. Cette annonce provoque un vrai tollé chez une grande partie des fidèles de la série, déçus par ce changement de cap imprévisible.<br/><br/>À l’E3 2002, pourtant, la démo jouable du jeu qu’on appelle encore « Zelda GameCube » rencontre un franc succès, remportant le prix du salon et amenant de nombreux critiques à revoir leur point de vue sur le parti pris graphique. Fin 2002, le titre japonais du jeu, Kaze no Takuto (le « Bâton du vent ») est révélé, suivi très vite par la traduction occidentale, The Wind Waker. Le jeu sort le 13 décembre au pays du soleil levant et arrive en Europe début mai de l’année suivante, un gros mois après l’Amérique du Nord.<br/><br/>Le titre fait bien sûr référence à la principale mécanique de gameplay du jeu, à savoir l’orientation du vent au moyen d’une baguette de chef d’orchestre, permettant de progresser en voilier sur la Grande Mer, l’univers du jeu. The Wind Waker prend en effet place un bon millénaire après Ocarina of Time : à la suite du retour de Ganondorf, Hyrule a été plongé sous les eaux et n’émergent de l’ancien Royaume qu’une cinquantaine d’îles. Le thème du jeu est donc clairement marin. Bien qu’on lui ait reproché la facilité et le faible nombre de ses donjons ainsi qu’une dernière partie de jeu franchement lourde, The Wind Waker reste un Zelda très apprécié par une partie des fans pour la qualité et l’originalité de son univers et des personnages qui le constituent, mais aussi pour le sentiment de liberté qu’il procure à quiconque navigue sur son vaste océan.")
            ->setHistory("L'histoire fait suite aux événements d’Ocarina of Time. Toutes les figures ici présentées sont donc des incarnations antérieures, différentes de celles d’Ocarina of Time. On raconte que jadis, dans une cité prospère et verdoyante, se produisit un drame: l'arrivée d'un être maléfique, Ganon, qui plongea le monde dans les ténèbres. Le Héros du Temps pu vaincre ce démon et ramena la paix; une statue fut érigée en son honneur. Après sa victoire, l'être maléfique resurgit, mais le héros du Temps ne reparut pas, malgré les prières des habitants. Le roi d'Hyrule remit donc le sort de son royaume aux mains des dieux, qui plongèrent le royaume sous les eaux. Un sceau fut également placé; ce dernier arrêta le temps et fit disparaître la lumière de ce monde, maintenant dénaturé. Les habitants furent sauvés à temps, et rejoignirent le sommet des montagnes, maintenant devenus des îles, tandis que le roi préféra rester dans son Royaume en attendant que quelqu'un vienne arranger la situation. Ganondorf et son armée furent eux aussi scellés sous l'eau.<br/><br/>Des siècles passèrent, et les habitants maintenant installés sur les îles, oublièrent tout du passé. Aujourd'hui l'ancien royaume d'Hyrule laisse place à un vaste océan sur lequel se trouve l’île de l'Aurore, où vit Link, qui vient d'atteindre ses 12 ans. C'est un jour important et il doit revêtir une tunique Verte en l'honneur du Héros du Temps.<br/><br/>L'intrigue commence lorsque Arielle, la sœur de Link, offre sa longue-vue  pour l’anniversaire de son grand frère. Ensuite, Arielle remarque un facteur Piaf effrayé, et Link regarde dans le ciel, où vole un énorme oiseau, avec dans ses griffes une jeune fille. Des pirates attaquent cet oiseau avec des boulets de canon, et l'un d'eux l'atteint, le faisant lâcher prise. La jeune fille tombe dans la forêt. Link va alors voir Orco, un maître épéiste, qui lui offre une épée et lui enseigne les bases de l'escrime. Après cela, il se précipite vers la forêt où quelques ennemis s'opposent à lui. Après que Link les ait battus, la jeune fille, qui répond au nom de Tetra, tombe de l'arbre. Link ainsi que Gonzo le pirate et Tetra quittent la forêt.<br/><br/>Arielle attend son grand frère à l'extérieur, mais se fait kidnapper par l'oiseau géant. Link demande donc à Tetra, qui est la capitaine des pirates, de le laisser s'embarquer sur leur navire pour sauver sa sœur. Elle refuse jusqu'à ce que le facteur Piaf intervienne et lui fasse comprendre qu'elle est en partie responsable et redevable à Link. Elle accepte finalement à condition que Link trouve un bouclier. Il en trouve un dans la maison de sa grand-mère. Fin prêt, Link part armé de courage sachant, qu'il ne reviendra pas avant longtemps. La nuit tombée, le bateau arrive à la forteresse Maudite où sa sœur est emprisonnée. Il s'y fait catapulter, mais perd son épée, qu'il retrouve plus tard. Il entre dans la salle où il retrouve sa sœur captive et s'approche de la cage apparaît alors l'oiseau géant qui l'a capturée. Il emmène Link face un personnage mystérieux, avant de l'envoyer vers le vaste océan. Le jour levé, Link se retrouve sur Mercantîle et fait la connaissance du Lion Rouge, seul bateau au monde parlant le langage des humains. Lion Rouge lui explique que le personnage menaçant qu'il a vu s'appelle Ganondorf, et qu'il est l'être maléfique dont parle la Légende d'Hyrule.")
            ->setCopiesSold(6630000)
            ->setThumbnail('zelda-ww-5fb59cf552b7b475380571.jpg')
            ->setBackgroundDesktop('zelda-ww-bkg-5fce946282fca523643343.jpg')
            ->setBackgroundMobile('zelda-ww-bkg-mobile-5fce946285073299496576.jpg')
            ->setBackgroundPosition('center top 45%')
            ->setFirstBlockMinHeight(600)
            ->setAfterBottom(-347)
        ;
        $gameZeldaWw
            ->addConsole($consoleWiiU)
            ->addConsole($consoleWii)
            ->addConsole($consoleGameCube)
        ;
        $gameZeldaWw
            ->addGenre($genreAction)
            ->addGenre($genreAventure)
        ;
        $manager->persist($gameZeldaWw);
        

        $aGamesItemsData = array(
            array(
                'item' => $itemBanane,
                'game' => $gameDk64,
                'thumbnail' => 'banane-dk-64-5fb59eaf288c0383924680.jpg',
            ),
            array(
                'item' => $itemTonneau,
                'game' => $gameDk64,
                'thumbnail' => 'taunneau-dk64-5fb59f6378da9495975284.jpg',
            ),
            array(
                'item' => $itemBanane,
                'game' => $gameDkCountry,
                'thumbnail' => 'banane-dk-country-5fb59f880c3b0545442403.jpg',
            ),
            array(
                'item' => $itemTonneau,
                'game' => $gameDkCountry,
                'thumbnail' => 'tauneaux-dk-country-5fd1488ab10db500054638.png',
            ),
            array(
                'item' => $itemBanane,
                'game' => $gameDkCountryTropcial,
                'thumbnail' => 'banane-dk-country-tropical-freeze-5fb5a05ee896b912550250.jpg',
            ),
            array(
                'item' => $itemTonneau,
                'game' => $gameDkCountryTropcial,
                'thumbnail' => 'taunneau-dk-country-tf-5fb5a153ed997987106023.jpg',
            ),
            array(
                'item' => $itemBanane,
                'game' => $gameDkCountry2,
                'thumbnail' => 'banane-dk-country-2-5fb5a1a25a5b7105557922.jpg',
            ),
            array(
                'item' => $itemTonneau,
                'game' => $gameDkCountry2,
                'thumbnail' => 'taunneau-dk-country2-5fb5a18d7cc04716667737.jpg',
            ),
            array(
                'item' => $itemMarteau,
                'game' => $gamePaperMario,
                'thumbnail' => 'marto-paper-mario-porte-millenaire-5fb5a2490cc23266241582.png',
            ),
            array(
                'item' => $itemSuperChampi,
                'game' => $gamePaperMario,
                'thumbnail' => 'champi-paper-mario-porte-millenaire-5fb5a254c52fb020678990.jpg',
            ),
            array(
                'item' => $itemFleurFeu,
                'game' => $gamePaperMario,
                'thumbnail' => 'fleur-feu-paper-mario-porte-millenaire-5fd1452e4c7a9350457161.jpg',
            ),
            array(
                'item' => $itemPiece,
                'game' => $gamePaperMario,
                'thumbnail' => 'piece-paper-mario-porte-millenaire-5fb5a6c7c5398832274156.jpg',
            ),
            array(
                'item' => $itemPokeBall,
                'game' => $gamePokemonEmeraude,
                'thumbnail' => 'pokeball-emeraude-5fb5a2ad68f92428714862.jpg',
            ),
            array(
                'item' => $itemPotion,
                'game' => $gamePokemonEmeraude,
                'thumbnail' => 'potion-emeraude-5fb5a29718625756784416.jpg',
            ),
            array(
                'item' => $itemMasterBall,
                'game' => $gamePokemonEmeraude,
                'thumbnail' => 'masterball-emeraude-5fb5a290472b4724532514.jpg',
            ),
            array(
                'item' => $itemRappel,
                'game' => $gamePokemonEmeraude,
                'thumbnail' => 'rappel-emeraude-5fb5a29d95d92808363547.jpg',
            ),
            array(
                'item' => $itemMasterBall,
                'game' => $gamePokemonEpee,
                'thumbnail' => 'masterball-epee-5fb5a38e77953804065910.jpg',
            ),
            array(
                'item' => $itemPokeBall,
                'game' => $gamePokemonEpee,
                'thumbnail' => 'pokeball-epee-5fb5a3841b8c0548910438.jpg',
            ),
            array(
                'item' => $itemPotion,
                'game' => $gamePokemonEpee,
                'thumbnail' => 'potion-epee-5fb5a36df332e707632536.jpg',
            ),
            array(
                'item' => $itemRappel,
                'game' => $gamePokemonEpee,
                'thumbnail' => 'rappel-emeraude-5fb5a374dbbbe533123353.jpg',
            ),
            array(
                'item' => $itemMasterBall,
                'game' => $gamePokemonPlatine,
                'thumbnail' => 'masterball-platine-5fb5a3d24ddcd268615232.jpg',
            ),
            array(
                'item' => $itemPokeBall,
                'game' => $gamePokemonPlatine,
                'thumbnail' => 'pokeball-platine-5fd1458d702cf972130603.jpg',
            ),
            array(
                'item' => $itemPotion,
                'game' => $gamePokemonPlatine,
                'thumbnail' => 'potion-platine-5fb5a3af9bddf243685334.jpg',
            ),
            array(
                'item' => $itemRappel,
                'game' => $gamePokemonPlatine,
                'thumbnail' => 'rappel-emeraude-5fb5a3bce6c87601805605.jpg',
            ),
            array(
                'item' => $itemMasterBall,
                'game' => $gamePokemonRfVf,
                'thumbnail' => 'masterball-rf-vf-5fb5a4cc83027334095445.jpg',
            ),
            array(
                'item' => $itemPokeBall,
                'game' => $gamePokemonRfVf,
                'thumbnail' => 'pokeball-rf-vf-5fb5a4791ce0e855316542.jpg',
            ),
            array(
                'item' => $itemPotion,
                'game' => $gamePokemonRfVf,
                'thumbnail' => 'potion-emeraude-5fb5a481087e2248967796.jpg',
            ),
            array(
                'item' => $itemRappel,
                'game' => $gamePokemonRfVf,
                'thumbnail' => 'rappel-emeraude-5fb5a48d9ff78088491664.jpg',
            ),
            array(
                'item' => $itemMasterBall,
                'game' => $gamePokemonSoleil,
                'thumbnail' => 'masterball-sl-5fb5a4ee3550b551129723.jpg',
            ),
            array(
                'item' => $itemPokeBall,
                'game' => $gamePokemonSoleil,
                'thumbnail' => 'pokeball-sl-5fb5a51c0cb33031405816.jpg',
            ),
            array(
                'item' => $itemPotion,
                'game' => $gamePokemonSoleil,
                'thumbnail' => 'potion-epee-5fb5a4f6bacff907398236.jpg',
            ),
            array(
                'item' => $itemRappel,
                'game' => $gamePokemonSoleil,
                'thumbnail' => 'rappel-emeraude-5fb5a4ff70e32940798096.jpg',
            ),
            array(
                'item' => $item1up,
                'game' => $gameMario64,
                'thumbnail' => '1up-mario-64-5fb5a66a8fbed916204677.jpg',
            ),
            array(
                'item' => $itemPiece,
                'game' => $gameMario64,
                'thumbnail' => 'piece-mario-64-5fb5a5eb0d0e0714238509.jpg',
            ),
            array(
                'item' => $itemSuperEtoile,
                'game' => $gameMario64,
                'thumbnail' => 'etoile-mario-64-5fb5a5d743c49764969001.jpg',
            ),
            array(
                'item' => $itemSuperEtoile,
                'game' => $gameMarioBros3,
                'thumbnail' => 'etoile-mario-bros-3-5fd14b5d9805d665363198.jpg',
            ),
            array(
                'item' => $itemPiece,
                'game' => $gameMarioBros3,
                'thumbnail' => 'piece-mario-bros-3-5fb5a69360980919335598.jpg',
            ),
            array(
                'item' => $item1up,
                'game' => $gameMarioBros3,
                'thumbnail' => '1up-mario-bros-3-5fb5a6583b851243256089.jpg',
            ),
            array(
                'item' => $itemFleurFeu,
                'game' => $gameMarioBros3,
                'thumbnail' => 'fleur-feu-mario-bros-3-5fb5a632a573d803021515.jpg',
            ),
            array(
                'item' => $itemSuperChampi,
                'game' => $gameMarioBros3,
                'thumbnail' => 'champi-mario-bros-3-5fb5a6418e47a766675986.jpg',
            ),
            array(
                'item' => $itemSuperEtoile,
                'game' => $gameMarioGalaxy,
                'thumbnail' => 'etoile-mario-galaxy-5fb5a7ccd1968845599896.jpg',
            ),
            array(
                'item' => $itemPiece,
                'game' => $gameMarioGalaxy,
                'thumbnail' => 'piece-mario-galaxy-5fb5a7d7d3179142979189.jpg',
            ),
            array(
                'item' => $item1up,
                'game' => $gameMarioGalaxy,
                'thumbnail' => '1up-mario-galaxy-5fb5a80fb5bbb603198524.jpg',
            ),
            array(
                'item' => $itemFleurFeu,
                'game' => $gameMarioGalaxy,
                'thumbnail' => 'fleur-feu-mario-galaxy-5fb5a7eaedb38690146093.jpg',
            ),
            array(
                'item' => $itemSuperEtoile,
                'game' => $gameMarioOdyssey,
                'thumbnail' => 'etoile-mario-odyssey-5fb5a8598a999901704834.jpg',
            ),
            array(
                'item' => $itemPiece,
                'game' => $gameMarioOdyssey,
                'thumbnail' => 'piece-mario-odyssey-5fb5a8683273b460884340.jpg',
            ),
            array(
                'item' => $itemMarteau,
                'game' => $gameSmashBros,
                'thumbnail' => 'marto-sb64-5fd14ea5e601c960643554.jpg',
            ),
            array(
                'item' => $itemPokeBall,
                'game' => $gameSmashBros,
                'thumbnail' => 'pokeball-ssb64-5fd154ac706ac848165043.jpg',
            ),
            array(
                'item' => $itemBalleSmash,
                'game' => $gameSmashBros4,
                'thumbnail' => 'balle-smash-sswiiu-5fb5aa648667a414356840.jpg',
            ),
            array(
                'item' => $itemBanane,
                'game' => $gameSmashBros4,
                'thumbnail' => 'banane-ssbwiiu-5fb5aa6fbe488717710313.jpg',
            ),
            array(
                'item' => $itemMarteau,
                'game' => $gameSmashBros4,
                'thumbnail' => 'marto-sbwiiu-5fd14edac2f84342883612.jpg',
            ),
            array(
                'item' => $itemNoixMojo,
                'game' => $gameSmashBros4,
                'thumbnail' => 'noi-mojo-ssbwiiu-5fb5aa9d6aa83956851379.jpg',
            ),
            array(
                'item' => $itemReceptaclesCoeur,
                'game' => $gameSmashBros4,
                'thumbnail' => 'receptacle-coeur-ssbwiiu-5fb5aaaa3ec3f462472961.jpg',
            ),
            array(
                'item' => $itemTonneau,
                'game' => $gameSmashBros4,
                'thumbnail' => 'taunneau-ssbwiiu-5fb5aab5ec41e783977452.jpg',
            ),
            array(
                'item' => $itemSuperChampi,
                'game' => $gameSmashBros4,
                'thumbnail' => 'champi-ssbb-5fd1448dcd3aa498801597.jpg',
            ),
            array(
                'item' => $itemTropheAide,
                'game' => $gameSmashBros4,
                'thumbnail' => 'trophee-aide-ssbwiiu-5fb5aac31efdc650572971.jpg',
            ),
            array(
                'item' => $itemPokeBall,
                'game' => $gameSmashBros4,
                'thumbnail' => 'pokeball-ssb4-5fd153de69fbd375070264.jpg',
            ),
            array(
                'item' => $itemFleurFeu,
                'game' => $gameSmashBros4,
                'thumbnail' => 'fleur-feu-ssb4-5fd15706d4775057092149.jpg',
            ),
            array(
                'item' => $itemBalleSmash,
                'game' => $gameSmashBrosBrawl,
                'thumbnail' => 'balle-smash-ssbb-5fb5acc07b7b2675605514.jpg',
            ),
            array(
                'item' => $itemBanane,
                'game' => $gameSmashBrosBrawl,
                'thumbnail' => 'banane-ssbb-5fb5ad7b933a0569406909.jpg',
            ),
            array(
                'item' => $itemMarteau,
                'game' => $gameSmashBrosBrawl,
                'thumbnail' => 'marto-ssbb-5fd14ed5c3971810321917.jpg',
            ),
            array(
                'item' => $itemNoixMojo,
                'game' => $gameSmashBrosBrawl,
                'thumbnail' => 'noi-mojo-ssbb-5fb5ad9226d54460339854.jpg',
            ),
            array(
                'item' => $itemReceptaclesCoeur,
                'game' => $gameSmashBrosBrawl,
                'thumbnail' => 'receptacle-coeur-ssbb-5fb5ab3b0d2d3375370871.jpg',
            ),
            array(
                'item' => $itemTonneau,
                'game' => $gameSmashBrosBrawl,
                'thumbnail' => 'taunneau-ssbb-5fb5ab4a58278727785776.jpg',
            ),
            array(
                'item' => $itemSuperChampi,
                'game' => $gameSmashBrosBrawl,
                'thumbnail' => 'champi-ssbu-5fd144c7c0171093143923.jpg',
            ),
            array(
                'item' => $itemTropheAide,
                'game' => $gameSmashBrosBrawl,
                'thumbnail' => 'trophee-aide-ssbb-5fb5ab53e7927171330956.jpg',
            ),
            array(
                'item' => $itemPokeBall,
                'game' => $gameSmashBrosBrawl,
                'thumbnail' => 'pokeball-ssbb-5fd153d076eec212557381.jpg',
            ),
            array(
                'item' => $itemBanane,
                'game' => $gameSmashBrosMelee,
                'thumbnail' => 'banane-bbsmelle-5fb5ac70b4fac531269037.jpg',
            ),
            array(
                'item' => $itemMarteau,
                'game' => $gameSmashBrosMelee,
                'thumbnail' => 'marto-ssbm-5fd14eb64c4a4836407786.jpg',
            ),
            array(
                'item' => $itemReceptaclesCoeur,
                'game' => $gameSmashBrosMelee,
                'thumbnail' => 'receptacle-coeur-ssbm-5fb5ac87e7d1c623761602.jpg',
            ),
            array(
                'item' => $itemPokeBall,
                'game' => $gameSmashBrosMelee,
                'thumbnail' => 'pokeball-ssbm-5fd15409d1521304164553.jpg',
            ),
            array(
                'item' => $itemFleurFeu,
                'game' => $gameSmashBrosMelee,
                'thumbnail' => 'fleur-feu-ssbm-5fd144a4c5ea3214736258.jpg',
            ),
            array(
                'item' => $itemBalleSmash,
                'game' => $gameSmashBrosUltimate,
                'thumbnail' => 'balle-smash-ssu-5fb5acfec2951377324651.jpg',
            ),
            array(
                'item' => $itemBanane,
                'game' => $gameSmashBrosUltimate,
                'thumbnail' => 'banane-ssbu-5fb5ad06c3f3a468364475.jpg',
            ),
            array(
                'item' => $itemMarteau,
                'game' => $gameSmashBrosUltimate,
                'thumbnail' => 'marto-ssbu-5fd14ec1f07e1360016712.jpg',
            ),
            array(
                'item' => $itemNoixMojo,
                'game' => $gameSmashBrosUltimate,
                'thumbnail' => 'noix-mojo-ssbu-5fd147cf75b63455933254.jpg',
            ),
            array(
                'item' => $itemReceptaclesCoeur,
                'game' => $gameSmashBrosUltimate,
                'thumbnail' => 'receptacle-coeur-ssbu-5fb5ad3c11816734205667.jpg',
            ),
            array(
                'item' => $itemTonneau,
                'game' => $gameSmashBrosUltimate,
                'thumbnail' => 'taunneau-ssbu-5fb5ad497d65d454062315.jpg',
            ),
            array(
                'item' => $itemSuperChampi,
                'game' => $gameSmashBrosUltimate,
                'thumbnail' => 'champi-ssbu-5fd147c6302a2933841299.jpg',
            ),
            array(
                'item' => $itemTropheAide,
                'game' => $gameSmashBrosUltimate,
                'thumbnail' => 'trophee-aide-ssbu-5fb5ad5428688059266232.jpg',
            ),
            array(
                'item' => $itemPokeBall,
                'game' => $gameSmashBrosUltimate,
                'thumbnail' => 'pokeball-ssbu-5fd153c5672d6093027790.jpg',
            ),
            array(
                'item' => $itemFleurFeu,
                'game' => $gameSmashBrosUltimate,
                'thumbnail' => 'fleur-feu-ssbu-5fd156f7c5c28276442099.jpg',
            ),
            array(
                'item' => $itemArc,
                'game' => $gameZeldaBotw,
                'thumbnail' => 'arc-botw-5fb5ae8ae1d33418248544.jpg',
            ),
            array(
                'item' => $itemBombe,
                'game' => $gameZeldaBotw,
                'thumbnail' => 'bombe-botw-5fb5ae9238082051238548.jpg',
            ),
            array(
                'item' => $itemBouclierHylien,
                'game' => $gameZeldaBotw,
                'thumbnail' => 'bouclier-hylien-botw-5fb5ae97e5b5b101806322.jpg',
            ),
            array(
                'item' => $itemMasterSword,
                'game' => $gameZeldaBotw,
                'thumbnail' => 'master-sword-botw-5fb5aea1bd124147182678.jpg',
            ),
            array(
                'item' => $itemReceptaclesCoeur,
                'game' => $gameZeldaBotw,
                'thumbnail' => 'receptacle-coeur-botw-5fb5aeacc6b89959257827.jpg',
            ),
            array(
                'item' => $itemArc,
                'game' => $gameZeldaMajora,
                'thumbnail' => 'arc-mm-5fb5aec49b71a914217416.jpg',
            ),
            array(
                'item' => $itemBombe,
                'game' => $gameZeldaMajora,
                'thumbnail' => 'bombe-mm-5fb5aecc8c5ac540507493.jpg',
            ),
            array(
                'item' => $itemReceptaclesCoeur,
                'game' => $gameZeldaMajora,
                'thumbnail' => 'receptacle-coeur-mm-5fb5aedc6b0f4238961251.jpg',
            ),
            array(
                'item' => $itemOcarina,
                'game' => $gameZeldaMajora,
                'thumbnail' => 'ocarina-mm-5fb5af3a4429c786095307.jpg',
            ),
            array(
                'item' => $itemNoixMojo,
                'game' => $gameZeldaMajora,
                'thumbnail' => 'noi-mojo-oot-5fb5b09c13819519941854.jpg',
            ),
            array(
                'item' => $itemArc,
                'game' => $gameZeldaOcarina,
                'thumbnail' => 'arc-oot-5fb5af66c33b4216115092.jpg',
            ),
            array(
                'item' => $itemBombe,
                'game' => $gameZeldaOcarina,
                'thumbnail' => 'bombe-oot-5fb5af6dc1627474240795.jpg',
            ),
            array(
                'item' => $itemBouclierHylien,
                'game' => $gameZeldaOcarina,
                'thumbnail' => 'bouclier-hylien-oot-5fb5af7475536631850910.jpg',
            ),
            array(
                'item' => $itemMasterSword,
                'game' => $gameZeldaOcarina,
                'thumbnail' => 'master-sword-ott-5fb5af805f57f357404762.jpg',
            ),
            array(
                'item' => $itemReceptaclesCoeur,
                'game' => $gameZeldaOcarina,
                'thumbnail' => 'receptacle-coeur-oot-5fb5af9c11e14988443940.jpg',
            ),
            array(
                'item' => $itemOcarina,
                'game' => $gameZeldaOcarina,
                'thumbnail' => 'ocarina-oot-5fb5af8d88e4d444559659.jpg',
            ),
            array(
                'item' => $itemNoixMojo,
                'game' => $gameZeldaOcarina,
                'thumbnail' => 'noi-mojo-oot-5fb5b07fe969a629547696.jpg',
            ),
            array(
                'item' => $itemTriforce,
                'game' => $gameZeldaOcarina,
                'thumbnail' => 'triforce-ott-5fb5afa7b3e88141575153.jpg',
            ),
            array(
                'item' => $itemArc,
                'game' => $gameZeldaTp,
                'thumbnail' => 'arc-tp-5fb5b02b8bf7d910574956.jpg',
            ),
            array(
                'item' => $itemBombe,
                'game' => $gameZeldaTp,
                'thumbnail' => 'bombe-tp-5fb5b035aaa2c445694788.jpg',
            ),
            array(
                'item' => $itemBouclierHylien,
                'game' => $gameZeldaTp,
                'thumbnail' => 'bouclier-hylien-tp-5fb5b03ee1b25279617911.jpg',
            ),
            array(
                'item' => $itemMasterSword,
                'game' => $gameZeldaTp,
                'thumbnail' => 'master-sword-tp-5fb5b0489bbf2511904912.jpg',
            ),
            array(
                'item' => $itemReceptaclesCoeur,
                'game' => $gameZeldaTp,
                'thumbnail' => 'receptacle-coeur-tp-5fb5b05f0124d950290753.jpg',
            ),
            array(
                'item' => $itemTriforce,
                'game' => $gameZeldaTp,
                'thumbnail' => 'triforce-tp-5fb5b0690e169291244011.jpg',
            ),
            array(
                'item' => $itemArc,
                'game' => $gameZeldaWw,
                'thumbnail' => 'arc-ww-5fb5b0ccb47cd078812877.jpg',
            ),
            array(
                'item' => $itemBombe,
                'game' => $gameZeldaWw,
                'thumbnail' => 'bombe-ww-5fb5b0d9026a4839522981.jpg',
            ),
            array(
                'item' => $itemMasterSword,
                'game' => $gameZeldaWw,
                'thumbnail' => 'master-sword-ww-5fb5b0e2657eb246453425.png',
            ),
            array(
                'item' => $itemReceptaclesCoeur,
                'game' => $gameZeldaWw,
                'thumbnail' => 'receptacle-coeur-ww-5fb5b10548df2780772926.jpg',
            ),
            array(
                'item' => $itemTriforce,
                'game' => $gameZeldaWw,
                'thumbnail' => 'triforce-ww-5fb5b10fa2c3d247448265.jpg',
            ),
        );

        foreach($aGamesItemsData as $aData){
            $gameItem = new GameItem();
            $gameItem
                ->setGame($aData['game'])
                ->setItem($aData['item'])
                ->setThumbnail($aData['thumbnail'])
            ;
            $manager->persist($gameItem);
        }

        

        /**
         * GameCharacter
         */
        $aGamesCharactersData = array(
            array(
                'character' => $characterDonkeyKong,
                'game' => $gameDk64,
                'thumbnail' => 'dk-dk-64-5fb59d59b96db363995888.jpg',
            ),
            array(
                'character' => $characterDiddyKong,
                'game' => $gameDk64,
                'thumbnail' => 'diddy-kong-dk-64-5fb59d480b1fd012747908.jpg',
            ),
            array(
                'character' => $characterCrankyKong,
                'game' => $gameDk64,
                'thumbnail' => 'kranky-kong-dk-64-5fb59d7753556385014810.jpg',
            ),
            array(
                'character' => $characterKingKRool,
                'game' => $gameDk64,
                'thumbnail' => 'king-k-rool-dk-64-5fb59d8d425d1687857812.jpg',
            ),
            array(
                'character' => $characterDonkeyKong,
                'game' => $gameDkCountry,
                'thumbnail' => 'dk-dk-country-5fb59fc2a43fb043600312.png',
            ),
            array(
                'character' => $characterDiddyKong,
                'game' => $gameDkCountry,
                'thumbnail' => 'diddy-kong-dk-country-5fb59fac07843441835527.jpg',
            ),
            array(
                'character' => $characterCrankyKong,
                'game' => $gameDkCountry,
                'thumbnail' => 'kranky-kong-dk-country-5fb59fd56314c817661437.jpg',
            ),
            array(
                'character' => $characterKingKRool,
                'game' => $gameDkCountry,
                'thumbnail' => 'king-k-rool-dk-country-5fb59fde2327f609076602.jpg',
            ),
            array(
                'character' => $characterDonkeyKong,
                'game' => $gameDkCountryTropcial,
                'thumbnail' => 'dk-dk-tropical-frezze-5fb5a0131b875084084227.jpg',
            ),
            array(
                'character' => $characterDiddyKong,
                'game' => $gameDkCountryTropcial,
                'thumbnail' => 'diddy-kong-dk-tropical-frezze-5fd14b21ba377553158390.jpg',
            ),
            array(
                'character' => $characterCrankyKong,
                'game' => $gameDkCountryTropcial,
                'thumbnail' => 'kranky-kong-dk-tropical-frezze-5fb5a04a9290b694162582.jpg',
            ),
            array(
                'character' => $characterDixieKong,
                'game' => $gameDkCountryTropcial,
                'thumbnail' => 'dixie-kong-dk-tropical-frezze-5fb5a01ac582a128143900.jpg',
            ),
            array(
                'character' => $characterDonkeyKong,
                'game' => $gameDkCountry2,
                'thumbnail' => 'dk-dk-country-2-5fb5a1da30b60773485335.jpg',
            ),
            array(
                'character' => $characterDiddyKong,
                'game' => $gameDkCountry2,
                'thumbnail' => 'diddy-kong-dk-countr-2-5fd149c19e58f487140151.jpg',
            ),
            array(
                'character' => $characterCrankyKong,
                'game' => $gameDkCountry2,
                'thumbnail' => 'kranky-kong-dk-country-2-5fb5a1e954377181779504.jpg',
            ),
            array(
                'character' => $characterKingKRool,
                'game' => $gameDkCountry2,
                'thumbnail' => 'king-k-rool-dk-country-2-5fb5a1f386e86535799150.jpg',
            ),
            array(
                'character' => $characterDixieKong,
                'game' => $gameDkCountry2,
                'thumbnail' => 'dixie-kong-dk-countr-2-5fb5a1ce51b46907164042.jpg',
            ),
            array(
                'character' => $characterBowser,
                'game' => $gamePaperMario,
                'thumbnail' => 'bowser-paper-mario-porte-millenaire-5fb5a208cd9ae082113268.jpg',
            ),
            array(
                'character' => $characterLuigi,
                'game' => $gamePaperMario,
                'thumbnail' => 'luigi-paper-mario-porte-millenaire-5fb5a233462f7780876663.png',
            ),
            array(
                'character' => $characterMario,
                'game' => $gamePaperMario,
                'thumbnail' => 'mario-paper-mario-porte-millenaire-5fb5a21d01761478028456.jpg',
            ),
            array(
                'character' => $characterPeach,
                'game' => $gamePaperMario,
                'thumbnail' => 'peach-paper-mario-porte-millenaire-5fb5a225eb0c7069815871.png',
            ),
            array(
                'character' => $characterYoshi,
                'game' => $gamePaperMario,
                'thumbnail' => 'yoshi-paper-mario-porte-millenaire-5fb5a78d7afc7162438513.jpg',
            ),
            array(
                'character' => $characterEvolie,
                'game' => $gamePokemonEmeraude,
                'thumbnail' => 'evolie-emeraude-5fb5a2de6e8e6912437465.jpg',
            ),
            array(
                'character' => $characterPikachu,
                'game' => $gamePokemonEmeraude,
                'thumbnail' => 'pikachu-emeraude-5fb5a3064bc34044127517.jpg',
            ),
            array(
                'character' => $characterDracaufeu,
                'game' => $gamePokemonEpee,
                'thumbnail' => 'dracaufeu-epee-5fb5a349b1a3d852257961.jpg',
            ),
            array(
                'character' => $characterEvolie,
                'game' => $gamePokemonEpee,
                'thumbnail' => 'evolie-epee-5fb5a35157b8a440145764.jpg',
            ),
            array(
                'character' => $characterPikachu,
                'game' => $gamePokemonEpee,
                'thumbnail' => 'pikachu-epee-5fb5a35e53545992783523.jpg',
            ),
            array(
                'character' => $characterEvolie,
                'game' => $gamePokemonPlatine,
                'thumbnail' => 'evolie-platine-5fb5a3fae78ad731138903.jpg',
            ),
            array(
                'character' => $characterPikachu,
                'game' => $gamePokemonPlatine,
                'thumbnail' => 'pikachu-platine-5fb5a40c062e0550605045.jpg',
            ),
            array(
                'character' => $characterDracaufeu,
                'game' => $gamePokemonRfVf,
                'thumbnail' => 'dracaufeu-rf-vr-5fb5a42c96d5b717342903.jpg',
            ),
            array(
                'character' => $characterEvolie,
                'game' => $gamePokemonRfVf,
                'thumbnail' => 'evolie-vf-rf-5fb5a43900091403690473.jpg',
            ),
            array(
                'character' => $characterPikachu,
                'game' => $gamePokemonRfVf,
                'thumbnail' => 'pikachu-rf-vf-5fb5a447be563357530351.jpg',
            ),
            array(
                'character' => $characterProfChen,
                'game' => $gamePokemonRfVf,
                'thumbnail' => 'prof-chen-rf-vf-5fd1468ed454a504041653.jpg',
            ),
            array(
                'character' => $characterRed,
                'game' => $gamePokemonRfVf,
                'thumbnail' => 'red-pokemon-rf-vr-5fb5a45f43008870470097.png',
            ),
            array(
                'character' => $characterDracaufeu,
                'game' => $gamePokemonSoleil,
                'thumbnail' => 'dracaufeu-sl-5fb5a53e6d992479243166.jpg',
            ),
            array(
                'character' => $characterEvolie,
                'game' => $gamePokemonSoleil,
                'thumbnail' => 'evolie-sl-5fb5a54827f84475361857.jpg',
            ),
            array(
                'character' => $characterPikachu,
                'game' => $gamePokemonSoleil,
                'thumbnail' => 'pikachu-soleil-lube-5fb5a56463380440100647.jpg',
            ),
            array(
                'character' => $characterRed,
                'game' => $gamePokemonSoleil,
                'thumbnail' => 'red-pokemon-sl-5fb5a56d4c469493123677.jpg',
            ),
            array(
                'character' => $characterMario,
                'game' => $gameMario64,
                'thumbnail' => 'mario-mario-64-5fb5a58ce68ad618518209.jpg',
            ),
            array(
                'character' => $characterPeach,
                'game' => $gameMario64,
                'thumbnail' => 'peach-mario-64-5fb5a59732d3b923535912.png',
            ),
            array(
                'character' => $characterBowser,
                'game' => $gameMario64,
                'thumbnail' => 'bowser-mario-64-5fb5a59e4dd36044706488.jpg',
            ),
            array(
                'character' => $characterYoshi,
                'game' => $gameMario64,
                'thumbnail' => 'yoshi-mario-64-5fb5a5bf70e28848775180.png',
            ),
            array(
                'character' => $characterMario,
                'game' => $gameMarioBros3,
                'thumbnail' => 'mario-mario-bros-3-5fb5a7113aa8a391413814.png',
            ),
            array(
                'character' => $characterPeach,
                'game' => $gameMarioBros3,
                'thumbnail' => 'peach-mario-bros-3-5fb5a7222e288184862264.png',
            ),
            array(
                'character' => $characterBowser,
                'game' => $gameMarioBros3,
                'thumbnail' => 'bowser-mario-bros-3-5fb5a6f896523231668646.jpg',
            ),
            array(
                'character' => $characterLuigi,
                'game' => $gameMarioBros3,
                'thumbnail' => 'luigi-mario-bros-3-5fb5a7387658d104687064.png',
            ),
            array(
                'character' => $characterMario,
                'game' => $gameMarioGalaxy,
                'thumbnail' => 'mario-mario-galaxy-5fb5a75cbe7ef323646840.jpg',
            ),
            array(
                'character' => $characterPeach,
                'game' => $gameMarioGalaxy,
                'thumbnail' => 'peach-mario-galaxy-5fb5a77b2849a881565254.png',
            ),
            array(
                'character' => $characterBowser,
                'game' => $gameMarioGalaxy,
                'thumbnail' => 'bowser-mario-galaxy-5fb5a74de75fc411517702.jpg',
            ),
            array(
                'character' => $characterHarmonie,
                'game' => $gameMarioGalaxy,
                'thumbnail' => 'harmonie-mario-galaxy-5fb5a8d9e0d40270622464.jpg',
            ),
            array(
                'character' => $characterLuigi,
                'game' => $gameMarioGalaxy,
                'thumbnail' => 'luigi-mario-galaxy-5fb5a764c3b6b171521458.png',
            ),
            array(
                'character' => $characterMario,
                'game' => $gameMarioOdyssey,
                'thumbnail' => 'mario-mario-odyssey-5fb5a8982c6c0451717842.jpg',
            ),
            array(
                'character' => $characterPeach,
                'game' => $gameMarioOdyssey,
                'thumbnail' => 'peach-mario-odyssey-5fb5a8b3f1d88787266595.png',
            ),
            array(
                'character' => $characterBowser,
                'game' => $gameMarioOdyssey,
                'thumbnail' => 'bowser-mario-odyssey-5fb5a8842d8cf223440127.jpg',
            ),
            array(
                'character' => $characterYoshi,
                'game' => $gameMarioOdyssey,
                'thumbnail' => 'yoshi-mario-odyssey-5fb5a8ab3d95b168981984.png',
            ),
            array(
                'character' => $characterLuigi,
                'game' => $gameMarioOdyssey,
                'thumbnail' => 'luigi-mario-odyssey-5fb5a89eded3c542609574.png',
            ),
            array(
                'character' => $characterPikachu,
                'game' => $gameSmashBros,
                'thumbnail' => 'pikachu-smash-bros-5fb5aa498ab19264074891.jpg',
            ),
            array(
                'character' => $characterDonkeyKong,
                'game' => $gameSmashBros,
                'thumbnail' => 'dk-smash-bros-64-5fb5a90a88f95286888815.jpg',
            ),
            array(
                'character' => $characterLink,
                'game' => $gameSmashBros,
                'thumbnail' => 'link-smash-bros-5fb5a914d370e166361837.jpg',
            ),
            array(
                'character' => $characterMario,
                'game' => $gameSmashBros,
                'thumbnail' => 'mario-mario-smash-bros-5fb5a931c56a8960997050.jpg',
            ),
            array(
                'character' => $characterDiddyKong,
                'game' => $gameSmashBros4,
                'thumbnail' => 'diddy-kong-smash-bros-wiiu-5fb5a989e6abd374450968.jpg',
            ),
            array(
                'character' => $characterBowser,
                'game' => $gameSmashBros4,
                'thumbnail' => 'bowser-smash-bros-wiiu-5fb5a9916d23a331373582.jpg',
            ),
            array(
                'character' => $characterDonkeyKong,
                'game' => $gameSmashBros4,
                'thumbnail' => 'dk-smash-bros-wiiu-5fb5a99c51309170612814.jpg',
            ),
            array(
                'character' => $characterGanondorf,
                'game' => $gameSmashBros4,
                'thumbnail' => 'ganondorf-smash-bros-wiiu-5fb5a9b218dbe057986230.jpg',
            ),
            array(
                'character' => $characterDracaufeu,
                'game' => $gameSmashBros4,
                'thumbnail' => 'dracaufeu-smash-bros-wiiu-5fb5a9a665403470524134.jpg',
            ),
            array(
                'character' => $characterHarmonie,
                'game' => $gameSmashBros4,
                'thumbnail' => 'harmonie-super-smash-bros-wiiu-5fb5a9bb8c5ca781135029.jpg',
            ),
            array(
                'character' => $characterLink,
                'game' => $gameSmashBros4,
                'thumbnail' => 'link-smash-bros-wiiu-5fb5a9cc0d24b348154811.jpg',
            ),
            array(
                'character' => $characterLuigi,
                'game' => $gameSmashBros4,
                'thumbnail' => 'luigi-smash-bros-wiiu-5fb5a9d6bd4ef686601438.jpg',
            ),
            array(
                'character' => $characterMario,
                'game' => $gameSmashBros4,
                'thumbnail' => 'mario-mario-smash-bros-wiiu-5fb5a9e14369d623806621.jpg',
            ),
            array(
                'character' => $characterPikachu,
                'game' => $gameSmashBros4,
                'thumbnail' => 'pikachu-smash-bros-wiiu-5fb5a9ed12c64902466725.jpg',
            ),
            array(
                'character' => $characterPeach,
                'game' => $gameSmashBros4,
                'thumbnail' => 'peach-smash-bros-wii-u-5fb5a9fecd849855796825.png',
            ),
            array(
                'character' => $characterYoshi,
                'game' => $gameSmashBros4,
                'thumbnail' => 'yoshi-smash-bros-wiiu-5fb5aa29a0e07869186720.jpg',
            ),
            array(
                'character' => $characterZelda,
                'game' => $gameSmashBros4,
                'thumbnail' => 'zelda-smash-bros-wiiu-5fb5aa34eff4c362269237.jpg',
            ),
            array(
                'character' => $characterDiddyKong,
                'game' => $gameSmashBrosBrawl,
                'thumbnail' => 'diddy-kong-smash-bros-brawl-5fb5ab748aad5653755755.jpg',
            ),
            array(
                'character' => $characterBowser,
                'game' => $gameSmashBrosBrawl,
                'thumbnail' => 'bowser-smash-bros-brawl-5fb5ab6d2adb2557162385.jpg',
            ),
            array(
                'character' => $characterDonkeyKong,
                'game' => $gameSmashBrosBrawl,
                'thumbnail' => 'dk-smash-bros-brawl-5fb5ab7e4f55c992253977.jpg',
            ),
            array(
                'character' => $characterGanondorf,
                'game' => $gameSmashBrosBrawl,
                'thumbnail' => 'ganondorf-smash-bros-brawl-5fb5ab96458d6209669516.jpg',
            ),
            array(
                'character' => $characterDracaufeu,
                'game' => $gameSmashBrosBrawl,
                'thumbnail' => 'dracaufeu-smash-bros-brawl-5fb5ab88b3cf0929356055.jpg',
            ),
            array(
                'character' => $characterLink,
                'game' => $gameSmashBrosBrawl,
                'thumbnail' => 'link-smash-bros-brawl-5fb5aba4cdd29105050245.jpg',
            ),
            array(
                'character' => $characterLuigi,
                'game' => $gameSmashBrosBrawl,
                'thumbnail' => 'luigi-smash-bros-brawl-5fb5abb280527373589572.jpg',
            ),
            array(
                'character' => $characterMario,
                'game' => $gameSmashBrosBrawl,
                'thumbnail' => 'mario-mario-smash-bros-brawl-5fb5abb99ed12472464905.jpg',
            ),
            array(
                'character' => $characterPikachu,
                'game' => $gameSmashBrosBrawl,
                'thumbnail' => 'pikachu-smash-bros-brawl-5fb5abd052ba7477033989.jpg',
            ),
            array(
                'character' => $characterPeach,
                'game' => $gameSmashBrosBrawl,
                'thumbnail' => 'peach-smash-bros-brawl-5fb5abc2199bd656076130.png',
            ),
            array(
                'character' => $characterYoshi,
                'game' => $gameSmashBrosBrawl,
                'thumbnail' => 'yoshi-smash-bros-brawl-5fb5abdc4a4de180046329.jpg',
            ),
            array(
                'character' => $characterZelda,
                'game' => $gameSmashBrosBrawl,
                'thumbnail' => 'zelda-smash-bros-brawl-5fb5abe65f873928563713.jpg',
            ),
            array(
                'character' => $characterBowser,
                'game' => $gameSmashBrosMelee,
                'thumbnail' => 'bowser-smash-bros-melee-5fb5abfbe5b15373780602.jpg',
            ),
            array(
                'character' => $characterDonkeyKong,
                'game' => $gameSmashBrosMelee,
                'thumbnail' => 'dk-smash-bros-melee-5fb5ac0bc1c84463635983.jpg',
            ),
            array(
                'character' => $characterGanondorf,
                'game' => $gameSmashBrosMelee,
                'thumbnail' => 'ganondorf-smash-bros-melee-5fb5ac17dacc8180939879.jpg',
            ),
            array(
                'character' => $characterLink,
                'game' => $gameSmashBrosMelee,
                'thumbnail' => 'link-smash-bros-melee-5fb5ac23134cb500567447.jpg',
            ),
            array(
                'character' => $characterLuigi,
                'game' => $gameSmashBrosMelee,
                'thumbnail' => 'luigi-smash-bros-melee-5fb5ac2f44c9f691688018.png',
            ),
            array(
                'character' => $characterMario,
                'game' => $gameSmashBrosMelee,
                'thumbnail' => 'mario-mario-smash-bros-melee-5fb5ac37eb60a719605473.jpg',
            ),
            array(
                'character' => $characterPikachu,
                'game' => $gameSmashBrosMelee,
                'thumbnail' => 'pikachu-smash-bros-melee-5fb5ac4bc6085214219773.jpg',
            ),
            array(
                'character' => $characterPeach,
                'game' => $gameSmashBrosMelee,
                'thumbnail' => 'peach-smash-bros-melle-5fb5ac4292d38457961639.png',
            ),
            array(
                'character' => $characterYoshi,
                'game' => $gameSmashBrosMelee,
                'thumbnail' => 'yoshi-smash-bros-melee-5fb5ac5ce9193483675116.jpg',
            ),
            array(
                'character' => $characterZelda,
                'game' => $gameSmashBrosMelee,
                'thumbnail' => 'zelda-smash-bros-melee-5fb5ac556985c993971233.jpg',
            ),
            array(
                'character' => $characterDiddyKong,
                'game' => $gameSmashBrosUltimate,
                'thumbnail' => 'diddy-kong-smash-bros-ultimate-5fb5adb039ef4783212201.jpg',
            ),
            array(
                'character' => $characterBowser,
                'game' => $gameSmashBrosUltimate,
                'thumbnail' => 'bowser-smash-bros-ultimate-5fb5ada88a695228248384.jpg',
            ),
            array(
                'character' => $characterDonkeyKong,
                'game' => $gameSmashBrosUltimate,
                'thumbnail' => 'dk-smash-bros-ultimate-5fb5adb7e13a0633551932.jpg',
            ),
            array(
                'character' => $characterGanondorf,
                'game' => $gameSmashBrosUltimate,
                'thumbnail' => 'ganondorf-smash-bros-ultimate-5fb5adc8caed0542834641.jpg',
            ),
            array(
                'character' => $characterDracaufeu,
                'game' => $gameSmashBrosUltimate,
                'thumbnail' => 'dracaufeu-smash-bros-ultimate-5fb5adbf475a4199467669.jpg',
            ),
            array(
                'character' => $characterHarmonie,
                'game' => $gameSmashBrosUltimate,
                'thumbnail' => 'harmonie-super-smash-bros-ultimate-5fb5add4e6f43193806368.jpg',
            ),
            array(
                'character' => $characterLink,
                'game' => $gameSmashBrosUltimate,
                'thumbnail' => 'link-smash-bros-ultimate-5fb5adeb04a6d775258331.jpg',
            ),
            array(
                'character' => $characterLuigi,
                'game' => $gameSmashBrosUltimate,
                'thumbnail' => 'luigi-smash-bros-ultimate-5fb5adf540737702140847.jpg',
            ),
            array(
                'character' => $characterMario,
                'game' => $gameSmashBrosUltimate,
                'thumbnail' => 'mario-mario-smash-bros-ultimate-5fb5adfee3902258573213.jpg',
            ),
            array(
                'character' => $characterPikachu,
                'game' => $gameSmashBrosUltimate,
                'thumbnail' => 'pikachu-smash-bros-ultimate-5fb5ae1473d19825178278.jpg',
            ),
            array(
                'character' => $characterPeach,
                'game' => $gameSmashBrosUltimate,
                'thumbnail' => 'peach-smash-bros-ultimate-5fb5ae0ac2774316747090.png',
            ),
            array(
                'character' => $characterYoshi,
                'game' => $gameSmashBrosUltimate,
                'thumbnail' => 'yoshi-smash-bros-ultimate-5fb5ae23a17c4579551639.jpg',
            ),
            array(
                'character' => $characterZelda,
                'game' => $gameSmashBrosUltimate,
                'thumbnail' => 'zelda-smash-bros-ultimate-5fb5ae30dc85d323047618.jpg',
            ),
            array(
                'character' => $characterKingKRool,
                'game' => $gameSmashBrosUltimate,
                'thumbnail' => 'king-k-rool-smash-bros-ultimate-5fb5adde5226d230549916.jpg',
            ),
            array(
                'character' => $characterArbreMojo,
                'game' => $gameZeldaBotw,
                'thumbnail' => 'arbre-mojo-botw-5fb5ae4ce5955287051165.jpg',
            ),
            array(
                'character' => $characterRoiHyrule,
                'game' => $gameZeldaBotw,
                'thumbnail' => 'roi-dhyrule-botw-5fb5ae6cbd562577955621.jpg',
            ),
            array(
                'character' => $characterGanondorf,
                'game' => $gameZeldaBotw,
                'thumbnail' => 'ganondorf-botw-5fb5ae57f2e8f970684728.jpg',
            ),
            array(
                'character' => $characterLink,
                'game' => $gameZeldaBotw,
                'thumbnail' => 'link-botw-5fb5ae61bcf4e179136529.jpg',
            ),
            array(
                'character' => $characterZelda,
                'game' => $gameZeldaBotw,
                'thumbnail' => 'zelda-botw-5fb5ae78c5a9a120252878.jpg',
            ),
            array(
                'character' => $characterLink,
                'game' => $gameZeldaMajora,
                'thumbnail' => 'link-mm-5fb5af02c6176968948866.jpg',
            ),
            array(
                'character' => $characterZelda,
                'game' => $gameZeldaMajora,
                'thumbnail' => 'zelda-mm-5fb5af14c0919662670301.jpg',
            ),
            array(
                'character' => $characterArbreMojo,
                'game' => $gameZeldaOcarina,
                'thumbnail' => 'arbre-mojo-ott-5fb5afbb83a56945439956.jpg',
            ),
            array(
                'character' => $characterGanondorf,
                'game' => $gameZeldaOcarina,
                'thumbnail' => 'ganondorf-ott-5fb5afc769e20647367889.jpg',
            ),
            array(
                'character' => $characterLink,
                'game' => $gameZeldaOcarina,
                'thumbnail' => 'link-ott-5fb5afd21369d039232332.jpg',
            ),
            array(
                'character' => $characterZelda,
                'game' => $gameZeldaOcarina,
                'thumbnail' => 'zelda-ott-5fb5afe756fff466330993.jpg',
            ),
            array(
                'character' => $characterMidona,
                'game' => $gameZeldaTp,
                'thumbnail' => 'midona-tp-5fb5b01d867c9187543186.jpg',
            ),
            array(
                'character' => $characterGanondorf,
                'game' => $gameZeldaTp,
                'thumbnail' => 'ganondorf-tp-5fb5affeebdca790558033.jpg',
            ),
            array(
                'character' => $characterLink,
                'game' => $gameZeldaTp,
                'thumbnail' => 'link-tp-5fb5b0083e4c3698064596.jpg',
            ),
            array(
                'character' => $characterZelda,
                'game' => $gameZeldaTp,
                'thumbnail' => 'zelda-tp-5fb5b011cc1ac731109700.jpg',
            ),
            array(
                'character' => $characterArbreMojo,
                'game' => $gameZeldaWw,
                'thumbnail' => 'arbre-mojo-ww-5fd1439374cdd207262952.jpg',
            ),
            array(
                'character' => $characterRoiHyrule,
                'game' => $gameZeldaWw,
                'thumbnail' => 'roi-dhyrule-ww-5fd61b7ce4fef216027061.jpg',
            ),
            array(
                'character' => $characterGanondorf,
                'game' => $gameZeldaWw,
                'thumbnail' => 'ganondorf-ww-5fd14375c0c76312110723.jpg',
            ),
            array(
                'character' => $characterLink,
                'game' => $gameZeldaWw,
                'thumbnail' => 'link-ww-5fd14365d951c986407635.jpg',
            ),
            array(
                'character' => $characterZelda,
                'game' => $gameZeldaWw,
                'thumbnail' => 'zelda-ww-5fd1437ee9ef1241161074.jpg',
            ),
        );

        foreach($aGamesCharactersData as $aData){
            $gameCharacter = new GameCharacter();
            $gameCharacter
                ->setGame($aData['game'])
                ->setCurrentCharacter($aData['character'])
                ->setThumbnail($aData['thumbnail'])
            ;
            $manager->persist($gameCharacter);
        }


        $manager->flush();
    }
}
