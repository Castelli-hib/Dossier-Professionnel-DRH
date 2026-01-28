# Schéma fonctionnel RSSI – Gouvernance SI 

Direction / DG ↕ RSSI ↕ DSI / Équipe technique ↕ SI (Applications RH, Plateforme web, Base de données) ↕ Utilisateurs (Agents, RH, Administrateurs)
Le RSSI pilote la sécurité de manière transverse entre gouvernance, technique et métiers.

**Ce que contient le chapitre**
    • Rôle et positionnement du RSSI
    • Gouvernance & PSSI
    • Analyse et gestion des risques
    • Sécurité organisationnelle
    • Sécurité technique
    • Protection des données & RGPD
    • Gestion des incidents
    • PCA / PRA
    • Suivi, audits et amélioration continue
    • Valeur stratégique du RSSI


## Schéma conceptuel (Mermaid)

flowchart TB
    DG[Direction / DG]
    RSSI[RSSI
Stratégie & Gouvernance sécurité]
    DSI[DSI / Équipe technique]

    subgraph SI[Système d’Information]
        APP[Application RH Symfony]
        DB[(Base de données RH)]
        API[API / Services]
end

    USERS[Utilisateurs
Agents / RH / Administrateurs]

    DG --> RSSI
    RSSI --> DSI
    RSSI -. définit règles .-> SI
    DSI --> SI
    USERS --> APP
    APP --> API
    API --> DB
    RSSI -. contrôle & audits .-> USERS

## Contexte projet

Plateforme RH développée en Symfony, permettant :
    • l’authentification des agents
    • la gestion des dossiers RH
    • la consultation de documents administratifs

**Rôle du RSSI dans ce projet**
Actions :
    • Analyser les risques liés à l’application Symfony
    • Définir les règles d’accès par rôle (Agent / RH / Admin)
    • Valider l’architecture de sécurité
    • Contrôler la conformité RGPD

**Traduction technique dans Symfony**
Exigence sécurité	                    Mise en œuvre Symfony
------------------------------------|------------------------------------------
Contrôle des accès	                    Security.yaml, rôles, voters
Authentification forte	                MFA / politique de mots de passe
Traçabilité	                            Logs,journalisation des connexions
Protection des données	                Doctrine, chiffrement, HTTPS
Sécurité applicative	                Validation des formulaires, CSRF

Le RSSI ne développe pas, mais oriente et valide les choix techniques.

### Synthèse

Sur cette plateforme RH Symfony, le RSSI se positionne entre la direction, la DSI et les utilisateurs. 
    • Il définit la politique de sécurité, 
    • contrôle les accès aux données RH, 
    • garantit la conformité RGPD 
    • assure que l’application est sécurisée, disponible et traçable. 
Le schéma montre cette gouvernance transverse. »

### Gouvernance de la sécurité du SI

**Politique de Sécurité des Systèmes d’Information (PSSI)**
Document de référence qui formalise les règles de sécurité applicables.
Contenu :
    • Objectifs de sécurité
    • Périmètre du SI
    • Rôles et responsabilités
    • Règles d’accès et d’usage
    • Gestion des incidents
La PSSI doit être connue, diffusée et validée par la direction.

**Référentiels et normes**
    • ISO/IEC 27001       – Management de la sécurité de l’information
    • ISO/IEC 27002       – Bonnes pratiques
    • ANSSI               – Guides et recommandations
    • RGPD                – Protection des données personnelles


### Sécurité technique

**Contrôle des accès**
    •	 Authentification forte (MFA)
    • Gestion des identités (IAM)
    • Journalisation des connexions

**Sécurité réseau**
    • Pare-feu
    • Segmentation réseau
    • VPN
    • Détection d’intrusion (IDS/IPS)

**Sécurité des postes et serveurs**
    • Antivirus / EDR
    • Mises à jour régulières
    • Chiffrement des données

**Sécurité applicative**
    • Gestion des vulnérabilités
    • Tests de sécurité (audit, pentest)
    • Sécurisation des API


### Protection des données

**Classification des données**
    • Publiques
    • Internes
    • Sensibles
    • Critiques

**Mesures de protection**
    • Chiffrement au repos et en transit
    • Sauvegardes régulières
    • Contrôle des accès aux données

**Conformité RGPD**
    • Minimisation des données
    • Traçabilité des accès
    • Gestion des droits des personnes


### Gestion des incidents de sécurité

**Détection**
    • Supervision
    • Alertes automatiques
    • Signalement interne

**Réaction**
    • Confinement
    • Analyse de l’incident
    • Restauration des services

**Retour d’expérience**
    • Analyse post-incident
    • Amélioration continue


### Continuité et reprise d’activité

**PCA**– Plan de Continuité d’Activité
Assure le maintien des activités essentielles.

**PRA** – Plan de Reprise d’Activité
Permet de restaurer le SI après un incident majeur.

**Éléments clés :**
    • Sauvegardes
    • Sites de secours
    • Scénarios de crise

### Suivi, contrôle et amélioration continue

**Indicateurs de sécurité**
    • Nombre d’incidents
    • Temps de résolution
    • Taux de conformité

**Audits et contrôles**
    • Audits internes
    • Audits externes
    • Tests réguliers

**Amélioration continue**
La sécurité est un processus évolutif, pas un état figé.


### Valeur ajoutée du RSSI

**Le RSSI contribue à :**
    • La confiance des utilisateurs
    • La protection du patrimoine informationnel
    • La pérennité de l’organisation
    • La maîtrise des risques numériques
La sécurité devient un levier stratégique, et non une contrainte.
