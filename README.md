# Sistem Perpustakaan Mini (Laravel + React Vite)

Proyek ini adalah sistem perpustakaan sederhana dengan pemisahan yang jelas antara:
- **Backend**: Laravel (API, database, autentikasi, admin panel)
- **Frontend**: React + Vite (tampilan utama untuk pengguna/peminjam)

Strukturnya terinspirasi dari repo contoh `Sistem Perpustakaan Mini` (Laravel + Next.js), tetapi disesuaikan dengan stack **Laravel + React (Vite)**.

---

## 📁 Struktur Folder

- **`backend/`**  
  Aplikasi Laravel:
  - REST API untuk data buku
  - Koneksi dan migrasi database
  - Autentikasi dan halaman login/register
  - (Opsional) panel admin untuk mengelola buku

- **`frontend/`**  
  Aplikasi React + Vite:
  - Tampilan utama daftar buku
  - Pencarian dan detail buku
  - Halaman/form peminjaman serta UI utama untuk presentasi

---

## 🧰 Tech Stack

### Backend
- Laravel 10.x (PHP Framework)
- MySQL (Database)
- Blade (untuk halaman login/admin sederhana)

### Frontend
- React + Vite
- JavaScript/TypeScript (sesuai konfigurasi project)
- CSS murni (tanpa framework besar) dengan desain modern dan responsif

---

## ✨ Fitur Utama

### Backend (Laravel)
- Autentikasi (Login / Register) untuk pengguna.
- Pengelolaan data buku (melalui migrasi dan seeder).
- API untuk mengambil data buku ke frontend React.
- Struktur siap dikembangkan menjadi admin panel (CRUD Buku, manajemen peminjaman, dll).

### Frontend (React + Vite)
- Halaman **Daftar Buku** dengan tampilan kartu modern.
- **Pencarian** buku secara realtime di sisi frontend.
- **Detail Buku**: melihat informasi lebih lengkap dari buku yang dipilih.
- Halaman/form **Peminjaman** buku (alur UI untuk peminjaman).
- Desain UI modern dengan latar gradien dan layout responsif, cocok untuk presentasi.

---

## 📋 Requirements

Sebelum menjalankan proyek di laptop lain, pastikan software berikut sudah terpasang:

- **PHP** ≥ 8.1
- **Composer**
- **Node.js** ≥ 18.x
- **npm**
- **MySQL** (atau MariaDB)
- Git (jika clone dari GitHub)

---

## 🚀 Setup di Laptop Baru

### 1. Dapatkan Source Code

Clone dari repository (atau copy folder proyek ini ke laptop lain):

```bash
git clone <URL_REPOSITORY_KAMU>
cd Ana_Project
```

Jika kamu tidak memakai Git, cukup copy-paste folder `Ana_Project` ke laptop lain.

---

### 2. Setup Backend (Laravel)

Masuk ke folder backend:

```bash
cd backend
```

1. **Install dependency PHP**
   ```bash
   composer install
   ```

2. **Salin file environment**
   ```bash
   copy .env.example .env   # Windows
   ```

3. **Atur konfigurasi database di `.env`**
   Sesuaikan dengan MySQL di laptop baru, misalnya:
   ```env
   DB_DATABASE=perpustakaan_mini
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Generate application key**
   ```bash
   php artisan key:generate
   ```

5. **Jalankan migrasi dan seeder**
   ```bash
   php artisan migrate --seed
   ```
   Ini akan membuat tabel dan mengisi data dummy buku (minimal 10 buku) di database.

6. **Jalankan server Laravel**
   ```bash
   php artisan serve
   ```
   Backend akan berjalan di:  
   `http://127.0.0.1:8000`

---

### 3. Setup Frontend (React + Vite)

Di terminal baru, masuk ke folder frontend:

```bash
cd frontend
```

1. **Install dependency frontend**
   ```bash
   npm install
   ```

2. **Jalankan development server**
   ```bash
   npm run dev
   ```

   Secara default, frontend akan berjalan di:  
   `http://localhost:5173`

Jika port berbeda, perhatikan alamat yang muncul di terminal (misalnya `http://localhost:5174`).

---

## ▶️ Cara Menjalankan Sehari-hari

Setelah setup pertama kali selesai, untuk menjalankan lagi cukup:

1. **Start backend (Laravel)**
   ```bash
   cd backend
   php artisan serve
   ```

2. **Start frontend (React)**
   ```bash
   cd frontend
   npm run dev
   ```

3. **Akses aplikasi**
   - Tampilan utama user (React): `http://localhost:5173`
   - Backend / halaman login Laravel: `http://127.0.0.1:8000`

---

## 🗃️ Data Dummy

Saat menjalankan perintah:

```bash
php artisan migrate --seed
```

Database akan terisi dengan:
- Beberapa kategori buku.
- Minimal 10 buku contoh dengan judul dan kategori berbeda, sehingga daftar buku di frontend langsung terisi tanpa input manual.

Kamu bisa menyesuaikan data dummy ini di file seeder Laravel sesuai kebutuhan.

---

## 🧪 Testing (Opsional)

Jika kamu menambahkan test di sisi Laravel, kamu bisa menjalankannya dengan:

```bash
cd backend
php artisan test
```

Ini membantu memastikan logika yang kamu tambahkan tetap berjalan dengan benar saat proyek berkembang.
