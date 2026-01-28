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

