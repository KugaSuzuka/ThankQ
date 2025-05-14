# ---------- 0. ベース ----------
FROM php:8.3-fpm

# ---------- 1. PHP 拡張 ----------
RUN apt-get update && apt-get install -y \
      git zip unzip \
      libpng-dev libonig-dev libxml2-dev libzip-dev libicu-dev \
 && docker-php-ext-install \
      pdo_mysql mbstring zip bcmath intl \
 && apt-get clean && rm -rf /var/lib/apt/lists/*

# ---------- 2. Composer ----------
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# ---------- 3. 依存インストール（キャッシュ狙い）----------
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts

# ---------- 4. アプリ本体 & .env ----------
COPY . .
COPY .env.production .env

# ---------- 5. Entrypoint スクリプト ----------
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# ---------- 6. 起動設定 ----------
EXPOSE 80
ENTRYPOINT ["entrypoint.sh"]
CMD ["php", "-S", "0.0.0.0:80", "-t", "public"]
