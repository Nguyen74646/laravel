FROM php:8.1-fpm

# Cài các extension cần thiết
RUN apt-get update && apt-get install -y \
    git curl unzip zip libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip gd mbstring

# Cài ext-mongodb
RUN pecl install mongodb && docker-php-ext-enable mongodb

# Cài composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install --no-dev --optimize-autoloader

# Laravel public chạy ở port 8080 (phải khớp với Railway)
EXPOSE 8080

# Run Laravel PHP built-in server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
