# Site RH – Collectivité Locale

Projet de site web destiné à la **Direction des Ressources Humaines d’une collectivité locale**.
Il comprend une partie publique institutionnelle et un **espace agents sécurisé**.

Ce projet a été réalisé dans le cadre du **Titre Professionnel Développeur Web et Web Mobile (DWWM)**.

---

## Objectifs du projet

- Concevoir un site institutionnel clair et accessible
- Mettre en place un espace agents sécurisé
- Développer un back-office RH
- Respecter les contraintes de sécurité et de confidentialité (RGPD)

---

## Fonctionnalités

### Partie publique
- Présentation de la DRH
- Informations recrutement
- Page de contact

### Espace agents
- Authentification sécurisée
- Accès aux documents RH
- Consultation des actualités internes

### Back-office RH
- Gestion des agents
- Publication de documents
- Gestion des actualités RH

---

## Technologies utilisées

- **Back-end** : PHP, Symfony
- **Front-end** : Twig, Bootstrap
- **Base de données** : MySQL
- **ORM** : Doctrine
- **Sécurité** : Symfony Security, CSRF
- **Environnement** : Docker
- **Versioning** : Git

---

## Sécurité & RGPD

- Authentification avec mots de passe chiffrés
- Gestion des rôles (agent, RH, administrateur)
- Accès restreint aux données sensibles
- Données limitées au strict nécessaire

---

## Conception

- Maquettes UI réalisées avec Figma
- Diagramme UML des entités
- Diagrammes de séquence (connexion, accès espace agent)

---

## Installation (environnement de développement)

```bash
git clone <repo>
docker compose up -d
symfony console doctrine:migrations:migrate
symfony console doctrine:fixtures:load
