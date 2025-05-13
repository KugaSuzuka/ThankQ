# Dockerfile (プロダクション向け最小例)
FROM php:8.2-fpm

# 必要拡張のインストール
RUN apt-get update && apt-get install -y \
    git zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev \
 && docker-php-ext-install pdo_mysql mbstring zip

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 作業ディレクトリ
WORKDIR /var/www

# 依存インストール → キャッシュ狙いで composer.json だけ先に
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader

# アプリケーションコピー
COPY . .

# Laravel キャッシュ系
RUN php artisan config:cache \
 && php artisan route:cache \
 && php artisan view:cache

# ポート
EXPOSE 80
CMD ["php", "-S", "0.0.0.0:80", "-t", "public"]
