1. FOCUS : le système de rôles

**Définition simple**
Cette ligne sert à stocker les rôles d’un utilisateur (Agent) en base de données.

#[ORM\Column(type: 'json')]
private array $roles = [];

- Ligne décomposée
#[ORM\Column(type: 'json')]

. ORM = Object-Relational Mapping
→ Outil qui fait le lien entre objet PHP ↔ table SQL
. Column
→ Champ en base de données

. type: 'json'
→ Stockage sous forme de tableau JSON en BDD

Exemple en base :
["ROLE_AGENT", "ROLE_ADMIN"]

private array $roles = [];
propriété privée

type : tableau
valeur par défaut : vide

Pourquoi JSON ?

Parce qu’un agent peut avoir plusieurs rôles

Exemple :

simple agent → ROLE_AGENT
RH → ROLE_AGENT + ROLE_RH
admin → ROLE_ADMIN

Carte mémoire (IMPORTANT)
ROLES = autorisations

ROLE_AGENT → utilisateur normal
ROLE_RH → gestion RH
ROLE_ADMIN → super admin

Stockage = JSON (tableau)
Ex: ["ROLE_AGENT", "ROLE_RH"]

**POINT CRUCIAL (souvent oublié)**

Dans mon constructeur :

$this->roles = [self::ROLE_AGENT];

Donc TOUS les agents ont au minimum ROLE_AGENT

Méthode clé

public function getRoles(): array
{
    $roles = $this->roles;
    $roles[] = self::ROLE_AGENT;
    return array_unique($roles);
}

Sécurité :

garantit qu’un utilisateur a toujours un rôle
évite les bugs d’accès

2. EXPLICATION GLOBALE DE L’ENTITÉ AGENT

Agent = utilisateur du système RH

3. LECTURE LIGNE PAR LIGNE + LOGIQUE

IDENTITÉ TECHNIQUE
#[ORM\Id]
#[ORM\GeneratedValue]
#[ORM\Column]
private ?int $id = null;

Carte mémoire
ID = clé primaire
auto-incrémentée
unique

IDENTITÉ MÉTIER
#[ORM\Column(length: 100)]
 #[Assert\NotBlank] <!-- Champ obligatoire -->
private ?string $nom = null;


#[ORM\Column(length: 100)]
#[Assert\NotBlank]
private ?string $prenom = null;

#[ORM\Column(length: 255, unique: true)]
#[Assert\NotBlank]
#[Assert\Email]
private ?string $email = null;

Carte mémoire
email :
- obligatoire
- unique
- format valide

ROLES (déjà vu)

gestion des droits

ORGANISATION
private ?string $poste
private ?string $service
private ?string $direction
private ?string $pole

Logique métier
Agent appartient à :
→ un poste
→ un service
→ une direction
→ un pôle

Sert pour :

filtrer
organiser
afficher

4. RELATIONS (TRÈS IMPORTANT)


1. Agent → Documents
#[ORM\OneToMany(mappedBy: 'agent', targetEntity: Document::class)]
private Collection $documents;

Traduction
1 Agent → plusieurs Documents

Relation inverse (dans Document)
ManyToOne → Agent

2. Agent → Actualités rédigées
mappedBy: 'auteur'
1 Agent écrit plusieurs actualités

3. Agent → Actualités validées
mappedBy: 'validateur'
1 Agent valide plusieurs actualités

**séparation importante :**
auteur ≠ validateur

4. Agent → Logs
mappedBy: 'utilisateur'

1 Agent → plusieurs logs de consultation

Sert pour :
traçabilité
audit
sécurité

CARTE MÉMOIRE GLOBALE
AGENT = utilisateur central

ATTRIBUTS :
- id
- nom
- prénom
- email
- roles

ORGANISATION :
- poste
- service
- direction
- pôle

RELATIONS :
- documents (1 → N)
- actualités rédigées (1 → N)
- actualités validées (1 → N)
- logs (1 → N)

VISION ARCHITECTURE (ULTRA IMPORTANT)
           Agent
             |
   -----------------------
   |    |       |       |
Documents  Actu    Actu   Logs
           (write) (validate)

CE QUE TU DOIS RETENIR (essentiel)

1. roles = sécurité (Symfony Security)
2. Agent = cœur du système
3. relations = structure de ton application
4. OneToMany = toujours réfléchi comme :

"1 Agent possède plusieurs ..."

