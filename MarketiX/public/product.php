<?php
/**
 * Product Page – Entry Point
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/MarketiX/app/bootstrap.php';
require_once ROOT_PATH . '/app/controllers/ProductController.php';

$productId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$controller = new ProductController($pdo);

/* ===============================
   Validation
================================ */
$productId = $controller->validateProductId($productId);

/* ===============================
   Data
================================ */
$product        = $controller->getProduct($productId);
$productImages  = $controller->getProductImages($productId);
$mainImage      = $controller->resolveMainImage($productImages);

/* ===============================
   Render View
================================ */
include ROOT_PATH . '/views/product/show.php';
