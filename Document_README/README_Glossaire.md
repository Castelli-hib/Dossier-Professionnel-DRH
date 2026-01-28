Glossaire technique – Projet DRH
Terme	                            Définition	                                                Version orale / synthèse
API JSON	                        Interface permettant l’échange de données 
                                    entre le back-end et le front-end au format JSON. 
                                    Facilite le rendu dynamique côté client 
                                    et la communication entre services.	                        « Une API JSON permet de transmettre des données entre le serveur et l’interface utilisateur. »

Back-end	                        Partie serveur de l’application qui gère la 
                                    logique métier, le traitement des données, 
                                    la sécurité et les interactions avec la base de données.	« Le back-end gère la logique métier et les données du projet. »

Base relationnelle	                Système de stockage structuré (ex : MySQL) qui organise 
                                    les données en tables avec relations, 
                                    clés primaires et étrangères.	                            « La base relationnelle stocke et organise les données critiques. »

Base NoSQL	                        Système de stockage non structuré (ex : MongoDB) 
                                    adapté aux données volumineuses ou non normalisées 
                                    comme les logs et statistiques.	                            « La base NoSQL stocke des données non structurées ou volumineuses. »

CRUD	                            Acronyme de Create, Read, Update, Delete. 
                                    Ensemble des opérations de base sur les données.	        « CRUD désigne créer, lire, modifier et supprimer des données. »

Docker	                            Outil de conteneurisation qui permet de standardiser 
                                    l’environnement de développement et de déploiement, garantissant 
                                    la reproductibilité et l’isolation des services.	        « Docker standardise et isole les environnements de développement et production. »

Git / GitHub	                    Outils de gestion de versions permettant de suivre 
                                    l’historique des modifications, collaborer et centraliser 
                                    les livrables techniques.	                                « Git et GitHub gèrent le versionnage et la collaboration sur le code. »

MoSCoW	                            Méthode de priorisation des exigences fonctionnelles : 
                                    Must, Should, Could, Won’t have. Permet de définir 
                                    le périmètre et organiser le développement.	                « MoSCoW priorise les besoins selon leur importance. »

Backlog                             produit	Liste organisée des tâches et user stories 
                                    issues de MoSCoW, servant de guide pour le développement 
                                    et le suivi du projet.	                                     « Le backlog organise et suit toutes les tâches du projet. »

ORM (Doctrine)	                    Object Relational Mapping. Bibliothèque permettant de 
                                    manipuler les données de la base via des objets PHP plutôt
                                    que du SQL brut.	                                        « ORM permet de gérer les données comme des objets PHP plutôt qu’en SQL. »

PHP 8.x / Symfony	                Langage serveur (PHP) et framework Symfony pour 
                                    structurer le code, gérer la logique métier, les routes 
                                    et la sécurité.                                         	« PHP et Symfony gèrent la logique métier et les routes du projet. »

SASS	                            Préprocesseur CSS permettant d’écrire du code CSS 
                                    plus structuré, modulable et maintenable.	                « SASS facilite l’écriture et la maintenance du CSS. »

Front-end	                        Partie visible par l’utilisateur : 
                                    interface, interactivité, accessibilité 
                                    et design responsive.	                                    « Le front-end correspond à l’interface et à l’expérience utilisateur. »

WCAG / RGAA	                        Normes d’accessibilité numérique garantissant 
                                    que l’application est utilisable par tous, 
                                    y compris les personnes en situation de handicap.	        « WCAG et RGAA assurent l’accessibilité universelle. »

3NF (Troisième Forme Normale)	    Règle de normalisation des bases relationnelles. 
                                    Chaque donnée dépend directement de la clé primaire 
                                    pour éviter les redondances et garantir l’intégrité.	    « La 3NF supprime les redondances et assure la cohérence des données. »

RBAC (Role-Based Access Control)	Gestion des droits et permissions basée sur les rôles 
                                    des utilisateurs (agent, RH, admin).	                    « RBAC contrôle l’accès aux fonctionnalités selon le rôle. »

Chart.js	                        Bibliothèque JavaScript permettant de créer des graphiques 
                                    et visualisations dynamiques côté front.	                « Chart.js sert à afficher des graphiques interactifs. »

VPS Debian + Nginx	                Environnement serveur pour production : 
                                    Debian (stable et sécurisé) 
                                    et Nginx (serveur web performant et reverse proxy).	        « VPS Debian et Nginx assurent la stabilité et la performance en production. »

Environnement local Windows	        Poste de développement simulant le serveur de 
                                    production via Docker, permettant tests 
                                    et développement sécurisé.	                                 « Windows local simule le serveur de production via Docker. »

UI	                                Composants graphiques
UX	                                Qualité du parcours utilisateur
Responsive	                        Adaptation multi-écrans
RGAA	                            Règles d’accessibilité
Sécurité front-end	                Protection des données client
Sanitation                          Ensemble de techniques permettant de nettoyer les données 
                                    entrantes afin de prévenir les failles de sécurité comme les injections ou le XSS.

Idempotent / Idempotence            Une opération est dite idempotente lorsqu’elle peut être exécutée plusieurs fois 
                                    avec le même résultat, sans effet supplémentaire après la première exécution.

