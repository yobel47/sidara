# Menggunakan image PHP
FROM php:8.2-fpm

# Install dependencies yang dibutuhkan Laravel
# #
# Install PHP extensions
RUN docker-php-ext-install pdo_mysql gd zip

# Copy source code ke dalam container
COPY . /var/www

# Atur working directory
WORKDIR /var/www

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install dependencies PHP
RUN composer install --no-dev --optimize-autoloader