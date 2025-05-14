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
RUN composer install --no-dev --no-scripts --optimize-autoloader \
 && composer dump-autoload -o --no-scripts

# アプリ & .env
COPY . .
COPY .env.production .env
# Laravelの古いキャッシュがあっても削除
RUN rm -f bootstrap/cache/config.php bootstrap/cache/routes.php
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN php artisan vendor:publish --force --tag=livewire:assets \
 && php artisan filament:assets
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 80

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
