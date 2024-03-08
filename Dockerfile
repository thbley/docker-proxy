FROM php:8.3-cli-alpine

RUN pecl download redis \
    && mkdir -p /usr/src/php/ext/redis /usr/src/php/ext/pcov \
    && tar xzf redis-*.tgz -C /usr/src/php/ext/redis --strip 1 \
    && rm *.tgz \
    && docker-php-ext-install -j$(nproc) redis opcache \
    && docker-php-source delete \
    && rm -rf /usr/src

WORKDIR /var/www
