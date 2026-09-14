FROM node:22-alpine AS assets

WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci
COPY resources ./resources
COPY public ./public
COPY vite.config.js ./
RUN npm run build

FROM composer:2 AS vendor

WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-interaction --no-scripts --optimize-autoloader
COPY . ./
RUN composer dump-autoload --no-dev --optimize

FROM php:8.3-apache

RUN apt-get update \
    && apt-get install -y --no-install-recommends libonig-dev libzip-dev unzip \
    && docker-php-ext-install mbstring pdo_mysql pdo_pgsql zip \
    && a2enmod rewrite headers \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html
COPY docker/apache-vhost.conf /etc/apache2/sites-available/000-default.conf
COPY docker/php.ini /usr/local/etc/php/conf.d/grownexia.ini
COPY --from=vendor /app ./
COPY --from=assets /app/public/build ./public/build
COPY docker/start.sh /usr/local/bin/start-grownexia

RUN chmod +x /usr/local/bin/start-grownexia \
    && chown -R www-data:www-data storage bootstrap/cache

EXPOSE 10000
CMD ["start-grownexia"]
