<?php
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/functions.php';

if (!empty($_SESSION['user'])) {
    redirect('index.php');
}

$error = '';
$flash = get_flash();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $username = trim((string) ($_POST['username'] ?? ''));
    $password = (string) ($_POST['password'] ?? '');

    if ($username === '' || $password === '') {
        $error = t('form_error');
    } else {
        $stmt = $pdo->prepare('SELECT id, username, password FROM users WHERE username = :username LIMIT 1');
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            session_regenerate_id(true);
            $_SESSION['user'] = ['id' => (int) $user['id'], 'username' => $user['username']];
            redirect('index.php');
        }
        $error = t('login_error');
    }
}

$pageTitle = t('login');
require __DIR__ . '/includes/header.php';
?>
<section class="login-card">
    <h1><?= e(t('login')) ?></h1>
    <?php if ($flash): ?><div class="alert alert-<?= e($flash['type']) ?>"><?= e($flash['message']) ?></div><?php endif; ?>
    <?php if ($error !== ''): ?><div class="alert alert-error"><?= e($error) ?></div><?php endif; ?>
    <form method="POST" class="form-stack">
        <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
        <div class="form-group">
            <label for="username"><?= e(t('username')) ?></label>
            <input id="username" name="username" type="text" maxlength="50" required autofocus autocomplete="username">
        </div>
        <div class="form-group">
            <label for="password"><?= e(t('password')) ?></label>
            <input id="password" name="password" type="password" required autocomplete="current-password">
        </div>
        <button type="submit" class="btn btn-primary btn-block"><?= e(t('login')) ?></button>
    </form>
    <p class="demo-hint"><?= e(t('login_demo')) ?></p>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
