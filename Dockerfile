
FROM php:8.3-apache

# Instal dependensi sistem dan ekstensi PHP
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libzip-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

# Ubah document root Apache ke folder public Laravel
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/000-default.conf \
    /etc/apache2/apache2.conf \
    /etc/apache2/conf-available/*.conf

WORKDIR /var/www/html

# Instal Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Salin project
COPY . .

# Instal dependency Laravel
RUN composer install --no-dev --optimize-autoloader

# Permission storage dan cache
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Jalankan Apache
CMD ["apache2-foreground"]
