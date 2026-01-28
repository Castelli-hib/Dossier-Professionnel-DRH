
# Diagramme de cas d’utilisation [https://editor.plantuml.com/]

% Définition des acteurs
actor Non-authentifié
actor Agent
actor "Agent RH" as RH
actor Administrateur as Admin

                 +---------------------------------------+
                 |           SYSTÈME RH                  |
                 |                                       |
Non-authentifié  --------> (Consulter infos DRH)         |
Non-authentifié  --------> (Consulter actualités)        |
Non-authentifié  --------> (Consulter infos légales)     |
Non-authentifié  --------> (Consulter formations)        |
Non-authentifié  --------> (Consulter concours)          |
Non-authentifié  --------> (Consulter offres emploi)     |
Non-authentifié  --------> (Accéder contacts RH)         |
Non-authentifié  --------> (Se connecter)                |
                 |                                       |
Agent ------->  (S’authentifier)                         |
Agent ------->  (Consulter contenus)                     |
Agent ------->  (Consulter ressources)                   |
Agent ------->  (Consulter procédures)                   |
Agent ------->  (Consulter notes service)                |
Agent ------->  (Télécharger documents)                  |
Agent ------->  (Se déconnecter)                         |
                 |                                       |
Agent RH -------> (Gérer contenus)                       |
Agent RH -------> (Créer contenus)                       |
Agent RH -------> (modifier contenus)                    |
Agent RH -------> (Ajouter contenus)                     |
Agent RH -------> (Supprimer contenus)                   |
Agent RH -------> (Publier documents)                    |
Agent RH -------> (Vérifier contenus)                    |
Agent RH -------> (Gérer actualités)                     |
                 |                                       |
Admin ----------> (Gérer utilisateurs)                   |
Admin ----------> (Gérer rôles & permissions)            |
Admin ----------> (Créer rôles & permissions)            |
Admin ----------> (modifier rôles & permissions)         |
Admin ----------> (Ajouter rôles & permissions)          |
Admin ----------> (Supprimer rôles & permissions)        |
Admin ----------> (Paraméter fonctionnalités)            |
Admin ----------> (Administration système)               |
                 +---------------------------------------+

## Rappels UML (appliqués à ton système RH)
<<include>>

**À utiliser quand**
le comportement est obligatoire
toujours exécuté
souvent technique / transverse

**Typiquement**
S’authentifier
Vérifier les droits
Les relations <<include>> modélisent les traitements obligatoires et transverses, notamment l’authentification.

<<extend>>
**À utiliser quand**
le comportement est optionnel
déclenché dans un contexte précis
dépend d’une décision utilisateur ou d’un rôle

**Typiquement**
Supprimer un contenu
Publier un document
Se déconnecter
Les relations <<extend>> permettent de représenter des actions optionnelles ou conditionnelles, principalement liées aux droits métier des agents RH et administrateurs.


@startuml
left to right direction
skinparam packageStyle rectangle

' === Acteurs ===
actor "Non authentifié" as NonAuth
actor Agent
actor "Agent RH" as RH
actor Administrateur as Admin

