# Dockerfile
FROM php:8.2-apache

# Habilitar ext pdo_pgsql
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Copiar API
COPY api/ /var/www/html/

# Permisos (si necesario)
RUN chown -R www-data:www-data /var/www/html

# Habilitar rewrite
RUN a2enmod rewrite

EXPOSE 80
CMD ["apache2-foreground"]
