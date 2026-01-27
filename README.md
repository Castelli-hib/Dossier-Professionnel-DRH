# Site Institutionnel - Direction des Ressources Humaines

Site web institutionnel de la Direction des Ressources Humaines, développé selon une approche **mobile-first** et conforme aux standards du service public français.

## 🎯 Objectifs

Concevoir et développer l'interface front-end d'un site institutionnel répondant aux exigences :
- **Fonctionnelles** : Navigation intuitive, information claire et accessible
- **Graphiques** : Design moderne conforme aux standards du service public
- **Techniques** : Responsive mobile-first, accessibilité RGAA, performance optimale

## 📱 Caractéristiques

- ✅ **Approche Mobile-First** : Optimisé d'abord pour smartphones, puis tablettes et ordinateurs
- ✅ **Responsive Design** : S'adapte automatiquement à tous les écrans
- ✅ **Accessibilité** : Conforme aux standards RGAA et WCAG 2.1 AA
- ✅ **Performance** : Code optimisé, pas de dépendances lourdes
- ✅ **Sémantique** : HTML5 sémantique, ARIA labels
- ✅ **Navigation intuitive** : Menu hamburger mobile, navigation horizontale desktop

## 🗂️ Structure du Site

```
├── index.html              # Page d'accueil
├── services.html           # Présentation des services DRH
├── equipe.html             # Présentation de l'équipe
├── contact.html            # Formulaire de contact + FAQ
├── mentions-legales.html   # Mentions légales et RGPD
├── css/
│   └── styles.css          # Styles mobile-first
├── js/
│   └── main.js             # Interactivité (vanilla JS)
└── DOCUMENTATION.md        # Documentation technique complète
```

## 🎨 Design

Le site utilise les couleurs officielles du service public français :
- **Bleu République** : `#000091`
- **Rouge Marianne** : `#E1000F`
- **Palette neutre** : Blancs et gris pour lisibilité optimale

## 🚀 Installation et Utilisation

### Démarrage Rapide

1. Cloner le repository
```bash
git clone https://github.com/Castelli-hib/Dossier-Professionnel-DRH.git
cd Dossier-Professionnel-DRH
```

2. Ouvrir `index.html` dans votre navigateur
```bash
# Avec un serveur local simple (Python)
python -m http.server 8000

# Ou avec Node.js
npx http-server
```

3. Accéder au site : `http://localhost:8000`

### Aucune dépendance requise !

Le site est développé en HTML, CSS et JavaScript vanilla. Aucune installation de packages n'est nécessaire.

## 📱 Responsive Breakpoints

- **Mobile** : < 768px (design de base)
- **Tablette** : ≥ 768px
- **Desktop** : ≥ 1024px

## ♿ Accessibilité

- Navigation au clavier complète
- Skip links pour aller au contenu principal
- ARIA labels et landmarks
- Contraste WCAG AA minimum
- Focus visible sur tous les éléments interactifs
- Support des technologies d'assistance

## 📄 Pages Disponibles

1. **Accueil** : Présentation générale, mission, actualités
2. **Nos Services** : Détails de tous les services DRH
3. **Notre Équipe** : Organisation et valeurs
4. **Contact** : Formulaire + coordonnées + FAQ
5. **Mentions Légales** : Conformité RGPD et informations légales

## 🛠️ Technologies Utilisées

- **HTML5** : Structure sémantique
- **CSS3** : Variables CSS, Flexbox, Grid, Media Queries
- **JavaScript ES6** : Vanilla JS pour interactivité
- **Aucun framework** : Performance optimale, maintenance simplifiée

## 📚 Documentation

Consultez [DOCUMENTATION.md](DOCUMENTATION.md) pour :
- Architecture détaillée
- Guide de déploiement
- Standards d'accessibilité
- Optimisations de performance
- Guide de maintenance

## 🌐 Support Navigateurs

| Navigateur | Version Minimale |
|------------|------------------|
| Chrome     | 2 dernières versions |
| Firefox    | 2 dernières versions |
| Safari     | 2 dernières versions |
| Edge       | 2 dernières versions |
| Mobile Safari | iOS 12+ |
| Chrome Android | 2 dernières versions |

## 📞 Contact

Direction des Ressources Humaines  
Email : contact@drh.gouv.fr  
Téléphone : 01 23 45 67 89

## 📝 Licence

© 2026 Direction des Ressources Humaines - Tous droits réservés

---

Développé avec ❤️ pour le service public
