# Tableau MoSCoW ↔ User Stories ↔ Sprints


Priorité	    User Story				            Rôle			    Sprint			    Livrable attendu
------------|-----------------------------------|-------------------|------------------ |-------------------------------
Must		| US-A1 – Connexion			        | Agent			    | Sprint 1		    | Authentification fonctionnelle
Must		| US-AD1 – Gestion utilisateurs	    | Admin			    | Sprint 1		    | Comptes + rôles
Must		| US-V1 – Présentation DRH		    | Non-authentifié	| Sprint 1		    | Pages publiques
Must		| US-V2 – Actualités RH			    | Non-authentifié	| Sprint 1		    | Consultation actualités
Must		| US-V5 – Contacts RH			    | Non-authentifié	| Sprint 1		    | Page contacts
Must		| US-RH2 – Gestion pages RH		    | RH			    | Sprint 2		    | CRUD contenus
Must		| US-RH5 – Gestion actualités		| RH			    | Sprint 2		    | Publication actualités
Must		| US-A5 – Déconnexion sécurisée		| Agent			    | Sprint 2		    | Sécurité session
Should		| US-A3 – Téléchargement documents	| Agent			    | Sprint 3		    | Documents RH
Should		| US-RH3 – Archivage documents		| RH			    | Sprint 3		    | Statut archive
Should		| US-RH4 – Validation contenu		| RH			    | Sprint 3		    | Workflow simple
Should		| US-AD5 – Logs techniques		    | Admin			    | Sprint 3		    | Supervision
Could		| Recherche interne			        | Agent			    | Sprint 4		    | Moteur simple
Could		| Filtres contenus			        | Tous			    | Sprint 4		    | UX améliorée
Won’t		| Chat temps réel				    | —			        | Hors périmètre	| Exclu
Won’t		| Signature électronique			| —			        | Hors périmètre	| Exclu
------------|-----------------------------------|-------------------|------------------ |-------------------------------

## Architecture technique pilotée par la méthodologie
Schéma logique enrichi (avec lien méthodo)
┌──────────────────────────────────┐
│          FRONT-END               │
│ HTML / CSS / SASS / JS / Twig    │
│                                  │
│  User Stories Must / Should      │
│  → rendu UI / UX                 │
└───────────────┬──────────────────┘
                │ API JSON interne
                ▼
┌──────────────────────────────────┐
│           BACK-END               │
│ PHP 8 / Symfony                  │
│                                  │
│ Controllers  ← User Stories      │
│ Services     ← Règles métier     │
│ Security     ← Must Have         │
└───────────────┬──────────────────┘
                │ Doctrine
                ▼
┌──────────────────────────────────┐
│        BASES DE DONNÉES          │
│ MySQL (données critiques)        │
│ MongoDB (logs / stats)           │
│                                  │
│ Issues du backlog technique      │
└──────────────────────────────────┘

┌──────────────────────────────────┐
│ Outils transverses               │
│ Git / Docker / Environnements    │
│ ← support méthodologique         │
└──────────────────────────────────┘

### Environnements = continuité méthodologique
Méthodologie	            Choix technique
-----------------------|------------------------------
Travail itératif       | Git / branches
Tests réguliers	       | Docker
Séparation dev/prod	   | VPS Debian + Nginx
Sécurisation	       | Permissions Linux + Symfony


#### Tableau MoSCoW ↔ US Admin ↔ Sprint ↔ Accès
| Priorité | User Story | Rôle | Sprint | Livrable attendu | Accès |
|---------|-----------|------|--------|------------------|-------|
| Must | US-AD1 – Gestion des comptes utilisateurs | Administrateur | Sprint 1 | Création / désactivation / attribution des rôles | Restreint |
| Must | US-AD2 – Attribution des rôles et permissions | Administrateur | Sprint 1 | Sécurisation des fonctionnalités | Restreint |
| Must | US-AD3 – Paramétrage du site | Administrateur | Sprint 2 | Configuration générale fonctionnelle | Restreint |
| Must | US-AD4 – Maintenance et mises à jour | Administrateur | Sprint 2 | Correctifs et mises à jour appliqués | Restreint |
| Should | US-AD5 – Consultation des logs techniques | Administrateur | Sprint 3 | Accès aux événements clés et détection d’anomalies | Restreint |

**Notes** 
Tous les US administrateur sont restreints, car ils touchent à la sécurité et aux données critiques.
La mention « Restreint » sert à valider l’accès au rôle spécifique dans Symfony Security (ROLE_ADMIN).
Le sprint reste cohérent avec le plan incrémental : base → paramétrage → supervision.


#### Tableau MoSCoW ↔ US RH ↔ Sprint ↔ Accès
| Priorité | User Story | Rôle | Sprint | Livrable attendu | Accès |
|---------|-----------|------|--------|------------------|-------|
| Must | US-RH1 – Connexion au back-office | RH | Sprint 1 | Accès sécurisé à l’espace RH | Restreint |
| Must | US-RH2 – Création / modification des pages RH | RH | Sprint 2 | Pages RH dynamiques | Restreint |
| Must | US-RH5 – Gestion des actualités RH | RH | Sprint 2 | Publication et mise à jour des actualités | Restreint |
| Should | US-RH3 – Publication et archivage des documents | RH | Sprint 3 | Documents structurés et archivés | Restreint |
| Should | US-RH4 – Vérification des contenus avant publication | RH | Sprint 3 | Contenus conformes et validés | Restreint |


