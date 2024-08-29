# Dockerfile per Laravel
FROM php:8.1-fpm

# Installare le dipendenze di sistema
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    unzip \
    git \
    curl

# Installare le estensioni PHP necessarie
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd

# Installare Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Impostare la directory di lavoro
WORKDIR /var/www

# Copiare il contenuto del progetto Laravel
COPY . .

# Installare le dipendenze di Laravel
RUN composer install

# Esporre la porta per il server PHP
EXPOSE 9000

CMD ["php-fpm"]
