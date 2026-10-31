<?php
$student = $student ?? ['nim' => '', 'nama' => '', 'email' => '', 'jurusan' => '', 'angkatan' => date('Y')];
$errors = $errors ?? [];
$majors = ['Teknik Informatika', 'Sistem Informasi', 'Teknik Elektro', 'Manajemen Informatika', 'Ilmu Komunikasi', 'Akuntansi'];
?>
<?php if (!empty($errors)): ?>
    <div class="alert alert-error">
        <strong><?= e(t('form_error')) ?></strong>
        <ul>
            <?php foreach ($errors as $error): ?><li><?= e($error) ?></li><?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
<form method="POST" class="form-stack" novalidate>
    <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
    <div class="form-group">
        <label for="nim"><?= e(t('nim')) ?> <span class="required">*</span></label>
        <input id="nim" name="nim" type="text" maxlength="10" value="<?= e($student['nim']) ?>" required autocomplete="off">
    </div>
    <div class="form-group">
        <label for="nama"><?= e(t('name')) ?> <span class="required">*</span></label>
        <input id="nama" name="nama" type="text" maxlength="100" value="<?= e($student['nama']) ?>" required>
    </div>
    <div class="form-group">
        <label for="email"><?= e(t('email')) ?> <span class="required">*</span></label>
        <input id="email" name="email" type="email" maxlength="100" value="<?= e($student['email']) ?>" required>
    </div>
    <div class="form-group">
        <label for="jurusan"><?= e(t('major')) ?> <span class="required">*</span></label>
        <select id="jurusan" name="jurusan" required>
            <option value=""><?= e(t('major_choose')) ?></option>
            <?php foreach ($majors as $major): ?>
                <option value="<?= e($major) ?>" <?= $student['jurusan'] === $major ? 'selected' : '' ?>><?= e($major) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="angkatan"><?= e(t('year')) ?> <span class="required">*</span></label>
        <input id="angkatan" name="angkatan" type="number" min="2000" max="<?= (int) date('Y') + 1 ?>" value="<?= e($student['angkatan']) ?>" required>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary"><?= e($formButton ?? t('save')) ?></button>
        <a href="index.php" class="btn btn-secondary"><?= e(t('cancel')) ?></a>
    </div>
</form>
