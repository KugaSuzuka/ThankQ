#!/usr/bin/env sh
set -eu

echo "▶︎ Running database migrations…"
php artisan migrate --force           # ① ここで cache テーブルを含む全マイグレーションを適用

echo "▶︎ Clearing & rebuilding caches…"
php artisan optimize:clear            # ② テーブルが出来た後にキャッシュ系を実行
php artisan route:cache

echo "▶︎ Starting PHP built‑in server"
exec php -S 0.0.0.0:80 -t public      # フォアグラウンドで常駐（PID 1）
