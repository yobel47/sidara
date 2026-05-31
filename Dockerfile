# Menggunakan image PHP
FROM php:8.2-fpm

# Install dependencies yang dibutuhkan Laravel
# Update repository dan install dependencies sistem terlebih dahulu
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    libonig-dev \
    && rm -rf /var/lib/apt/lists/* \
    curl \
    gnupg \
    && curl -sL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql gd zip mbstring

# Copy source code ke dalam container
COPY . /var/www

# Atur working directory
WORKDIR /var/www

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install dependencies PHP
RUN composer install --no-dev --optimize-autoloader