FROM php:8.2-apache

# Habilitar módulos necessários (rewrite útil para SEO/canonicals caso use .htaccess futuramente)
RUN a2enmod rewrite

# Copiar código para o DocumentRoot padrão
COPY . /var/www/html/

# Definir permissões básicas (opcional em ambiente de build)
RUN chown -R www-data:www-data /var/www/html

# Expor porta padrão do Apache
EXPOSE 80

# O apache-foreground é o CMD do php:apache por padrão