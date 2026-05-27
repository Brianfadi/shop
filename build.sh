#!/usr/bin/env bash

# Exit on error
set -e

echo "=== Installing PHP dependencies ==="
composer install --no-dev --optimize-autoloader --no-interaction

echo "=== Installing Node dependencies ==="
npm ci

echo "=== Building frontend assets ==="
npm run production

echo "=== Caching config, routes, and views ==="
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "=== Creating storage symlink ==="
php artisan storage:link

echo "=== Running database migrations ==="
php artisan migrate --force

echo "=== Setting storage permissions ==="
chmod -R 775 storage bootstrap/cache

echo "=== Build complete ==="
