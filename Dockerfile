# Utilise l'image PHP avec Apache
FROM php:8.3-apache

# Active mod_rewrite (utile pour Symfony)
RUN a2enmod rewrite

# Installe les extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    git unzip zip libpq-dev libonig-dev libzip-dev libicu-dev \
    && docker-php-ext-install pdo pdo_mysql intl mbstring zip

# Installe Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copie les fichiers du projet dans le conteneur
COPY . /var/www/html

# Donne les bons droits
RUN chown -R www-data:www-data /var/www/html

# Configure Apache pour autoriser .htaccess
RUN echo '<Directory /var/www/html/public>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/symfony.conf && \
    a2enconf symfony

# Définir le dossier public comme racine du serveur
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Appliquer le changement de racine dans Apache
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf
