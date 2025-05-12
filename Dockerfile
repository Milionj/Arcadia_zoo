FROM php:8.3.14-cli

# Installer les dépendances système
RUN apt-get update && apt-get install -y \
    git unzip zip libpq-dev libonig-dev libzip-dev libicu-dev \
    && docker-php-ext-install pdo pdo_pgsql intl mbstring zip

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /app

# Copier tous les fichiers dans le conteneur
COPY . .

# Installer les dépendances Symfony
RUN composer install

# Démarrage du serveur PHP
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
