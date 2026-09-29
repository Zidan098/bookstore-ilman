# Panduan Setup Project WahyuStore (Setelah Clone dari GitHub)

Ikuti langkah-langkah berikut secara berurutan untuk menjalankan project **WahyuStore** di komputer lokal setelah di-clone dari repository GitHub.

---

### 1. Clone Repository
```bash
git clone <URL_REPOSITORY_ANDA>
cd bookstore
```

---

### 2. Install Dependensi PHP
Jalankan Composer untuk menginstall seluruh paket dan dependensi framework Laravel:
```bash
composer install
```

---

### 3. Konfigurasi File Environment (`.env`)
Salin file `.env.example` menjadi `.env`:

**Windows (PowerShell / CMD):**
```powershell
copy .env.example .env
```
*atau di Git Bash / Linux / macOS:*
```bash
cp .env.example .env
```

---

### 4. Generate Application Key
Buat kunci enkripsi aplikasi Laravel:
```bash
php artisan key:generate
```

---

### 5. Atur Koneksi Database MySQL
Buka file `.env` yang baru dibuat menggunakan text editor / IDE Anda, lalu sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bookstore
DB_USERNAME=root
DB_PASSWORD=
```
> **Catatan:** Pastikan server MySQL (XAMPP / Laragon / Docker / MySQL Service) sudah berjalan dan buat database baru bernama `bookstore` jika belum ada.

---

### 6. Hubungkan Storage Link (Upload Cover Buku)
Buat symlink folder storage agar file gambar sampul buku dapat diakses secara publik:
```bash
php artisan storage:link
```

---

### 7. Jalankan Migrasi & Database Seeder
Jalankan perintah berikut untuk membuat seluruh tabel database beserta data awal (akun admin, akun demo customer, kategori, dan koleksi buku):
```bash
php artisan migrate:fresh --seed
```

---

### 8. Jalankan Server Lokal
Nyalakan server development Laravel:
```bash
php artisan serve
```

Aplikasi sekarang dapat diakses melalui browser di:
👉 **`http://127.0.0.1:8000`**

---

### Akun Bawaan (Default Login):

| Role | Email | Password | Akses URL |
| :--- | :--- | :--- | :--- |
| **Admin** | `admin@wahyustore.com` | `password` | `http://127.0.0.1:8000/login` (Otomatis redirect ke `/admin/dashboard`) |
| **Customer** | `customer@gmail.com` | `password` | `http://127.0.0.1:8000/login` (Redirect ke `/`) |

---

### Catatan Tambahan:
- Frontend menggunakan **daisyUI 5 + Tailwind CSS v4 via CDN**, sehingga **tidak memerlukan `npm install` atau `npm run build/dev`**.
- Pengunjung umum (tamu / guest) dapat langsung berbelanja dan melakukan checkout tanpa harus registrasi / login.
