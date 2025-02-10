FROM php:8.1-fpm

# Install ekstensi MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Set working directory
WORKDIR /var/www/html
