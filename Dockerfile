FROM composer:2.7 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-progress --optimize-autoloader

FROM node:20-alpine AS node
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY resources/ resources/
COPY vite.config.js tailwind.config.js postcss.config.js ./
RUN npm run build

FROM php:8.2-fpm-alpine
WORKDIR /var/www/html

RUN apk add --no-cache \
        nginx \
        supervisor \
        icu-dev \
        oniguruma-dev \
        libzip-dev \
        libpng-dev \
        freetype-dev \
        jpeg-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        pdo_pgsql \
        pgsql \
        mbstring \
        bcmath \
        intl \
        zip \
        gd \
        opcache \
    && rm -rf /var/cache/apk/*

COPY . /var/www/html
COPY --from=vendor /app/vendor /var/www/html/vendor
COPY --from=node /app/public/build /var/www/html/public/build
COPY nginx.conf /etc/nginx/http.d/default.conf
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 10000
CMD ["supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
