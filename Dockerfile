FROM php:8.3-fpm

RUN apt-get update && apt-get install -y git curl unzip \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www/html

# Copia composer.json de src/
COPY src/composer.json ./

# Instala dependências
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Copia o resto de src/
COPY src/ .

# Permissões
RUN chown -R www-data:www-data /var/www/html

CMD ["php-fpm"]