Référentiel Git – Commandes essentielles
#  Référentiel Git – Commandes essentielles

##  Initialisation & configuration

| Commande                                                                              | Description              | Commentaire                     |
| --------------------------------------------------------------------------------------| -------------------------| --------------------------------|
| `git init`                                                                            | Initialise un dépôt Git  | À faire une seule fois          |
| `git clone URL`                                                                       | Clone un dépôt distant   | Récupère le projet + historique |
| `git config --global user.name "Marie Castelli"`                                      | Définit le nom           | Visible dans les commits        |
| `git config --global user.email "marie.castelli@adiktionstudio.com"`                  | Définit l’email          | Obligatoire                     |
| `git config --list`                                                                   | Affiche la configuration | Vérification                    |

- **--global**        → valable pour tous les projets
- **Sans --global**   → uniquement pour le projet courant
- L’email doit correspondre à celui de GitHub pour lier les commits
---

Renommer
git branch -m master main

**MySite (Projet Javascript)**
- Warnings LF will be replaced by CRLF (Windows)
- fichiers sont en LF (format Unix)
- Windows utilise CRLF
- Git avertit qu’il va convertir à l’écriture, pas maintenant

**recommandée (1 seule fois)**
git config --global core.autocrlf true

- Git stocke les fichiers en LF
- Windows travaille en CRLF
- Plus de warnings

**Vérification**
git config --global core.autocrlf

**Lier avec git distant**
PS C:\ENV\DRH> git remote add origin https://github.com/Castelli-hib/Dossier-Professionnel-DRH.git
PS C:\ENV\DRH> git remote -v
origin  https://github.com/Castelli-hib/Dossier-Professionnel-DRH.git (fetch)
origin  https://github.com/Castelli-hib/Dossier-Professionnel-DRH.git (push)

PS C:\ENV\DRH> git push -u origin main

# Token Git = Créer un token sur GitHub Manuellement
**Étape 1 — Ouvrir les Settings**
- Cliquer sur ta photo de profil en haut à droite
- Sélectionner Settings
**Étape 2 — Developer settings**
Sur la colonne de gauche, tout en bas :
- Developer settings
**tape 3 — Choisir le type de token**
- Personal access tokens → Fine‑grained tokens
**cliquer sur :**
Fine‑grained tokens
Nouveau type de token plus sécurisé que GitHub recommande d’utiliser.
**Étape 4 — Générer un token**
- Cliquer Generate new token
- Donner un nom (ex : Git push DRH)
- Choisir une expiration (par ex. 30 jours ou plus)
**Dans les autorisations :**
S'assurer que les accès au repository sont autorisés (Write / Push)
**Génèrer le token**
Copier 
Utiliser ce token à la place du mot de passe quand git push le demandera.
**Utilisation pour git push**
Quand Git demande :

Username:
Password:
- Username → mon identifiant GitHub (Castelli‑hib)
- Password → le token généré (pas mon mot de passe normal)
Copier le token. Visible une fois !


## Option GitHub CLI (gh auth login)
**Avantages**
GitHub CLI  guide pas à pas pour générer le token et l’utiliser automatiquement
Configurer Git automatiquement pour ne  jamais avoir à entrer le token à la main
Compatible HTTPS ou SSH
Plus sûr et pro sur plusieurs dépôts
Permet ensuite d’utiliser d’autres commandes GitHub comme création de repo, PR, etc. depuis le terminal

**Windows (PowerShell)**
winget install --id GitHub.cli
Fermer le powershell ou redémarrer VScode

**Vérifier ensuite**
gh --version
gh version 2.85.0 (2026-01-14)
https://github.com/cli/cli/releases/tag/v2.85.0

**Se connecter à GitHub avec la CLI**
Dans le terminal à la racine du projet :
gh auth login

