FROM php:7.1-alpine

COPY --from=composer /usr/bin/composer /usr/bin/composer
