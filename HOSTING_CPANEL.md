# Panduan Hosting Laravel + Vite ke cPanel (Root Domain ke `public`)

Dokumen ini menjelaskan langkah-langkah men-deploy proyek ini ke cPanel dengan document root langsung mengarah ke folder `public`. Diasumsikan `.env` dan koneksi database sudah siap.

## Prasyarat di cPanel
- PHP 8.2+ aktif untuk domain.
- Ekstensi: OpenSSL, Mbstring, Tokenizer, PDO MySQL, Ctype, JSON, BCMath, Fileinfo, XML, Curl, GD.
- Akses SSH atau Terminal cPanel (disarankan) atau fitur "PHP Composer" di cPanel.
- Domain diatur agar Document Root mengarah ke `shortener/public` (lihat bagian Konfigurasi Domain).

## Konfigurasi Domain (Document Root ke `public`)
1. Masuk cPanel → menu Domains.
2. Pilih domain utama → Manage.
3. Set Document Root menjadi `shortener/public` (relatif ke home cPanel Anda, mis. `/home/USER/shortener/public`).
4. Simpan perubahan. Tunggu propagasi (jika diperlukan).

> Alternatif: Jika tidak bisa mengubah docroot, tempatkan folder proyek di luar `public_html` lalu buat symbolic link atau gunakan subdomain yang docroot-nya bisa diatur ke `public`. Namun sesuai permintaan, kita asumsikan docroot langsung ke `public`.

## Upload Kode Proyek
- Upload seluruh folder proyek (mis. `shortener/`) ke home cPanel Anda melalui File Manager atau SFTP.
- Pastikan struktur tetap: `shortener/app`, `shortener/public`, `shortener/vendor`, dll.

## Dependencies (Composer)
Jika punya SSH/Terminal cPanel:
```bash
cd /home/USER/shortener
php -v
composer install --no-dev --prefer-dist --optimize-autoloader
```
Tanpa SSH (opsi): gunakan fitur "PHP Composer" di cPanel untuk menjalankan `composer install` pada folder proyek.

> Catatan: Anda boleh mengupload folder `vendor/` dari lokal, namun lebih stabil menjalankan `composer install` di server.

## Build Asset Vite (Production)
Karena server shared cPanel kadang tidak menyediakan Node, disarankan build di lokal:
```bash
# Di lokal
npm install
npm run build
```
Langkah ini akan menghasilkan output di `public/build`. Upload hasil build ke server jika belum ada atau jika Anda melakukan perubahan frontend.

> Proyek ini sudah menyertakan `public/build/manifest.json`. Lakukan `npm run build` ulang setiap ada perubahan asset agar sinkron.

## Pengaturan `.env` (Produksi)
Pastikan nilai berikut (env Anda disebut sudah beres, ini cek cepat):
- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_URL=https://domain-anda.com`
- Konfigurasi database sudah sesuai dan dapat diakses dari server.
- Jika menggunakan fitur OAuth/Google, pastikan variabel ENV terkait dan callback URL sudah benar (lihat `GOOGLE_OAUTH_SETUP.md`).

## Artisan & Optimasi
Jalankan perintah berikut di server (SSH/Terminal cPanel):
```bash
cd /home/USER/shortener
php artisan key:generate --force  # jika APP_KEY belum terisi
php artisan storage:link
php artisan migrate --force       # bila migrasi belum dijalankan
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
# ketika hosting ulang 
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## Permission Folder
Atur izin agar Laravel bisa menulis cache dan storage:
```bash
cd /home/USER/shortener
chmod -R 775 storage bootstrap/cache
# Jika perlu, set kepemilikan sesuai user web server
# chown -R USER:USER storage bootstrap/cache
```

Catatan: Pada cPanel, folder `public_html/.well-known` dan file `public_html/.well-known/pki-validation/*` dikelola oleh AutoSSL/Let's Encrypt dan bisa dilindungi (immutable/owned oleh sistem). Hindari mengubah izin di path tersebut. Jika menjalankan perintah massal, kecualikan path itu, contoh:

```bash
# Jalankan dari root proyek Anda
find . -type d -not -path "./public_html/.well-known*" -exec chmod 755 {} \;
find . -type f -not -path "./public_html/.well-known*" -exec chmod 644 {} \;
```

## .htaccess
File `public/.htaccess` sudah berisi aturan standar Laravel untuk rewrite ke `index.php`. Pastikan modul `mod_rewrite` aktif.

## Cron (Opsional)
Jika menggunakan scheduler Laravel:
```cron
* * * * * cd /home/USER/shortener && php artisan schedule:run >> /dev/null 2>&1
```
Untuk queue worker di shared hosting (opsi sederhana):
```cron
* * * * * cd /home/USER/shortener && php artisan queue:work --stop-when-empty --timeout=90 --tries=3 >> /dev/null 2>&1
```
Untuk beban serius, pertimbangkan layanan queue terdedikasi atau VPS.

## Troubleshooting
- Asset tidak muncul: pastikan `npm run build` sudah menghasilkan `public/build`, `APP_ENV=production`, dan cache dibersihkan (`php artisan optimize:clear` lalu `php artisan optimize`).
- 404 atau loop redirect: cek docroot domain benar ke `shortener/public`, modul `mod_rewrite` aktif.
- Error 500: cek `storage/logs/laravel.log`, izin folder, versi PHP dan ekstensi.
- Perubahan tidak terlihat: jalankan `php artisan view:clear` dan `php artisan config:clear` lalu cache ulang.

## Ringkas Alur Deploy
1. Pastikan docroot domain → `shortener/public`.
2. Upload proyek ke `/home/USER/shortener`.
3. Jalankan `composer install` di server.
4. Build Vite di lokal (`npm run build`) dan upload `public/build` (jika perlu).
5. Sesuaikan `.env` (production, URL domain, db).
6. Jalankan artisan: `storage:link`, `migrate --force`, `config:cache`, `route:cache`, `view:cache`, `optimize`.
7. Atur permission `storage` & `bootstrap/cache`.
8. Tambahkan cron (opsional) untuk scheduler/queue.

Selesai. Jika butuh verifikasi tambahan, cek halaman utama dan satu-dua view yang memuat asset Vite untuk memastikan manifest dan path sudah terbaca.
