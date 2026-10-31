<?php
require_once __DIR__ . '/functions.php';

if (empty($_SESSION['user'])) {
    set_flash('warning', t('login_required'));
    redirect('login.php');
}
