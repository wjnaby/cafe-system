#!/usr/bin/env bash
set -e
cd /var/www/html

echo "[Laravel] Caching configuration..."
php artisan config:cache

echo "[Laravel] Caching routes..."
php artisan route:cache

echo "[Laravel] Caching views..."
php artisan view:cache

echo "[Laravel] Linking storage..."
php artisan storage:link || true

echo "[Laravel] Running migrations..."
php artisan migrate --force

echo "[Laravel] Startup complete."
