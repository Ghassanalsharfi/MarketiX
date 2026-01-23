<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: " . BASE_URL . "/public/login.php");
    exit;
}

$stmt = $pdo->prepare("
    SELECT s.store_status
    FROM stores s
    JOIN sellers se ON s.seller_id = se.seller_id
    WHERE se.user_id = ?
    LIMIT 1
");
$stmt->execute([$_SESSION['user_id']]);
$store = $stmt->fetch(PDO::FETCH_ASSOC);

/* لا يوجد متجر */
if (!$store) {
    header("Location: store.php");
    exit;
}

/* متجر غير مفعل */
if ($store['store_status'] !== 'active') {
    $_SESSION['store_blocked_message'] = true;
    header("Location: dashboard.php");
    exit;
}