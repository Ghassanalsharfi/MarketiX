<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/MarketiX/app/bootstrap.php';
require_once ROOT_PATH . '/app/middleware/auth.php';
require_once ROOT_PATH . '/app/middleware/admin.php';

requireAuth($pdo);
requireAdmin();

if (!isset($_GET['id'], $_GET['action'])) {
    header("Location: ../stores.php");
    exit;
}

$storeId = (int) $_GET['id'];
$action  = $_GET['action'];

/* ===============================
   Fetch store + seller status
================================ */
$stmt = $pdo->prepare("
    SELECT 
        s.store_status,
        u.user_status AS seller_status
    FROM stores s
    JOIN sellers se ON s.seller_id = se.seller_id
    JOIN users u    ON se.user_id = u.user_id
    WHERE s.store_id = ?
    LIMIT 1
");
$stmt->execute([$storeId]);
$store = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$store) {
    header("Location: ../stores.php");
    exit;
}

/* ===============================
   Determine new status
================================ */
$newStatus = match ($action) {
    'activate'   => 'active',
    'deactivate' => 'inactive',
    'block'      => 'blocked',
    default      => null
};

if (!$newStatus) {
    header("Location: ../stores.php");
    exit;
}

/* ===============================
   Logical Protections
================================ */

// ❌ لا تفعيل إذا البائع محظور
if ($newStatus === 'active' && $store['seller_status'] === 'blocked') {
    header("Location: ../stores.php?error=seller_blocked");
    exit;
}

// ❌ لا تحديث إذا الحالة نفسها
if ($store['store_status'] === $newStatus) {
    header("Location: ../stores.php");
    exit;
}

/* ===============================
   ❌ منع التعطيل / الحظر إذا فيه طلبات معلّقة
================================ */
if (in_array($newStatus, ['inactive', 'blocked'])) {

    $stmt = $pdo->prepare("
        SELECT COUNT(*)
        FROM orders o
        JOIN order_items oi ON o.order_id = oi.order_id
        JOIN products p ON oi.product_id = p.product_id
        WHERE p.store_id = ?
          AND o.order_status IN ('pending', 'paid')
    ");
    $stmt->execute([$storeId]);
    $hasActiveOrders = (int)$stmt->fetchColumn() > 0;

    if ($hasActiveOrders) {
        $_SESSION['flash'] = [
            'type'    => 'danger',
            'message' => '❌ Cannot disable store — active orders exist.'
        ];

        header("Location: ../stores.php");
        exit;
    }
}

/* ===============================
   Update Status (Transaction)
================================ */
$pdo->beginTransaction();

try {

    $stmt = $pdo->prepare("
        UPDATE stores
        SET store_status = ?
        WHERE store_id = ?
    ");
    $stmt->execute([$newStatus, $storeId]);

    /* ✅ Admin Activity Log */
    ActivityLogger::log(
        $pdo,
        $_SESSION['user_id'], // admin id
        match ($newStatus) {
            'active'   => 'ADMIN_ACTIVATE_STORE',
            'inactive' => 'ADMIN_DEACTIVATE_STORE',
            'blocked'  => 'ADMIN_BLOCK_STORE',
        },
        "Admin changed store #{$storeId} status from {$store['store_status']} to {$newStatus}"
    );

    $pdo->commit();

} catch (Exception $e) {
    $pdo->rollBack();
}

header("Location: ../stores.php");
exit;
