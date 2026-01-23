<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/MarketiX/app/bootstrap.php';
require_once ROOT_PATH . '/app/middleware/auth.php';
require_once ROOT_PATH . '/app/middleware/admin.php';

requireAuth($pdo);
requireAdmin();
require_once ROOT_PATH . '/app/controllers/AdminOrdersController.php';

$controller = new AdminOrdersController($pdo);

/* Stores */
$stores = $controller->getStores();

/* Filter */
$storeFilter = $controller->getStoreFilter($_GET);

/* Orders */
$orders = $controller->getOrders($storeFilter);

/* Stats */
$stats = $controller->calculateStats($orders);

/* Pass to view */
$pageTitle = "Orders Management";
$content   = __DIR__ . '/pages/orders_content.php';

require_once __DIR__ . '/layouts/layout.php';
