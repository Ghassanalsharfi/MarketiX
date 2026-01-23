<?php
/**
 * Admin Products Management Page
 *
 * Allows administrators to:
 * - View all products
 * - Filter products by status
 * - Hide or activate products
 *
 * This file acts as a View bootstrap and delegates
 * all business logic to AdminProductsController.
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/MarketiX/app/bootstrap.php';
require_once ROOT_PATH . '/app/middleware/auth.php';
require_once ROOT_PATH . '/app/middleware/admin.php';

requireAuth($pdo);
requireAdmin();

$controller = new AdminProductsController($pdo);

/* ===============================
   Filters
================================ */
$statusFilter = $controller->getStatusFilter($_GET);

/* ===============================
   Handle Actions
================================ */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->handleActions($_POST, $statusFilter);
}

/* ===============================
   Fetch Products
================================ */
$products = $controller->getProducts($statusFilter);

/* ===============================
   Page Setup
================================ */
$pageTitle = "Products Management";
$content   = __DIR__ . '/pages/products_content.php';

require_once __DIR__ . '/layouts/layout.php';
