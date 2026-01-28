# JMerise

Types des entités (JMerise / Merise)

Dans JMerise, type logique (VARCHAR, DATE, etc.).
Compatible MySQL / PostgreSQL.

**Entité AGENT**
Attribut	            Type	            Remarque
id_agent	            INT	                Identifiant
nom	                    VARCHAR(100)	
prenom	                VARCHAR(100)	
email	                VARCHAR(255)	    Unique
role	                ENUM(100    )    	        AGENT / RH / ADMIN (ENUM = type de donnée à valeurs limitées. Ne peut contenir que l’une des valeurs définies.)
pole                    VARCHAR(100)	    POPULATION / DEVELOPPEMENT / TERRITOIRE / RESSOURCES
poste                   VARCHAR(150)        
service                 VARCHAR(100)	    (lister les services, voir organigramme)	   
                                            Direction de l'éducation (pôle population)
referent                VARCHAR(100)	                                            

**Entité DOCUMENT**
Attribut	            Type	            Remarque
id_document	            INT	                Identifiant
titre	                VARCHAR(100)	
type	                VARCHAR(50)	        PDF, DOCX…
service                 VARCHAR(100)
catégorie               VARCHAR(100)        Enquête, rapport, modèle, arrété ect.
est_public	            BOOLEAN	
date_publication	    DATE	


**Entité ACTUALITE_RH**
Attribut	            Type	            Remarque
id_actualite	        INT	                Identifiant
titre	                VARCHAR(200)	
contenu	                TEXT
catégorie               VARCHAR(100)        Enquête, rapport, modèle, arrété ect.	
date_publication	    DATE	
est_publique	        BOOLEAN	


**Entité LOG_CONSULTATION**
Attribut	            Type	            Remarque
id_log	                INT	                Identifiant
date_action	            DATETIME	        Traçabilité
type_action	            VARCHAR(255)	        CONSULTATION, TÉLÉCHARGEMENT


## IDENTIFIANTS

Type : INT
Nature : clé primaire
Génération : auto-incrémentée (au MPD)

## DATES

DATE → événement métier (publication)
DATETIME → traçabilité / logs

## BOOLEENS

BOOLEAN
(implémenté comme TINYINT(1) en MySQL)

### 3NF – Troisième Forme Normale

La 3NF est une règle de normalisation des bases de données relationnelles visant à supprimer les redondances et dépendances inutiles afin de garantir l’intégrité et la cohérence des données.

**Conditions pour qu’une table soit en 3NF**
La table est en 2NF (Deuxième Forme Normale).
Aucune colonne non clé ne dépend d’une autre colonne non clé.
Toutes les colonnes non clés dépendent directement de la clé primaire, et pas d’autres colonnes.

Exemple simple (conceptuel)
Table non normalisée :
ID_Client	            Nom_Client	        Ville	            Code_Postal
Code_Postal dépend de Ville, qui dépend de ID_Client → violation de 3NF.

**Table normalisée (3NF) :**
Table Clients
| ID_Client | Nom_Client | Ville_ID |

Table Villes
| Ville_ID | Ville | Code_Postal |

Chaque donnée dépend directement de la clé primaire.
Redondances éliminées, cohérence assurée.


La base de données relationnelle est conçue selon la Troisième Forme Normale (3NF), garantissant que chaque donnée dépend directement de la clé primaire et éliminant les redondances. 
Cette normalisation assure l’intégrité et la cohérence des informations stockées.

**« La 3NF est une règle de normalisation qui garantit que chaque donnée dépend directement de la clé primaire, ce qui supprime les redondances et assure la cohérence de la base. »**

CATEGORIE
Pour :
•	documents
•	actualités
•	ressources
--> Améliore :
•	classement
•	filtrage
•	évolutivité

TYPE_DOCUMENT
pour distinguer :
•	formulaire
•	procédure
•	note officielle

Modèle principalement informatif et documentaire du système = cohérence, maintenabilité et évolutivité du modèle. 
Le modèle de données volontairement léger et centré sur les besoins réels du système d’information RH.
Chaque entité correspond à une information métier persistante, sans redondance ni sur-modélisation.
Garantit la cohérence, la maintenabilité et l’évolutivité du système tout en respectant les principes de normalisation.

Rôle : acteur interne du SI
**Entité AGENT**
CREATE TABLE AGENT (
    id_agent    INT AUTO_INCREMENT PRIMARY KEY,
    nom         VARCHAR(100) NOT NULL,
    prenom      VARCHAR(100) NOT NULL,
    email       VARCHAR(255) NOT NULL UNIQUE,
    role        ENUM('AGENT','RH','ADMIN') NOT NULL,
    pole        ENUM('POPULATION', 'TERRITOIRE', 'DEVELOPPEMENT','RESSOURCES') NOT NULL,
    poste       VARCHAR(150) NOT NULL,
    direction   ENUM('liste des directions') NOT NULL,
    service     VARCHAR(150) NOT NULL,
    referent    VARCHAR(100)NOT NULL
);


