<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/MarketiX/app/bootstrap.php';

if (isset($_SESSION['user_id']) && isset($pdo)) {
    $stmt = $pdo->prepare("
        UPDATE user_login_logs
        SET logout_time = NOW()
        WHERE user_id = ?
        ORDER BY login_time DESC
        LIMIT 1
    ");
    $stmt->execute([$_SESSION['user_id']]);
}

// حذف كوكيز Remember Me
setcookie('remember_token', '', time() - 3600, '/');
setcookie('remember_user', '', time() - 3600, '/');

// تدمير الجلسة
$_SESSION = [];
session_unset();
session_regenerate_id(true);
session_destroy();

// إعادة التوجيه
header("Location: " . BASE_URL . "/public/login.php");
exit;