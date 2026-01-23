<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/MarketiX/app/bootstrap.php';
require_once ROOT_PATH . '/app/middleware/auth.php';
require_once ROOT_PATH . '/app/middleware/admin.php';

requireAuth($pdo);
requireAdmin();

if (!isset($_GET['id'], $_GET['action'])) {
    header("Location: ../users.php");
    exit;
}

$userId = (int) $_GET['id'];
$action = $_GET['action'];

/* ===============================
   Fetch user
================================ */
$stmt = $pdo->prepare("
    SELECT user_role, user_status
    FROM users
    WHERE user_id = ?
    LIMIT 1
");
$stmt->execute([$userId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// حماية
if (!$user || $user['user_role'] === 'admin') {
    header("Location: ../users.php");
    exit;
}

/* ===============================
   Toggle Status (active / blocked)
================================ */
if ($action === 'toggle_status') {

    $current   = $user['user_status'] ?? 'blocked';
    $newStatus = ($current === 'active') ? 'blocked' : 'active';

    $stmt = $pdo->prepare("
        UPDATE users
        SET user_status = ?
        WHERE user_id = ?
    ");
    $stmt->execute([$newStatus, $userId]);

    /* ✅ Admin Activity Log */
    ActivityLogger::log(
        $pdo,
        $_SESSION['user_id'], // admin id
        ($newStatus === 'blocked')
            ? 'ADMIN_BLOCK_USER'
            : 'ADMIN_ACTIVATE_USER',
        "Admin changed user #{$userId} status from {$current} to {$newStatus}"
    );

    header("Location: ../users.php");
    exit;
}

/* ===============================
   Toggle Role (user <-> seller)
================================ */
if ($action === 'toggle_role') {

    $oldRole = $user['user_role'];
    $newRole = ($oldRole === 'seller') ? 'user' : 'seller';

    $pdo->beginTransaction();

    try {
        /* تحديث دور المستخدم */
        $stmt = $pdo->prepare("
            UPDATE users
            SET user_role = ?
            WHERE user_id = ?
        ");
        $stmt->execute([$newRole, $userId]);

        /* ===============================
           لو صار Seller → أنشئ Seller + Store
        ================================ */
        if ($newRole === 'seller') {

            /* تحقق هل seller موجود */
            $stmt = $pdo->prepare("
                SELECT seller_id
                FROM sellers
                WHERE user_id = ?
                LIMIT 1
            ");
            $stmt->execute([$userId]);
            $sellerId = $stmt->fetchColumn();

            /* إنشاء seller إذا غير موجود */
            if (!$sellerId) {
                $stmt = $pdo->prepare("
                    INSERT INTO sellers (user_id, seller_status)
                    VALUES (?, 'inactive')
                ");
                $stmt->execute([$userId]);
                $sellerId = $pdo->lastInsertId();
            }

            /* تحقق هل store موجود */
            $stmt = $pdo->prepare("
                SELECT store_id
                FROM stores
                WHERE seller_id = ?
                LIMIT 1
            ");
            $stmt->execute([$sellerId]);
            $storeExists = $stmt->fetchColumn();

            /* إنشاء متجر افتراضي إذا غير موجود */
            if (!$storeExists) {
                $stmt = $pdo->prepare("
                    INSERT INTO stores
                    (seller_id, store_name, store_description, store_status)
                    VALUES (?, '', '', 'active')
                ");
                $stmt->execute([$sellerId]);
            }
        }

        /* ✅ Admin Activity Log */
        ActivityLogger::log(
            $pdo,
            $_SESSION['user_id'], // admin id
            ($newRole === 'seller')
                ? 'ADMIN_PROMOTE_TO_SELLER'
                : 'ADMIN_DEMOTE_TO_USER',
            "Admin changed user #{$userId} role from {$oldRole} to {$newRole}"
        );

        $pdo->commit();

    } catch (Exception $e) {
        $pdo->rollBack();
    }

    header("Location: ../users.php");
    exit;
}

/* fallback */
header("Location: ../users.php");
exit;
