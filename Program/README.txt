SISTEM INFORMASI DATA MAHASISWA
Pure PHP + MySQL/MariaDB + PDO

KEBUTUHAN
- XAMPP (Apache, PHP, MySQL/MariaDB)
- PHP dengan extension PDO MySQL aktif

CARA MENJALANKAN
1. Ekstrak folder sistem-informasi-mahasiswa ke dalam folder htdocs XAMPP.
   Contoh: C:\\xampp\\htdocs\\sistem-informasi-mahasiswa
2. Jalankan Apache dan MySQL dari XAMPP Control Panel.
3. Buka http://localhost/phpmyadmin
4. Pilih tab Import, lalu pilih file database.sql dari folder proyek dan jalankan.
   File SQL membuat database db_mahasiswa, tabel users, tabel mahasiswa,
   satu akun demo, dan tiga data mahasiswa contoh.
5. Pastikan pengaturan database pada config/config.php sesuai dengan XAMPP Anda.
   Pengaturan bawaan: host=localhost, database=db_mahasiswa, user=root, password kosong.
6. Buka http://localhost/sistem-informasi-mahasiswa/login.php

AKUN DEMO
Username: admin
Password: admin123

FITUR
- Login dan logout menggunakan PHP Session.
- Hak akses halaman CRUD dilindungi autentikasi.
- Pilihan bahasa Indonesia dan Inggris disimpan dalam Session.
- CRUD data mahasiswa dengan PDO prepared statements.
- Pencarian berdasarkan NIM atau nama.
- Validasi input di sisi server dan sanitasi output menggunakan htmlspecialchars.
- Validasi format email dengan filter_var.
- Perlindungan CSRF pada form yang mengubah data.
- Password akun disimpan menggunakan password_hash.