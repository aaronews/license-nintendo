<?php

namespace App\DataFixtures;

use App\Entity\Character;
use App\Entity\Console;
use App\Entity\Game;
use App\Entity\GameCharacter;
use App\Entity\GameItem;
use App\Entity\Genre;
use App\Entity\Item;
use App\Entity\License;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /**
         * License
         */
        $license1 = new License();
        $license1->setName('Mario')
            ->setSlug('mario')
            ->setDescription('Mario est une franchise médiatique constituée de jeux vidéo publiés et produits par Nintendo mettant en vedette le personnage de fiction Mario. Elle a été créée à l\'origine par le concepteur de jeu Shigeru Miyamoto avec le jeu d\'arcade Donkey Kong, sorti le 9 juillet 1981. Les jeux ont été développés par une variété de développeurs de Nintendo. La plupart des jeux Mario ont été soit sortis sur arcade, console Nintendo ou ordinateurs portables datant de la NES à la génération actuelle de consoles de jeux vidéo.<br/><br/>
            La principale série de la franchise est la série de plates-formes Super Mario, qui suit la plupart des aventures de Mario dans le monde fictif du Royaume Champignon. Ces jeux reposent généralement sur la capacité de saut de Mario pour lui permettre de progresser à travers les niveaux. La franchise a donné naissance à plus de 200 jeux de différents genres. La totalité de la franchise, y compris les séries tels que Super Mario, Mario Kart, Mario Party, Mario Tennis et Mario Golf, ont été vendues à plus de 550 millions d\'exemplaires, ce qui en fait la franchise de jeu vidéo la plus vendue de tous les temps.')
            ->setThumbnail('img/fixtures/licenses/mario.png');
        $manager->persist($license1);

        $license2 = new License();
        $license2->setName('The Legend of Zelda')
            ->setSlug('the-legend-of-zelda')
            ->setDescription('The Legend of Zelda, ou simplement Zelda, est une série de jeux vidéo d\'action-aventure produite par la société japonaise Nintendo et créée par Shigeru Miyamoto et Takashi Tezuka. Depuis 1986 et la sortie du jeu The Legend of Zelda sur la console NES, dix-neuf jeux font officiellement partie de la saga. Plusieurs rééditions, remakes et jeux dérivés ont également vu le jour.<br/><br/>
            L\'histoire qui sert de base pour la plupart des épisodes de la série est celle du héros Link qui doit libérer le royaume d\'Hyrule et sa princesse, Zelda, des mains du seigneur du Mal, Ganon. La série est connue notamment pour son côté exploration, pionnier des jeux en monde ouvert, son gameplay, la profondeur de son scénario, la multitude de quêtes secondaires et ses musiques créées par Koji Kondo.')
            ->setThumbnail('img/fixtures/licenses/the-legend-of-zelda.png');
        $manager->persist($license2);

        /**
         * Game
         */
        $releaseDateMarioBros3 = new DateTime();
        $game1 = new Game();
        $game1->setName('Super Mario Bros 3')
            ->setDescription('Super Mario Bros. 3 est le troisième opus de la série Super Mario Bros. commencée en 1985. Il marque le retour de Bowser dans la série, car le volet précédent était "divisé" en deux parties. On voit également l\'apparition des Koopalings, les sbires les plus redoutables de Bowser.')
            ->setThumbnail('img/fixtures/games/super-mario-bros-3.jpg')
            ->setSlug('super-mario-bros-3')
            ->setHistory("Grâce aux frères Mario, la princesse Peach a été sauvée des griffes de Bowser dans Super Mario Bros. Pour se venger, le vil roi Koopa envoie ses sept sbires koopa (les Koopalings) à différents endroits du royaume. Ceux-ci attaquent chacun un roi avec leur bateau volant, lui volent son sceptre magique et le transforment en animal. Les frères plombiers partent ainsi à la rescousse des sept souverains.<br/><br/>
            Après avoir terminé leur lourde tâche, les deux héros reçoivent une lettre via le roi du Pipe Land. Celle-ci vient de Bowser, qui a (une fois de plus) kidnappé la princesse. Les frères se rendent donc dans un ultime monde, le Dark Land, où réside le roi maléfique.")
            ->setNbPlayers(2)
            ->setReleaseDate($releaseDateMarioBros3->setDate(1988, 10, 23))
            ->setLicense($license1);
        $manager->persist($game1);

        $releaseDateMario64= new DateTime();
        $game2 = new Game();
        $game2->setName('Super Mario 64')
            ->setDescription("Super Mario 64 est le premier jeu de la série Super Mario à être en 3D temps réel. Il est sorti exclusivement sur la Nintendo 64 et était, avec Pilotwings 64, un des deux jeux de lancement (trois au Japon) de la console, ayant aidé les ventes initiales de la Nintendo 64. Au 20 mai 2017, 11,89 millions d'exemplaires de ce jeu ont été vendus dans le monde[1], en faisant le jeu plus vendu de la Nintendo 64, devant Mario Kart 64. En 1998, le jeu est ressorti sous le label Choix des joueurs.<br/><br/>
            Une suite appelée Super Mario 64 2 était censée sortir sur le Nintendo 64DD en 1999, mais a été annulée faute de succès du périphérique. Super Mario 64 a été refait pour la Nintendo DS en 2004 sous le titre Super Mario 64 DS. Il est aussi ressorti sur la console virtuelle Wii fin 2006 et celle de la Wii U en avril 2015, en faisant de lui et Donkey Kong 64 les deux premiers jeux Nintendo 64 à être disponibles sur la console virtuelle de la seconde console.")
            ->setThumbnail('img/fixtures/games/super-mario-64.jpg')
            ->setSlug('super-mario-64')
            ->setHistory("Super Mario 64 débute par une lettre de la princesse Peach qui a invité Mario à manger un gâteau qu'elle a préparé dans son château. Cependant, une fois rentré dans le château, Mario découvre que Bowser a fait prisonnière la princesse ainsi que ses serviteurs en utilisant le pouvoir des 120 étoiles du château. La plupart des peintures du château sont des portes vers d'autres mondes, dans lesquels les serviteurs de Bowser gardent les étoiles. Mario cherche ces portes dans le château pour entrer dans ces mondes et récupérer les étoiles. Il obtient l'accès à de nouvelles pièces lorsqu'il obtient des étoiles, et il devra affronter Bowser à trois reprises dans des niveaux spéciaux. Vaincre Bowser les deux premières fois permet à Mario d'obtenir une clef vers un autre niveau du château, tandis que le dernier combat permet de libérer Peach. Cette dernière récompensera Mario en lui préparant le gâteau qu'elle lui avait promis.<br/><br/>
            Super Mario 64 se déroule dans le château de la princesse Peach, qui se compose de trois étages, un sous-sol, des douves et une cour. La zone à l'extérieur du château est une zone d'introduction dans laquelle le joueur peut expérimenter tous les nouveaux mouvements permis par la 3D. Des peintures et des murs secrets éparpillés à travers le château permettent d'entrer dans les niveaux.")
            ->setNbPlayers(1)
            ->setReleaseDate($releaseDateMario64->setDate(1996, 06,23))
            ->setLicense($license1);
        $manager->persist($game2);

        $releaseDateMarioGalaxy = new DateTime();
        $game3 = new Game();
        $game3->setName('Super Mario Galaxy')
            ->setDescription("Super Mario Galaxy est le premier jeu de la série éponyme. Il est sorti sur Wii et est le premier jeu Mario se déroulant dans l'espace. Trois ans plus tard, la série continue, avec la sortie de Super Mario Galaxy 2. Il est souvent considéré comme étant le troisième opus des Mario 3D, succédant ainsi à Super Mario 64 et Super Mario Sunshine.")
            ->setThumbnail('img/fixtures/games/super-mario-galaxy.jpg')
            ->setSlug('super-mario-galaxy')
            ->setHistory("La Princesse Peach invite Mario à une fête dans son château, disant avoir un cadeau à lui donner. En effet, tous les cents ans, une comète passe dans le ciel et une fête est organisée pour l'occasion dans tout le Royaume Champignon. Un morceau de ladite comète contenant un bébé Luma est tombé du ciel et la brigade Toad l'a trouvé. Peach a donc décidé de l'offrir à son amoureux, malheureusement, elle se fait capturer par Bowser au cours de la soirée. Il emporte avec lui la princesse et son château ainsi que les 120 étoiles de puissance (grandes étoiles, étoiles vertes et étoile rouge de puissance comprises). Le plombier tente de la sauver en vain, il est finalement vaincu par Kamek, qui l'envoie dans l'espace.<br/><br/>
            Le bébé Luma que la Princesse Peach prévoyait d’offrir à Mario a eu le temps de s’échapper et de rejoindre Harmonie, qui le lui confiera officiellement. Ils chercheront ensemble les étoiles de puissance nécessaires pour défaire Bowser.<br/><br/>
            Mario se réveille sur le portail cosmique en compagnie de trois lapins. Au cours de ses aventures, il trouvera des étoiles de puissance ainsi que des grandes étoiles, lui permettant de traverser des mondes.<br/><br/>
            Mario bat finalement Bowser. Tout le monde est joyeux et compte reprendre la fête là où elle s'était arrêtée.")
            ->setNbPlayers(2)
            ->setReleaseDate($releaseDateMarioGalaxy->setDate(2007, 11, 1))
            ->setLicense($license1);
        $manager->persist($game3);

        $releaseDateMarioOdyssey = new DateTime();
        $game4 = new Game();
        $game4->setName('Super Mario Odyssey')
            ->setDescription("Super Mario Odyssey est un jeu de plate-formes de la série sorti le 27 octobre 2017 sur la Nintendo Switch. Il a été annoncé durant la vidéo de présentation de la Nintendo Switch, le 13 janvier 2017[1]. Il est conçu par Yoshiaki Koizumi. Il s'agit du seizième opus de la série Super Mario ainsi que du huitième jeu de la série en 3D.<br/><br/>
            Super Mario Odyssey se déroule dans divers pays que Mario visite comme, par exemple, une ville peuplée d'humains s'appelant New Donk City. Similairement à Super Mario 64 et Super Mario Sunshine, il s'agit d'un jeu de plate-formes en 3D et en monde ouvert. Le héros moustachu est de retour ; cette fois, il est aidé de Cappy, un Chapiforme qui prend possession de sa casquette en la dotant d'yeux. Mario peut interagir avec lui en se chapimorphosant en d'autres entités ou en s'en servant comme boomerang, comme plate-forme volante et bien plus encore.")
            ->setThumbnail('img/fixtures/games/super-mario-odyssey.jpg')
            ->setSlug('super-mario-odyssey')
            ->setHistory("Le jeu ouvre sur un affrontement entre Mario et Bowser sur la forteresse volante de ce dernier. Mario finit par se faire éjecter loin du Royaume Champignon, et Bowser écrase la casquette de Mario avant de s'en aller afin de se marier avec la princesse Peach.<br/><br/>
            Peu de temps après, Mario se réveille sur une colline avant de tomber nez à nez avec un petit fantôme portant un chapeau. Celui-ci s'enfuit, mais Mario le rattrape. Après avoir compris que Mario ne lui veut pas de mal, le fantôme se présente. Il se révèle être un Chapiforme nommé Cappy. Il lui explique aussi que son village a été attaqué par Bowser et que ce dernier a capturé sa sœur Tiara. Mario accepte de l'aider, et Cappy prend alors la forme de sa casquette. En quête d'un vaisseau pour pourchasser le Roi des Koopas, le duo traverse le Pays des Chapeaux et escalade la Chapitour, le grand bâtiment surplombant la zone, où le plombier découvre qu'il peut chapimorphoser les ennemis grâce à son nouveau complice. Après avoir atteint le sommet de la tour, Mario et Cappy tombent sur les Broodals, qui leur expliquent qu'ils sont les ordonnateurs du mariage de Bowser et Peach. Après un affrontement contre Topper, Mario se dirige vers le Pays des Chutes en prenant possession d'une borne gzzzt, et c'est là que l'aventure commence vraiment.")
            ->setNbPlayers(2)
            ->setReleaseDate($releaseDateMarioOdyssey->setDate(2017, 10, 27))
            ->setLicense($license1);
        $manager->persist($game4);

        $releaseDateZeldaMm = new DateTime();
        $game5 = new Game();
        $game5->setName('Majora’s Mask')
            ->setDescription("En mai 1999, le magazine japonais Famitsu parle de l’arrivée prochaine sur l’archipel de l’extension d’Ocarina of Time pour le 64DD : c’est le projet Ura Zelda, finalement annulé vu le manque d’engouement pour le périphérique et qui refera surface plus tard sous les traits de Master Quest. Toujours est-il qu’il y a un temps une confusion entre ce Ura Zelda et le Zelda Gaiden (Gaiden désignant en gros une histoire complémentaire), qui apparaît en août 1999 au Nintendo Space World (pour l’anecdote, au même moment qu’un autre titre Zelda : The Legend of Zelda: The Acorn of the Mystery Tree — Tale of Power, qui donnera finalement naissance à Oracle of Seasons). C’est bien ce Zelda Gaiden qui deviendra Majora’s Mask, mais il est assez difficile de déterminer si le projet était à la base confondu avec Ura Zelda, ou si les deux ont toujours été distincts.<br/><br/>
            C’est à ce SpaceWorld 1999 qu’on peut pour la première fois apercevoir des éléments caractéristiques du jeu, tels que Bourg-Clocher ou le Masque Goron. C’est là les prémices de tout le système de masques du jeu final, chacun conférant à Link une habileté particulière et certains permettant même de le changer en Mojo, Goron ou Zora, modifiant du coup radicalement la façon dont on contrôle le personnage.<br/><br/>
            Le jeu utilise l’Expansion Pak de la Nintendo 64 : ainsi, bien que les graphismes et le moteur soient directement repris d’Ocarina of Time, divers éléments d’ordre technique comme la distance d’affichage, les détails des textures ou le nombre de personnages à l’écran sont améliorés. En novembre 1999, Nintendo annonce Zelda Gaiden pour la fin d’année 2000 aux États-Unis.<br/><br/>
            C’est en mars 2000 que le titre définitif du jeu, Majora’s Mask, est officiellement annoncé : exit Zelda Gaiden. Le jeu est finalement lancé en mai au Japon, en octobre en Amérique du Nord et le 17 novembre 2000 en Europe. Beaucoup s’attendaient à voir le jeu se retrouver dans l’ombre de son prédécesseur Ocarina of Time, mais les critiques sont largement positives.")
            ->setThumbnail('img/fixtures/games/majora-s-mask.jpg')
            ->setSlug('majora-s-mask')
            ->setHistory("Après avoir vaincu Ganondorf, Link part dans une quête secrète pour retrouver un ancien ami (sûrement Navi) et son périple l'amène à croiser un Skull Kid au fin fond des bois Perdus. Ce dernier lui vole sa jument, Epona, ainsi que l'ocarina du Temps, avant de s'enfuir. En partant à sa poursuite, notre héros tombe dans un monde parallèle à Hyrule : Termina, et il fait la connaissance de Taya, fée de compagnie de Skull Kid, qui a été séparée de son frère Tael et qui souhaite le retrouver, en s'alliant d'abord temporairement à Link.<br/><br/>
            Dans un premier temps, transformé par Skull Kid en Peste Mojo, Link apprend des habitants de Termina que la lune va s'écraser sur la terre et qu'il ne dispose que de trois jours pour stopper l'apocalypse. Apocalypse provoquée par Skull Kid, qui possède d'ailleurs un étrange masque : le masque de Majora. En premier lieu, Link remet la main sur son ocarina du Temps, et Taya décide de continuer à l'accompagner dans sa quête, car Skull Kid est en train de devenir fou et elle veut l'arrêter. Ils devront alors remettre la main sur le masque de Majora, à la requête du vendeur de Masques, et ce en collectant les masques des boss du jeu, pour réveiller les quatre Géants.")
            ->setNbPlayers(1)
            ->setReleaseDate($releaseDateZeldaMm->setDate(2000,4,27))
            ->setLicense($license2);
        $manager->persist($game5);

        $releaseDateZeldaTp = new DateTime();
        $game6 = new Game();
        $game6->setName('Twilight Princess')
            ->setDescription("Mai 2004. Les joueurs ont maintenant largement eu le temps de retourner The Wind Waker dans tous les sens et arrivent déjà les premières interrogations quant au futur de la série : on parle depuis déjà un moment d’un « The Wind Waker 2 » dans la veine du précédent épisode. Mais, si le cel-shading aura finalement trouvé grâce aux yeux de beaucoup de monde, le vieux fantasme du Zelda next-gen au style plus réaliste, entrevu au Nintendo Spaceworld quatre ans plus tôt, est toujours bien présent… Durant sa conférence à l'E3, Reggie Fils-Aime revient sur scène à la fin de celle-ci pour une dernière surprise sur GameCube…<br/><br/>
            Pas sûr que l’annonce d’un nouveau jeu ait jamais provoqué autant d’enthousiasme que celle-ci : les journalistes hurlent de joie tandis qu’un Link adulte, dans un style photoréaliste, traverse une plaine sur le dos d’Epona, affronte des ennemis montés sur des sangliers et fait face à un immense boss de feu, dans une ambiance générale qui n’est pas sans rappeler le Seigneur des Anneaux. <br/><br/>
            Le jeu reste très discret pendant les mois qui suivent, avec pas plus de trois piètres screenshots accordés aux joueurs morts d’impatience entre l’E3 de mai 2004 et la Game Developers Conference de mars 2005. À cette occasion, Satoru Iwata tient une petite conférence devant des acteurs de l’industrie et dévoile un second trailer du jeu, dans l’esprit du précédent. Il se conclut sur un plan assez énigmatique d’un loup hurlant à la pleine lune…<br/><br/>
            Les choses s’accélèrent à l’approche de l’E3 2005. Plus d’infos commencent à filtrer dans la presse : on apprend notamment que Link commence l’aventure en tant que jeune fermier dans un petit village en périphérie d’Hyrule. Pendant la conférence, Nintendo dévoile une 3e bande-annonce. Il s’avère alors que Link est le loup : il s’agit de sa transformation lorsqu’il est envoyé dans le Royaume du Crépuscule, un monde de ténèbres qui menace de recouvrir le Royaume d’Hyrule. À la fin du show, fin 2005 est associée dans tous les agendas au lancement d’un jeu auquel on peut désormais donner un titre : Twilight Princess.<br/><br/>
            En septembre 2006, avec une énième série de screenshots et une vidéo de plus à la clé, la date de sortie définitive du jeu est fixée, coïncidant avec le lancement de la Wii sur les trois territoires, en novembre en Amérique du Nord et en décembre au Japon et en Europe.<br/><br/>
            Twilight Princess reçoit d’excellentes critiques à sa sortie, tant de la part de la presse que parmi les fans. Assez vite, on constate cependant une certaine déception chez certains, que ce soit parce que les attentes étaient trop hautes après un développement si suivi, ou bien peut-être parce que le produit final manque un peu du souffle épique des premiers trailers. Le jeu est souvent accusé de se retrouver dans l’ombre d’Ocarina of Time à force d’avoir tant voulu le dépasser, trop classique et figé dans les codes de la série.")
            ->setThumbnail('img/fixtures/games/twilight-princess.jpg')
            ->setSlug('twilight-princess')
            ->setHistory("Le joueur incarne Link, un jeune fermier de 17 ans vivant dans un village appelé Toal avec ses amis. L'histoire commence réellement quand ceux-ci se font capturer par des monstres montés sur des sangliers. Link part à leur recherche en direction de la forêt de Firone et se retrouve face à un mur noir inquiétant. De l'autre côté, une partie du royaume d'Hyrule est corrompue par le Crépuscule. Un monstre emporte Link vers ce monde et essaie de l'éliminer. Le pouvoir de la Triforce du courage, détenu par Link, le transforme en loup pour se protéger. Il est fait prisonnier dans les geôles du château d'Hyrule où il rencontre Midona, une créature du Crépuscule qui le libère et le guide vers la princesse Zelda. Celle-ci raconte alors à Link comment Xanto, le roi des Ombres, a pris le contrôle du royaume d'Hyrule.

            Pour rendre leur lumière aux différentes régions d'Hyrule et retrouver sa forme humaine, Link doit retrouver des perles de lumière qui y sont dispersées. En parallèle, Midona l'entraîne en quête des cristaux d'Ombre afin de permettre de vaincre Xanto. Le royaume d'Hyrule libéré du Crépuscule et les cristaux d'Ombre récupérés, Link tombe nez-à-nez avec Xanto qui récupère les cristaux d'Ombre, maudit Link pour qu'il soit à jamais un loup et expose Midona à la lumière de l'esprit de Lanelle, ce qui l'affaiblit gravement. Link emmène Midona auprès de la princesse Zelda, qui offre son énergie vitale en sacrifice pour la sauver. Zelda révèle à Link l'existence d'une épée légendaire, cachée au sanctuaire de la forêt de Firone, capable de déchirer sa malédiction. Link retrouve sa forme humaine et Midona récupère le fragment de magie qui l'empoisonnait.
            
            Midona entraîne Link dans le désert Gerudo à la recherche du miroir des Ombres, permettant de se rendre au royaume du Crépuscule. Sur place, les anciens sages veillant sur le miroir révèlent que le miroir des Ombres a été brisé par Xanto eqt que ce dernier n'est que le sous-fifre du Seigneur du Mal, Ganondorf. Link doit retrouver les fragments du miroir éparpillés en Hyrule. Une fois le miroir reconstituer, les sages dévoilent que Midona n'est autre que la princesse du Crépuscule, maudite par Xanto. Link ouvre ensuite le passage vers le monde des Ombres, traverse le Palais du Crépuscule, bat Xanto et récupère les cristaux d'ombres.
            
            Link se prépare ensuite à affronter Ganondorf, qui a pris le contrôle du château d'Hyrule et de la princesse Zelda. Le combat final prend place au château. Après avoir triomphé, Link aperçoit la silhouette d'une jeune fille titubante au loin, qui n'est autre que Midona ayant reprise son apparence « humaine ». La scène finale montre Link, Zelda et Midona face au Miroir des Ombres, s'échangeant quelques mots d'adieux à la suite desquels Midona repart dans son royaume et détruit définitivement le miroir des Ombres, afin de couper tout lien entre le monde de la lumière et celui des ombres.")
            ->setNbPlayers(1)
            ->setReleaseDate($releaseDateZeldaTp->setDate(2006,12,2))
            ->setLicense($license2);
        $manager->persist($game6);

        $releaseDateZeldaOtt = new DateTime();
        $game7 = new Game();
        $game7->setName('Ocarina of Time')
            ->setDescription('En 1995, la série Zelda s’apprête à amorcer le plus grand tournant de son histoire. La Nintendo 64 fait partout parler d’elle et fin novembre de cette année, elle est pour la première fois montrée au public en version jouable. Mais même avec un bond technologique aussi important que le passage à la 3D comme argument, ce sont avant tout les jeux qui décident du destin d’une machine. Deux gros projets sont alors développés en parallèle par Nintendo EAD, chacun chargé de réinventer une série populaire de la société pour la 3D : Super Mario 64 et Zelda 64, bientôt connu sous le nom d’Ocarina of Time.<br/><br/>
            Chacun des deux jeux est révélé au Nintendo Space World de décembre 1995 au travers d’une première démo technique : c’est l’occasion de voir un Link encore peu détaillé et proche des anciens épisodes en combat contre un chevalier métallique.<br/><br/>
            À l’origine, Mario 64 devait servir de jeu de lancement pour la console, tandis qu’Ocarina of Time sortirait plus tard sur le Nintendo 64DD, un périphérique quasi mort-né qui connaîtra un échec commercial retentissant à sa sortie japonaise en 1999. Nintendo décidera par la suite de sortir Ocarina of Time sur cartouche (on parle à l’époque de la plus grosse jamais conçue, avec 256 mégabits de données !). Le jeu final conserve la possibilité d’une mise à jour via le 64DD : c’est le fameux Ura Zelda, finalement annulé vu l’insuccès du périphérique et qui referait surface sous une forme assez étrangère au projet de base avec Master Quest sur GameCube.<br/><br/>
            Au début de son développement, Ocarina of Time est pensé par Miyamoto comme un jeu à la première personne : il croyait que cela permettrait mieux au joueur d’appréhender les vastes décors du jeu, et aux développeurs de se focaliser sur la création des ennemis et environnements. Cette vision est balayée quand le ressort principal du jeu est introduit, à savoir la présence d’un Link enfant ET d’un Link adulte séparés par sept ans mais liés par l’Ocarina du Temps. Miyamoto se dit en effet qu’il sera alors nécessaire que Link apparaisse bel et bien à l’écran.<br/><br/>
            Le développement du jeu est tumultueux et marqué par une série de retards : Miyamoto chapeaute à la base une série de directeurs, mais est obligé de se replonger plus directement dans la création du titre, voyant que les choses ne vont pas aussi vite que prévu. Le fait que Mario 64 soit créé en parallèle joue aussi en la défaveur d’Ocarina of Time : vu que le plombier est prioritaire sur le calendrier, certaines idées que Miyamoto avait eues pour Zelda sont plutôt intégrées à Mario 64. Les deux jeux tournent avec le même moteur, mais il est largement modifié pour Ocarina of Time, laissant davantage le contrôle de la caméra à l’IA qu’au joueur pour mieux se focaliser sur les environnements du jeu.<br/><br/>
            Ce n’est que fin 1998 qu’Ocarina of Time est lancé partout dans le monde, après une attente quasi insoutenable de trois ans qui aura notamment nécessité la mise en place d’une opération spéciale permettant d’obtenir une cartouche dorée par précommande. La demande est si importante que les enseignes doivent commencer à refuser les réservations alors que plusieurs semaines les séparent encore de la sortie du jeu.<br/><br/>
            Ocarina of Time est l’un des jeux vidéo les plus acclamés par la presse de tous les temps ; certains le considèrent comme le meilleur jeu jamais créé. Une étiquette sans doute un peu cliché et amplifiée par le mythe créé autour du jeu, mais impossible de ne pas en voir les raisons : Ocarina a su faire passer la formule Zelda dans l’ère de la 3D sans en ruiner le gameplay — et c’est une transition très délicate —, à l’image de Super Mario 64 ou Metroid Prime pour leurs séries respectives.<br/><br/>
            Réédité en 2003 sur GameCube, avec sa version Master Quest, pour la sortie de The Wind Waker, puis sur la Console Virtuelle de la Wii en 2007, le jeu fera enfin l’objet en juin 2011 d’un remake sur la Nintendo 3DS, alors toute récente sur le marché. Le jeu bénéficie avec cette édition d’une mise à jour graphique incluant, logiquement, des effets 3D, mais aussi d’une meilleure ergonomie grâce aux deux écrans du système.<br/><br/>
            Le fait qu’Ocarina of Time raconte l’origine du Royaume d’Hyrule et se passe chronologiquement avant tous les autres Zelda sortis précédemment contribue à lui donner ce côté mythe fondateur de la série, plus encore que The Legend of Zelda et A Link to the Past. Un nombre incalculable d’éléments de l’univers du jeu sont repris dans les Zelda ultérieurs et son système de combat est toujours d’application huit ans plus tard, certes dans une version plus ou moins améliorée dans Twilight Princess. Qu’on le préfère aux autres Zelda 3D ou non, la série est ce qu’elle est aujourd’hui grâce à Ocarina of Time, impossible de le nier !')
            ->setThumbnail('img/fixtures/games/ocarina-of-time.jpg')
            ->setSlug('ocarina-of-time')
            ->setHistory("Link vit dans la forêt kokiri. Les autres enfants ont une fée sauf lui. Un jour l'Arbre Mojo envoie une fée pour réveiller Link. L'Arbre Mojo (l'esprit protecteur de la forêt) convoque Link, un enfant de la forêt, pour lui parler. Il lui explique que ses origines ne sont pas dans la forêt, comme les autres enfants qui peuplent celle-ci (les Kokiris), et qu'il a une quête à accomplir : sauver Hyrule d'un vil cavalier du désert (Ganondorf) qui désire s'emparer de la Triforce. C'est alors que commence sa quête. Il reçoit de l'Arbre Mojo la pierre ancestrale de la forêt, qu'il doit remettre à la princesse d'Hyrule, Zelda. Celle-ci lui demande de ramener deux autres pierres (données par Darunia et Ruto) qui permettront de desceller la porte du temple du Temps à l'aide de l'ocarina du Temps. Derrière cette porte repose l'épée de Légende qui fera de Link, projeté dans le temps grâce à elle et équipé de l'ocarina, le héros du temps.<br/><br/>
            Link entonne le chant du Temps avec l'ocarina du Temps devant le piédestal des trois pierres Ancestrales. Cela fait, la porte du Temps s'ouvre et Link se retrouve dans la pièce où se trouve L'épée de Légende. Link s'en approche et la retire de son socle. Il rencontre Rauru, l'un des sept sages protecteurs de la Triforce qui lui apprend que l'épée avait endormi son âme pendant sept années, durant lesquelles le vil Ganondorf a envahi Hyrule…Link est devenu plus grand et plus puissant. Il pourra ainsi voyager dans le temps en insérant l'épée de Légende dans son socle de granit pour rajeunir ou en la retirant pour passer à l'âge adulte. À l'âge adulte, Link ne peut plus utiliser certains objets de son enfance mais en revanche, il peut monter une jument, Epona. L'épée de Légende est une lame purificatrice repoussant les forces obscures. Les êtres du mal ne peuvent donc pas la toucher et seul le Héros du Temps (l'élu) peut la retirer de son socle de granit. Sa quête est maintenant d'éveiller les six autres sages d'Hyrule pour battre Ganondorf, guidé par le mystérieux Sheik.")
            ->setNbPlayers(1)
            ->setReleaseDate($releaseDateZeldaOtt->setDate(1998,11,21))
            ->setLicense($license2);
        $manager->persist($game7);

        $releaseDateZeldaBotw = new DateTime();
        $game8 = new Game();
        $game8->setName('Breath of the Wild')
            ->setDescription("A l’E3 2014, les premières images du futur Breath of the Wild apparaissent devant les yeux des fans, alors fascinés par ce qu’ils voient. Le trailer, réalisé avec le moteur du jeu, met en scène Link sur un cheval, au milieu d’une vaste plaine, en train de fuir puis affronter une créature robotique — dont le nom de Gardien sera plus tard dévoilé. Finalement, Link saute de sa monture pour décocher une flèche d’une technologie avancée sur son redoutable adversaire. Il est bon de noter que pour l’heure, Link n’est pas vêtu de sa légendaire tunique verte et que c’est une première dans la série. La plupart du temps, Link ne porte une tenue conventionnelle qu’au début de ses aventures avant d’être choisi pour porter les habits du héros, qu’il conserve jusqu’à la victoire finale, et même après.<br/><br/>
            Pendant plus d’un an, le jeu se fait désirer : toujours pas de nom définitif et une sortie vaguement estimée à 2015, nous n’en saurons pas plus avant le mois de novembre 2015. En effet, un Nintendo Direct présente Twilight Princess HD plus en détail et révèle sa date de sortie, et, en fin de présentation, un rapide teaser du nouveau Zelda Wii U est montré et il est indiqué que l’amiibo Link loup qui sort en même temps que Twilight Princess HD sera compatible avec le vrai nouveau Zelda, alors annoncé pour 2016.<br/><br/>
            Ce qui nous amène à l’E3 2016 où un premier vrai trailer du jeu est dévoilé. Ce dernier est riche en informations, une voix en anglais demande à Link de se réveiller et l’appelle à l’aide, la vidéo met l’accent sur le côté sauvage du monde d’Hyrule. On y voit Link gravir des falaises, couper des arbres pour fabriquer un pont, chasser ou encore faire la cuisine. Le logo du jeu et son titre définitif sont révélés ; le jeu s’appellera The Legend of Zelda: Breath of the Wild. Il n’y avait toujours pas de date de sortie à se mettre sous la dent à ce moment-là. <br/><br/>
            Le 13 janvier 2017, Nintendo avait donné rendez-vous à ses fans à cinq heures de matin (heure française) pour la présentation de la Nintendo Switch. Si le doute était encore permis sur l’absence du jeu Zelda lors du lancement de la nouvelle console, la seconde partie de la présentation est une extase servie sur un plateau d’argent. Non seulement le jeu sortirait bien le 3 mars 2017 en même temps que la Switch, mais les éléments supplémentaires dévoilés lors d’un second trailer ont de quoi ravir les fans qui jusque là s’inquiétaient du vide qu’était le Royaume d’Hyrule. On y découvre de nombreux personnages emblématiques notamment la princesse Zelda, ainsi que les races communes de la saga Zelda : Gorons, Zoras, Gérudos, grandes fées, arbre mojo… Chose surprenante, on découvre que les personnages sont doublés, chose qui est loin d’être fréquente au sein de la saga et que, mieux encore, les joueurs auront droit à des voix françaises.<br/><br/>
            Avec de telles qualités, il est peu surprenant que le jeu soit si bien reçu auprès de la presse spécialisée comme auprès des consommateurs avec un défilé de notes parfaites ou quasi parfaites. Les previews et les tests pullulent et s’accordent pour qualifier le jeu d’exceptionnel. Si certains défauts sont pointés du doigt, ils sont dans la majorité des cas plus une histoire de goût qu’autre chose. Les ventes confirment cette impression offrant au jeu – et à la Switch – un départ remarquable laissant présager de bonnes choses pour Nintendo.")
            ->setThumbnail('img/fixtures/games/breath-of-the-wild.jpg')
            ->setSlug('breath-of-the-wild')
            ->setHistory("Link sort d'un long sommeil d'une centaine d'années au début du jeu. Il se réveille dans le Sanctuaire de la Renaissance du Plateau du Prélude, car une voix l'appelle. Cette voix va le guider hors de ce lieu de réveil, et c'est alors que commence une nouvelle aventure dans un Royaume d'Hyrule largement dévasté. C'est en fait la Princesse Zelda qui s'adresse à lui. Link rencontre sur son chemin un Vieil Homme autour d'un feu de camp l'informant du lieu où il se trouve et de l'événement catastrophique qui se produisit cent années auparavant, le Grand Fléau causé par Ganon contrôlant depuis lors le Château d'Hyrule.<br/><br/>
            Link, guidé par la tablette Sheikah, découvre la première tour Sheikah, la Tour du Prélude, puis l'active, émergeant du sol jusqu'à une hauteur très importante. Le Vieil Homme vient à sa rencontre avec une paravoile et lui demande de trouver les quatre sanctuaires du plateau du Prélude et d'acquérir leur trésor, un Emblème du triomphe. Une fois la quête accomplie, le Vieil Homme offre à Link sa paravoile pour lui permettre de quitter le plateau. Aussi le vieil Homme se confie et révèle être l'esprit du Roi Rhoam, le dernier Roi d'Hyrule.<br/><br/>
            Il raconte que Link était le Chevalier dévoué à la Princesse Zelda. Il combattit Ganon avec courage mais fut défait alors que la victoire était toute proche. Link, gravement blessé et au bord du trépas, fut emmené dans le sanctuaire de la Renaissance où il demeura un siècle tandis que Zelda empêchait Ganon de sortir du château. Avant de disparaître, le roi offre sa paravoile à Link et lui demande de sauver son royaume. Il dit à Link que dans l'état actuel des choses, aller affronter Ganon maintenant serait de la folie. Il guide tout d'abord Link vers une femme nommée Impa qui lui indiquera la voie.")
            ->setNbPlayers(1)
            ->setReleaseDate($releaseDateZeldaBotw->setDate(2017,3,3))
            ->setLicense($license2);
        $manager->persist($game8);

        
        /**
         * Console
         */
        $releaseDateNes = new DateTime();
        $console1 = new Console();
        $console1->setName('Nintendo Entertainment System (NES)')
            ->setSlug('nintendo-entertainment-system')
            ->setThumbnail('img/fixtures/consoles/nintendo-entertainment-system.jpg')
            ->setReleasePrice(335)
            ->setReleaseDate($releaseDateNes->setDate(1987,10,27))
            ->setDescription("Ce qui était au départ le Famicom (Family Computer) au Japon finit par devenir la machine qui sauva l'industrie du jeu vidéo. Après une chute énorme du marché des jeux à l'ouest, le Nintendo Entertainment System a démenti les experts en se vendant par millions. Les joueurs se ruèrent pour voir et pour jouer à des classiques comme Super Mario Bros, The Legend of Zelda et Excitebike, autant de titres qui étaient déjà tellement en avance sur ceux des autres consoles de salon.");
        $manager->persist($console1);
        
        $releaseDateGba = new DateTime();
        $console2 = new Console();
        $console2->setName('Game Boy Advance')
            ->setSlug('game-boy-advance')
            ->setThumbnail('img/fixtures/consoles/game-boy-advance.jpg')
            ->setReleasePrice(90)
            ->setReleaseDate($releaseDateGba->setDate(2001,6,22))
            ->setDescription("C'est en 2001 que Nintendo a mis en circulation dans les mains des gamers les plus exigeants la nouvelle génération du jeu portable. Avec le Game Boy Advance c'est une qualité de jeu de console de salon que vous pouvez maintenant vous mettre dans la poche. C'est coloré, éclatant et le design très intuitif des contrôles est toujours un grand classique.");
        $manager->persist($console2);
        
        $releaseDateGC = new DateTime();
        $console3 = new Console();
        $console3->setName('Game Cube')
            ->setSlug('game-cube')
            ->setThumbnail('img/fixtures/consoles/game-cube.png')
            ->setReleasePrice(199)
            ->setReleaseDate($releaseDateGC->setDate(2002,5,3))
            ->setDescription("Petit, mignon et désirable - c'est le Nintendo GameCube. Disponible en violet, noir et en éditions spéciales de différentes couleurs, le design unique du Nintendo GameCube et sa forme compacte (11.4cm x 15cm x 16cm) démontrent bien la volonté de Nintendo de perpétuer l'originalité et l'innovation dans le monde des jeux vidéo. Et avec toute la puissance qu'il y a sous le capot pour un si petit prix, Nintendo GameCube est un investissement plus que rentable.");
        $manager->persist($console3);
        
        $releaseDateWii = new DateTime();
        $console4 = new Console();
        $console4->setName('Wii')
            ->setSlug('wii')
            ->setThumbnail('img/fixtures/consoles/wii.jpg')
            ->setReleasePrice(249)
            ->setReleaseDate($releaseDateWii->setDate(2006, 12, 6))
            ->setDescription("La Wii est une console de jeux de salon du fabricant japonais Nintendo, sortie en 2006. Console de la septième génération, tout comme la Xbox 360 et la PlayStation 3 avec lesquelles elle est en rivalité, la Wii est la console de salon la plus vendue de sa génération avec 101,63 millions d'exemplaires écoulés en 2016. Elle a comme particularité d'utiliser un accéléromètre capable de détecter la position, l'orientation et les mouvements dans l'espace de la manette.

            La Wii a marqué un tournant dans l'histoire du jeu vidéo en ouvrant ce loisir à un public plus large, ciblant ainsi l'ensemble de la société, ce qui explique en partie son succès.");
        $manager->persist($console4);
        
        $releaseDateN64 = new DateTime();
        $console5 = new Console();
        $console5->setName('Nintendo 64')
            ->setSlug('nintendo-64')
            ->setThumbnail('img/fixtures/consoles/nintendo-64.png')
            ->setReleasePrice(150)
            ->setReleaseDate($releaseDateN64->setDate(1997, 9 ,1))
            ->setDescription("Le chiffre '64' pour les 64 bits de riches graphismes que la Nintendo 64 apporte dans votre télévision. Exploitant chaque astuce graphique existante, la Nintendo 64 vous invite à explorer des mondes époustouflants en 3D qui regorgent de couleurs, s'animent à l'aide d'effets graphiques en temps réel et séduisent vos oreilles avec un son de qualité CD.");
        $manager->persist($console5);
        
        $releaseDateSwitch = new DateTime();
        $console6 = new Console();
        $console6->setName('Nintendo Switch')
            ->setSlug('nintendo-switch')
            ->setThumbnail('img/fixtures/consoles/nintendo-switch.png')
            ->setReleasePrice(299)
            ->setReleaseDate($releaseDateSwitch->setDate(2017,3,3))
            ->setDescription("La Nintendo Switch est une console de jeux vidéo produite par Nintendo, succédant à la Wii U. Il s'agit de la première console hybride, c'est-à-dire multi modes, mise en vente de l'histoire, pouvant aussi bien faire office de console de salon que de console portable. Annoncée le 17 mars 2015 au cours d'une conférence de presse, présentée officiellement le 20 octobre 2016 et montrée plus en détail le 17 janvier 2017 lors d'une présentation en direct, elle est sortie mondialement le 3 mars 2017.");
        $manager->persist($console6);
        
        $releaseDateWiiU = new DateTime();
        $console7 = new Console();
        $console7->setName('Wii U')
            ->setSlug('wii-u')
            ->setThumbnail('img/fixtures/consoles/wii-u.png')
            ->setReleasePrice(299)
            ->setReleaseDate($releaseDateWiiU->setDate(2012,11,30))
            ->setDescription("La Wii U est la console qui va succéder à la Wii. Elle est annoncée le 7 juin 2011, durant l'E3 2011. La Wii U est la première console de salon à proposer une manette avec un écran tactile intégré, le Wii U GamePad. Les deux principales nouveautés de la console sont apportées par celui-ci. D'une part, le Wii U GamePad permet de continuer une partie, grâce à son écran intégré, même lorsque la télévision n'est pas disponible, mais cette fonctionnalité n'est pas présente avec tous les jeux. D'autre part en complément de manettes Wii, le contrôleur offre en multijoueur une expérience de jeu dite d'« informations asymétriques », c'est-à-dire que les joueurs ne disposent pas nécessairement des mêmes informations sur le GamePad par rapport à une manette et un écran de télévision traditionnels. Enfin, il s'agit de la première console de Nintendo à pouvoir générer des graphismes en haute définition.<br/><br/>
            Considérée comme une déception commerciale, la production de la console s'arrête en 2017, soit seulement 4 ans après sa sortie, pour laisser place à la Nintendo Switch.");
        $manager->persist($console7);

        $game1->addConsole($console1)->addConsole($console2);
        $game2->addConsole($console5)->addConsole($console6);
        $game3->addConsole($console4)->addConsole($console6);
        $game4->addConsole($console6);
        $game5->addConsole($console5);
        $game6->addConsole($console4)->addConsole($console3)->addConsole($console7);
        $game7->addConsole($console5);
        $game8->addConsole($console6)->addConsole($console7);


        /**
         * Genre
         */
        $genre1 = new Genre();
        $genre1->setName('Action');
        $manager->persist($genre1);

        $genre2 = new Genre();
        $genre2->setName('Aventure');
        $manager->persist($genre2);

        $genre2 = new Genre();
        $genre2->setName('Plateforme');
        $manager->persist($genre2);

        $game1->addGenre($genre1)->addGenre($genre2);
        $game2->addGenre($genre1)->addGenre($genre2);
        $game3->addGenre($genre2)->addGenre($genre2);
        $game4->addGenre($genre2)->addGenre($genre1);
        $game5->addGenre($genre1)->addGenre($genre2);
        $game6->addGenre($genre1)->addGenre($genre2);
        $game7->addGenre($genre1);
        $game8->addGenre($genre1)->addGenre($genre2);

        /**
         * Items
         */
        $item1 = new Item();
        $item1->setName('Champignon')
            ->setSlug('champignon')
            ->setThumbnail('img/fixtures/items/champignon.png')
            ->setDescription('Le champignon (ou simplement champi) est un objet qui apparaît généralement dans les spin-offs des jeux vidéo Mario. Son effet change selon les séries. Il a la même apparence que le super champignon. Selon les jeux où il apparait, il peut soit rendre des points de vie, donner un coup d\'accélération, ou encore doubler des dés. Quelque soit son rôle, ses effets restent toujours bénéfiques.');
        $manager->persist($item1);

        $item2 = new Item();
        $item2->setName('Bloc Surprise')
            ->setSlug('bloc-surprise')
            ->setThumbnail('img/fixtures/items/bloc-surprise.png')
            ->setDescription("Le bloc ? (anciennement Bloc Surprise) est un bloc jaune avec un point d'interrogation blanc inscrit dessus apparaissant très fréquemment dans la franchise Mario. Les blocs ? sont le plus souvent vus flottant dans l'air, contenant un objet ou des pièces. Ils peuvent également être invisibles. En tapant dans le bloc, ces derniers en sortent. À partir de Super Mario Bros. 3, il est possible de frapper un bloc autrement : avec un coup de queue de Mario raton-laveur ou Mario tanuki, avec un tournoiement de cape de Mario cape dans Super Mario World ou en lançant Cappy dessus (maintenir le bouton enfoncé pour récupérer plus de pièces) dans Super Mario Odyssey . À partir de New Super Mario Bros., il est possible de frapper les blocs depuis le dessus en faisant une Charge au sol.");
        $manager->persist($item2);

        $item3 = new Item();
        $item3->setName('Super étoile')
            ->setSlug('super-etoile')
            ->setThumbnail('img/fixtures/items/super-etoile.png')
            ->setDescription('Les super étoiles sont des objets apparaissant dans plusieurs jeux de la franchise Mario. Lorsque Mario entre en contact avec une super étoile, il devient invincible. La super étoile a été introduite dès Super Mario Bros..');
        $manager->persist($item3);

        $item4 = new Item();
        $item4->setName('Pièce')
            ->setSlug('piece')
            ->setThumbnail('img/fixtures/items/piece.png')
            ->setDescription('Les pièces sont la principale monnaie dans le Royaume Champignon. Elles apparaissent dans presque toute la franchise Mario. Les pièces ont des effets différents selon les jeux : dans les opus de plates-formes, elles augmentent le score, et après en avoir amassé un certain nombre, les pièces donnent des vies. Dans les jeux de rôle, elles servent à acheter différents objets.');
        $manager->persist($item4);

        $item5 = new Item();
        $item5->setName('Épée de Légende')
            ->setSlug('epee-de-legende')
            ->setThumbnail('img/fixtures/items/epee-de-legende.png')
            ->setDescription('L’Épée de Légende, aussi appelée Excalibur ou Master Sword, est l\'épée la plus emblématique de la série des Zelda. Elle sert à repousser le mal, ou plus généralement repousser Ganon, mais elle sert aussi à acquérir de nouveaux pouvoirs. Elle est souvent associée avec le Bouclier d\'Hylia.');
        $manager->persist($item5);

        $item6 = new Item();
        $item6->setName('Rubis')
            ->setSlug('rubis')
            ->setThumbnail('img/fixtures/items/rubis.png')
            ->setDescription('Les rubis sont la monnaie de la série Zelda. Ils apparaissent dans tous les opus, à l\'exception de The Adventure of Link où il n\'y a pas de monnaie, et Four Swords Adventures où ils sont remplacés par les gemmes de force. Ils servent aussi de monnaie dans Hyrule Warriors.');
        $manager->persist($item6);

        $item7 = new Item();
        $item7->setName('Bombe')
            ->setSlug('bombe')
            ->setThumbnail('img/fixtures/items/bombe.png')
            ->setDescription('Les bombes sont des objets récurrents dans la série Zelda.<br/><br/>
            Elles sont présentes dans tous les jeux, sauf The Adventure of Link. Cannon, le marchand de bombes et Crahmé sont considérés comme des artistes de la fabrication de bombes et d\'engins explosifs. Pour cela, ils ont pignon sur rue en ville. Les bombes sont généralement obtenues au début de chaque jeu, et elles sont généralement stockées dans un sac de Bombes. Si votre bombe vous explose dessus, vous perdez des cœurs. Depuis leur première apparition, elles ont gardé une apparence similaire, jusqu\'à Twilight Princess, où elles ont reçu une apparence plus réaliste. Il existe même un livre consacré à l\'utilisation des bombes dans Link\'s Awakening.');
        $manager->persist($item7);

        $item8 = new Item();
        $item8->setName('Grappin')
            ->setSlug('grappin')
            ->setThumbnail('img/fixtures/items/grappin.png')
            ->setDescription('Le grappin est un objet récurrent de la série. Il permet à Link de se tracter vers un endroit éloigné ou au contraire de ramener un objet vers lui.');
        $manager->persist($item8);


        /**
         * GameItems
         */
        $aGamesItemsData = array(
            array(
                'item' => $item1,
                'game' => $game1,
                'thumbnail' => 'img/fixtures/games-items/champignon-super-mario-bros-3.png',
            ),
            array(
                'item' => $item2,
                'game' => $game1,
                'thumbnail' => 'img/fixtures/games-items/bloc-surprise-super-mario-bros-3.jpg',
            ),
            array(
                'item' => $item2,
                'game' => $game3,
                'thumbnail' => 'img/fixtures/games-items/bloc-surprise-super-mario-galaxy.png',
            ),
            array(
                'item' => $item2,
                'game' => $game4,
                'thumbnail' => 'img/fixtures/games-items/bloc-surprise-super-mario-odyssey.png',
            ),
            array(
                'item' => $item3,
                'game' => $game1,
                'thumbnail' => 'img/fixtures/games-items/super-etoile-super-mario-bros-3.jpg',
            ),
            array(
                'item' => $item3,
                'game' => $game3,
                'thumbnail' => 'img/fixtures/games-items/super-etoile-super-mario-galaxy.jpg',
            ),
            array(
                'item' => $item4,
                'game' => $game1,
                'thumbnail' => 'img/fixtures/games-items/piece-super-mario-bros-3.png',
            ),
            array(
                'item' => $item4,
                'game' => $game2,
                'thumbnail' => 'img/fixtures/games-items/piece-super-mario-64.png',
            ),
            array(
                'item' => $item4,
                'game' => $game3,
                'thumbnail' => 'img/fixtures/games-items/piece-super-mario-galaxy.png',
            ),
            array(
                'item' => $item4,
                'game' => $game4,
                'thumbnail' => 'img/fixtures/games-items/piece-super-mario-odyssey.png',
            ),
            array(
                'item' => $item5,
                'game' => $game6,
                'thumbnail' => 'img/fixtures/games-items/master-sword-ocarina-of-time.jpg',
            ),
            array(
                'item' => $item5,
                'game' => $game7,
                'thumbnail' => 'img/fixtures/games-items/master-sword-twilight-princess.png',
            ),
            array(
                'item' => $item5,
                'game' => $game8,
                'thumbnail' => 'img/fixtures/games-items/master-sword-breath-of-the-wild.png',
            ),
            array(
                'item' => $item6,
                'game' => $game5,
                'thumbnail' => 'img/fixtures/games-items/rubis-ocarina-of-time.png',
            ),
            array(
                'item' => $item6,
                'game' => $game6,
                'thumbnail' => 'img/fixtures/games-items/rubis-ocarina-of-time.png',
            ),
            array(
                'item' => $item6,
                'game' => $game7,
                'thumbnail' => 'img/fixtures/games-items/rubis-twilight-princess.png',
            ),
            array(
                'item' => $item6,
                'game' => $game8,
                'thumbnail' => 'img/fixtures/games-items/rubis-breath-of-the-wild.jpg',
            ),
            array(
                'item' => $item7,
                'game' => $game6,
                'thumbnail' => 'img/fixtures/games-items/bombe-ocarina-of-time.png',
            ),
            array(
                'item' => $item7,
                'game' => $game7,
                'thumbnail' => 'img/fixtures/games-items/bombe-twilight-princess.png',
            ),
            array(
                'item' => $item7,
                'game' => $game8,
                'thumbnail' => 'img/fixtures/games-items/bombe-breath-of-the-wild.png',
            ),
            array(
                'item' => $item7,
                'game' => $game5,
                'thumbnail' => 'img/fixtures/games-items/bombe-ocarina-of-time.png',
            ),
        );

        foreach($aGamesItemsData as $aData){
            $gameItem = new GameItem();
            $gameItem->setGame($aData['game'])
                    ->setItem($aData['item'])
                    ->setThumbnail($aData['thumbnail']);
            $manager->persist($gameItem);
        }

        /**
         * Character
         */
        $character1 = new Character();
        $character1->setName('Mario')
            ->setSlug('mario')
            ->setThumbnail('img/fixtures/characters/mario.png')
            ->setDescription("Mario est le personnage principal de la longue série Mario. Il a été créé par le concepteur japonais Shigeru Miyamoto et sert aussi de mascotte principale de Nintendo.<br/><br/>
            Mario fait sa première apparition en tant que protagoniste dans le jeu d'arcade Donkey Kong, sorti en 1981, appelé \"Jumpman\" par les joueurs. Il possède son nom définitif à partir de Mario Bros. Depuis Super Mario Bros, ses plus notables capacités sont son saut, avec lequel il bat la plupart de ses ennemis, et sa capacité à changer de taille et de pouvoir avec divers éléments, tels que le Super champignon ou la Fleur de feu.<br/><br/>
            Les jeux dans lesquels il est présent ont dépeint Mario comme un personnage silencieux avec une personnalité distincte (course à la Fortune est une exception notable), ce qui lui permet de s'adapter à différents genres et rôles. Dans la plupart des jeux, il est le héros qui part à l'aventure pour sauver la Princesse Peach du roi Bowser, mais il a été montré en faisant d'autres activités,, comme de la course et du sport.")
            ->setGender('H');
        $manager->persist($character1);
        
        $character2 = new Character();
        $character2->setName('Bowser')
            ->setSlug('bowser')
            ->setThumbnail('img/fixtures/characters/bowser.png')
            ->setDescription("Bowser, de son nom complet Roi Bowser Koopa Sr., est le principal antagoniste de l'Univers de Mario, et le boss final de beaucoup de jeux de la franchise. Il est le roi des Koopa, mais beaucoup d'autres espèces lui obéissent, et forme une grande armée pour l'aider à conquérir le Royaume Champignon. Il a un fils du nom de Bowser Jr.<br/><br/>
            Sa principale activité consiste à enlever la princesse du Royaume Champignon afin de pouvoir régner sur le royaume, ce qui fait de lui l'ennemi principal de Mario et ses amis.<br/><br/>
            À l'instar du Dr. Eggman ou encore de Ganondorf, il est l'un des méchants les plus reconnaissables du monde des jeux vidéos.")
            ->setGender('H');
        $manager->persist($character2);
        
        $character3 = new Character();
        $character3->setName('Luigi')
            ->setSlug('luigi')
            ->setThumbnail('img/fixtures/characters/luigi.png')
            ->setDescription("Luigi (surnommé Moustache verte par Bowser) est le petit frère de Mario. Il est plus grand, plus maigre, saute plus haut et a aussi d'autres talents cachés, apparaissant pour la première fois dans Mario Bros.. Luigi s'est toujours battu avec Mario à plusieurs reprises. Luigi et Mario ont toujours sauvé Peach. Il surmonte parfois la garde du Château de Peach ou la maison de Mario avec lequel il cohabite.")
            ->setGender('H');
        $manager->persist($character3);
        
        $character4 = new Character();
        $character4->setName('Link')
            ->setSlug('link')
            ->setThumbnail('img/fixtures/characters/link.png')
            ->setDescription("Link est un personnage dont l’histoire, l'apparence et l’âge peuvent varier au cours des jeux.<br/><br/>
            De manière générale, on peut le décrire comme un jeune garçon, dont l'âge ne dépasse jamais dix-neuf ans, qui va être amené à quitter son foyer pour partir en voyage afin de combattre les forces du mal. Bien qu'il ne semble pas connaître très bien le maniement des armes au début des jeux, il maîtrise rapidement de nouvelles techniques et se constitue un arsenal varié (l'épée restant son arme fétiche), apprend quelques fois la magie, traverse des donjons, pour devenir finalement un héros légendaire.<br/><br/>
            Link est presque toujours orphelin et fait partie du peuple des Hyliens. Par conséquent, ses oreilles sont pointues. D'autres traits physiques reviennent à travers les jeux, comme ses cheveux clairs (blonds ou bruns), ses yeux bleus (parfois marrons/verts), et le fait qu'il soit gaucher (à l'exception des opus Wii et de Breath of the Wild). Sa main gauche possède d'ailleurs parfois le symbole de la Triforce du Courage, dont il est souvent le détenteur. Il porte une tunique verte dans tous les jeux de la saga, mais peut être amené à obtenir d'autres tenues ou à se transformer.<br/><br/>
            On peut difficilement avoir une idée de la personnalité de Link car il ne parle jamais, excepté de manière indirecte pour répondre à certaines questions posées par d'autres personnages. Cela est voulu par les développeurs, afin de facilité l'identification au personnage par le joueur. Cependant il est souvent qualifié de jeune homme modeste et courageux toujours prêt à aider ceux qui en ont besoin. Il semble toutefois être assez paresseux, étant donné que presque tous les jeux commencent par une scène où Link dort ou somnole, afin de symboliser son éveil en tant que héros.<br/><br/>
            Dans Breath of the Wild, une explication de son choix mutique est apportée grâce au journal intime de Zelda. Link resterait muet à cause de sa peur de décevoir les gens qui comptent tous sur lui. Le poids de ses responsabilités l'auraient ainsi plongé dans un profond mutisme. Zelda avoue même trouver cela angoissant car elle ne peut deviner ses pensées et peut donc difficilement cerner sa personnalité.")
            ->setGender('H');
        $manager->persist($character4);
        
        $character5 = new Character();
        $character5->setName('Zelda')
            ->setSlug('zelda')
            ->setThumbnail('img/fixtures/characters/zelda.png')
            ->setDescription("La Princesse Zelda est un personnage central de la série The Legend of Zelda. Bien que la série doive son nom à ce personnage, il ne s'agit pas d'un personnage jouable dans la série principale et elle n'est pas non plus le personnage principal. Il y a même certains jeux où elle n'apparaît pas ou très peu (comme Majora's Mask ou encore Tri Force Heroes). Il s'agit d'un membre de la famille royale d'Hyrule. Elle est la plupart du temps enlevée par Ganondorf, Vaati ou un autre antagoniste et Link doit la secourir. Comme Link, elle a de nombreuses incarnations au fil des jeux.")
            ->setGender('F');
        $manager->persist($character5);
        
        $character6 = new Character();
        $character6->setName('Tingle')
            ->setSlug('tingle')
            ->setThumbnail('img/fixtures/characters/tingle.png')
            ->setDescription("C'est un Hylien, de trente-cinq ans dans Majora's Mask, obsédé par les \"fées des bois\", et il se dit lui-même être \"l'absolue réincarnation d'une fée\". En voyant Link , Tingle pense être face à l'une de ses fées des bois, apparemment à cause des vêtements verts que Link porte, exactement comme Tingle. Il a des talents de cartographe qui seront utiles à notre héros dans plusieurs jeux. Il flotte parfois à l'aide d'un ballon rouge. Il est très bizarre, c'est l'un des personnages les plus excentriques de la série. Il possède aussi deux frères, Dingle et Klingle ; et un frère adoptif, David Junior, qui n'est pas beaucoup aimé des trois autres.")
            ->setGender('H');
        $manager->persist($character6);

        /**
         * GameCharacter
         */
        $aGamesCharactersData = array(
            array(
                'character' => $character1,
                'game' => $game1,
                'thumbnail' => 'img/fixtures/games-characters/mario-super-mario-bros-3.jpg',
            ),
            array(
                'character' => $character1,
                'game' => $game2,
                'thumbnail' => 'img/fixtures/games-characters/mario-super-mario-64.jpg',
            ),
            array(
                'character' => $character1,
                'game' => $game3,
                'thumbnail' => 'img/fixtures/games-characters/mario-super-mario-galaxy.jpg',
            ),
            array(
                'character' => $character1,
                'game' => $game4,
                'thumbnail' => 'img/fixtures/games-characters/mario-super-mario-odyssey.jpg',
            ),
            array(
                'character' => $character2,
                'game' => $game1,
                'thumbnail' => 'img/fixtures/games-characters/bowser-super-mario-bros-3.jpg',
            ),
            array(
                'character' => $character2,
                'game' => $game2,
                'thumbnail' => 'img/fixtures/games-characters/bowser-mario-64.png',
            ),
            array(
                'character' => $character2,
                'game' => $game3,
                'thumbnail' => 'img/fixtures/games-characters/bowser-mario-galaxy.jpg',
            ),
            array(
                'character' => $character2,
                'game' => $game4,
                'thumbnail' => 'img/fixtures/games-characters/bowser-mario-odyssey.png',
            ),
            array(
                'character' => $character3,
                'game' => $game1,
                'thumbnail' => 'img/fixtures/games-characters/luigi-super-mario-bros-3.png',
            ),
            array(
                'character' => $character3,
                'game' => $game3,
                'thumbnail' => 'img/fixtures/games-characters/luigi-mario-galaxy.jpg',
            ),
            array(
                'character' => $character3,
                'game' => $game4,
                'thumbnail' => 'img/fixtures/games-characters/lungi-mario-odyssey.jpg',
            ),
            array(
                'character' => $character4,
                'game' => $game7,
                'thumbnail' => 'img/fixtures/games-characters/link-ocarina-of-time.png',
            ),
            array(
                'character' => $character4,
                'game' => $game5,
                'thumbnail' => 'img/fixtures/games-characters/lnik-majora-mask.png',
            ),
            array(
                'character' => $character4,
                'game' => $game6,
                'thumbnail' => 'img/fixtures/games-characters/link-twilight-princess.png',
            ),
            array(
                'character' => $character4,
                'game' => $game8,
                'thumbnail' => 'img/fixtures/games-characters/link-breath-of-the-wild.png',
            ),
            array(
                'character' => $character5,
                'game' => $game7,
                'thumbnail' => 'img/fixtures/games-characters/zelda-ocarina-of-time.png',
            ),
            array(
                'character' => $character5,
                'game' => $game6,
                'thumbnail' => 'img/fixtures/games-characters/zelda-twilight-pricess.png',
            ),
            array(
                'character' => $character5,
                'game' => $game8,
                'thumbnail' => 'img/fixtures/games-characters/zelda-breath-of-the-wild.png',
            ),
            array(
                'character' => $character6,
                'game' => $game5,
                'thumbnail' => 'img/fixtures/games-characters/tingle-majora-mask.png',
            ),
        );

        foreach($aGamesCharactersData as $aData){
            $gameCharacter = new GameCharacter();
            $gameCharacter->setGame($aData['game'])
                ->setCurrentCharacter($aData['character'])
                ->setThumbnail($aData['thumbnail']);
            $manager->persist($gameItem);
        }


        $manager->flush();
    }
}
