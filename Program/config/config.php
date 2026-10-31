<?php
// Konfigurasi utama aplikasi.

define('APP_NAME', 'Sistem Informasi Data Mahasiswa');
define('DB_HOST', 'localhost');
define('DB_NAME', 'db_mahasiswa');
define('DB_USER', 'root');
define('DB_PASS', '');

date_default_timezone_set('Asia/Jakarta');

if (session_status() !== PHP_SESSION_ACTIVE) {
    ini_set('session.use_strict_mode', '1');
    ini_set('session.use_only_cookies', '1');
    // Cookie session hanya dikirim melalui koneksi HTTP; aktifkan secure saat memakai HTTPS.
    $isHttps = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'secure' => $isHttps,
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
    session_start();
}

// Pilihan bahasa disimpan dalam session agar konsisten antarhalaman.
if (isset($_GET['lang']) && in_array($_GET['lang'], ['id', 'en'], true)) {
    $_SESSION['lang'] = $_GET['lang'];
}
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'id';
}
