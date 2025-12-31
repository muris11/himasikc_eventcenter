 # Panduan Deployment ke cPanel
 
 ## Struktur Hosting cPanel
 
 Untuk hosting di cPanel dengan **document root di folder /public**, ikuti langkah berikut:
 
 ### Opsi 1: Document Root Langsung ke /public (Recommended)
 
 Jika hosting memungkinkan mengubah document root:
 
 1. Upload SEMUA file project ke folder di luar public_html, misalnya:
    ```
    /home/username/hima-sikc/
    ```
 
 2. Di cPanel > Domains, ubah document root ke:
    ```
    /home/username/hima-sikc/public
    ```
 
 3. Selesai! Website langsung berjalan.
 
 ---
 
 ### Opsi 2: Menggunakan public_html (Standar cPanel)
 
 Jika tidak bisa mengubah document root:
 
 1. Upload semua file KECUALI folder `public` ke folder di luar public_html:
    ```
    /home/username/hima-sikc-app/
    ├── app/
    ├── bootstrap/
    ├── config/
    ├── database/
    ├── resources/
    ├── routes/
    ├── storage/
    ├── vendor/
    ├── .env
    └── ...
    ```
 
 2. Upload ISI folder `public` ke `public_html`:
    ```
    /home/username/public_html/
    ├── build/
    ├── storage -> ../hima-sikc-app/storage/app/public
    ├── .htaccess
    ├── index.php (EDIT FILE INI!)
    ├── logo.png
    ├── manifest.json
    ├── robots.txt
    └── sw.js
    ```
 
 3. **EDIT file `public_html/index.php`:**
    ```php
    <?php
    
    use Illuminate\Foundation\Application;
    use Illuminate\Http\Request;
    
    define('LARAVEL_START', microtime(true));
    
    // Path ke folder app (sesuaikan dengan lokasi Anda)
    $appPath = '/home/username/hima-sikc-app';
    
    if (file_exists($maintenance = $appPath.'/storage/framework/maintenance.php')) {
        require $maintenance;
    }
    
    require $appPath.'/vendor/autoload.php';
    
    $app = require_once $appPath.'/bootstrap/app.php';
    
    $app->handleRequest(Request::capture());
    ```
 
 4. **Buat symlink storage** via SSH atau File Manager:
    ```bash
    ln -s /home/username/hima-sikc-app/storage/app/public /home/username/public_html/storage
    ```
 
 ---
 
 ## Perintah Setelah Upload
 
 Jalankan via SSH atau Terminal cPanel:
 
 ```bash
 cd /home/username/hima-sikc-app
 
 # Set permissions
 chmod -R 755 storage bootstrap/cache
 chmod -R 775 storage/logs
 
 # Clear and cache
 php artisan config:cache
 php artisan route:cache
 php artisan view:cache
 
 # Generate app key (jika belum)
 php artisan key:generate
 
 # Storage link (jika pakai Opsi 1)
 php artisan storage:link
 ```
 
 ---
 
 ## Konfigurasi .env untuk Production
 
 ```env
 APP_NAME="HIMA-SIKC Event Center"
 APP_ENV=production
 APP_DEBUG=false
 APP_URL=https://event-center.himasikcpolindra.my.id
 
 # Database
 DB_CONNECTION=mysql
 DB_HOST=localhost
 DB_PORT=3306
 DB_DATABASE=nama_database
 DB_USERNAME=user_database
 DB_PASSWORD=password_database
 
 # Cache & Session
 CACHE_DRIVER=file
 SESSION_DRIVER=file
 QUEUE_CONNECTION=sync
 
 # Mail (opsional)
 MAIL_MAILER=smtp
 MAIL_HOST=smtp.mailtrap.io
 MAIL_PORT=587
 ```
 
 ---
 
 ## Checklist Sebelum Go Live
 
 - [ ] APP_DEBUG=false
 - [ ] APP_ENV=production
 - [ ] Database sudah di-migrate
 - [ ] Storage link sudah dibuat
 - [ ] Cache sudah di-generate
 - [ ] HTTPS sudah aktif
 - [ ] Favicon/logo muncul
 - [ ] robots.txt accessible
 - [ ] sitemap.xml accessible
 
 ---
 
 ## Troubleshooting
 
 ### Error 500
 - Cek `storage/logs/laravel.log`
 - Pastikan permission storage folder 755/775
 
 ### Gambar tidak muncul
 - Pastikan symlink storage sudah benar
 - Jalankan `php artisan storage:link`
 
 ### CSS/JS tidak load
 - Jalankan `npm run build` sebelum upload
 - Pastikan folder `public/build` terupload
 
 ### Favicon tidak muncul
 - Clear browser cache
 - Pastikan logo.png ada di public folder
