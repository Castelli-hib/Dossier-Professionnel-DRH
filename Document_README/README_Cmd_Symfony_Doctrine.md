Tableau des commandes Symfony / Doctrine (projet DRH)
⚙️ 1. Création & structure du projet
Commande	Rôle	Utilité
symfony new mon_projet --webapp	Créer un projet Symfony complet	Base du projet (Twig, Doctrine, etc.)
composer require symfony/orm-pack	Installer Doctrine	Gestion base de données
composer require --dev symfony/maker-bundle	Installer Maker Bundle	Générer entités, controllers, etc.
🧱 2. Base de données
Commande	Rôle	Utilité
symfony console doctrine:database:create	Créer la base	Initialise la base SQL
symfony console doctrine:schema:validate	Vérifier schéma	Vérifie si entités OK
symfony console doctrine:schema:update --force	Appliquer schéma	Sync entités → base
symfony console doctrine:migrations:migrate	Appliquer migrations	Méthode propre recommandée
🧬 3. Entités (Doctrine)
Commande	Rôle	Utilité
symfony console make:entity NomEntite	Créer entité	Génère classe + champs
symfony console make:migration	Créer migration	Transforme entité → SQL
symfony console doctrine:migrations:diff	Comparer DB/entités	Génère migration automatiquement
🧪 4. Tests des entités (ton “laboratoire DRH”)
Commande	Rôle	Utilité
symfony console make:command NomCommande	Créer commande test	Base du test entités
symfony console app:test-entities	Lancer tests entités	Ta commande personnalisée
symfony console debug:container validator	Vérifier service validator	Tester injection Symfony
🧾 5. Validation & debug
Commande	Rôle	Utilité
symfony console debug:validator App\Entity\X	Voir contraintes entité	Vérifie annotations #[Assert]
symfony console debug:container	Liste services	Debug global
symfony console debug:router	Routes	Vérifie URLs
🧩 6. Génération MVC (après entités)
Commande	Rôle	Utilité
symfony console make:controller NomController	Créer controller	Base logique web
symfony console make:form NomType	Créer formulaire	Lien entité ↔ formulaire
symfony console make:crud NomEntite	Générer CRUD complet	Controller + form + Twig
🧪 7. Tests (qualité)
Commande	Rôle	Utilité
composer require --dev phpunit/phpunit	Installer tests	Base testing
symfony console make:test TestClass	Créer test unitaire	PHPUnit Symfony
vendor/bin/phpunit	Lancer tests	Exécuter suite test
🔥 8. Commandes utiles de développement
Commande	Rôle	Utilité
symfony server:start	Lancer serveur	Développement local
symfony console cache:clear	Nettoyer cache	Résout bugs étranges
symfony console debug:autowiring	Services auto	Debug injection dépendances
🧠 9. Ton workflow logique (DRH propre)

Voici l’ordre idéal pour ton projet :

1️⃣ Entité
make:entity
2️⃣ Migration
make:migration
doctrine:migrations:migrate
3️⃣ Test entité (TA commande)
app:test-entities
4️⃣ Validation règles métier
debug:validator
5️⃣ Controller + Form
make:controller
make:form
💡 10. Résumé simple (important)

👉 Tu peux retenir ça :

🧱 entité → make:entity
🗄 base → migrations
🧪 test → app:test-entities
🌐 web → controller + form + twig