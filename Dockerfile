FROM php:8.4-fpm-alpine

# System dependencies
RUN apk add --no-cache \
    icu-dev \
    postgresql-dev \
    libpng-dev \
    libzip-dev\
    git \
    unzip

# PHP Extension
RUN docker-php-ext-install \
    intl \
    pdo \
    pdo_pgsql \
    gd \
    zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html