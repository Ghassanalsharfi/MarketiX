<?php
/**
 * Edit Product Page Controller (Seller)
 *
 * Handles product update logic only.
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/MarketiX/app/bootstrap.php';
require_once ROOT_PATH . '/app/middleware/auth.php';
require_once ROOT_PATH . '/app/middleware/seller.php';
require_once ROOT_PATH . '/app/controllers/SellerDashboardController.php';

requireAuth($pdo);
requireSeller(); // ← هذا السطر هو المفتاح


$controller = new SellerProductFormController($pdo);

/* ===============================
   Seller + Product
================================ */
$sellerId  = $controller->getSellerId($_SESSION['user_id']);
$productId = (int) ($_GET['id'] ?? 0);

$product = $controller->getProduct($productId, $sellerId);

if (!$product) {
    die('Unauthorized access');
}

/* ===============================
   Handle Image Actions
================================ */

// 1️⃣ Set Main Image
if (isset($_POST['set_main'])) {
    $controller->setMainImage($productId, (int)$_POST['set_main']);
    header("Location: edit_product.php?id=" . $productId);
    exit;
}

// 2️⃣ Delete Single Image
if (isset($_POST['delete_image'])) {
    $controller->deleteImage((int)$_POST['delete_image'], $productId);
    header("Location: edit_product.php?id=" . $productId);
    exit;
}

/* ===============================
   Product Images (Gallery)
================================ */
$productImages = $controller->getProductImages($productId);

$error   = null;
$success = false;

/* ===============================
   Handle Product Update
================================ */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name   = trim($_POST['product_name'] ?? '');
    $desc   = trim($_POST['product_description'] ?? '');
    $price  = (float) ($_POST['product_price'] ?? 0);
    $qty    = (int) ($_POST['product_quantity'] ?? 0);
    $status = $_POST['product_status'] ?? 'active';

    if ($name === '' || $desc === '') {
        $error = 'Product name and description are required.';
    } elseif ($price < 0 || $qty < (int)$product['product_reserved']) {
        $error = 'Invalid price or quantity.';
    }

    // Multiple Images (optional)
    $images = null;
    if (!$error && !empty($_FILES['product_images']['name'][0])) {
        $images = $_FILES['product_images'];
    }

    if (!$error) {
        $controller->updateProduct(
            $productId,
            $name,
            $desc,
            $price,
            $qty,
            $status,
            $images
        );

        $success = true;

        // Refresh data after update
        $product        = $controller->getProduct($productId, $sellerId);
        $productImages  = $controller->getProductImages($productId);
    }
}

/* ===============================
   Render View
================================ */
$pageTitle = 'Edit Product';

ob_start();
require __DIR__ . '/pages/edit_product_content.php';
$content = ob_get_clean();

include __DIR__ . '/layouts/dashboard_layout.php';
