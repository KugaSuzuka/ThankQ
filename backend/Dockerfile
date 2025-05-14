FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    git zip unzip \
    libpng-dev libonig-dev libxml2-dev libzip-dev libicu-dev \
 && docker-php-ext-install pdo_mysql mbstring zip bcmath intl \
 && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# 依存インストール（キャッシュ狙い）
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts

# アプリ & .env
COPY . .
COPY .env.production .env
# Laravelの古いキャッシュがあっても削除
RUN rm -f bootstrap/cache/config.php bootstrap/cache/routes.php
EXPOSE 80
CMD ["php", "-S", "0.0.0.0:80", "-t", "public"]