id_agent : clé primaire auto-incrémentée
email : unique pour garantir l’unicité
role : ENUM, valeurs limitées (simplifie la gestion des droits)
Les autres champs : VARCHAR pour texte court


Rôle : ressource RH structurée
**Entité DOCUMENT**
CREATE TABLE DOCUMENT (
    id_document         INT AUTO_INCREMENT PRIMARY KEY,
    titre               VARCHAR(100) NOT NULL,
    type                ENUM ('PDF', 'DOC', 'DOCX', 'RTF', 'JPG', 'XLS', 'XLSX') NOT NULL, 
    service             ENUM('GESTION RH','ACCOMPAGNEMENT RH') NOT NULL,        -- GESTION RH           = Unité Carriere-paye, Unité GTT-Congés-Retraite
                                                                                -- ACCOMPAGNEMENT RH    = Unité Emploi-Compétences-Formation, Unité prévention-Médecine du Travail
    categorie           ENUM('FORMULAIRE','NOTE','ARRETE','PROCEDURE','MODELE') NOT NULL,
    est_public          BOOLEAN DEFAULT TRUE,
    date_publication    DATE
    id_agent            INT,                           -- nullable si visiteur non-auth
);


type :          VARCHAR(10), suffisant pour l’extension
categorie :     ENUM pour contrôler les valeurs métier
est_public :    BOOLEAN, permet filtrage public / interne


Rôle : information RH temporelle
**Entité ACTUALITE_RH**
CREATE TABLE ACTUALITE_RH (
    id_actualite                INT AUTO_INCREMENT PRIMARY KEY,
    titre                       VARCHAR(200) NOT NULL,
    contenu                     TEXT NOT NULL,
    date_publication            DATE,
    est_publique                BOOLEAN DEFAULT TRUE
    FOREIGN KEY id_agent        INT,                           -- nullable si visiteur non-auth
    FOREIGN KEY (id_document)   REFERENCES DOCUMENT(id_document),
);

contenu :           TEXT pour contenir des paragraphes ou notes complètes
date_publication :  DATE simple
est_publique :      BOOLEAN, filtrage pour visiteurs / agents


Rôle : traçabilité / sécurité / RGPD
**Entité LOG_CONSULTATION**
CREATE TABLE LOG_CONSULTATION (
    id_log                      INT AUTO_INCREMENT PRIMARY KEY,
    id_agent                    INT,                           -- nullable si visiteur non-auth
    id_document                 INT,                           -- nullable si actualité
    id_actualite                INT,                           -- nullable si document
    date_action                 DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    type_action                 ENUM('CONSULTATION','TELECHARGEMENT') NOT NULL,
    FOREIGN KEY (id_agent)      REFERENCES AGENT(id_agent),
    FOREIGN KEY (id_document)   REFERENCES DOCUMENT(id_document),
    FOREIGN KEY (id_actualite)  REFERENCES ACTUALITE_RH(id_actualite)
);


type_action : ENUM pour limiter les valeurs
Relations avec AGENT, DOCUMENT, ACTUALITE_RH
date_action : DATETIME avec timestamp par défaut
Les id_document et id_actualite peuvent être NULL selon le type d’action

**Points importants**
Les ENUM sont utilisés pour limiter les valeurs et garantir la cohérence.
Les BOOLEAN permettent un filtrage simple public / interne.
Les clés étrangères assurent l’intégrité référentielle (3NF respectée).
La structure légère mais complète, adaptée à un site RH documentaire.


AGENT RH
  |(0,n)          (1,1)
  |--- PRODUIT --- DOCUMENT
  |
  |--- PUBLIE ---- ACTUALITE_RH
  |
  |--- EFFECTUE -- LOG_CONSULTATION
                      |
                      |--- CONCERNE --- DOCUMENT
                      |
                      |--- CONCERNE --- ACTUALITE_RH

## Merise – Entités / Relations / Cardinalités

AGENT
Identifiant : id_agent
Rôle : AGENT / RH / ADMIN

Relations
AGENT (0,n) — consulte — DOCUMENT (0,n)
AGENT (0,n) — consulte — ACTUALITE_RH (0,n)

RH (1,n) — produit — DOCUMENT (1,1)
RH (1,n) — publie — ACTUALITE_RH (1,1)

AGENT (0,n) — effectue — LOG_CONSULTATION (1,1)

Règle métier :
Les relations produit et publie sont restreintes au rôle RH.

