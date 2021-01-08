# Licences Nintendo

Ce site liste les licences, jeux, personnages, objets et consoles de l'univers Nintendo. Un backoffice permet de gérer les différentes entités.

## Installation et configuration

### Pré-requis


Pour lancer ce projet, il faudra au préalable avoir la commande [**Symfony**](https://symfony.com/download), [**NodeJs**](https://nodejs.org/en/download/) et [**composer**](https://getcomposer.org/) d'installer sur votre machine.

### Installation


Téléchargez l'archive du projet et décompréssez là sur votre machine

Allez dans le dossier du projet et installez les dépendences avec composer.
```shell
cd /path/of/projet
composer install
```

### Paramétrage de la base de données


Modifiez la variable `DATABASE_URL` dans le fichier `.env` à la racine du projet, pour y mettre les informations de connexion à votre base de données MySQL (si vous testez le projet en local sur votre ordinateur, vous pouvez utilisez les bases de données MySQL de [**Wamp**](https://www.wampserver.com/#download-wrapper))

```
# Exemple avec les accès par défaut de Wamp

DATABASE_URL=mysql://root:@127.0.0.1:3306/license_nintendo?serverVersion=5.7
```

Créez et remplissez la base de données en utilisants les commandes fournis par Symfony

```shell
# Crée la base de données

php bin/console doctrine:database:create

# Crée les tables 

php bin/console doctrine:migrations:migrate

# Remplis la base à partir des fixtures du projet

php bin/console doctrine:fixtures:load
```
### Installer et lancer WebPack Encore


Installez webpack en lançant la commande suivante

```shell
npm install --force
```

Lancez WebPack en lançant la commande suivante

```shell
npm run build
```

## Accéder au site

Si souhaitez lancer le site sur votre ordinateur en local, éxécutez la commande suivante à la racine du projet. Si vous êtes sur un serveur dédié, vous pouvez accéder au site depuis le nom de domaine lié au dossier où vous avez installé le projet.

```shell
symfony server:start
```

Le site est maintenant accèssible [en local] (http://localhost:8000/)

## Tests unitaires

Pour lancer les tests unitaires du projet, allez à la racine du projet et lancer la commande suivante.

```shell
cd /path/of/projet
php bin/phpunit
```