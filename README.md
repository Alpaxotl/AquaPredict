# AquaPredict: Smart Fisheries Monitoring System

AquaPredict adalah aplikasi web yang dikembangkan sebagai bagian dari project akhir mata kuliah Pemrograman Web Framework. Aplikasi ini berfokus pada **Smart Fisheries**, memberikan solusi untuk monitoring kualitas air kolam, analisis kelayakan air, dan pendukung keputusan bagi pembudidaya ikan.

## Deskripsi Project
Dalam konteks *Living Lab*, AquaPredict berfungsi sebagai antarmuka yang mengelola data kualitas air secara *real-time* dan menyajikan hasil analisis/prediksi yang didukung oleh model Data Mining yang terintegrasi.

## Fitur Utama
- **Dashboard:** Ringkasan informasi kolam dan kualitas air terbaru.
- **Manajemen Kolam (CRUD):** Pengelolaan data kolam budidaya.
- **Log Kualitas Air (CRUD):** Pencatatan parameter air (pH, suhu, DO, dll).
- **Analyzer:** Fitur analisis kualitas air yang terintegrasi dengan model AI (via FastAPI).
- **Konsultasi:** Fitur pendukung keputusan untuk rekomendasi budidaya.
- **RBAC:** Hak akses pengguna (Admin & Staff) untuk menjaga integritas data.

## Teknologi
- **Framework:** [Laravel](https://laravel.com/) (PHP)
- **Frontend:** [Tailwind CSS](https://tailwindcss.com/) & [Vite](https://vite.dev/)
- **Data Mining Backend:** [FastAPI](https://fastapi.tiangolo.com/) (Python)
- **Database:** MySQL

## Instalasi

### Prerequisites
- PHP >= 8.2
- Composer
- Node.js & npm
- Python 3

### Langkah Instalasi (Laravel)
1. Clone repository ini.
2. Salin file environment: `cp .env.example .env`
3. Install dependencies PHP: `composer install`
4. Generate key: `php artisan key:generate`
5. Jalankan migrasi: `php artisan migrate`
6. Install dependencies JS: `npm install`
7. Jalankan aplikasi: `php artisan serve`

### Menjalankan FastAPI
1. Masuk ke direktori: `cd fastapi_app`
2. Jalankan server: `uvicorn main:app --reload` (Pastikan environment python sudah aktif dengan library yang diperlukan).

## Kontribusi
Project ini dikerjakan oleh kelompok [Masukkan Nama Kelompok Anda] untuk mata kuliah Pemrograman Web Framework.

## Lisensi
[MIT License](https://opensource.org/licenses/MIT)
