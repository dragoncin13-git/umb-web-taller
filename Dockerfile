FROM php:8.2-apache

# Activar mod_rewrite (opcional pero recomendado)
RUN a2enmod rewrite

# Copiar todo el proyecto dentro del contenedor
COPY . /var/www/html/

# Dar permisos a Apache
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Exponer el servidor
EXPOSE 80

# Iniciar Apache
CMD ["apache2-foreground"]
