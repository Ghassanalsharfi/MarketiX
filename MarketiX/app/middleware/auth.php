<?php
/**
 * auth.php
 * Middleware للتحقق من تسجيل الدخول
 */
function requireAuth(PDO $pdo)
{
    if (
        !isset($_SESSION['user_id'])
        && isset($_COOKIE['remember_user'], $_COOKIE['remember_token'])
    ) {
        $userId = (int) $_COOKIE['remember_user'];
        $token  = $_COOKIE['remember_token'];

        $expectedToken = hash(
            'sha256',
            $userId . $_SERVER['HTTP_USER_AGENT']
        );

        if (hash_equals($expectedToken, $token)) {

            $_SESSION['user_id'] = $userId;

            $stmt = $pdo->prepare(
                "SELECT user_role FROM users WHERE user_id = ?"
            );
            $stmt->execute([$userId]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            $_SESSION['user_role'] = $user['user_role'] ?? 'user';

        } else {
            // تنظيف كوكيز غير صحيحة
            setcookie('remember_user', '', time() - 3600, '/');
            setcookie('remember_token', '', time() - 3600, '/');
        }
    }

    if (!isset($_SESSION['user_id'])) {
        $_SESSION['flash'] = [
            'type' => 'warning',
            'message' => 'Please login first'
        ];
        header("Location: " . BASE_URL . "/public/login.php");
        exit;
    }
}