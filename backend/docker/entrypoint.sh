#!/usr/bin/env sh
set -eu
php artisan route:clear
php artisan config:clear
php artisan cache:clear
php artisan view:clear

echo "▶︎ Running database migrations…"
php artisan migrate --force

echo "▶︎ Seeding initial data…"
# Seeder が無い場合は行ごと削除して OK
php artisan db:seed --class=UserSeeder --force || true


echo "▶︎ Starting PHP built-in server"
exec php -S 0.0.0.0:80 -t public
