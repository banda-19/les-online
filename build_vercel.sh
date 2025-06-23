
#!/bin/bash
echo "Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader

echo "Building frontend assets..."
npm install
npm run build

echo "Linking storage..."
php artisan storage:link

echo "Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache