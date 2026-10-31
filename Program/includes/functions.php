<?php
require_once __DIR__ . '/../config/config.php';

function e($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function t(string $key): string
{
    static $translations = [
        'id' => [
            'login' => 'Masuk', 'username' => 'Nama pengguna', 'password' => 'Kata sandi',
            'login_error' => 'Nama pengguna atau kata sandi tidak sesuai.',
            'login_required' => 'Silakan masuk terlebih dahulu untuk mengakses halaman tersebut.',
            'dashboard' => 'Data Mahasiswa', 'add_student' => 'Tambah Mahasiswa',
            'edit_student' => 'Ubah Data Mahasiswa', 'search_placeholder' => 'Cari nama / NIM',
            'search' => 'Cari', 'no' => 'No', 'nim' => 'NIM', 'name' => 'Nama',
            'email' => 'Email', 'major' => 'Jurusan', 'year' => 'Angkatan', 'action' => 'Aksi',
            'edit' => 'Ubah', 'delete' => 'Hapus', 'save' => 'Simpan', 'update' => 'Perbarui',
            'cancel' => 'Batal', 'logout' => 'Keluar', 'hello' => 'Halo',
            'empty' => 'Belum ada data mahasiswa.', 'no_result' => 'Data mahasiswa tidak ditemukan.',
            'created' => 'Data mahasiswa berhasil ditambahkan.',
            'updated' => 'Data mahasiswa berhasil diperbarui.',
            'deleted' => 'Data mahasiswa berhasil dihapus.',
            'delete_confirm' => 'Yakin ingin menghapus data mahasiswa ini?',
            'required' => ' wajib diisi.', 'invalid_email' => 'Format email tidak valid.',
            'nim_length' => 'NIM maksimal 10 karakter.', 'nim_exists' => 'NIM sudah terdaftar.',
            'year_invalid' => 'Angkatan harus berupa tahun yang valid.',
            'form_error' => 'Periksa kembali data yang dimasukkan.',
            'back' => 'Kembali ke daftar', 'login_demo' => 'Akun demo: admin / admin123',
            'footer' => 'Sistem Informasi Data Mahasiswa', 'language' => 'Bahasa',
            'major_choose' => 'Pilih jurusan', 'dashboard_subtitle' => 'Kelola data mahasiswa dengan mudah.',
            'welcome' => 'Selamat datang di sistem informasi mahasiswa.'
        ],
        'en' => [
            'login' => 'Sign in', 'username' => 'Username', 'password' => 'Password',
            'login_error' => 'The username or password is incorrect.',
            'login_required' => 'Please sign in before accessing that page.',
            'dashboard' => 'Student Data', 'add_student' => 'Add Student',
            'edit_student' => 'Edit Student Data', 'search_placeholder' => 'Search name / student ID',
            'search' => 'Search', 'no' => 'No', 'nim' => 'Student ID', 'name' => 'Name',
            'email' => 'Email', 'major' => 'Major', 'year' => 'Enrollment Year', 'action' => 'Actions',
            'edit' => 'Edit', 'delete' => 'Delete', 'save' => 'Save', 'update' => 'Update',
            'cancel' => 'Cancel', 'logout' => 'Log out', 'hello' => 'Hello',
            'empty' => 'There are no student records yet.', 'no_result' => 'No student records found.',
            'created' => 'Student record added successfully.',
            'updated' => 'Student record updated successfully.',
            'deleted' => 'Student record deleted successfully.',
            'delete_confirm' => 'Are you sure you want to delete this student record?',
            'required' => ' is required.', 'invalid_email' => 'Please enter a valid email address.',
            'nim_length' => 'Student ID must be 10 characters or fewer.', 'nim_exists' => 'Student ID is already registered.',
            'year_invalid' => 'Enter a valid enrollment year.',
            'form_error' => 'Please review the information you entered.',
            'back' => 'Back to list', 'login_demo' => 'Demo account: admin / admin123',
            'footer' => 'Student Data Information System', 'language' => 'Language',
            'major_choose' => 'Choose a major', 'dashboard_subtitle' => 'Manage student records easily.',
            'welcome' => 'Welcome to the student information system.'
        ]
    ];

    $lang = $_SESSION['lang'] ?? 'id';
    return $translations[$lang][$key] ?? $key;
}

function redirect(string $path): void
{
    header('Location: ' . $path);
    exit;
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verify_csrf(): void
{
    $token = $_POST['csrf_token'] ?? '';
    if (!is_string($token) || empty($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $token)) {
        http_response_code(403);
        exit('Permintaan tidak valid. Muat ulang halaman dan coba kembali.');
    }
}

function set_flash(string $type, string $message): void
{
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function get_flash(): ?array
{
    if (empty($_SESSION['flash'])) {
        return null;
    }
    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);
    return $flash;
}

function current_language_url(string $language): string
{
    $params = $_GET;
    $params['lang'] = $language;
    return basename($_SERVER['PHP_SELF']) . '?' . http_build_query($params);
}
