# Schéma d’architecture DRH – Symfony

## Architecture logique (Symfony)

```
┌───────────────────────────┐
│        Front-end          │
│ Twig / Bootstrap / JS     │
│ ou SPA (React/Vue)        │
└─────────────▲─────────────┘
              │ HTTP / JSON
┌─────────────┴─────────────┐
│        Controllers        │
│ (HTTP, validation,        │
│ sécurité d’accès)         │
└─────────────▲─────────────┘
              │ appels métier
┌─────────────┴─────────────┐
│        Services            │
│ (règles DRH, calculs,     │
│ workflows)                │
└─────────────▲─────────────┘
              │ accès données
┌─────────────┴─────────────┐
│       Repositories         │
│ (Doctrine ORM, requêtes)  │
└─────────────▲─────────────┘
              │ SQL
┌─────────────┴─────────────┐
│        Base de données     │
│ PostgreSQL / MySQL        │
└───────────────────────────┘
```

### Pourquoi c’est idéal pour un DRH
- Les **Controllers restent fins**
- Les **Services portent la logique métier RH**
- Les **Repositories encapsulent les requêtes complexes**
- Doctrine gère les relations, migrations et l’historique

---


# Tableau comparatif – Symfony vs autres stacks

| Critère               | Symfony (PHP)        | Laravel        | NestJS     | Django     | Spring Boot   |
|---------------------  |----------------------|----------------|------------|------------|-------------  |
| Architecture métier   | ⭐⭐⭐⭐⭐         | ⭐⭐⭐       | ⭐⭐⭐⭐ | ⭐⭐⭐    | ⭐⭐⭐⭐⭐ |
| Sécurité native       | ⭐⭐⭐⭐⭐         | ⭐⭐⭐⭐     | ⭐⭐⭐⭐ | ⭐⭐⭐⭐ | ⭐⭐⭐⭐⭐ |

---

# Conclusion technique

Symfony + SQL + Doctrine est :
- **Parfait pour un site DRH solide**
- Orienté règles métier, sécurité et maintenance

Ce n’est pas la stack la plus rapide à coder
Plus **fiable à maintenir**

