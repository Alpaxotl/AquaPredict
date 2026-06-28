# AquaPredict: Smart Fisheries Monitoring System

AquaPredict adalah aplikasi web yang dikembangkan sebagai bagian dari project akhir mata kuliah Pemrograman Web Framework. Aplikasi ini berfokus pada **Smart Fisheries**, memberikan solusi untuk monitoring kualitas air kolam, analisis kelayakan air, dan pendukung keputusan bagi pembudidaya ikan.

## Deskripsi Project
Dalam konteks *Living Lab*, AquaPredict berfungsi sebagai antarmuka yang mengelola data kualitas air secara *real-time* dan menyajikan hasil analisis/prediksi yang didukung oleh model Data Mining yang terintegrasi.

## Fitur Utama
- **Dashboard:** Ringkasan informasi kolam dan kualitas air terbaru.
- **Manajemen Kolam (CRUD):** Pengelolaan data kolam budidaya.
- **Log Kualitas Air (CRUD):** Pencatatan 14 parameter kualitas air (pH, suhu, DO, BOD, CO2, alkalinitas, hardness, kalsium, amonia, nitrit, fosfor, H2S, turbidity, plankton).
- **Analyzer:** Fitur analisis kualitas air instan yang terintegrasi dengan model AI (via FastAPI), lengkap dengan fallback analisis lokal jika layanan FastAPI sedang offline.
- **Konsultasi:** Fitur pendukung keputusan untuk rekomendasi budidaya.
- **RBAC:** Hak akses pengguna (Admin & Petani/Staff) untuk menjaga integritas data.

## Teknologi
- **Framework:** [Laravel 12](https://laravel.com/) (PHP)
- **Frontend:** Blade Templates, [Tailwind CSS](https://tailwindcss.com/) & [Vite](https://vite.dev/)
- **Data Mining Backend:** [FastAPI](https://fastapi.tiangolo.com/) (Python) dengan model scikit-learn (`model_kualitas_air.joblib`)
- **Database:** SQLite

## Instalasi

### Prerequisites
- PHP >= 8.2
- Composer
- Node.js & npm
- Python 3.9+

### Langkah Instalasi (Laravel)
1. Clone repository ini:
   ```bash
   git clone https://github.com/DwiJesika/AquaPredict.git
   cd AquaPredict
   ```
2. Salin file environment:
   ```bash
   cp .env.example .env
   ```
3. Install dependencies PHP:
   ```bash
   composer install
   ```
4. Generate application key:
   ```bash
   php artisan key:generate
   ```
5. Buat file database SQLite:
   ```bash
   touch database/database.sqlite
   ```
6. Jalankan migrasi beserta seeder (membuat akun contoh):
   ```bash
   php artisan migrate --seed
   ```
7. Install dependencies JS:
   ```bash
   npm install
   ```
8. Build asset frontend:
   ```bash
   npm run build
   ```
9. Jalankan aplikasi Laravel:
   ```bash
   php artisan serve
   ```
   Aplikasi dapat diakses di `http://127.0.0.1:8000`.

### Menjalankan FastAPI (Layanan Analisis ML)
1. Masuk ke direktori FastAPI:
   ```bash
   cd fastapi_app
   ```
2. (Opsional, disarankan) Buat virtual environment:
   ```bash
   python -m venv venv
   source venv/bin/activate   # Windows: venv\Scripts\activate
   ```
3. Install dependencies Python:
   ```bash
   pip install fastapi uvicorn joblib pandas scikit-learn pydantic
   ```
4. Jalankan server FastAPI (port harus sesuai `FASTAPI_URL` di `.env`, default `8001`):
   ```bash
   uvicorn main:app --reload --host 127.0.0.1 --port 8001
   ```

> **Catatan:** Aplikasi Laravel dan FastAPI harus berjalan bersamaan (di terminal/process yang berbeda) agar fitur Analyzer, Water Logs, dan Consultation dapat melakukan analisis otomatis. Jika FastAPI tidak aktif, sistem akan tetap berjalan menggunakan mekanisme fallback analisis lokal berbasis ambang batas parameter.

## Kontribusi
Project ini dikerjakan oleh kelompok untuk mata kuliah Pemrograman Web Framework, Universitas Pendidikan Ganesha:
- Jesika
- Dhion
- Anna
- Alvian (2415091075)

## Lisensi
[MIT License](https://opensource.org/licenses/MIT)
