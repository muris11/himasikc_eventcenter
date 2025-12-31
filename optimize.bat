 @echo off
 echo ========================================
 echo   HIMA SIKC - Production Optimization
 echo ========================================
 echo.
 
 echo [1/7] Clearing all caches...
 php artisan cache:clear
 php artisan config:clear
 php artisan route:clear
 php artisan view:clear
 
 echo.
 echo [2/7] Caching configuration...
 php artisan config:cache
 
 echo.
 echo [3/7] Caching routes...
 php artisan route:cache
 
 echo.
 echo [4/7] Caching views...
 php artisan view:cache
 
 echo.
 echo [5/7] Caching events...
 php artisan event:cache
 
 echo.
 echo [6/7] Building frontend assets...
 call npm run build
 
 echo.
 echo [7/7] Optimizing autoloader...
 composer dump-autoload --optimize --no-dev
 
 echo.
 echo ========================================
 echo   Optimization Complete!
 echo ========================================
 echo.
 pause
