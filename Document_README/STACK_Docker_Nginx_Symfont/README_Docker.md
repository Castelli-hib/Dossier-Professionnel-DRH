# Catégories de commandes Docker

(ou Commandes par composant Docker)

Gestion des images
Gestion des conteneurs
Gestion des volumes
Gestion des réseaux
Docker Compose
Inspection & Debug

## TABLEAU GLOBAL DES COMMANDES DOCKER

**Gestion des Images**
Commande	                        Rôle
docker pull image	                Télécharger une image
docker build -t nom .	            Construire une image
docker images	                    Lister les images
docker rmi image	                Supprimer une image
docker tag	                        Renommer / versionner une image

**Gestion des Conteneurs**
Commande	                        Rôle
docker run	                        Créer et lancer un conteneur
docker ps	                        Voir conteneurs actifs
docker ps -a	                    Voir tous les conteneurs
docker stop	                        Arrêter un conteneur
docker start	                    Démarrer un conteneur arrêté
docker restart	                    Redémarrer
docker rm	                        Supprimer un conteneur
docker logs	                        Voir les logs
docker exec -it	                    Entrer dans le conteneur

**Gestion des Volumes**
Commande	                        Rôle
docker volume create	            Créer un volume
docker volume ls	                Lister volumes
docker volume inspect	            Inspecter
docker volume rm	                Supprimer volume


**Gestion des Réseaux**
Commande	                        Rôle
docker network create	            Créer un réseau
docker network ls	                Lister réseaux
docker network inspect	            Inspecter
docker network rm	                Supprimer


**Docker Compose (Orchestration)**
Commande	                        Rôle
docker compose up -d	            Démarrer services
docker compose down	                Arrêter services
docker compose ps	                Voir services actifs
docker compose logs	                Voir logs
docker compose build	            Construire images
docker compose restart	            Redémarrer


**Inspection & Debug**
Commande	                        Rôle
docker inspect	                    Infos détaillées
docker stats	                    Utilisation CPU/RAM
docker top	                        Processus internes
docker system df	                Espace disque
docker system prune	                Nettoyage global

### Commandes Docker utiles

docker compose up -d            # Démarre tous les services
docker compose ps               # Vérifie que tout tourne
docker compose logs web         # Logs Nginx
docker compose logs php         # Logs Symfony
docker compose logs phpmyadmin  # Logs PhpMyAdmin
docker compose down             # Arrête et supprime les conteneurs

Accès rapide
Service	URL / Port
Symfony	http://localhost:8080
PhpMyAdmin	http://localhost:8081

Utilisateur BDD : drh_user
Mot de passe : drh_pass


1-Création du dossier nginx 
C:\ENV\DRH> mkdir nginx
Répertoire : C:\ENV\DRH

Mode                 LastWriteTime         Length Name
----                 -------------         ------ ----
d-----        24/02/2026     13:55                nginx

PS C:\ENV\DRH> mkdir nginx\conf.d


Répertoire : C:\ENV\DRH\nginx
Mode                 LastWriteTime         Length Name
----                 -------------         ------ ----
d-----        24/02/2026     13:55                conf.d

PS C:\ENV\DRH> New-Item nginx\conf.d\default.conf -ItemType File


Répertoire : C:\ENV\DRH\nginx\conf.d
Mode                 LastWriteTime         Length Name
----                 -------------         ------ ----
-a----        24/02/2026     13:56              0 default.conf





PS C:\ENV\DRH> docker compose up -d
time="2026-02-24T13:57:33+01:00" level=warning msg="C:\\ENV\\DRH\\compose.yaml: the attribute `version` is obsolete, it will be ignored, please remove it to avoid potential confusion"
[+] Running 24/2
 ✔ database Pulled                  16.4s 
 ✔ php Pulled                       15.1s 
[+] Running 4/5
 ✔ Network drh_default   Created                                                                                                                                                                                                           0.0s 
 ✔ Volume "drh_db_data"  Created                                                                                                                                                                                                           0.0s 
 ✔ Container drh_db      Started                                                                                                                                                                                                           0.8s 
 ✔ Container drh_app     Started                                                                                                                                                                                                           0.6s 
 - Container drh_nginx   Starting                                                                                                                                                                                                          0.7s 
- 
Error response from daemon: driver failed programming external connectivity on endpoint drh_nginx (61b6e53679b959e834e7057639ab27c8443bdc8610fbca8b84087acc0ec7523c): Bind for 0.0.0.0:8080 failed: port is already allocated
PS C:\ENV\DRH> docker compose ps
time="2026-02-24T13:58:29+01:00" level=warning msg="C:\\ENV\\DRH\\compose.yaml: the attribute `version` is obsolete, it will be ignored, please remove it to avoid potential confusion"
NAME      IMAGE         COMMAND                  SERVICE    CREATED          STATUS          PORTS
drh_app   php:8.2-fpm   "docker-php-entrypoi…"   php        39 seconds ago   Up 38 seconds   9000/tcp
drh_db    mysql:8       "docker-entrypoint.s…"   database   40 seconds ago   Up 38 seconds   0.0.0.0:3306->3306/tcp, 33060/tcp
PS C:\ENV\DRH> 