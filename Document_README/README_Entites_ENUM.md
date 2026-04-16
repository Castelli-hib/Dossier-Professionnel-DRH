# Étape 1 : créer l’ENUM
// src/Enum/StatutActualite.php

namespace App\Enum;

enum StatutActualite: string
{
    case BROUILLON = 'brouillon';
    case EN_VALIDATION = 'en_validation';
    case PUBLIEE = 'publiee';
    case ARCHIVEE = 'archivee';
}

## Étape 2 : l’utiliser dans ton entité
use App\Enum\StatutActualite;

#[ORM\Column(length: 50)]
private StatutActualite $statut = StatutActualite::BROUILLON;

### Étape 3 : getters/setters
public function getStatut(): StatutActualite
{
    return $this->statut;
}

public function setStatut(StatutActualite $statut): static
{
    $this->statut = $statut;
    return $this;
}

**Ajouter des méthodes métier :**

public function publier(): void
{
    $this->statut = StatutActualite::PUBLIEE;
    $this->date_publication = new \DateTime();
}

public function archiver(): void
{
    $this->statut = StatutActualite::ARCHIVEE;
    $this->date_archivage = new \DateTime();
}

**Logique métier réelle**

Conclusion
Élément	                Mon code	            Version donnée                 Verdict
Structure entité	    ✅	                    ✅                           égal
Relations	            ✅ (mieux nommées)	    OK	                         👍
Validation	            ✅	                    ✅	                        égal
ENUM	                ❌	                    ❌ (juste proposé)	        à améliorer
Logique métier	        ❌	                    ❌	                        à ajouter


Mon code est :

✔ propre
✔ cohérent
✔ prêt pour soutenance

✅ Enum PHP → ✔
✅ Typage fort → ✔
✅ Méthodes métier (publier, archiver) → ✔

PROBLÈME : Doctrine ne sait pas gérer l'Enum (pour l’instant)

#### MAIS le rendre niveau pro++ avec :

Enum PHP
Méthodes métier (publier, archiver)
Typage fort

**Actuellement :**

#[ORM\Column(length: 50)]
private StatutActualite $statut = StatutActualite::BROUILLON;

Doctrine ne sait pas automatiquement comment stocker un Enum
Il faut lui dire comment le mapper

**CORRECTION OBLIGATOIRE (mapping Doctrine)**

Ajouter enumType : (FAIT)

#[ORM\Column(type: 'string', enumType: StatutActualite::class)]
private StatutActualite $statut = StatutActualite::BROUILLON;

Là :

Doctrine stocke "brouillon" en base
PHP manipule StatutActualite::BROUILLON

**Impact sur la base de données**

AVANT :
statut VARCHAR(50)

APRÈS :
Toujours VARCHAR (⚠️ important)

Mais :
Doctrine contrôle les valeurs
Plus de manipulation de string côté PHP


**symfony console make:migration**

Deux cas :
✔ Cas 1 : aucune migration détectée

NORMAL
Car DB = string → ça ne change pas

**✔ Cas 2 : migration générée** FAIT

Vérifie qu’elle ne casse rien


**Impact sur MON CODE (important)**
AVANT :
$actualite->setStatut('publiee');
❌ Maintenant interdit

APRÈS :
$actualite->setStatut(StatutActualite::PUBLIEE);
=
autocomplétion
zéro faute de frappe
cohérence globale

**Impact sur tes contrôleurs**
Exemple :
if ($actualite->getStatut() === 'publiee')

- à remplacer par :

if ($actualite->getStatut() === StatutActualite::PUBLIEE)

**Impact sur les formulaires Symfony**
Très important sinon ça casse
Dans ton FormType :

use Symfony\Component\Form\Extension\Core\Type\EnumType;

$builder->add('statut', EnumType::class, [
    'class' => StatutActualite::class,
]);

Symfony va automatiquement générer un select :

brouillon
en_validation
publiee
archivee

*Impact sur Twig (affichage)*
AVANT :
{{ actualite.statut }}
APRÈS :
{{ actualite.statut.value }}

sinon Affiches l’objet Enum

## Méthodes métier


public function publier(): void
{
    $this->statut = StatutActualite::PUBLIEE;
    $this->date_publication = new \DateTime();
}

1. Ajoute une règle métier :

public function valider(): void
{
    if ($this->statut !== StatutActualite::BROUILLON) {
        throw new \LogicException('Seul un brouillon peut être validé');
    }

    $this->statut = StatutActualite::EN_VALIDATION;
}


2. Impact sur tes autres entités

AUCUN impact direct sur :

Agent
Document
CategorieDocument

Pourquoi ?
statut est un champ local à ActualiteRH

MAIS impact indirect :

Sur :

des filtres
des requêtes
des dashboards

Exemple repository :
->andWhere('a.statut = :statut')
->setParameter('statut', StatutActualite::PUBLIEE)

CONCLUSION
Ce que tu dois faire MAINTENANT
1. Corriger ton mapping
2. Vérifier ton code partout
Remplacer :
'publiee'
par :
StatutActualite::PUBLIEE
3. Adapter ton FormType
EnumType::class
4. Adapter Twig
statut.value
