<?php
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/auth.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id || $id < 1) {
    set_flash('warning', t('no_result'));
    redirect('index.php');
}
$stmt = $pdo->prepare('SELECT id, nim, nama, email, jurusan, angkatan FROM mahasiswa WHERE id = :id');
$stmt->execute(['id' => $id]);
$student = $stmt->fetch();
if (!$student) {
    set_flash('warning', t('no_result'));
    redirect('index.php');
}
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $student = array_merge($student, [
        'nim' => trim((string) ($_POST['nim'] ?? '')),
        'nama' => trim((string) ($_POST['nama'] ?? '')),
        'email' => trim((string) ($_POST['email'] ?? '')),
        'jurusan' => trim((string) ($_POST['jurusan'] ?? '')),
        'angkatan' => trim((string) ($_POST['angkatan'] ?? ''))
    ]);

    foreach (['nim' => t('nim'), 'nama' => t('name'), 'email' => t('email'), 'jurusan' => t('major'), 'angkatan' => t('year')] as $field => $label) {
        if ($student[$field] === '') $errors[] = $label . t('required');
    }
    if (strlen($student['nim']) > 10) $errors[] = t('nim_length');
    if (strlen($student['nama']) > 100 || strlen($student['email']) > 100) $errors[] = t('form_error');
    if ($student['email'] !== '' && !filter_var($student['email'], FILTER_VALIDATE_EMAIL)) $errors[] = t('invalid_email');
    $allowedMajors = ['Teknik Informatika', 'Sistem Informasi', 'Teknik Elektro', 'Manajemen Informatika', 'Ilmu Komunikasi', 'Akuntansi'];
    if ($student['jurusan'] !== '' && !in_array($student['jurusan'], $allowedMajors, true)) $errors[] = t('form_error');
    if ($student['angkatan'] !== '' && (!ctype_digit((string) $student['angkatan']) || (int) $student['angkatan'] < 2000 || (int) $student['angkatan'] > (int) date('Y') + 1)) $errors[] = t('year_invalid');

    if (!$errors) {
        $check = $pdo->prepare('SELECT id FROM mahasiswa WHERE nim = :nim AND id <> :id');
        $check->execute(['nim' => $student['nim'], 'id' => $id]);
        if ($check->fetch()) {
            $errors[] = t('nim_exists');
        } else {
            $update = $pdo->prepare('UPDATE mahasiswa SET nim = :nim, nama = :nama, email = :email, jurusan = :jurusan, angkatan = :angkatan WHERE id = :id');
            $update->execute([
                'nim' => $student['nim'], 'nama' => $student['nama'], 'email' => $student['email'],
                'jurusan' => $student['jurusan'], 'angkatan' => (int) $student['angkatan'], 'id' => $id
            ]);
            set_flash('success', t('updated'));
            redirect('index.php');
        }
    }
}

$pageTitle = t('edit_student');
$formButton = t('update');
require __DIR__ . '/includes/header.php';
?>
<section class="form-card">
    <div class="section-heading compact">
        <h1><?= e(t('edit_student')) ?></h1>
        <a href="index.php" class="text-link">&larr; <?= e(t('back')) ?></a>
    </div>
    <?php require __DIR__ . '/includes/student_form.php'; ?>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
