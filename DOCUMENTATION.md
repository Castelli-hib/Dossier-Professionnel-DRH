# Documentation Technique - Site Institutionnel DRH

## Vue d'ensemble

Ce projet constitue le site institutionnel de la Direction des Ressources Humaines (DRH), développé selon une approche **mobile-first** et conforme aux standards du service public français.

## Architecture du Site

### Structure des Pages

```
/
├── index.html              # Page d'accueil
├── services.html           # Présentation des services
├── equipe.html             # Présentation de l'équipe
├── contact.html            # Formulaire de contact
├── mentions-legales.html   # Mentions légales
├── css/
│   └── styles.css          # Feuille de styles principale
└── js/
    └── main.js             # Scripts JavaScript
```

### Arborescence du Site

1. **Accueil** (`index.html`)
   - Hero section avec présentation générale
   - Section mission et valeurs
   - Grille de fonctionnalités (4 services principaux)
   - Section actualités
   - Call-to-action contact

2. **Nos Services** (`services.html`)
   - Gestion des carrières et mobilité
   - Formation et développement des compétences
   - Recrutement et intégration
   - Gestion administrative du personnel
   - Santé et sécurité au travail
   - Accompagnement social

3. **Notre Équipe** (`equipe.html`)
   - Direction
   - Services opérationnels
   - Valeurs de l'équipe

4. **Contact** (`contact.html`)
   - Coordonnées complètes
   - Formulaire de contact interactif
   - FAQ (Foire Aux Questions)

5. **Mentions Légales** (`mentions-legales.html`)
   - Informations légales obligatoires
   - RGPD et protection des données
   - Accessibilité

## Approche Mobile-First

### Breakpoints Responsifs

Le design utilise trois points de rupture principaux :

```css
/* Mobile par défaut : < 768px */
/* Styles de base optimisés pour mobile */

/* Tablette : ≥ 768px */
@media (min-width: 768px) {
    /* Grilles à 2 colonnes */
    /* Menu horizontal */
}

/* Desktop : ≥ 1024px */
@media (min-width: 1024px) {
    /* Grilles à 3-4 colonnes */
    /* Layout optimisé grand écran */
}
```

### Stratégie Responsive

1. **Mobile (< 768px)**
   - Menu hamburger avec navigation verticale
   - Grilles en 1 colonne
   - Espacement optimisé pour tactile (min 44x44px)
   - Typography adaptée à la lecture mobile

2. **Tablette (768px - 1023px)**
   - Menu horizontal
   - Grilles en 2 colonnes
   - Espacement augmenté
   - Formulaires optimisés

3. **Desktop (≥ 1024px)**
   - Grilles en 3-4 colonnes
   - Layout pleine largeur (max 1200px)
   - Typographie plus grande
   - Effets de survol enrichis

## Standards du Service Public

### Design System

Le site respecte les standards visuels du service public français :

- **Couleurs principales** :
  - Bleu République : `#000091`
  - Rouge Marianne : `#E1000F`
  - Fond neutre : `#F6F6F6`

- **Typographie** :
  - Police système pour performance optimale
  - Tailles de police relatives (rem)
  - Line-height de 1.6 pour lisibilité

### Accessibilité (RGAA)

Le site intègre les bonnes pratiques d'accessibilité :

1. **Structure sémantique**
   - Utilisation correcte des balises HTML5
   - Hiérarchie des titres respectée (h1-h6)
   - Landmarks ARIA (`role="banner"`, `role="navigation"`, etc.)

2. **Navigation au clavier**
   - Tous les éléments interactifs sont accessibles
   - Skip link pour aller au contenu principal
   - Focus visible personnalisé
   - Gestion de la touche Escape

3. **Attributs ARIA**
   - `aria-label` sur les boutons
   - `aria-expanded` pour le menu mobile
   - `aria-current="page"` pour la navigation
   - `aria-required` sur les champs obligatoires
   - `role="alert"` pour les messages

4. **Contrastes**
   - Ratio de contraste conforme WCAG AA
   - Texte lisible sur tous les fonds

5. **Médias**
   - Alternative textuelle pour icônes décoratives (`aria-hidden="true"`)
   - Labels explicites pour formulaires

