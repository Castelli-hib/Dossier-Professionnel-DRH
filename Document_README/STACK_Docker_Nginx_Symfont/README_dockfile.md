Dockerfile expliqué
FROM php:8.2-fpm

# On part d’une image officielle PHP 8.2 avec PHP-FPM.

PHP-FPM = moteur qui exécute le PHP
Nginx ne sait pas exécuter du PHP seul
Donc : Nginx → envoie à PHP-FPM → PHP exécute Symfony

RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_mysql zip

**Partie 1 : installer des outils système**
apt-get update      → met à jour la liste des paquets Linux
libzip-dev          → nécessaire pour gérer les archives zip
zip / unzip         → Symfony utilise des archives
git                 → Composer télécharge des dépendances depuis GitHub

**Partie 2 : installer extensions PHP**
docker-php-ext-install pdo pdo_mysql zip
pdo                 → abstraction base de données
pdo_mysql           → connexion MySQL
zip                 → gestion archives (Symfony en a besoin)

Sans pdo_mysql, Symfony ne pourra pas se connecter à MySQL.

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
Ligne intelligente.

Ça signifie :
On prend Composer depuis l’image officielle composer:2
On copie uniquement le binaire
On évite d’installer Composer manuellement

Résultat : le conteneur PHP aura Composer prêt à l’emploi.

WORKDIR /var/www/html
Définit le dossier de travail par défaut.

Quand :
docker compose exec php bash

directement ici :
/var/www/html

Ce dossier correspond à :
C:\ENV\DRH\symfony

Grâce au volume :

volumes:
  - ./symfony:/var/www/html

Donc :
Ce que Composer installe dans le conteneur
Apparaît immédiatement dans le dossier Windows

**Résumé architectural**

Après build :

Nginx  --->  PHP-FPM (ton Dockerfile)
                      |
                      ↓
                 Symfony (dans ./symfony)
                      |
                      ↓
                   MySQL

**Pourquoi on installe Symfony dans le conteneur ?**

Les dépendances sont Linux
Les extensions PHP sont Linux
L’environnement est identique à la production

évite les conflits Windows

- Important avant composer create-project

S'assurer :

docker compose up -d --build
se termine sans erreur.

Puis vérifie :
docker compose ps

Tu dois voir :

drh_db
drh_app
drh_nginx

ensuite :
docker compose exec php bash