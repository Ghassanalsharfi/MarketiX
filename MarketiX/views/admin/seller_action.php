<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/MarketiX/app/bootstrap.php';
require_once ROOT_PATH . '/app/middleware/auth.php';
require_once ROOT_PATH . '/app/middleware/admin.php';

requireAuth($pdo);
requireAdmin();

if (!isset($_GET['id'], $_GET['action'])) {
    header("Location: sellers.php");
    exit;
}

$sellerId = (int) $_GET['id'];
$action   = $_GET['action'];

/* ===============================
   Fetch seller
================================ */
$stmt = $pdo->prepare("
    SELECT seller_status
    FROM sellers
    WHERE seller_id = ?
    LIMIT 1
");
$stmt->execute([$sellerId]);
$seller = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$seller) {
    header("Location: sellers.php");
    exit;
}

/* ===============================
   Toggle status
================================ */
if ($action === 'toggle') {

    $current = $seller['seller_status'];

    if ($current !== 'active' && $current !== 'inactive') {
        $current = 'inactive';
    }

    $newStatus = ($current === 'active')
        ? 'inactive'
        : 'active';

    $stmt = $pdo->prepare("
        UPDATE sellers
        SET seller_status = ?
        WHERE seller_id = ?
    ");
    $stmt->execute([$newStatus, $sellerId]);
}

header("Location: sellers.php");
exit;
