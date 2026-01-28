┌─────────────────────────────────┐
│          UTILISATEURS           │
│─────────────────────────────────│
│  Non Auth. │ Agent │ RH │ Admin │
└───────────────┬─────────────────┘
                │
                ▼
┌──────────────────────────────┐
│        INTERFACE WEB         │
│  HTML5 / Twig / CSS / JS     │
│  Bootstrap – Mobile First    │
│  Accessibilité RGAA          │
└───────────────┬──────────────┘
                │
                ▼
┌──────────────────────────────┐
│        CONTRÔLEURS           │
│     Symfony (MVC)            │
│  Routes simples par rôle     │
└───────────────┬──────────────┘
                │
                ▼
┌──────────────────────────────┐
│       SERVICES MÉTIER        │
│  Logique RH centralisée      │
│  Règles simples et lisibles  │
└───────────────┬──────────────┘
                │
                ▼
┌──────────────────────────────┐
│        PERSISTANCE           │
│  Doctrine ORM                │
│  Base MySQL relationnelle    │
└───────────────┬──────────────┘
                │
                ▼
┌──────────────────────────────┐
│     API JSON INTERNE         │
│  Données ciblées (Chart.js)  │
│  Pas de micro-services       │
└──────────────────────────────┘

Élément	                        Choix KISS
-------------------------------|--------------------------
Architecture	               | Monolithique Symfony
Sécurité	                   | RBAC simple (4 rôles)
Données	                       | MySQL relationnel
API	                           | Interne uniquement
Front	                       | Twig + JS léger
Évolution	                   | Ajout par service

**Architecture Symfony monolithique**
- rôles clairs 
- logique métier centralisée. 
- application lisible, maintenable et 
- adaptée aux contraintes d’un service RH public
- sans complexité inutile