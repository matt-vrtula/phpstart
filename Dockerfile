FROM php:8.3-apache

# Install system dependencies for Composer
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    libzip-dev \
    && docker-php-ext-install zip

# Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

# Install extensions (e.g. mysqli for MySQL)
RUN docker-php-ext-install mysqli

# Enable Apache mod_rewrite if needed
RUN a2enmod rewrite
