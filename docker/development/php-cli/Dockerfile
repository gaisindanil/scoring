FROM php:8.1-cli-alpine

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/bin --filename=composer --quiet


RUN apk update && apk add libpq-dev icu-dev \
    && apk add libzip-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo_pgsql \
    && docker-php-ext-install zip \
    && docker-php-ext-install intl \
    && docker-php-ext-enable intl

ENV COMPOSER_ALLOW_SUPERUSER 1

WORKDIR /app