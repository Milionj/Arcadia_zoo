Lancer le projet (via Docker)
docker compose up -d --build

Base de données & données de test:

php bin/console doctrine:database:drop --force
php bin/console doctrine:database:create
php bin/console doctrine:schema:update --force

Charger les données fictives (fixtures) :
php bin/console doctrine:fixtures:load
