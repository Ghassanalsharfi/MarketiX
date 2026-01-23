<?php

class AuthController
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /* =========================
       Register
    ========================= */
    public function register(array $data)
    {
        $name     = trim($data['name'] ?? '');
        $email    = trim($data['email'] ?? '');
        $password = $data['password'] ?? '';

        if ($name === '' || $email === '' || $password === '') {
            return ['success' => false, 'message' => 'All fields are required.'];
        }

        $check = $this->pdo->prepare(
            "SELECT user_id FROM users WHERE user_email = ? LIMIT 1"
        );
        $check->execute([$email]);

        if ($check->fetch()) {
            return ['success' => false, 'message' => 'Email already exists.'];
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt = $this->pdo->prepare("
                INSERT INTO users (user_name, user_email, user_password, user_role, user_status)
                VALUES (?, ?, ?, 'user', 'active')
            ");
            $stmt->execute([$name, $email, $hashedPassword]);

            return ['success' => true];

        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Something went wrong.'];
        }
    }

    /* =========================
       Login
    ========================= */
    public function login(string $email, string $password): array
    {
        $stmt = $this->pdo->prepare("
            SELECT user_id, user_name, user_password, user_role, user_status
            FROM users
            WHERE user_email = ?
            LIMIT 1
        ");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        /* ❌ المستخدم غير موجود */
        if (!$user) {
            return ['success' => false, 'message' => 'Invalid email or password.'];
        }

        /* 🚫 المستخدم محظور */
        if ($user['user_status'] !== 'active') {
            return [
                'success' => false,
                'message' => '🚫 Your account has been blocked. Please contact support.'
            ];
        }

        /* ❌ كلمة المرور خطأ */
        if (!password_verify($password, $user['user_password'])) {
            return ['success' => false, 'message' => 'Invalid email or password.'];
        }

        /* ✅ تسجيل الجلسة */
        $_SESSION['user_id']   = $user['user_id'];
        $_SESSION['user_name'] = $user['user_name'];
        $_SESSION['user_role'] = $user['user_role'];

        /* 🧾 تسجيل الدخول في logs */
        $log = $this->pdo->prepare("
            INSERT INTO user_login_logs (user_id, ip_address, user_agent)
            VALUES (?, ?, ?)
        ");
        $log->execute([
            $user['user_id'],
            $_SERVER['REMOTE_ADDR'] ?? null,
            $_SERVER['HTTP_USER_AGENT'] ?? null
        ]);

        return ['success' => true];
    }

    /* =========================
       Logout
    ========================= */
    public function logout(): void
    {
        if (isset($_SESSION['user_id'])) {
            $stmt = $this->pdo->prepare("
                UPDATE user_login_logs
                SET logout_time = NOW()
                WHERE user_id = ?
                ORDER BY login_time DESC
                LIMIT 1
            ");
            $stmt->execute([$_SESSION['user_id']]);
        }

        session_destroy();
    }
}
