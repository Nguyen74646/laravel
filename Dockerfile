# Dùng image PHP chính thức
FROM php:8.1-fpm

# Cài các extension cơ bản
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libssl-dev \
    pkg-config \
    && docker-php-ext-install pdo pdo_mysql zip gd mbstring

# Cài ext-mongodb
RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

# Cài composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Tạo thư mục app
WORKDIR /var/www

COPY . .

# Cài đặt Laravel
RUN composer install --no-dev --optimize-autoloader

# Laravel public
CMD php artisan serve --host=0.0.0.0 --port=3000
