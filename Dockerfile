FROM php:8.1-fpm

# Cài các gói cần thiết
RUN apt-get update && apt-get install -y \
    git curl unzip zip libzip-dev pkg-config libssl-dev libcurl4-openssl-dev

# Ép cài đúng version mongodb ext
RUN pecl install mongodb && docker-php-ext-enable mongodb


# Các extension Laravel cần
RUN docker-php-ext-install pdo zip bcmath

# Cài Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy toàn bộ code
COPY . /var/www
WORKDIR /var/www

# Cài các package PHP
RUN composer install --no-dev --optimize-autoloader

# Phân quyền
RUN chmod -R 775 storage bootstrap/cache

# Chạy Laravel trên cổng 8080 (Railway cần)
CMD php artisan serve --host=0.0.0.0 --port=8080
