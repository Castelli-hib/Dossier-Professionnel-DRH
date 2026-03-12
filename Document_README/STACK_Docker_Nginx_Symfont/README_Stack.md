# Docker

Rôle ici : orchestration des conteneurs

Conteneurs :
drh_app → PHP-FPM + Symfony
drh_nginx → Nginx
drh_db → MySQL

**Docker gère réseaux, volumes, isolation**
Commandes principales utilisées :
docker compose up -d --build        → démarre tout le stack
docker compose exec php bash        → entrer dans le conteneur PHP

## Nginx

Rôle : serveur web
Reçoit les requêtes HTTP du navigateur
Transfère les fichiers .php à PHP-FPM via fastcgi_pass
Sert les fichiers statiques (public/) directement

Config principale : nginx/conf.d/default.conf
root → /var/www/html/public
location / → redirige vers index.php

### Symfony (dans PHP-FPM)

Rôle : application web / logique métier
Contient ton code : src/, config/, public/, var/
Symfony interagit avec MySQL via Doctrine/PDO

Commandes Composer utilisées :
composer create-project symfony/skeleton .          → crée ton projet
php bin/console ...                                 → commandes Symfony dans le conteneur

**Résumé simple**
Composant	            Rôle principal	            Actions
Docker	                Orchestration	            Crée conteneurs, réseau, volumes
Nginx	                Serveur HTTP	            Reçoit requêtes, redirige PHP-FPM
PHP-FPM + Symfony	    Application	                Exécute code PHP, parle à MySQL
MySQL	                Base de données	            Stocke données DRH

┌────────────────────────────┐
│        NAVIGATEUR          │  ← http://localhost:8888
└───────────────┬────────────┘
                │
                ▼
   ┌────────────────────────┐
   │        NGINX           │  ← Conteneur : drh_nginx
   │ - Serveur web           │
   │ - Sert /public          │
   │ - Transfert PHP → PHP-FPM│
   └───────────────┬────────┘
                   │
                   ▼
   ┌────────────────────────┐
   │      PHP-FPM           │  ← Conteneur : drh_app
   │ - Symfony installé      │
   │ - Exécute index.php     │
   │ - Utilise Doctrine/PDO  │
   └───────────────┬────────┘
                   │
                   ▼
   ┌────────────────────────┐
   │        MySQL           │  ← Conteneur : drh_db
   │ - Base de données drh  │
   │ - Stocke utilisateurs, │
   │   données, paramètres  │
   └────────────────────────┘

Volumes persistants : 
    - ./symfony     ↔ /var/www/html (code Symfony local)
    - db_data       ↔ /var/lib/mysql (données MySQL persistantes)

Réseau Docker : drh_default → tous les conteneurs communiquent entre eux