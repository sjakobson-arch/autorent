FROM php:8.2-apache

# Install mysqli + pdo_mysql
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy project (but compose will override with volume)
COPY . /var/www/html

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html
