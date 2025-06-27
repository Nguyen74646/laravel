FROM php:8.1-fpm

# Cài các dependency
RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev libpng-dev libonig-dev libxml2-dev libssl-dev pkg-config libcurl4-openssl-dev

# Cài ext cần thiết
RUN docker-php-ext-install pdo mbstring zip exif pcntl bcmath gd

# Cài ext-mongodb
RUN pecl install mongodb && docker-php-ext-enable mongodb

# Cài Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy source vào container
COPY . /var/www

WORKDIR /var/www

# Cài các gói PHP
RUN composer install --no-dev --optimize-autoloader

# Laravel key & quyền thư mục
RUN chmod -R 775 storage bootstrap/cache

# Laravel dùng cổng 8080 trên Railway
CMD php artisan serve --host=0.0.0.0 --port=8080
