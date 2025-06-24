FROM php:8.3-apache

# Install extensions (e.g. mysqli for MySQL)
RUN docker-php-ext-install mysqli

# Enable Apache mod_rewrite if needed
RUN a2enmod rewrite
