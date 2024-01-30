FROM php:8.3-fpm-alpine

RUN wget https://raw.githubusercontent.com/composer/getcomposer.org/76a7060ccb93902cd7576b67264ad91c8a2700e2/web/installer -O - -q | php && \
    mv composer.phar /usr/local/bin/composer

EXPOSE 8000
