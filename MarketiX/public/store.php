<?php
/**
 * Store Page – Entry Point
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/MarketiX/app/bootstrap.php';
require_once ROOT_PATH . '/app/middleware/auth.php';

requireAuth($pdo);

$isLoggedIn = isset($_SESSION['user_id']);


$controller = new StoreController($pdo);

/* ===============================
   Store ID Validation
================================ */
$storeId = $controller->validateStoreId($_GET['id']);

/* ===============================
   Views Counter
================================ */
$controller->incrementViews($storeId);

/* ===============================
   Data
================================ */
$store    = $controller->getStore($storeId);
$products = $controller->getProducts($storeId);

/* ===============================
   Status
================================ */
$storeStatus = $store['store_status'] ?? 'inactive';
[$badgeClass, $statusText] = $controller->resolveStatus($storeStatus);

/* ===============================
   Render View
================================ */
include ROOT_PATH . '/views/store/index.php';
