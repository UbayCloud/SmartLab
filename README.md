# 📦 SmartLab – Web Peminjaman Alat

SmartLab adalah aplikasi berbasis web yang dikembangkan untuk mempermudah proses peminjaman dan pengembalian alat laboratorium. Sistem ini mendukung tiga peran pengguna (Admin, Petugas, dan Peminjam) serta menggunakan QR Code untuk mempercepat identifikasi alat.

## 🎯 Latar Belakang

Proses peminjaman alat di Instansi umumnya masih dilakukan secara manual sehingga rentan terjadi kesalahan pencatatan, kehilangan data, dan sulit memantau ketersediaan alat. SmartLab hadir sebagai solusi digital yang membuat proses peminjaman menjadi lebih cepat, aman, dan terdokumentasi.

## ✨ Fitur Utama

### 👨‍💼 Admin
- Dashboard statistik
- Manajemen alat & kategori
- Upload foto alat
- Generate & cetak QR Code
- Manajemen pengguna
- Log aktivitas
- Data peminjaman & pengembalian

### 👷 Petugas
- Menyetujui / menolak pengajuan
- Proses pengembalian alat
- Melihat laporan peminjaman
- Daftar alat laboratorium

### 👨‍🎓 Peminjam
- Melihat daftar alat
- Scan QR Code alat
- Mengajukan peminjaman
- Melihat riwayat pengajuan
- Mengajukan pengembalian

## 📱 Alur Sistem

1. Peminjam melakukan **scan QR Code** pada alat.
2. Sistem menampilkan detail alat beserta stok.
3. Peminjam mengisi formulir peminjaman.
4. Status menjadi **Menunggu Persetujuan**.
5. Petugas menyetujui atau menolak pengajuan.
6. Setelah alat dikembalikan, stok otomatis bertambah dan status berubah menjadi **Selesai**.

## 🛠️ Teknologi

- Laravel 12
- PHP 8.3
- sqlite
- Tailwind CSS
- Blade Template
- Spatie Laravel Permission
- Simple QrCode
- SweetAlert2

## 📷 Fitur QR Code

Setiap alat memiliki QR Code unik yang dapat dicetak dan ditempel pada alat. QR Code mengarahkan pengguna langsung ke halaman detail alat sehingga proses peminjaman menjadi lebih efisien.

## 📊 Role Pengguna

| Role | Hak Akses |
|------|-----------|
| Admin | Kelola seluruh sistem |
| Petugas | Verifikasi & pengembalian |
| Peminjam | Pinjam & scan QR |

## 🚀 Instalasi

```bash
git clone https://github.com/azryaa-04/MohUbaidillahRahman_UniversitasTrunodjoyoMadura_Smartlab.git
cd MohUbaidillahRahman_UniversitasTrunodjoyoMadura_Smartlab


composer install
npm install
cp .env.example .env

php artisan key:generate
php artisan migrate --seed

npm run dev
php artisan serve
```

## 👨‍💻 Pengembang

**Moh Ubaidillah Rahman**

Program Studi Teknik Informatika – Fakultas Teknik

Trunojoyo Creative Competition (TCC) 2026