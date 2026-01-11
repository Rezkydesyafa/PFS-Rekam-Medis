# Sistem Informasi Rekam Medis (SIRM)

**Project SIRM** adalah aplikasi berbasis web yang dirancang untuk mendigitalkan dan mempermudah proses administrasi serta pengelolaan data klinis di fasilitas kesehatan. Sistem ini dibangun menggunakan framework **Laravel** yang modern, memastikan performa tinggi, keamanan, dan skalabilitas.

---

## 🚀 Fitur Utama

-   **Manajemen Pasien**: Pencatatan, pencarian, dan pengelolaan data pasien secara efisien.
-   **Manajemen Dokter**: Pengelolaan data dokter spesialis dan jadwal praktik.
-   **Inventaris Obat**: Monitoring stok obat dan manajemen data farmasi.
-   **Rekam Medis Elektronik**: Pencatatan riwayat kesehatan pasien yang terintegrasi.
-   **Sistem Penagihan (Billing)**: Pembuatan invoice perawatan secara otomatis.
-   **Export Laporan PDF**: Cetak tagihan dan laporan rekam medis ke format PDF siap cetak.
-   **Dashboard Interaktif**: Ringkasan data statistik fasilitas kesehatan.

## 🛠 Teknologi yang Digunakan

Aplikasi ini dibangun menggunakan tumpukan teknologi (tech stack) modern:

-   **Backend Framework**: [Laravel 12](https://laravel.com)
-   **Bahasa Pemrograman**: PHP 8.2+
-   **Frontend**: Blade Templates, [Tailwind CSS](https://tailwindcss.com), [Alpine.js](https://alpinejs.dev)
-   **Database**: MySQL / MariaDB
-   **PDF Generator**: [laravel-dompdf](https://github.com/barryvdh/laravel-dompdf)
-   **Build Tool**: Vite

## ⚙️ Cara Instalasi

Ikuti langkah-langkah berikut untuk menjalankan project di lingkungan lokal Anda:

1. **Clone Repository**

    ```bash
    git clone https://github.com/username/rekam-medis-laravel.git
    cd rekam-medis-laravel
    ```

2. **Install Dependencies**
   Pastikan Composer dan Node.js sudah terinstall.

    ```bash
    composer install
    npm install
    ```

3. **Konfigurasi Environment**
   Salin file `.env.example` ke `.env` dan sesuaikan konfigurasi database Anda.

    ```bash
    cp .env.example .env
    ```

4. **Generate App Key**

    ```bash
    php artisan key:generate
    ```

5. **Migrasi Database**
   Jalankan migrasi untuk membuat struktur tabel database.

    ```bash
    php artisan migrate --seed
    ```

6. **Build Aset Frontend**
   Compile file CSS dan JS menggunakan Vite.

    ```bash
    npm run build
    ```

7. **Jalankan Aplikasi**
    ```bash
    php artisan serve
    ```
    Akses aplikasi melalui browser di `http://localhost:8000`.

## 📖 Cara Penggunaan

1. **Login**: Masuk ke sistem menggunakan kredensial admin/staff.
2. **Dashboard**: Pantau ringkasan data pasien dan kunjungan hari ini.
3. **Menu Navigasi**: Gunakan sidebar untuk mengakses modul (Pasien, Dokter, Obat, dll).
4. **Cetak PDF**: Pada halaman detail tagihan atau rekam medis, klik tombol "Export PDF" untuk mengunduh dokumen resmi.

## 📂 Struktur Folder Penting

Berikut adalah beberapa direktori kunci dalam pengembangan project ini:

-   `app/Http/Controllers` - Logika utama aplikasi (Controller Pasien, Dokter, Tagihan).
-   `app/Models` - Representasi data database (Eloquent Models).
-   `resources/views` - Tampilan antarmuka (Blade Templates).
-   `routes/web.php` - Definisi routing aplikasi.
-   `database/migrations` - Skema struktur database.

## 📄 Lisensi

Project ini dilisensikan di bawah [MIT License](https://opensource.org/licenses/MIT).

## 👥 Kontributor

Dikembangkan oleh **Tim Pengembang SIRM**.
Terbuka untuk kontribusi, silakan ajukan _Pull Request_ atau laporkan _Issues_.
