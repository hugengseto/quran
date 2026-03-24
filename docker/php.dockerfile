FROM php:8.4-fpm-alpine

# Install sistem dependensi (dibutuhkan untuk ekstensi PHP tertentu)
RUN apk add --no-cache \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl

# Install ekstensi PHP yang wajib untuk Laravel
RUN docker-php-ext-install pdo pdo_mysql gd zip

# Ambil Composer terbaru dari image resmi
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set tempat kerja di dalam kontainer
WORKDIR /var/www/html

# Membuat user 'www' dengan ID 1000 agar sinkron dengan Fedora
RUN addgroup -g 1000 www && \
    adduser -u 1000 -G www -s /bin/sh -D www

# Beritahu Docker untuk selalu menggunakan user ini
USER www