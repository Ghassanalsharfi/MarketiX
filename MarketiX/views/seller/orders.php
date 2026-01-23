<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/MarketiX/app/bootstrap.php';
require_once ROOT_PATH . '/app/middleware/auth.php';
require_once ROOT_PATH . '/app/middleware/seller.php';
require_once ROOT_PATH . '/app/controllers/SellerDashboardController.php';

requireAuth($pdo);
requireSeller(); // ← هذا السطر هو المفتاح


$userId = (int) $_SESSION['user_id'];
$controller = new SellerOrdersController($pdo);

/* ===============================
   Handle POST Actions
================================ */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $controller->handleOrderAction(
            (int) ($_POST['order_id'] ?? 0),
            $userId,
            $_POST['action'] ?? ''
        );
        header('Location: orders.php?success=1');
        exit;
    } catch (Exception $e) {
        header('Location: orders.php?error=action_failed');
        exit;
    }
}

/* ===============================
   Fetch Data for View
================================ */
$sellerId = $controller->getSellerId($userId);
$orders   = $controller->getOrders($sellerId);
$totals   = $controller->calculateTotals($orders);
$commissionRate = $controller->getCommissionRate();

$pageTitle = 'Orders';

ob_start();
require __DIR__ . '/pages/orders_content.php';
$content = ob_get_clean();

require __DIR__ . '/layouts/dashboard_layout.php';