Les directions sont modélisées comme un ENUM car elles sont institutionnelles et rarement modifiées.
AGENT est une entité centrale représentant l’ensemble des utilisateurs internes de la collectivité. Les notions de pôle et de direction étant institutionnelles et stables, elles sont modélisées sous forme de domaines énumérés afin de garantir la cohérence des données et d’éviter toute saisie incohérente.

## SQL
-- =====================
-- TABLE AGENT
-- =====================
CREATE TABLE AGENT (
    id_agent INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,

    role ENUM('AGENT','RH','ADMIN') NOT NULL,

    pole ENUM(
        'POPULATION',
        'TERRITOIRE',
        'DEVELOPPEMENT',
        'RESSOURCES'
    ) NOT NULL,

    direction ENUM(
        'CABINET_MAIRE',
        'DIRECTION_GENERALE_SERVICES',
        'EDUCATION',
        'ACTION_CULTURELLE',
        'JEUNESSE_SPORTS',
        'TROIS_S',
        'CUISINE_CENTRALE',
        'URBANISME_GRANDS_PROJETS_CTM',
        'HABITAT_LOGEMENT',
        'ENVIRONNEMENT_DD',
        'AFFAIRES_MARITIMES',
        'ETAT_CIVIL',
        'POLICE_MUNICIPALE_ENVIRONNEMENTALE',
        'ADMINISTRATION_GENERALE_JURIDIQUE',
        'RESSOURCES_HUMAINES',
        'FINANCES_ACHAT_PUBLIC',
        'DSI'
    ) NOT NULL,

    service VARCHAR(150) NOT NULL,
    poste VARCHAR(150) NOT NULL,
    referent VARCHAR(100) NOT NULL
);

-- =====================
-- TABLE DOCUMENT
-- =====================
CREATE TABLE DOCUMENT (
    id_document INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(100) NOT NULL,

    type ENUM(
        'FORMULAIRE',
        'NOTE',
        'ARRETE',
        'PROCEDURE',
        'MODELE'
    ) NOT NULL,

    service ENUM(
        'GESTION_RH',
        'ACCOMPAGNEMENT_RH'
    ) NOT NULL,

    categorie ENUM(
        'PDF',
        'DOC',
        'DOCX',
        'RTF',
        'JPG',
        'XLS',
        'XLSX'
    ) NOT NULL,

    est_public BOOLEAN DEFAULT TRUE,
    date_publication DATE,

    id_agent INT NOT NULL,

    CONSTRAINT fk_document_agent
        FOREIGN KEY (id_agent)
        REFERENCES AGENT(id_agent)
        ON DELETE RESTRICT
        ON UPDATE CASCADE
);

-- =====================
-- TABLE ACTUALITE_RH
-- =====================
CREATE TABLE ACTUALITE_RH (
    id_actualite INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(200) NOT NULL,
    contenu TEXT NOT NULL,
    date_publication DATE,
    est_publique BOOLEAN DEFAULT TRUE,

    id_agent INT NOT NULL,
    id_document INT NULL,

    CONSTRAINT fk_actualite_agent
        FOREIGN KEY (id_agent)
        REFERENCES AGENT(id_agent)
        ON DELETE RESTRICT
        ON UPDATE CASCADE,

    CONSTRAINT fk_actualite_document
        FOREIGN KEY (id_document)
        REFERENCES DOCUMENT(id_document)
        ON DELETE SET NULL
        ON UPDATE CASCADE
);


-- =====================
-- TABLE LOG_CONSULTATION
-- =====================
CREATE TABLE LOG_CONSULTATION (
    id_log INT AUTO_INCREMENT PRIMARY KEY,

    date_action DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

    type_action ENUM(
        'CONSULTATION',
        'TELECHARGEMENT'
    ) NOT NULL,

    id_agent INT NULL,
    id_document INT NULL,
    id_actualite INT NULL,

    CONSTRAINT fk_log_agent
        FOREIGN KEY (id_agent)
        REFERENCES AGENT(id_agent)
        ON DELETE SET NULL
        ON UPDATE CASCADE,

    CONSTRAINT fk_log_document
        FOREIGN KEY (id_document)
        REFERENCES DOCUMENT(id_document)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    CONSTRAINT fk_log_actualite
        FOREIGN KEY (id_actualite)
        REFERENCES ACTUALITE_RH(id_actualite)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    CONSTRAINT chk_log_cible_unique
        CHECK (
            (id_document IS NOT NULL AND id_actualite IS NULL)
            OR
            (id_document IS NULL AND id_actualite IS NOT NULL)
        )
);



## Analyse de l’entité AGENT
Clé primaire
id_agent

**Dépendances fonctionnelles**
id_agent → nom, prenom, email, role, pole, direction, service, poste, referent


