<?php

require_once ROOT_PATH . '/app/middleware/seller_store_status.php';

function requireSeller()
{
    global $pdo;

    if (!isset($_SESSION['user_id'])) {
        header("Location: " . BASE_URL . "/public/login.php");
        exit;
    }

    // تأكد أن المستخدم Seller
    $stmt = $pdo->prepare("
        SELECT seller_id 
        FROM sellers 
        WHERE user_id = ?
        LIMIT 1
    ");
    $stmt->execute([$_SESSION['user_id']]);
    $seller = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$seller) {
        header("Location: " . BASE_URL . "/public/login.php");
        exit;
    }

    $_SESSION['seller_id'] = $seller['seller_id'];

    /* 🔥 فحص حالة المتجر هنا إجبارياً */
    checkSellerStoreStatus($pdo);
}
