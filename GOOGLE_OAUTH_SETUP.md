# Setup Google OAuth

Untuk mengaktifkan fitur login dengan Google, ikuti langkah-langkah berikut:

## 1. Buat Project di Google Cloud Console

1. Kunjungi [Google Cloud Console](https://console.cloud.google.com/)
2. Buat project baru atau pilih project yang sudah ada
3. Enable Google+ API atau Google Identity API

## 2. Buat OAuth 2.0 Credentials

1. Di sidebar, pilih **APIs & Services** > **Credentials**
2. Klik **Create Credentials** > **OAuth client ID**
3. Pilih **Application type**: Web application
4. Isi nama aplikasi
5. Di **Authorized redirect URIs**, tambahkan:
   ```
   http://localhost:8000/auth/google/callback
   http://127.0.0.1:8000/auth/google/callback
   ```
6. Klik **Create**
7. Copy **Client ID** dan **Client Secret**

## 3. Setup di Laravel

1. Buka file `.env`
2. Tambahkan konfigurasi berikut:
   ```
   GOOGLE_CLIENT_ID=your_client_id_here
   GOOGLE_CLIENT_SECRET=your_client_secret_here
   GOOGLE_REDIRECT_URL=http://localhost:8000/auth/google/callback
   ```

## 4. Testing

1. Jalankan server: `php artisan serve`
2. Buka halaman login: `http://localhost:8000/login`
3. Klik tombol "Login with Google"
4. Pilih akun Google Anda
5. Anda akan diarahkan ke dashboard

## Catatan

- Untuk production, ganti redirect URL dengan domain Anda yang sebenarnya
- Pastikan Anda sudah mengaktifkan Google+ API atau Google Identity API di Google Cloud Console
- Simpan Client ID dan Client Secret dengan aman