**Vérification**
Règle	    Statut	        Justification
-----------|---------------|--------------
1NF	        ✅	            Tous les attributs sont atomiques
2NF	        ✅	            Clé simple (pas de clé composée)
3NF	        ⚠️	             direction → service (potentielle dépendance transitive)

**Dans une collectivité**
un service dépend d’une direction
id_agent → direction → service
Dépendance transitive potentielle = Une dépendance transitive existe lorsqu’un attribut dépend d’un autre attribut qui dépend lui-même de la clé primaire.
-- id_agent → direction
-- id_agent → service
Mais dans la réalité
direction → service
Le service est déjà contenu dans la direction --> Donc le service ne dépend pas directement de l’agent, mais de sa direction

Agent	    Direction	    Service
-----------|---------------|--------------
Marie	    RH	            Unité carrière
Paul	    RH	            Unité carrière

Le service est répété
Il dépend de la direction RH, pas de chaque agent
C’est une dépendance transitive

**Contraintes métiers fonctionnelles**
[Seul un AGENT avec rôle = RH peut]
produire un DOCUMENT
publier une ACTUALITE_RH

[Un AGENT simple peut]
consulter
télécharger

[Un Admin]
gère la technique
n’intervient pas sur les contenus RH

**Contraintes de données**
email est unique
pole, role, direction sont des domaines fermés

Un LOG_CONSULTATION :
concerne soit un DOCUMENT
soit une ACTUALITE_RH
jamais les deux simultanément

**Contraintes RGPD**
[Les logs sont]
horodatés
limités à la traçabilité
sans données sensibles
Conservation limitée (ex : 12 mois)

Terme	                    Traduction 
---------------------------|-----------------------------------
Dépendance transitive	    Une info dépend d’une autre info
Potentielle	                Acceptée volontairement
Pragmatique	                Simple, utile, adapté
Sur-modélisation	        Trop de tables pour rien


### Tableau récapitulatif
**Entités, relations et cardinalités**

Entités
Entité	                Rôle
AGENT	                Utilisateur interne (Agent, RH, Admin)
DOCUMENT	            Ressource RH (formulaire, note, arrêté…)
ACTUALITE_RH	        Communication RH
LOG_CONSULTATION	    Traçabilité des accès


**Relations & cardinalités**
Relation	                       Cardinalité	                Explication

AGENT → DOCUMENT	                1 → 0..*	                Un agent RH peut produire plusieurs documents
DOCUMENT → AGENT	                * → 1	                    Un document a un seul producteur
AGENT → ACTUALITE_RH	            1 → 0..*	                Un agent RH publie des actualités
AGENT → LOG_CONSULTATION	        0..1 → 0..*	                Un agent peut consulter plusieurs ressources
DOCUMENT → LOG_CONSULTATION	        1 → 0..*	                Un document peut être consulté plusieurs fois
ACTUALITE_RH → LOG_CONSULTATION	    1 → 0..*	                Une actualité peut être consultée plusieurs fois

**Contraintes métiers documentées**
[Rôles_&_droits]
AGENT :     consultation et téléchargement
RH :        création, publication, mise à jour
ADMIN :     gestion des comptes et paramètres

[Documents]
Un document est créé par un agent RH uniquement
Un document peut être public ou restreint
Un document appartient à un seul service RH

[Actualités_RH]
Publiées uniquement par un agent RH
Peuvent référencer un document associé
Peuvent être visibles ou non selon le statut

[Logs]
Toute consultation ou téléchargement est tracé
Un log référence soit un document soit une actualité (jamais les deux)
Les logs permettent audit, sécurité et statistiques

« Le modèle est structuré autour de l’agent comme acteur central.
Les documents et actualités sont produits par les agents RH, tandis que les consultations sont tracées pour assurer la sécurité et la traçabilité.
Les cardinalités garantissent l’intégrité des données sans surcharger le modèle, tout en respectant les règles métiers du service RH. »


ENTITÉ – RELATION
Liens structurels

Entité          source	        Relation	        Entité cible	    Commentaire
---------------|---------------|-------------------|-------------------|---------------------------
AGENT	       |produit	       | DOCUMENT	       | Agent RH          |  crée des documents
AGENT	       |publie	       | ACTUALITE_RH	   | Agent RH          |  publie des actualités
DOCUMENT	   |peut être lié à	ACTUALITE_RH	   | Relation optionnelle
AGENT	       |consulte	   | DOCUMENT	       | Accès tracé
AGENT	       |consulte	   | ACTUALITE_RH	   | Accès tracé
DOCUMENT	   |génère	       | LOG_CONSULTATION  | Trace consultation
ACTUALITE_RH   |génère	       | LOG_CONSULTATION  | Trace consultation