## Fonctionnalités JavaScript

### Menu Mobile Responsive

```javascript
- Toggle du menu hamburger
- Fermeture au clic extérieur
- Fermeture à la touche Escape
- Auto-fermeture en mode desktop
```

### Formulaire de Contact

```javascript
- Validation côté client
- Feedback visuel en temps réel
- Messages de succès/erreur
- Simulation d'envoi (à remplacer par appel API)
```

### Navigation Fluide

```javascript
- Smooth scroll pour les ancres
- Gestion du focus pour accessibilité
- Fermeture automatique du menu mobile
```

### FAQ Interactive

```javascript
- Navigation au clavier
- Expand/collapse avec animation
- État maintenu visuellement
```

## Performance

### Optimisations Appliquées

1. **CSS**
   - Pas de framework lourd (Bootstrap, etc.)
   - CSS vanilla optimisé
   - Variables CSS pour maintenance facile
   - Media queries groupées

2. **JavaScript**
   - Vanilla JS (pas de jQuery)
   - Code modulaire et documenté
   - Event delegation où applicable
   - Pas de dépendances externes

3. **HTML**
   - Sémantique HTML5
   - Pas d'images lourdes (icônes emoji pour prototype)
   - Structure minimale et propre

### Métriques Cibles

- First Contentful Paint : < 1.5s
- Time to Interactive : < 3.5s
- Cumulative Layout Shift : < 0.1
- Lighthouse Score : > 90

## Intégration Future

### Images et Médias

Pour une version production, remplacer les icônes emoji par :
- SVG optimisés ou font-icons
- Images responsives avec `<picture>` et `srcset`
- Lazy loading pour images below-the-fold

### Backend

Le formulaire de contact nécessitera :
- Endpoint API pour l'envoi
- Validation serveur
- Protection anti-spam (reCAPTCHA)
- Stockage sécurisé des données

### CMS

Pour faciliter la gestion de contenu :
- Intégration possible avec un CMS headless
- API REST ou GraphQL
- Interface d'administration

## Guide de Déploiement

### Prérequis

- Serveur web (Apache, Nginx, etc.)
- Support HTTPS obligatoire (service public)
- Compression gzip/brotli activée

### Configuration Serveur

```nginx
# Exemple configuration Nginx
server {
    listen 80;
    server_name drh.example.gouv.fr;
    root /var/www/html;
    index index.html;

    # Cache statique
    location ~* \.(css|js)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
    }

    # Security headers
    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";
    add_header X-XSS-Protection "1; mode=block";
}
```

### Checklist de Mise en Production

- [ ] Valider le HTML (W3C Validator)
- [ ] Vérifier l'accessibilité (WAVE, axe DevTools)
- [ ] Tester sur différents navigateurs
- [ ] Tester sur différents appareils
- [ ] Optimiser les images
- [ ] Minifier CSS et JS
- [ ] Configurer HTTPS
- [ ] Ajouter un fichier robots.txt
- [ ] Ajouter un sitemap.xml
- [ ] Configurer les analytics (optionnel)

## Maintenance

### Tâches Régulières

- Mise à jour du contenu des actualités
- Vérification des liens
- Contrôle d'accessibilité
- Monitoring des performances
- Backup régulier

### Support Navigateurs

| Navigateur | Version Minimale |
|------------|------------------|
| Chrome     | Dernières 2 versions |
| Firefox    | Dernières 2 versions |
| Safari     | Dernières 2 versions |
| Edge       | Dernières 2 versions |
| Mobile Safari | iOS 12+ |
| Chrome Android | Dernières 2 versions |

## Conformité RGPD

Le site respecte le RGPD :
- Pas de cookies de tracking
- Consentement explicite pour le formulaire
- Mentions légales complètes
- Coordonnées du DPO (Data Protection Officer)
- Droits des utilisateurs expliqués

## Contact Technique

Pour toute question technique concernant ce projet :
- Email : dev@drh.gouv.fr
- Documentation : Ce fichier
- Support : Service informatique DRH

---

*Dernière mise à jour : Janvier 2026*
