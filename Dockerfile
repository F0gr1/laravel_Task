FROM php:8.4-fpm-bookworm AS php-base

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN docker-php-ext-install pdo_mysql

FROM composer:2 AS vendor

WORKDIR /var/www/html

ARG INSTALL_DEV=0

COPY composer.json composer.lock ./
RUN if [ "$INSTALL_DEV" = "1" ]; then \
        composer install --prefer-dist --no-interaction --no-progress --no-scripts; \
    else \
        composer install --prefer-dist --no-interaction --no-progress --no-dev --no-scripts; \
    fi

COPY . .

RUN composer dump-autoload --optimize --no-interaction

FROM node:22-bookworm-slim AS assets

WORKDIR /var/www/html

COPY package.json package-lock.json vite.config.js ./
COPY resources ./resources
RUN npm ci --no-audit && npm run production

FROM php-base AS runtime

WORKDIR /var/www/html
COPY . .
COPY --from=vendor /var/www/html/vendor ./vendor
COPY --from=assets /var/www/html/public/build ./public/build
RUN mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

CMD ["php-fpm"]

FROM runtime AS development

FROM runtime AS production

FROM nginx:1.27-alpine AS web

COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf
COPY --from=runtime /var/www/html/public /var/www/html/public
