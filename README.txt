Structure du projet
------------------------


backend : Le backend en Symfony pour la gestion des API et la logique serveur.
frontend : Le frontend en Vue.js pour l'interface utilisateur.



Étapes détaillées
---------------------


- Installation des dépendances
composer install


- Configuration de la base de données
Dans le fichier .env, configurez l'URL de la base de données (par exemple pour XAMPP : DATABASE_URL="mysql://root:@127.0.0.1:3306/betail").
php bin/console doctrine:database:create
php bin/console make:migration
php bin/console doctrine:migrations:migrate


- Frontend - Installation de Vue.js et Tailwind CSS
cd frontend
npm install


- Compilation des assets
npm run serve


- Lancer le serveur
symfony server:start


- Accéder au projet
Rendez-vous sur http://127.0.0.1:8081 



Temps estimé pour chaque étape
--------------------------------


Création du projet Symfony		=>	15 minutes
Configuration de la base de données	=>	10 minutes
Installation de Vue.js et Tailwind	=>	20 minutes
Mise en place des entités et API	=>	30 minutes
Création du front Vue.js		=>	50 minutes
Intégration du front et du backend	=>	15 minutes
Création de la commande createuser	=>	20 minutes
Tests et validation			=>	30 minutes

Total = 3h15











Améliorations possibles
-------------------------
Sécurité
-----------

Validation des entrées utilisateur : Ajouter des validations strictes pour toutes les données envoyées via les formulaires afin de prévenir les injections SQL.

Authentification : Mettre en place un système d’authentification pour le back-office afin de limiter l’accès aux seuls utilisateurs autorisés. Symfony propose un composant Security qui peut être configuré pour cela.



Remarques de sécurité
Pour cet exercice, toutes les informations sensibles, comme les identifiants de base de données, ont été laissées en dur dans le code pour simplifier l'installation et la configuration.

En situation réelle, ces informations devraient être stockées dans un fichier .env ou d'autres variables d'environnement sécurisées. Cela permet de protéger les informations sensibles et de faciliter la configuration sur différents environnements, sans risque d'exposition sur un dépôt public comme GitHub.