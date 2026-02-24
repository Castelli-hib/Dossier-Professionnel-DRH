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
Commande	Rôle
docker network create	Créer un réseau
docker network ls	Lister réseaux
docker network inspect	Inspecter
docker network rm	Supprimer


5️⃣ 🐳 Docker Compose (Orchestration)
Commande	Rôle
docker compose up -d	Démarrer services
docker compose down	Arrêter services
docker compose ps	Voir services actifs
docker compose logs	Voir logs
docker compose build	Construire images
docker compose restart	Redémarrer


6️⃣ 🔍 Inspection & Debug
Commande	Rôle
docker inspect	Infos détaillées
docker stats	Utilisation CPU/RAM
docker top	Processus internes
docker system df	Espace disque
docker system prune	Nettoyage global