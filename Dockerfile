FROM php:8.1-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libicu-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl zip \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Disable root warning
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV XDEBUG_MODE=coverage
ENV PHP_MEMORY_LIMIT=1G

RUN echo "memory_limit=1G" > /usr/local/etc/php/conf.d/memory-limit.ini

# Set working directory
WORKDIR /app
