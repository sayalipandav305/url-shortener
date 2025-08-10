# Use the official PHP image as the base image
FROM php:8.2-fpm

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libzip-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libwebp-dev \
    locales \
    git \
    curl \
    unzip \
    libonig-dev \
    libpq-dev \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install -j$(nproc) \
    pdo_mysql \
    mbstring \
    zip \
    exif \
    pcntl \
    gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy the application code to the working directory
COPY . /var/www/html

# Set permissions for the storage and cache directories
RUN chown -R www-data:www-data /var/www/html/storage \
    && chown -R www-data:www-data /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage

# Expose port 9000 and start PHP-FPM
EXPOSE 9000
CMD ["php-fpm"]