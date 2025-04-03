# Sử dụng PHP 8.2 + Apache
FROM php:8.2-apache

# Cài đặt các extension PHP cần thiết
RUN apt-get update && apt-get install -y \
    libpq-dev unzip \
    && docker-php-ext-install pdo pdo_pgsql

# Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Kích hoạt mod_rewrite cho Apache
RUN a2enmod rewrite

# Cấu hình thư mục gốc của Apache vào thư mục public của Laravel
WORKDIR /var/www/html

# Copy source code vào container
COPY . .

# Cài đặt các package Laravel
RUN composer install --no-dev --optimize-autoloader

# Phân quyền storage và cache
RUN chmod -R 777 storage bootstrap/cache

# Cấu hình Apache để cho phép .htaccess
RUN echo '<Directory /var/www/html/public>' >> /etc/apache2/apache2.conf \
    && echo '    AllowOverride All' >> /etc/apache2/apache2.conf \
    && echo '    Require all granted' >> /etc/apache2/apache2.conf \
    && echo '</Directory>' >> /etc/apache2/apache2.conf

# Cập nhật thư mục root của Apache để trỏ tới thư mục public của Laravel
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Mở cổng 80 (Apache)
EXPOSE 80

# Chạy Apache trong foreground
CMD ["apache2-foreground"]