#### Tableau MoSCoW ↔ US Agent ↔ Sprint ↔ Accès
| Priorité | User Story | Rôle | Sprint | Livrable attendu | Accès |
|---------|-----------|------|--------|------------------|-------|
| Must | US-A1 – Connexion à l’espace personnel | Agent | Sprint 1 | Authentification fonctionnelle | Restreint |
| Must | US-A2 – Consultation des documents RH internes | Agent | Sprint 2 | Accès aux procédures internes | Restreint |
| Should | US-A3 – Téléchargement des formulaires administratifs | Agent | Sprint 3 | Formulaires RH téléchargeables | Restreint |
| Should | US-A4 – Consultation des notes de service | Agent | Sprint 2 | Notes internes accessibles | Restreint |
| Must | US-A5 – Déconnexion sécurisée | Agent | Sprint 2 | Fin de session sécurisée | Restreint |


#### Tableau MoSCoW ↔ US Non-authentifié ↔ Sprint ↔ Accès
| Priorité | User Story | Rôle | Sprint | Livrable attendu | Accès |
|---------|-----------|------|--------|------------------|-------|
| Must | US-V1 – Présentation de la DRH | Visiteur | Sprint 1 | Page institutionnelle | Public |
| Must | US-V2 – Consultation des actualités RH | Visiteur | Sprint 1 | Actualités accessibles | Public |
| Must | US-V3 – Informations temps de travail et législation | Visiteur | Sprint 1 | Contenus réglementaires | Public |
| Must | US-V4 – Informations formations et concours | Visiteur | Sprint 1 | Opportunités visibles | Public |
| Must | US-V5 – Accès aux contacts RH | Visiteur | Sprint 1 | Coordonnées RH | Public |

**Synthèse**
Public : accès sans authentification (Non-authentifié)
Restreint : accès contrôlé par rôle (Agent / RH / Admin)
Sécurité, logique d’accès et périmètre parfaitement maîtrisés

##### Accès ↔ Rôles ↔ Symfony Security
| Niveau d’accès | Rôle Symfony | US concernées | Mécanisme Symfony |
|---------------|-------------|---------------|-------------------|
| Public | Aucun (`IS_AUTHENTICATED_ANONYMOUSLY`) | US-V1 à US-V5 | Routes publiques |
| Restreint Agent | `ROLE_AGENT` | US-A1 à US-A5 | `access_control`, `@IsGranted` |
| Restreint RH | `ROLE_RH` | US-RH1 à US-RH5 | Hiérarchie de rôles |
| Restreint Admin | `ROLE_ADMIN` | US-AD1 à US-AD5 | Sécurité back-office |

**Lecture technique**
Les accès sont définis au niveau des routes
Les contrôles sont centralisés via Symfony Security
La hiérarchie des rôles est claire et sans ambiguité

##### Correspondance Backlog → UML
| Élément backlog | Diagramme UML associé | Objectif |
|-----------------|----------------------|----------|
| User Stories | Diagramme de cas d’utilisation | Identifier les interactions |
| Authentification | Diagramme de séquence | Flux de connexion |
| Gestion des contenus RH | Diagramme de classes | Structure métier |
| Téléchargement documents | Diagramme de séquence | Accès sécurisé |
| Gestion des rôles | Diagramme de classes | Relations User / Role |

**Logique méthodologique**
Le backlog définit le besoin
Les diagrammes UML définissent le comportement et la structure
Aucun diagramme n’est produit sans user story associée

##### Transition UML → MCD (logique données)
| UML (Classes) | MCD (Entités) | Commentaire |
|--------------|---------------|-------------|
| User | Utilisateur | Identité et rôle |
| Role | Rôle | Droits et accès |
| RHContent | ContenuRH | Pages et infos |
| Document | Document | Fichiers RH |
| Actualite | Actualité | Communication interne |

Le MCD est une traduction orientée données du diagramme de classes.

**Scrum**
Cadre de gestion de projet agile et itératif, reposant sur des cycles courts sprints (généralement de 2 à 4 semaines).
Scrum structure le travail à l’aide de rôles définis (Product Owner, Scrum Master, équipe de développement) et de rituels réguliers (daily meeting, sprint planning, sprint review, rétrospective),  favoriser l’adaptabilité, la collaboration et l’amélioration continue.

| Critère       | Scrum          | Kanban        | Cycle en V    |
| ------------- | -------------- | ------------- | ------------- |
| Type          | Agile itératif | Agile continu | Prédictif     |
| Flexibilité   | Élevée         | Très élevée   | Faible        |
| Livraison     | Par sprint     | Continue      | Fin de projet |
| Documentation | Allégée        | Minimale      | Très forte    |


[https://trello.com/invite/b/6965fcf9f906d526737ae05e/ATTI67306590a60d30baa0c91f2873047cd597B54098/dossier-professionnel-drh]

✔ Capacité d’organisation
✔ Priorisation métier (MoSCoW)
✔ Suivi des sprints
✔ Vision globale du projet
✔ Traçabilité des livrables

Tableau MoSCoW ↔ US Admin ↔ Sprint ↔ Accès