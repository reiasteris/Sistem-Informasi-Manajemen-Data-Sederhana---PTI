<?php
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('index.php');
}
verify_csrf();
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if ($id && $id > 0) {
    $stmt = $pdo->prepare('DELETE FROM mahasiswa WHERE id = :id');
    $stmt->execute(['id' => $id]);
    set_flash($stmt->rowCount() ? 'success' : 'warning', $stmt->rowCount() ? t('deleted') : t('no_result'));
} else {
    set_flash('warning', t('no_result'));
}
redirect('index.php');
