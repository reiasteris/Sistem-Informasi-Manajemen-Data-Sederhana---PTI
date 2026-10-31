<?php
require_once __DIR__ . '/functions.php';
$pageTitle = $pageTitle ?? t('dashboard');
$currentUser = $_SESSION['user']['username'] ?? null;
?>
<!DOCTYPE html>
<html lang="<?= e($_SESSION['lang'] ?? 'id') ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle) ?> | <?= e(APP_NAME) ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header class="topbar">
    <a class="brand" href="index.php"><?= e(APP_NAME) ?></a>
    <div class="topbar-right">
        <nav class="language" aria-label="<?= e(t('language')) ?>">
            <?= e(t('language')) ?>:
            <a class="<?= ($_SESSION['lang'] ?? 'id') === 'id' ? 'active' : '' ?>" href="<?= e(current_language_url('id')) ?>">ID</a>
            <span>|</span>
            <a class="<?= ($_SESSION['lang'] ?? 'id') === 'en' ? 'active' : '' ?>" href="<?= e(current_language_url('en')) ?>">EN</a>
        </nav>
        <?php if ($currentUser): ?>
            <span class="welcome"><?= e(t('hello')) ?>, <strong><?= e($currentUser) ?></strong></span>
            <form method="POST" action="logout.php" class="inline-form">
                <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                <button type="submit" class="btn btn-light btn-small"><?= e(t('logout')) ?></button>
            </form>
        <?php endif; ?>
    </div>
</header>
<main class="main-container">
