<?php

function checkSellerStoreStatus(PDO $pdo)
{
    // استثناء صفحة الحظر نفسها
    if (str_contains($_SERVER['REQUEST_URI'], 'store_blocked.php')) {
        return;
    }

    $stmt = $pdo->prepare("
        SELECT s.store_status
        FROM stores s
        JOIN sellers se ON s.seller_id = se.seller_id
        WHERE se.user_id = ?
        LIMIT 1
    ");
    $stmt->execute([$_SESSION['user_id']]);
    $status = $stmt->fetchColumn();

    if ($status !== false && $status !== 'active') {
        header("Location: " . BASE_URL . "/views/seller/store_blocked.php");
        exit;
    }
}
