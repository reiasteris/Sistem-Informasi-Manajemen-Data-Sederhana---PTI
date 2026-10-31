# Sistem Informasi Data Mahasiswa Sederhana

Aplikasi sistem informasi berbasis web sederhana untuk mengelola data mahasiswa. Aplikasi dibuat menggunakan PHP murni dan MySQL dengan fitur login, pengelolaan data mahasiswa, pencarian, serta pilihan bahasa Indonesia dan Inggris.

Aplikasi ini dibuat untuk memenuhi Tugas 2 mata kuliah Penerapan Teknologi Internet.

---

## Fitur Sistem

- Login dan logout menggunakan PHP Session.
- Halaman pengelolaan data dilindungi autentikasi.
- Menampilkan seluruh data mahasiswa.
- Menambah, mengubah, dan menghapus data mahasiswa.
- Mencari data berdasarkan NIM atau nama.
- Pilihan bahasa Indonesia dan Inggris.
- Validasi input menggunakan PHP.
- Koneksi database menggunakan PDO dan prepared statements.
- Sanitasi output menggunakan `htmlspecialchars()`.
- Validasi email menggunakan `filter_var()`.
- Perlindungan CSRF pada form yang mengubah data.
- Password akun disimpan menggunakan `password_hash()`.

---

## Akun Demo

| Username | Password |
|----------|----------|
| `admin` | `admin123` |

Akun demo digunakan untuk pengujian aplikasi secara lokal.

---

## Database

Nama database: `db_mahasiswa`

Tabel yang digunakan:

| Tabel | Keterangan |
|-------|------------|
| `users` | Menyimpan akun pengguna untuk login. |
| `mahasiswa` | Menyimpan data mahasiswa seperti NIM, nama, email, jurusan, dan angkatan. |

File `database.sql` berisi perintah untuk membuat database dan tabel, akun demo, serta beberapa data mahasiswa contoh.

---

## Teknologi

| Teknologi | Kegunaan |
|-----------|----------|
| PHP murni | Backend, autentikasi, validasi, dan pengolahan data. |
| MySQL / MariaDB | Menyimpan data aplikasi. |
| PDO | Menghubungkan PHP dengan database. |
| HTML | Struktur halaman aplikasi. |
| CSS | Tampilan antarmuka. |
| XAMPP | Menjalankan server lokal. |
| Apache | Web server. |
| phpMyAdmin | Mengelola database. |

---

## Struktur Project

```text
Program/
│
├── assets/
│   └── css/
│       └── style.css
│
├── config/
│   ├── config.php
│   └── database.php
│
├── includes/
│   ├── auth.php
│   ├── footer.php
│   ├── functions.php
│   ├── header.php
│   └── student_form.php
│
├── database.sql
├── edit.php
├── hapus.php
├── index.php
├── login.php
├── logout.php
└── tambah.php
```

---

## Instalasi dan Menjalankan Program

1. Salin atau clone folder project ke dalam direktori `htdocs` XAMPP.

   ```text
   C:\xampp\htdocs\Program
   ```

2. Jalankan **Apache** dan **MySQL** melalui XAMPP Control Panel.

3. Buka phpMyAdmin melalui alamat:

   ```text
   http://localhost/phpmyadmin
   ```

4. Pilih menu **Import**, lalu impor file `database.sql` yang terdapat di folder project. File tersebut akan membuat database `db_mahasiswa` beserta tabel dan data contoh.

5. Periksa konfigurasi database pada `config/config.php`. Konfigurasi bawaan XAMPP adalah:

   ```php
   DB_HOST = localhost
   DB_NAME = db_mahasiswa
   DB_USER = root
   DB_PASS = ""
   ```

6. Buka aplikasi melalui browser:

   ```text
   http://localhost/Program/login.php
   ```

7. Masuk menggunakan akun demo yang tersedia pada bagian **Akun Demo**.

---

## Catatan

- Pastikan ekstensi PDO MySQL aktif pada PHP yang digunakan.
- Ubah konfigurasi database jika username atau password MySQL berbeda.
- Data mahasiswa contoh dapat diubah atau dihapus sesuai kebutuhan.
- Untuk penggunaan di luar pengujian lokal, ganti password demo dan gunakan konfigurasi server yang aman.
