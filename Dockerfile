# Imagen base oficial de PHP con Apache
FROM php:8.2-apache

# Instalar dependencias necesarias para PostgreSQL
RUN apt-get update && \
    apt-get install -y libpq-dev && \
    rm -rf /var/lib/apt/lists/*

# Instalar extensiones PHP para PostgreSQL
RUN docker-php-ext-install pgsql pdo pdo_pgsql

# Habilitar mod_rewrite (si lo necesitas)
RUN a2enmod rewrite

# Copiar todo el proyecto al servidor
COPY . /var/www/html/

# Dar permisos correctos
RUN chown -R www-data:www-data /var/www/html

# Exponer el puerto
EXPOSE 80
