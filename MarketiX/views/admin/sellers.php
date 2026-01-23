<?php
/**
 * Admin Sellers Management Page
 *
 * Acts as a bootstrap file and delegates all
 * business logic to AdminSellersController.
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/MarketiX/app/bootstrap.php';
require_once ROOT_PATH . '/app/middleware/auth.php';
require_once ROOT_PATH . '/app/middleware/admin.php';

requireAuth($pdo);
requireAdmin();

$controller = new AdminSellersController($pdo);

/* ===============================
   Filter
================================ */
$statusFilter = $controller->getStatusFilter($_GET);

/* ===============================
   Fetch Sellers
================================ */
$sellers = $controller->getSellers($statusFilter);

/* ===== Page Settings ===== */
$pageTitle = "Sellers Management";
$content   = __DIR__ . '/pages/sellers_content.php';

require_once __DIR__ . '/layouts/layout.php';
