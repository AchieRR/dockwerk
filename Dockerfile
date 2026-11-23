FROM node:24-alpine AS assets
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci
COPY resources ./resources
COPY vite.config.js ./
RUN npm run build

FROM dunglas/frankenphp:1-php8.4-alpine AS php-base
WORKDIR /app
RUN install-php-extensions bcmath intl mbstring opcache pdo_pgsql pdo_sqlite zip \
    && cp "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

FROM php-base AS dependencies
ENV COMPOSER_ALLOW_SUPERUSER=1
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-interaction --no-progress --prefer-dist
COPY . .
RUN mkdir -p storage/framework/views storage/framework/sessions storage/framework/cache/data storage/logs bootstrap/cache \
    && composer dump-autoload --no-dev --optimize --no-interaction \
    && php artisan filament:assets

FROM php-base AS runtime
ENV APP_ENV=production \
    APP_DEBUG=false \
    APP_LOCALE=nl \
    LOG_CHANNEL=stderr \
    SESSION_DRIVER=database \
    SESSION_SECURE_COOKIE=true \
    CACHE_STORE=database \
    QUEUE_CONNECTION=sync \
    LARAVEL_STORAGE_PATH=/tmp/dockwerk-storage \
    PORT=80
COPY --from=dependencies /app /app
COPY --from=assets /app/public/build /app/public/build
COPY docker/Caddyfile /etc/caddy/Caddyfile
COPY docker/start.sh /usr/local/bin/dockwerk-start
RUN chmod +x /usr/local/bin/dockwerk-start
EXPOSE 80
CMD ["dockwerk-start"]
