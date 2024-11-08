Structure du projet
------------------------


backend : Le backend en Symfony pour la gestion des API et la logique serveur.
frontend : Le frontend en Vue.js pour l'interface utilisateur.



Étapes détaillées
---------------------


- Installation des dépendances
composer install


- Configuration de la base de données
Dans le fichier .env, configurez l'URL de la base de données (par exemple pour XAMPP : DATABASE_URL="mysql://root:@127.0.0.1:3306/animal").
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
