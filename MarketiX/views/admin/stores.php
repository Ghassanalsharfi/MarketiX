<?php
/**
 * Admin Stores Management Page
 *
 * Allows administrators to:
 * - View all stores
 * - View store statistics
 * - Manage store status (activate / deactivate / block)
 *
 * Acts as a bootstrap file and delegates business logic
 * to AdminStoresController.
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/MarketiX/app/bootstrap.php';
require_once ROOT_PATH . '/app/middleware/auth.php';
require_once ROOT_PATH . '/app/middleware/admin.php';

requireAuth($pdo);
requireAdmin();

$controller = new AdminStoresController($pdo);

/* ===============================
   Fetch Stores
================================ */
$stores = $controller->getStores();

/* ===== Page Settings ===== */
$pageTitle = "Stores Management";
$content   = __DIR__ . '/pages/stores_content.php';

require_once __DIR__ . '/layouts/layout.php';
