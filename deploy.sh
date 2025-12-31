#!/bin/bash

# Deployment script for HIMA-SIKC Event Center
# Run this after uploading files to cPanel

echo "🚀 Starting deployment..."

# Install dependencies
echo "📦 Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader

# Copy production environment
echo "⚙️  Setting up environment..."
cp .env.production .env

# Generate application key if not set
if ! grep -q "APP_KEY=base64:" .env; then
    echo "🔑 Generating application key..."
    php artisan key:generate
fi

# Set permissions
echo "🔒 Setting permissions..."
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
chmod 644 .env

# Create storage link
echo "🔗 Creating storage link..."
php artisan storage:link

# Run migrations
echo "🗄️  Running migrations..."
php artisan migrate --force

# Clear and cache config
echo "⚡ Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Build assets
echo "🎨 Building assets..."
npm install
npm run build

echo "✅ Deployment completed successfully!"
echo "🌐 Your site should now be accessible."