rectangle "Système RH" {

  ' =======================
  '   ESPACE UTILISATEUR
  ' =======================
  package "Fonctionnalités Utilisateur" {

    usecase UC_Connexion as "Se connecter"
    usecase UC_Auth as "S’authentifier"
    usecase UC_Deconnexion as "Se déconnecter"

    usecase UC_ConsulterActualites as "Consulter actualités"
    usecase UC_ConsulterInfosLegales as "Consulter infos légales"
    usecase UC_ConsulterFormations as "Consulter formations"
    usecase UC_ConsulterConcours as "Consulter concours"
    usecase UC_AccederContacts as "Accéder contacts RH"

    usecase UC_ConsulterContenus as "Consulter contenus RH"
    usecase UC_Telecharger as "Télécharger documents"
  }

  ' =======================
  '   ESPACE ADMINISTRATION
  ' =======================
  package "Fonctionnalités Administration" {

    usecase UC_GererUsers as "Gérer utilisateurs"
    usecase UC_GererRoles as "Gérer rôles & permissions"
    usecase UC_Parametrer as "Paramétrer fonctionnalités"
    usecase UC_AdminSys as "Administrer système"
  }

  ' =======================
  '   ESPACE RH
  ' =======================
  package "Fonctionnalités RH" {

    usecase UC_GererContenus as "Gérer contenus RH"
    usecase UC_CreerContenu as "Créer contenu"
    usecase UC_ModifierContenu as "Modifier contenu"
    usecase UC_PublierContenu as "Publier contenu"
    usecase UC_SupprimerContenu as "Supprimer contenu"
  }

  ' === Associations acteurs ===
  NonAuth --> UC_Connexion
  NonAuth --> UC_ConsulterActualites
  NonAuth --> UC_ConsulterInfosLegales
  NonAuth --> UC_ConsulterFormations
  NonAuth --> UC_ConsulterConcours
  NonAuth --> UC_AccederContacts

  Agent --> UC_ConsulterContenus
  Agent --> UC_Telecharger
  Agent --> UC_Deconnexion

  RH --> UC_GererContenus

  Admin --> UC_GererUsers
  Admin --> UC_GererRoles
  Admin --> UC_Parametrer
  Admin --> UC_AdminSys

  ' === include (obligatoire) ===
  UC_Connexion .> UC_Auth : <<include>>
  UC_ConsulterContenus .> UC_Auth : <<include>>
  UC_Telecharger .> UC_Auth : <<include>>
  UC_GererContenus .> UC_Auth : <<include>>
  UC_GererUsers .> UC_Auth : <<include>>
  UC_GererRoles .> UC_Auth : <<include>>

  ' === extend (optionnel) ===
  UC_CreerContenu .> UC_GererContenus : <<extend>>
  UC_ModifierContenu .> UC_GererContenus : <<extend>>
  UC_PublierContenu .> UC_GererContenus : <<extend>>
  UC_SupprimerContenu .> UC_GererContenus : <<extend>>
}
@enduml


### Diagramme d’activité Mermaid — Parcours Agent Non authentifié