## MODIFICATION VARCHAR(100)  en ENUM
La ligne complète
1. columnDefinition: "ENUM('Population','Développement','Territoire','Ressources') NOT NULL DEFAULT 'Ressources'"
ENUM('Population','Développement','Territoire','Ressources')
ENUM = type spécial MySQL qui limite les valeurs possibles

Ici, la colonne ne peut prendre que 4 valeurs possibles :

'Population', 'Développement', 'Territoire', 'Ressources'

**Carte mémoire :**

ENUM = liste fermée de valeurs possibles
2. NOT NULL
La colonne ne peut pas être vide.
Autrement dit, chaque enregistrement doit avoir une valeur pour cette colonne.

**Carte mémoire :**

NOT NULL = obligatoire
3. DEFAULT 'REssources'
Si on n’indique pas de valeur lors de l’insertion, la colonne prendra automatiquement ‘Ressources’, ce qui reste logique car le Pôle RH fait partie du Pôle Ressources.

**Carte mémoire :**

DEFAULT = valeur par défaut si non précisée
4. Exemple concret en SQL
INSERT INTO table (nom_colonne) VALUES ('Développement');  -- OK
INSERT INTO table (nom_colonne) VALUES (NULL);            -- ❌ interdit à cause de NOT NULL
INSERT INTO table DEFAULT VALUES;                         -- prendra 'Population'

5. Résumé mémoire rapide
Mot-clé	Signification
ENUM(...)	Valeurs possibles limitées
NOT NULL	Obligatoire, ne peut pas être vide
DEFAULT 'X'	Valeur par défaut si aucune valeur donnée

**Astuce pour retenir :**

ENUM        = liste Exclusive
NOT NULL    = Non nul
DEFAULT     = valeur par défaut

Changement manuel


SELECT DISTINCT pole FROM agent;

→ Résultat : Empty set, donc la colonne pole est vide.

Ce que ça implique pour la migration ENUM
Aucune valeur existante dans pole → aucun risque de blocage MySQL lors de la conversion en ENUM.
1. créer une migration manuelle qui transforme VARCHAR(100) en ENUM directement, sans nettoyer la colonne.

**Migration Doctrine**
Créer un fichier dans migrations/ par exemple Version20260408075341.php :

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260408XXXXXX extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Transform pole column from VARCHAR to ENUM';
    }

    public function up(Schema $schema): void
    {
        // Transformation de pole en ENUM
        $this->addSql("ALTER TABLE agent MODIFY COLUMN pole ENUM('Population','Développement','Territoire','Ressources') NOT NULL DEFAULT 'Ressources'");
    }

    public function down(Schema $schema): void
    {
        // Retour arrière : back to VARCHAR
        $this->addSql("ALTER TABLE agent MODIFY COLUMN pole VARCHAR(100) NOT NULL");
    }
}

**Appliquer la migration**

Génèrer la migration dans Symfony :
docker exec -it drh_app php bin/console make:migration

Appliquer-la :
docker exec -it drh_app php bin/console doctrine:migrations:migrate

Doctrine va transformer pole en ENUM MySQL.
Vu que la colonne est vide, tout se passera sans erreur.

### MODIFICATION DOCUMENT POUR TYPE

Optimisation simple côté VARCHAR

Tu peux juste ajuster le length :

#[ORM\Column(length: 5)]
#[Assert\Choice(choices: ['pdf', 'doc', 'docx', 'xls', 'xlsx'])]
private ?string $type = null;
Suffisant pour tous les formats listés.
Plus clair, plus léger en base.


**Option ENUM MySQL**

Si tu veux que la base impose les valeurs :

#[ORM\Column(columnDefinition: "ENUM('pdf','doc','docx','xls','xlsx') NOT NULL")]
#[Assert\Choice(choices: ['pdf', 'doc', 'docx', 'xls', 'xlsx'])]
private ?string $type = null;
Doctrine générera un ALTER TABLE pour transformer la colonne en ENUM.
Avantage : impossibilité d’injecter des valeurs invalides côté base.


**Option Enum PHP (PHP 8.1+)**

Pour avoir la sécurité totale côté code :

enum DocumentType: string {
    case PDF = 'pdf';
    case DOC = 'doc';
    case DOCX = 'docx';
    case XLS = 'xls';
    case XLSX = 'xlsx';
}

#[ORM\Column(type: 'string', length: 5)]
private ?DocumentType $type = null;
Typé → impossible de mettre une valeur invalide.
Doctrine peut mapper l’Enum en string.
Modernise ton code et simplifie la maintenance si de nouveaux types apparaissent.

**Résumé / Recommandation :**

stricte validation côté base → ENUM MySQL.