Suivre les instructions : (Faire entrée pour Y)
Account → GitHub.com
Protocol → HTTPS (pour l’instant)
Authentication → Login with web browser (recommandé pour éviter les tokens manuels)
La CLI ouvre le navigateur → valider l’accès GitHub →  configure le token automatiquement

Après ça, Git connaît ton username + token et l’utilisera automatiquement pour git push et git pull.
! First copy your one-time code: 1E3D-28E0

**Vérifier que GitHub CLI est bien connecté**
gh auth status

Logged in to github.com as Castelli-hib
Git operations: https

**Lier le dépôt local au dépôt GitHub (si pas déjà fait)**
git remote add origin https://github.com/Castelli-hib/Dossier-Professionnel-DRH.git

**Vérifier**
git remote -v

**Pousser le projet complet**
git push -u origin main

-u crée le lien entre la branche locale main et la branche distante main.
Après ça, juste faire 'git push' à chaque modification.


##  Suivi des fichiers

| Commande              | Description              | Commentaire          |
| --------------------- | ------------------------ | -------------------- |
| `git status`          | État du dépôt            | Commande réflexe     |
| `git add fichier`     | Ajoute un fichier        | En staging           |
| `git add .`           | Ajoute tous les fichiers | Attention aux oublis |
| `git restore fichier` | Annule modifs locales    | Avant commit         |
| `git rm fichier`      | Supprime un fichier      | Avec commit          |

---

##  Commit

| Commande                   | Description         | Bonnes pratiques     |
| -------------------------- | ------------------- | -------------------- |
| `git commit -m "message"`  | Crée un commit      | Message clair        |
| `git commit -am "message"` | Add + commit        | Fichiers déjà suivis |
| `git log`                  | Historique complet  | Traçabilité          |
| `git log --oneline`        | Historique court    | Lecture rapide       |
| `git show`                 | Détails d’un commit | Audit                |

---

##  Branches

| Commande            | Description          | Commentaire     |
| ------------------- | -------------------- | --------------- |
| `git branch`        | Liste les branches   | `*` = active    |
| `git branch nom`    | Crée une branche     | Feature         |
| `git checkout nom`  | Change de branche    | Ancien          |
| `git switch nom`    | Change de branche    | Recommandé      |
| `git switch -c nom` | Crée + change        | Très utilisé    |
| `git merge nom`     | Fusionne une branche | Depuis la cible |
| `git branch -d nom` | Supprime une branche | Après merge     |

---

##  Dépôts distants

| Commande                     | Description          | Commentaire    |
| ---------------------------- | -------------------- | -------------- |
| `git remote -v`              | Liste les remotes    | Vérification   |
| `git remote add origin URL`  | Lier dépôt distant   | Une fois       |
| `git fetch`                  | Récupère sans fusion | Sécurisé       |
| `git pull`                   | Fetch + merge        | Risque conflit |
| `git push`                   | Envoie les commits   | Publication    |
| `git push -u origin branche` | Push + suivi         | Première fois  |

---

## Annulation / récupération

| Commande                  | Description        | Usage        |
| ------------------------- | ------------------ | ------------ |
| `git reset --soft HEAD~1` | Annule commit      | Garde modifs |
| `git reset --hard HEAD~1` | Supprime commit    | ⚠️ destructif |
| `git revert HASH`         | Annule proprement  | Production   |
| `git stash`               | Met de côté        | Avant pull   |
| `git stash pop`           | Restaure stash     | Après pull   |
| `git reflog`              | Historique interne | Sauvetage    |

---

## Inspection

| Commande            | Description     | Utilité      |
| ------------------- | --------------- | ------------ |
| `git diff`          | Différences     | Avant commit |
| `git diff --staged` | Diff staging    | Vérification |
| `git blame fichier` | Auteur ligne    | Debug        |
| `git ls-files`      | Fichiers suivis | Audit        |

---

## Workflow recommandé

```bash
git status
git switch -c feature-x
git add .
git commit -m "Ajout feature X"
git switch main
git pull
git merge feature-x
git push


