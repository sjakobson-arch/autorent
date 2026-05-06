FROM php:8.2-apache

# Install MySQL server
RUN apt-get update && apt-get install -y mariadb-server

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache rewrite
RUN a2enmod rewrite

# Copy custom php.ini
COPY php.ini /usr/local/etc/php/

COPY init.sql /docker-entrypoint-initdb.d/

# Start MySQL automatically
CMD service mysql start && apache2-foreground
