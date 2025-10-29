FROM php:8.3-fpm-alpine

WORKDIR /var/www/html

RUN apk add --no-cache \
    bash git unzip sqlite sqlite-dev libzip-dev oniguruma-dev curl \
    && docker-php-ext-install pdo pdo_sqlite mbstring zip bcmath

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
COPY . .

RUN composer install --no-dev --optimize-autoloader
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN mkdir -p /opt/render/project/src/database \
    && touch /opt/render/project/src/database/database.sqlite \
    && chmod 666 /opt/render/project/src/database/database.sqlite


EXPOSE $PORT

CMD ["sh", "-c", "php artisan migrate --force && php artisan config:cache && php artisan route:cache && php artisan serve --host=0.0.0.0 --port=$PORT"]
