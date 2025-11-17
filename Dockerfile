# Dockerfile (en la raíz del repo)
FROM php:8.2-apache

# Habilitar PostgreSQL PDO
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Copiar la API (carpeta api/)
COPY api/ /var/www/html/

# Permisos
RUN chown -R www-data:www-data /var/www/html

# Habilitar mod_rewrite (si lo necesitas)
RUN a2enmod rewrite

EXPOSE 80
CMD ["apache2-foreground"]
