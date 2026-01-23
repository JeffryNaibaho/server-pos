# Point of Sales (POS) System - Backend API

Repository ini adalah bagian **Backend Server** untuk aplikasi Point of Sales (Kasir). Aplikasi ini dibangun untuk membantu manajemen stok barang, transaksi kasir, dan pelaporan penjualan sederhana.

Backend ini menyediakan RESTful API yang nantinya akan dikonsumsi oleh Frontend (React.js).

## Teknologi yang Digunakan
- **Framework:** Laravel 11 (PHP)
- **Database:** MySQL
- **Authentication:** Laravel Sanctum (Planned)
- **Architecture:** MVC (Model-View-Controller)

## Fitur & Roadmap Pengembangan
Berikut adalah status pengembangan fitur dalam proyek ini:

### 1. Persiapan & Konfigurasi
- [x] Instalasi Laravel Framework
- [x] Konfigurasi Database (MySQL)
- [x] Setup Database Migrations (Tabel Schema)

### 2. Autentikasi (Auth)
- [ ] Login API untuk Kasir & Admin
- [ ] Logout API
- [ ] Proteksi Route menggunakan Sanctum Middleware

### 3. Manajemen Produk (Inventory)
- [ ] CRUD Kategori Barang
- [ ] CRUD Data Barang (Product)
- [ ] Fitur Update Stok Barang

### 4. Transaksi (Point of Sales)
- [ ] Membuat Transaksi Baru (Simpan ke Database)
- [ ] Logika Pengurangan Stok Otomatis saat Transaksi
- [ ] Detail Transaksi (Pivot Table)

## Cara Menjalankan (Local Development)

1. **Clone Repository**
   ```bash
   git clone [https://github.com/JeffryNaibaho/server-pos.git](https://github.com/JeffryNaibaho/server-pos.git)
   cd server-pos