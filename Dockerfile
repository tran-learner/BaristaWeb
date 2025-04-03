# Sử dụng PHP 8.2 + Apache
FROM php:8.2-apache

# Cài đặt extension PHP cần thiết
RUN apt-get update && apt-get install -y \
    libpq-dev unzip \
    && docker-php-ext-install pdo pdo_pgsql

# Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Đặt thư mục làm việc
WORKDIR /var/www/html/public    

# Copy source code vào container
COPY . .

# Cài đặt các package Laravel
RUN composer install --no-dev --optimize-autoloader

# Phân quyền storage
RUN chmod -R 777 storage bootstrap/cache

# Mở cổng 80 (Apache)
EXPOSE 80

# Chạy Laravel
CMD ["apache2-foreground"]