flowchart TD
    Start([Début])

    A[Accès page d'accueil]
    B[Consulter rubriques publiques]
    C[Présentation DRH]
    D[Actualités RH]
    E[Temps de travail & législation]
    F[Formations, concours & prévention]
    G[Télécharger documents publics]
    H[Accéder contacts RH]
    I[Redirection liens externes]

    End([Fin])

    Start --> A --> B
    B --> C
    B --> D
    B --> E
    B --> F
    F --> G
    B --> H
    H --> I
    I --> End


**User Stories concernées**
US-AN1 : Consulter présentation DRH
US-AN2 : Accéder aux actualités RH
US-AN3 : Consulter temps de travail & législation
US-AN4 : Accéder formations, concours, prévention
US-AN5 : Accéder aux contacts RH

**Lecture**
Le visiteur accède à des contenus publics uniquement
Aucun compte ni authentification requis
Le parcours respecte les principes d’accessibilité et de clarté de l’information
Les redirections externes sont clairement identifiées


###  Diagramme de séquence (mermaid) — Authentification Symfony (Security / Authenticator) [https://mermaid.js.org/]

**Relié à la User Story US-A1**
US-A1
En tant qu’agent, je veux me connecter à mon espace personnel afin d’accéder aux ressources internes.

**Diagramme de séquence (Symfony ≥ 6 – Authenticator)**

sequenceDiagram
    autonumber
    actor Agent
    participant "Navigateur" as Browser
    participant "Security Firewall" as Firewall
    participant "LoginAuthenticator" as Authenticator
    participant "UserRepository" as Repo
    participant "PasswordHasher" as Hasher
    participant "Base de données" as DB

    Agent ->> Browser: Saisie identifiant + mot de passe
    Browser ->> Firewall: POST /login

    Firewall ->> Authenticator: supports(request)
    Authenticator ->> Authenticator: authenticate()

    Authenticator ->> Repo: loadUserByIdentifier(email)
    Repo ->> DB: SELECT user WHERE email
    DB -->> Repo: Données utilisateur
    Repo -->> Authenticator: User

    Authenticator ->> Hasher: verify(hashedPassword, password)

    alt Identifiants valides
        Hasher -->> Authenticator: OK
        Authenticator -->> Firewall: Passport valid
        Firewall ->> Browser: Session créée + redirect
        Browser ->> Agent: Accès espace personnel
    else Identifiants invalides
        Hasher -->> Authenticator: KO
        Authenticator -->> Firewall: AuthenticationException
        Firewall ->> Browser: Message d’erreur
        Browser ->> Agent: Accès refusé
    end


**Agent**
US-A1
En tant qu’agent, je veux me connecter à mon espace personnel afin d’accéder aux ressources internes.

### Enchaînement des User Stories Agent (vision fonctionnelle)

sequenceDiagram
    actor Agent
    participant "Système DRH"

    Agent ->> Système DRH: Se connecter (US-A1)
    Système DRH -->> Agent: Authentifié

    Agent ->> Système DRH: Consulter documents RH (US-A2)
    Agent ->> Système DRH: Télécharger formulaires (US-A3)
    Agent ->> Système DRH: Consulter notes de service (US-A4)
    Agent ->> Système DRH: Se déconnecter (US-A5)


**Agent (agent authentifié)**
• US-A1
En tant qu’agent, je veux me connecter à mon espace personnel afin d’accéder aux ressources internes.
• US-A2
En tant qu’agent, je veux consulter les documents RH internes afin de connaître les procédures en vigueur.
• US-A3
En tant qu’agent, je veux télécharger des formulaires administratifs afin d’effectuer mes démarches RH.
• US-A4
En tant qu’agent, je veux consulter les notes de service afin d’être informé des communications internes.
• US-A5
En tant qu’agent, je veux me déconnecter de manière sécurisée afin de protéger mes données.

**Lecture**
US-A1 est bloquante
US-A2 à US-A4 nécessitent ROLE_AGENT
US-A5 clôt la session de manière sécurisée

## Diagramme d’activité — Agent (utilisateur authentifié)

flowchart TD
    Start([Début])

    A[Connexion sécurisée]
    B{Authentification valide ?}

    C[Accès espace agent]
    D[Consulter documents RH internes]
    E[Télécharger formulaires administratifs]
    F[Consulter notes de service]

    G[Déconnexion sécurisée]
    End([Fin])

    Start --> A --> B
    B -- Non --> End
    B -- Oui --> C
    C --> D
    C --> E
    C --> F
    D --> G
    E --> G
    F --> G
    G --> End


**User Stories concernées**
US-A1 : Se connecter à l’espace personnel
US-A2 : Consulter documents RH internes
US-A3 : Télécharger formulaires administratifs
US-A4 : Consulter notes de service
US-A5 : Se déconnecter de manière sécurisée

**Lecture**
L’accès aux fonctionnalités est conditionné par l’authentification
Les actions sont en lecture / téléchargement uniquement
La déconnexion clôt la session et protège les données personnelles

### Diagramme de séquence — Publication RH

sequenceDiagram
    autonumber
    actor "Agent RH" as RH
    participant "Navigateur" as Browser
    participant "Firewall Symfony" as Firewall
    participant "Back-office RH (Controller)" as Controller
    participant "Service Contenu RH" as Service
    participant "Repository Doctrine" as Repo
    participant "Base de données" as DB

    RH ->> Browser: Connexion sécurisée
    Browser ->> Firewall: POST /login
    Firewall -->> Browser: Session RH active

    RH ->> Browser: Accès back-office RH
    Browser ->> Controller: GET /rh/contenus

    Controller ->> Firewall: Vérification ROLE_RH
    Firewall -->> Controller: Autorisé

    RH ->> Browser: Création / modification contenu RH
    Browser ->> Controller: POST /rh/contenu

    Controller ->> Service: validerContenu()
    Service ->> Service: Vérification conformité réglementaire

    alt Contenu conforme
        Service ->> Repo: save(contenu)
        Repo ->> DB: INSERT / UPDATE
        DB -->> Repo: OK
        Repo -->> Service: OK
        Service -->> Controller: Publication réussie
        Controller ->> Browser: Confirmation publication
        Browser ->> RH: Contenu publié
    else Contenu non conforme
        Service -->> Controller: Erreur validation
        Controller ->> Browser: Message d’erreur
        Browser ->> RH: Correction demandée
    end


**RH (agent RH avec droits étendus)**
• US-RH1
En tant qu’agent RH, je veux me connecter afin de gérer les contenus RH.
• US-RH2
En tant qu’agent RH, je veux créer et modifier des pages RH afin de maintenir les informations à jour.
• US-RH3
En tant qu’agent RH, je veux publier et archiver des documents afin de structurer l’information interne.
• US-RH4
En tant qu’agent RH, je veux vérifier les contenus avant publication afin de garantir leur conformité réglementaire.
• US-RH5
En tant qu’agent RH, je veux gérer les actualités RH afin d’informer efficacement les agents.

**User Stories concernées**
US-RH1 : Connexion agent RH
US-RH2 : Créer / modifier des pages RH
US-RH3 : Publier et archiver des documents
US-RH4 : Vérifier les contenus avant publication
US-RH5 : Gérer les actualités RH

**Lecture**
L’agent RH est authentifié et possède le rôle ROLE_RH
L’accès au back-office est filtré par le firewall Symfony
Les contenus sont validés fonctionnellement avant publication
Les données sont persistées via Doctrine
Une alternative explicite gère les erreurs de conformité

✔ Séparation claire UI / Sécurité / Métier / Persistance
✔ Aligné avec les user stories RH
✔ Conforme aux bonnes pratiques Symfony Security


#### Diagramme d’activité Mermaid — Parcours RH
flowchart TD
    Start([Début])

    A[Connexion sécurisée RH]
    B{Authentification valide ?}

    C[Accès back-office RH]
    D[Créer / modifier contenu RH]
    E[Vérifier conformité réglementaire]
    F{Contenu conforme ?}

    G[Publier contenu RH]
    H[Archiver contenu RH]
    I[Message d'erreur / Correction]

    J[Déconnexion]
    End([Fin])

    Start --> A --> B
    B -- Non --> End
    B -- Oui --> C --> D --> E --> F
    F -- Oui --> G --> H --> J --> End
    F -- Non --> I --> D


**User Stories concernées**
US-RH1 : Connexion agent RH
US-RH2 : Créer / modifier des pages RH
US-RH3 : Publier et archiver des documents
US-RH4 : Vérifier la conformité des contenus
US-RH5 : Gérer les actualités RH

**Lecture**
Le diagramme met en évidence le cycle de vie d’un contenu RH (Attention cette partie sera contraint par la gestion des accès sécurité du service de la DSI, et sera amené a être modifié en fonction des services déjà existants)
La conformité réglementaire est une étape obligatoire
Les boucles de correction sont explicites
Le rôle RH est clairement distinct du rôle administrateur

##### Diagramme de séquence — Administrateur (Administration technique)
sequenceDiagram
    autonumber
    actor Administrateur as Admin
    participant Navigateur as Browser
    participant "Firewall Symfony" as Firewall
    participant "Back-office Admin (Controller)" as Controller
    participant "Service Administration" as Service
    participant "Repository Doctrine" as Repo
    participant "Base de données" as DB

    Admin ->> Browser: Connexion administrateur
    Browser ->> Firewall: POST /login
    Firewall -->> Browser: Session Admin active

    Admin ->> Browser: Accès back-office technique
    Browser ->> Controller: GET /admin

    Controller ->> Firewall: Vérification ROLE_ADMIN
    Firewall -->> Controller: Autorisé

    Admin ->> Browser: Action d'administration
    Browser ->> Controller: POST /admin/action

    Controller ->> Service: traiterActionAdmin()

    alt Gestion utilisateurs / rôles
        Service ->> Repo: create/update User
        Repo ->> DB: INSERT / UPDATE
        DB -->> Repo: OK
    else Paramétrage / maintenance
        Service ->> DB: Mise à jour paramètres
    else Consultation logs
        Service ->> Repo: fetch Logs
        Repo ->> DB: SELECT logs
        DB -->> Repo: Logs
    end

    Service -->> Controller: Action terminée
    Controller ->> Browser: Confirmation
    Browser ->> Admin: Résultat affiché


**User Stories concernées**
US-AD1 : Gérer les comptes utilisateurs
US-AD2 : Attribuer rôles et permissions
US-AD3 : Paramétrer le site
US-AD4 : Maintenance et mises à jour
US-AD5 : Consultation des logs

**Lecture**
L’administrateur agit exclusivement sur le périmètre technique
Les actions sont sécurisées par rôle
La traçabilité est intégrée via les logs
La séparation métier / technique est respectée