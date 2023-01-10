FROM php:8.1-fpm-alpine

WORKDIR /var/www

# Install system dependencies
RUN docker-php-ext-install pdo pdo_mysql && \
    apk add bash git

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apk add --no-cache pcre-dev $PHPIZE_DEPS \
        && pecl install redis \
        && docker-php-ext-enable redis.so
