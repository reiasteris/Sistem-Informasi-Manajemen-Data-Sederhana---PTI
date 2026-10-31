<?php
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/auth.php';

$q = trim((string) ($_GET['q'] ?? ''));
if ($q !== '') {
    $stmt = $pdo->prepare('SELECT id, nim, nama, email, jurusan, angkatan FROM mahasiswa WHERE nim LIKE :q_nim OR nama LIKE :q_nama ORDER BY nama ASC');
    $like = '%' . $q . '%';
    $stmt->execute(['q_nim' => $like, 'q_nama' => $like]);
} else {
    $stmt = $pdo->query('SELECT id, nim, nama, email, jurusan, angkatan FROM mahasiswa ORDER BY nama ASC');
}
$students = $stmt->fetchAll();
$flash = get_flash();
$pageTitle = t('dashboard');
require __DIR__ . '/includes/header.php';
?>
<section class="content-card">
    <div class="section-heading">
        <div>
            <h1><?= e(t('dashboard')) ?></h1>
            <p class="muted"><?= e(t('dashboard_subtitle')) ?></p>
        </div>
        <a href="tambah.php" class="btn btn-primary">+ <?= e(t('add_student')) ?></a>
    </div>

    <?php if ($flash): ?><div class="alert alert-<?= e($flash['type']) ?>"><?= e($flash['message']) ?></div><?php endif; ?>

    <form method="GET" class="search-form">
        <?php if (($_SESSION['lang'] ?? 'id') !== 'id'): ?><input type="hidden" name="lang" value="en"><?php endif; ?>
        <input type="search" name="q" value="<?= e($q) ?>" placeholder="<?= e(t('search_placeholder')) ?>" aria-label="<?= e(t('search_placeholder')) ?>">
        <button type="submit" class="btn btn-secondary"><?= e(t('search')) ?></button>
        <?php if ($q !== ''): ?><a href="index.php<?= ($_SESSION['lang'] ?? 'id') === 'en' ? '?lang=en' : '' ?>" class="btn btn-ghost"><?= e(t('cancel')) ?></a><?php endif; ?>
    </form>

    <div class="table-wrap">
        <table>
            <thead><tr>
                <th><?= e(t('no')) ?></th><th><?= e(t('nim')) ?></th><th><?= e(t('name')) ?></th>
                <th><?= e(t('email')) ?></th><th><?= e(t('major')) ?></th><th><?= e(t('year')) ?></th><th><?= e(t('action')) ?></th>
            </tr></thead>
            <tbody>
            <?php if (!$students): ?>
                <tr><td colspan="7" class="empty-state"><?= e($q === '' ? t('empty') : t('no_result')) ?></td></tr>
            <?php else: ?>
                <?php foreach ($students as $index => $student): ?>
                    <tr>
                        <td data-label="<?= e(t('no')) ?>"><?= $index + 1 ?></td>
                        <td data-label="<?= e(t('nim')) ?>"><?= e($student['nim']) ?></td>
                        <td data-label="<?= e(t('name')) ?>"><?= e($student['nama']) ?></td>
                        <td data-label="<?= e(t('email')) ?>"><?= e($student['email']) ?></td>
                        <td data-label="<?= e(t('major')) ?>"><?= e($student['jurusan']) ?></td>
                        <td data-label="<?= e(t('year')) ?>"><?= e($student['angkatan']) ?></td>
                        <td data-label="<?= e(t('action')) ?>" class="action-cell">
                            <a class="btn btn-secondary btn-small" href="edit.php?id=<?= (int) $student['id'] ?>"><?= e(t('edit')) ?></a>
                            <form method="POST" action="hapus.php" class="inline-form" onsubmit="return confirm('<?= e(t('delete_confirm')) ?>')">
                                <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                                <input type="hidden" name="id" value="<?= (int) $student['id'] ?>">
                                <button type="submit" class="btn btn-danger btn-small"><?= e(t('delete')) ?></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <p class="record-count"><?= count($students) ?> <?= ($_SESSION['lang'] ?? 'id') === 'id' ? 'data ditampilkan' : 'records shown' ?></p>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
