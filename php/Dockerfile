FROM composer:latest AS composer
FROM php:8.1-alpine
COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN apk update \
    && apk add icu-dev libxslt-dev libzip-dev \
    && docker-php-ext-install xsl \
    && docker-php-ext-install intl \
    && docker-php-ext-install zip