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


