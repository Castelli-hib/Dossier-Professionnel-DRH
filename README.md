# Projet DRH – Application RH interne (Symfony)

## Contexte du projet
Ce projet correspond au développement d’une **application RH interne**
réalisée au sein de la **DSI de la Mairie de Porto-Vecchio**.

L’application est destinée à :
- aux agents de la Commune
- des gestionnaires RH
- des administrateurs (DSI)

Besoins métiers réels, avec des contraintes fortes
- sécurité, 
- d’accès aux données 
- et de conformité.

---

## Objectifs du projet

- Concevoir une application web métier sécurisée
- Mettre en œuvre une architecture MVC sous Symfony
- Développer des interfaces utilisateurs accessibles et responsives
- Assurer la cohérence entre front-end et back-end
- Respecter les exigences RSSI et DPO liées aux données RH

---

## Périmètre fonctionnel

### Front-end
- Intégration des interfaces utilisateurs (HTML5 / CSS3)
- Développement des vues Twig
- Approche mobile-first
- Accessibilité (ARIA, contrastes, navigation clavier)
- Affichage conditionnel selon les rôles utilisateurs
- Interactions front-end légères en JavaScript

### Back-end
- Architecture MVC sous Symfony
- Création et gestion des entités Doctrine
- Authentification et autorisation (RBAC)
- Sécurisation des routes et des contrôleurs
- Validation des données
- API interne JSON pour certains échanges

---

## Cohérence front / back

Interfaces front-end directement liées :
- aux rôles définis côté serveur
- aux règles d’accès aux données
- à la logique métier RH

L’affichage des éléments UI conditionné par les autorisations
gérées côté back-end, garant cohérence fonctionnelle et sécuritaire.

---

## Environnement technique

- PHP 8
- Symfony
- Twig
- Doctrine ORM
- SQL
- Docker (environnement de développement et déploiement)
- Git / GitHub

---

## Positionnement dans le Dossier Professionnel

**les activités-types :**

- Développer la partie front-end d’une application web sécurisée
- Développer la partie back-end d’une application web sécurisée

---

## Remarque

Ce premier dépôt est centré sur le **Dossier Professionnel** et les éléments de conception associés 
- maquettes, 
- documents explicatifs, 
- structuration du projet.

La priorité de travail donnée : 
- à la formalisation du dossier, 
- à la cohérence des interfaces 
- et à la justification des choix techniques.

Le second dépôt sera dédié 
- à un premier jet fonctionnel du site, 
- à l'intégration progressive
- aux développements front-end et back-end correspondants.

