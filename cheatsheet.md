Création d'un projet

    symfony new --webapp NomProjet


Lancer un serveur et l'arreter

    symfony server:start
    symfony server:stop

# Controllers

Créer un controller avec l'assistant

    symfony console make:controller NomController



# Modèle

1. importer doctrine

    symfony composer req symfony/orm-pack

2. changer les paramètres de la BD (.env dans la racine)

        DATABASE_URL="mysql://root:@127.0.0.1:3306/bibliotheque?serverVersion=10.11.2-MariaDB&charset=utf8mb4"

3. créer la BD (allumer le serveur MySQL d'abord!)

        symfony console doctrine:database:create

        symfony console d:d:c

    (Pour effacer la BD, utilisez *drop* au lieu de *create*)

4. créer les Entity (classes du diagramme de classes)

Créer une entité ou rajouter de propriétés à une entité

    symfony console make:entity

On peut uniquement rajouter de propriétés à l'entité, l'assistant ne peut pas les éliminer

Créer et puis lancer une migration:

    symfony console make:migration
    symfony console doctrine:migrations:migrate


# Fixtures

Installer le module

    symfony composer req --dev orm-fixtures

Créer un fichier de fixure

    symfony console make:fixture

Lancer les fixtures

    symfony console doctrine:fixtures:load

Rajouter Faker au projet

    composer require fakerphp/faker

# Formulaires

Création d'un formulaire associé à une entité

    symfony console make:form