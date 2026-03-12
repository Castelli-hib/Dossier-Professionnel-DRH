installer Symfony

# Créer projet Symfony dans le conteneur PHP.

**Commande à lancer**

Depuis C:\ENV\DRH :
docker compose exec php composer create-project symfony/skeleton .

**Ce que ça fait**

docker compose exec php     → entre dans le conteneur PHP
composer create-project     → télécharge Symfony
.                           → installe dans le dossier courant (/var/www/html)

Grâce au volume :

- ./symfony:/var/www/html

Le projet sera créé dans ton dossier local C:\ENV\DRH\symfony

**Important**

S'assurer que le dossier existe :
C:\ENV\DRH\symfony

**Sinon le créer avant :**
mkdir symfony

**Après installation**
Le conteneur PHP va télécharger Symfony (version minimale)
Symfony sera installé dans /var/www/html        → ton dossier C:\ENV\DRH\symfony sera rempli automatiquement

Nginx pourra ensuite servir la page /public/index.php
Astuce : si ça  demande de remplacer des fichiers existants, taper yes ou y (normalement pour un dossier vide, ça ira directement).

### Après l’installation,  vérifier avec :
docker compose exec php ls -l
Pour voir que bin/, config/, public/ etc. sont bien là.

**Résultat : ls -l**

bin
composer.json
composer.lock
config
public
src
symfony.lock
var
vendor


**Explication des dossiers/fichiers :**
Élément	                    Rôle
bin/	                    Contient les fichiers exécutables Symfony, notamment console
composer.json	            Liste les dépendances PHP de ton projet
composer.lock	            Versions exactes installées pour garantir la stabilité
config/	                    Paramètres de Symfony (routes, services, packages)
public/	                    Dossier accessible par Nginx → contient index.php
src/	                    Le code PHP, classes, contrôleurs, entités…
symfony.lock	            Verrouillage des packages Symfony internes
var/	                    Cache, logs, sessions
vendor/	                    Toutes les librairies téléchargées par Composer

**Ce que ça veut dire pour Nginx**
Nginx sert les fichiers depuis /var/www/html/public
Le fichier index.php est la porte d’entrée Symfony

Donc quand tu vas sur :

## Tester dans navigateur :
[http://localhost:8888]

On doit voir :
Welcome to Symfony

## Résumé :
               ┌───────────────┐
               │   Navigateur  │
               │ localhost:8888│
               └───────┬───────┘
                       │ HTTP (80 → 8888)
                       ▼
               ┌───────────────┐
               │   Nginx       │
               │ drh_nginx     │
               └───────┬───────┘
                       │ PHP-FPM (via fastcgi_pass php:9000)
                       ▼
               ┌───────────────┐
               │ PHP-FPM       │
               │ drh_app       │
               │ (Symfony)     │
               └───────┬───────┘
                       │ Doctrine / PDO MySQL
                       ▼
               ┌───────────────┐
               │ MySQL         │
               │ drh_db        │
               │ Base : drh    │
               └───────────────┘
Navigateur → Nginx → PHP-FPM/Symfony → MySQL
1-Navigateur → Nginx
    accès à [http://localhost:8888]
    Nginx reçoit la requête HTTP

2-Nginx → PHP-FPM (Symfony)
    Nginx transfère les fichiers .php à PHP-FPM (drh_app)
    Symfony se trouve dans /var/www/html (volume ./symfony:/var/www/html)
    Le fichier d’entrée est /public/index.php

3-PHP-FPM → MySQL
    Symfony utilise PDO pour se connecter à MySQL (drh_db)
    Connection via DATABASE_URL="mysql://drh_user:drh_pass@database:3306/drh"

4-Volumes et persistances
    Code Symfony            → dossier local C:\ENV\DRH\symfony
    Base de données MySQL   → volume Docker db_data (persistant même si les conteneurs sont supprimés)


### Installation des packs complémentaires
docker compose exec php composer require symfony/orm-pack
        - symfony/orm-pack → installe Doctrine ORM + intégration Symfony
        - Il va aussi installer doctrine/doctrine-bundle et doctrine/dbal pour la connexion MySQL
  
**Do you want to include Docker configuration from recipes?**
    [y] Yes
    [n] No
    [p] Yes permanently, never ask again for this project
    [x] No permanently, never a

Symfony Flex détecte que je suis dans un projet Dockerisé et te propose de créer automatiquement des fichiers de configuration Docker pour Symfony.
Options :

Option	Ce que ça fait
y	Oui, créer les fichiers Docker pour ce projet (temporaire)
n	Non, ne pas créer pour ce projet (je pourrais toujours le faire toi-même)
p	Oui, et ne plus jamais me demander pour ce projet
x	Non, et ne plus jamais me demander pour ce projet

n = Comme ça Symfony ne touchera pas à mon Docker, je gardes le contrôle.
      
      
#### Installer Doctrine ORM et MySQL support
C:\ENV\DRH> docker compose exec php composer require symfony/orm-pack
Si tout est correct → Symfony crée la base drh dans MySQL

**Vérifier la connexion**
docker compose exec php php bin/console doctrine:query:sql "SELECT 1"

Symfony n’a pas vraiment de commande database:connect une fois Doctrine installé, mais tu peux faire :
docker compose exec php php bin/console doctrine:query:sql "SELECT 1"

Si ça retourne 1 → connexion OK 

Ou directement depuis MySQL :
docker compose exec database mysql -u drh_user -p drh

Mot de passe : drh_pass
Puis :

SHOW TABLES;
SELECT DATABASE();
mysql> SHOW TABLES;
Empty set
mysql> SELECT DATABASE();
+------------+
| DATABASE() |
+------------+
| drh        |
+------------+
La base drh existe bien
Cconnection avec drh_user / drh_pass

**Étape suivante**

Une fois la base validée :

docker compose exec php php bin/console make:entity
docker compose exec php php bin/console doctrine:schema:update --force

Crée tes tables pour ton projet DRH
Symfony → MySQL est prêt