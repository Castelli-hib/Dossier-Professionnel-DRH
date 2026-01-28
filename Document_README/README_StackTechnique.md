# 1️.Stack technique RNCP harmonisée

| Couches / Rôle                    | Technologies / Outils                                | Usage/Ojectif |
|-----------------------------------|------------------------------------------------------|
| **Front-end**                      | HTML5, CSS3, SASS, JavaScript, Bootstrap, Twig      | Interface utilisateur, 
|                                                                                           | responsive, ergonomie, 
|                                                                                           | accessibilité WCAG
|-----------------------------------|                                                                                        |    
| **Visualisation / Graphiques**     | Chart.js                                            | Représentation dynamique des 
|                                                                                          | données exposées via 
|                                                                                          | l’API JSON 
| **Back-end**                       | PHP 8.x, Symfony                                    | Logique métier, sécurité, 
|                                                                                          | gestion des routes et 
|                                                                                          | contrôleurs
| **Base de données relationnelle**  | MySQL via Doctrine ORM                              | Stockage des données métier, transactions, intégrité référentielle              |
| **Base NoSQL / complémentaire**    | MongoDB                                             | Logs, statistiques, données non structurées, export ou historique               |
| **API / Interactions front-back**  | API JSON interne                                    | Exposition des données côté front-end pour le rendu dynamique                   |
| **Sécurité**                       | Symfony Security – rôles & permissions, sanitation, validation | Contrôle d’accès, protection des données, prévention des failles XSS/Injection |
| **Conteneurisation / environnement** | Docker                                                     | Standardisation de l’environnement de développement et de production            |
| **Outils transverses**             | Git / GitHub                                               | Gestion de versions, traçabilité, collaboration, centralisation des livrables   |
| **Accessibilité & normes**         | WCAG / RGAA                                                | Respect des standards pour l’accès universel aux contenus numériques            

Cette table couvre l’ensemble du projet, côté fonctionnel et technique, et permet de répondre aux attentes RNCP sur les compétences de développement front et back.

---

# 2️.Schéma d’architecture simplifié (texte + concept)

+------------------------------------------------+
| FRONT-END |
| HTML / CSS / SASS / JS / Bootstrap / Twig |
| +----------------------+ |
| | Chart.js / API JSON | <---+ |
+-------+----------------------+ | |
|
v
+------------------------------------------------+
| BACK-END |
| PHP 8.x / Symfony / Controllers / Services |
| +--------------------+ +----------------+ |
| | MySQL (Doctrine) | | MongoDB | |
| +--------------------+ +----------------+ |
| Roles & Permissions / Validation / Sanitation|
+------------------------------------------------+
^
|
v
+------------------------------------------------+
| OUTILS TRANSVERSES / ENVIRONNEMENT |
| Git / GitHub <--> Docker / Environnements |
+------------------------------------------------+


- Flèches → flux de données / interactions front-back  
- Base relationnelle → données métier critiques  
- MongoDB → données complémentaires / logs / stats  
- Git / Docker → support transverse, versioning, déploiement  

---

# 3️.Cohérence avec le référentiel RNCP

- **Front-end** : HTML / CSS / JS / SASS + accessibilité    →  Bloc Front-end RNCP  
- **Back-end** : Symfony / PHP / Doctrine + sécurité        →  Bloc Back-end RNCP  
- **API JSON interne**                                      →  correspond à “exposer des données pour interaction dynamique”  
- **Bases de données relationnelle + NoSQL**                →  gère intégrité + flexibilité, argumentable pour projet réel  
- **Outils transverses** : Git, Docker                      →  correspond à la compétence “utiliser des outils de gestion et d’organisation de projet”  
- **Normes WCAG / RGAA**                                    → exigence accessibilité obligatoire RNCP  


# Stack technique RNCP harmonisée – Projet Symfony / DRH

## 1️ Front-end

| Couches / Rôle                  | Technologies / Outils                                  | Usage / Objectif                                                                |
|---------------------------------|--------------------------------------------------------|---------------------------------------------------------------------------------|
| Front-end                       | HTML5, CSS3, SASS, JavaScript, Bootstrap, Twig         | Interface utilisateur, responsive, ergonomie, accessibilité WCAG                | 
| Visualisation / Graphiques      | Chart.js                                               | Représentation dynamique des données exposées via l’API JSON                    |

---

## 2️ Back-end

| Couches / Rôle                 | Technologies / Outils                                            | Usage / Objectif                                                                |
|--------------------------------|------------------------------------------------------------------|---------------------------------------------------------------------------------|
| Back-end                        | PHP 8.x, Symfony                                                | Logique métier, sécurité, gestion des routes et contrôleurs                     |
| Base de données relationnelle   | MySQL via Doctrine ORM                                          | Stockage des données métier, transactions, intégrité référentielle              |
| Base NoSQL / complémentaire     | MongoDB                                                         | Logs, statistiques, données non structurées, export ou historique               |
| API / Interactions front-back   | API JSON interne                                                | Exposition des données côté front-end pour le rendu dynamique                   |
| Sécurité                        | Symfony Security – rôles & permissions, sanitation, validation | Contrôle d’accès, protection des données, prévention des failles XSS/Injection   |

---

## 3️ Conteneurisation et environnement

| Élément / Rôle             | Technologies          | Usage / Objectif             
|----------------------------|-----------------------|------------------------------------------------------------------------------|
| Environnement local        | Windows + Docker      | Développement et tests avec simulation de l’environnement de production      |
| Environnement production   | VPS Debian + Nginx    | Serveur web performant et sécurisé pour l’hébergement réel de l’application  |
| Outils transverses         | Git / GitHub          | Gestion de versions, traçabilité, collaboration, centralisation des livrables|
| Accessibilité & normes     | WCAG / RGAA           | Respect des standards pour l’accès universel aux contenus numériques         |

---

## 4 Schéma d’architecture simplifié (texte + concept)

