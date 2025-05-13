# ───────── Dockerfile（修正版）─────────
FROM php:8.3-fpm

# OS パッケージ & PHP 拡張のインストール
RUN apt-get update && apt-get install -y \
    git zip unzip \
    libpng-dev libonig-dev libxml2-dev libzip-dev \
    libicu-dev                                \
 && docker-php-ext-install \
    pdo_mysql mbstring zip bcmath intl        \
 && apt-get clean && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# アプリケーションコピー
COPY . .

# 依存インストール（キャッシュ狙い）
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader
# アプリケーションコピー
COPY .env.production .env

# Laravel キャッシュ
RUN php artisan config:cache && \
    php artisan route:cache  && \
    php artisan view:cache

EXPOSE 80
CMD ["php", "-S", "0.0.0.0:80", "-t", "public"]
