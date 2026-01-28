Structure du projet (Symfony – DRH)
drh/
├── app/
│   ├── src/
│   │   ├── Controller/
│   │   │   ├── AuthController.php
│   │   │   ├── AgentController.php
│   │   │   ├── RhController.php
│   │   │   └── AdminController.php
│   │   ├── Entity/
│   │   │   ├── Agent.php
│   │   │   ├── Document.php
│   │   │   ├── Actualite_RH.php
│   │   │   └── Log_Consultation.php
│   │   ├── Repository/
│   │   └── Service/
│   ├── templates/
│   │   ├── base.html.twig
│   │   ├── auth/
│   │   ├── agent/
|   |   |── actualite_RH/
|   |   |── document/
│   │   ├── rh/
│   │   └── admin/
│   ├── assets/
│   │   ├── styles/
│   │   ├── js/
│   │   └── images/
│   ├── public/
│   │   └── build/
│   └── migrations/
├── config/
├── var/
├── vendor/
└── docker/ (prévu)

# Environnement technique – Projet DRH

**Langages utilisés**
HTML5
Utilisé pour la structure et la mise en page des pages du site.
CSS3
Mise en forme, responsive design et accessibilité.
Préprocesseur CSS : SASS
Utilisation ponctuelle selon les besoins du projet pour organiser les styles (charte graphique DRH, layout, composants, pages).
JavaScript (ES6+)
Interactions dynamiques et traitement côté client.
PHP 8.x
Logique métier côté serveur.
SQL
Gestion des données relationnelles et modélisation avec Doctrine ORM.
NoSQL (MongoDB)
Stockage de données non structurées ou semi-structurées, utile pour certaines fonctionnalités RH (documents, historiques, logs).
YAML / Twig
Utilisés via Symfony pour la configuration et le rendu des vues.



« Le SQL est utilisé pour les données structurées et critiques RH, nécessitant intégrité et contraintes fortes.
MongoDB est réservé à des données plus flexibles comme les historiques, documents ou journaux d’activité, où le schéma doit rester évolutif. »

**Frameworks / librairies**
•  Symfony : framework PHP MVC pour le back-end
•	Routing
•	Controllers
•	Twig (moteur de templates)
•	Doctrine ORM
•	Gestion de la sécurité (authentification, rôles, droits)
•  Bootstrap 5 : framework CSS pour la structuration des interfaces et le responsive
•  Chart.js : librairie de visualisation de données pour les tableaux de bord RH
•  Font Awesome / Lucide Icons : icônes vectorielles
•  Webpack Encore : gestion et compilation des assets front-end
•  Tailwind CSS : utilisé pour accélérer la génération des maquettes et la mise en forme rapide des composants

« Le projet est conçu de manière modulaire. Toutes les technologies listées ont été utilisées de façon ciblée, selon les besoins.
Le cœur métier repose sur Symfony, SQL et Twig. Les autres outils, comme Chart.js ou MongoDB, sont utilisés uniquement pour des cas précis, notamment les tableaux de bord et les données non structurées. »

« Bootstrap est utilisé pour la structure globale et la cohérence des interfaces finales.
Tailwind est utilisé uniquement en phase de maquettage rapide et pour certains composants spécifiques, afin d’accélérer les itérations visuelles. »

**Logiciels et outils utilisés**
(diagrammes et outils de maquette uniquement pour la phase de conception)
[Développement]
•	Visual Studio Code : éditeur de code
•	Symfony CLI : gestion et exécution du projet
•	Node.js / npm : gestion des dépendances front-end
•	PHPMyAdmin : administration de la base de données
•	Docker (environnement technique préparé, non déployé en production)

« Docker est préparé comme environnement technique reproductible, mais le déploiement n’entre pas dans le périmètre fonctionnel du projet.
L’objectif est la maintenabilité et la portabilité, pas la mise en production réelle. »

[Conception_modélisation]
•	**Figma**
    o	Zoning
    o	Wireframes
    o	Maquettes fonctionnelles
    o	Prototypes interactifs
•	**PlantUMl**
    o	Diagramme de cas d'utilisation
•	**Mermaid**
    o	Diagrammes de séquence
    o	Diagrammes d'activité
•	**JMerise**
    o	Diagramme de classes
    o	Modélisation de la base de données

[Méthodes_et_outils_d’analyse]
o	User Stories
o	Cas d’utilisation
o	Méthode MoSCoW
o	Approche mobile-first
o	Analyse des rôles (Agent, RH, Administrateur)

[Orientation_technique]
•	Architecture MVC
•	Séparation stricte logique métier / présentation
•	Exploitation des données RH via API JSON pour tableaux de bord
•	Respect des exigences :
    o	Sécurité des données (rôles, droits, accès)
    o	Traçabilité
    o	Accessibilité (ARIA)
    o	Maintenabilité et évolutivité du SI

API JSON
« Il s’agit d’API internes, exposant des données RH nécessaires aux tableaux de bord.
Elles sont conçues pour être exploitables côté front, tout en respectant les règles de sécurité et de droits d’accès. »

[Organisation_des_rôles]

**RSSI** (Responsable de la Sécurité des Systèmes d’Information) :
o supervision de la sécurité applicative
o suivi des accès, journaux d’audit et incidents

**DPO**(Délégué à la Protection des Données) :
o contrôle de la conformité RGPD
o gestion des consentements
o accès aux traitements de données personnelles

« La sécurité est intégrée dès la conception :
– gestion fine des rôles et des droits
– séparation des responsabilités RH / RSSI / DPO
– traçabilité des accès via journaux d’audit
– conformité RGPD intégrée par le principe de privacy by design. »

[Synthèse]

« l’objectif est de proposer un outil RH fiable reposant sur un socle technique solide.
Les choix technologiques servent directement les besoins RH : sécurité des données, traçabilité, conformité RGPD et exploitation des indicateurs. »

« accentuation sur la clarté, la sécurité et la maintenabilité plutôt que l’accumulation de fonctionnalités. »