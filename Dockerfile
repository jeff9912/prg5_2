# Use official PHP 8.3 FPM image with Alpine (small, secure)
FROM php:8.3-fpm-alpine

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apk add --no-cache \
    bash \
    git \
    unzip \
    sqlite \
    sqlite-dev \
    libzip-dev \
    oniguruma-dev \
    curl \
    && docker-php-ext-install pdo pdo_sqlite mbstring zip bcmath

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy application code
COPY . .

# Copy your .env file (already exists in your repo)
# Make sure the path is correct in your repo
COPY .env .env

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions for storage and cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Make sure SQLite database file exists
RUN touch /opt/render/project/src/database/database.sqlite \
    && chmod 666 /opt/render/project/src/database/database.sqlite

# Expose port (match the port Render assigns)
EXPOSE 10000

# Run migrations and start built-in PHP server
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=10000
