<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/MarketiX/app/bootstrap.php';
require_once ROOT_PATH . '/app/middleware/auth.php';
require_once ROOT_PATH . '/app/middleware/admin.php';

requireAuth($pdo);
requireAdmin();

/* ===============================
   Platform Settings
================================ */
$commissionRate = 0.10;

/* Users */
$totalUsers = (int)$pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();

/* Sellers */
$totalSellers = (int)$pdo->query("SELECT COUNT(*) FROM sellers")->fetchColumn();

/* Stores */
$totalStores = (int)$pdo->query("SELECT COUNT(*) FROM stores")->fetchColumn();

/* Completed Orders */
$totalOrders = (int)$pdo->query("
    SELECT COUNT(*) FROM orders WHERE order_status = 'completed'
")->fetchColumn();

/* Total Sales */
$totalSales = (float)$pdo->query("
    SELECT IFNULL(SUM(order_total),0)
    FROM orders
    WHERE order_status = 'completed'
")->fetchColumn();

/* Platform Profit */
$platformProfit = $totalSales * $commissionRate;

/* ===== Page Settings ===== */
$pageTitle = "Admin Dashboard";
$content   = __DIR__ . '/pages/dashboard_content.php';

require_once __DIR__ . '/layouts/layout.php';
