# Imagen base oficial de PHP con Apache
FROM php:8.2-apache

# Instalar extensión pgsql para PostgreSQL
RUN docker-php-ext-install pgsql pdo pdo_pgsql

# Habilitar mod_rewrite si lo necesitas
RUN a2enmod rewrite

# Copiar todo el proyecto al servidor
COPY . /var/www/html/

# Dar permisos
RUN chown -R www-data:www-data /var/www/html

# Exponer el puerto
EXPOSE 80
