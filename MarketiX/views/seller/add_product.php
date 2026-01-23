<?php
/**
 * Add Product Page Controller (Seller)
 *
 * Handles product creation logic only.
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/MarketiX/app/bootstrap.php';
require_once ROOT_PATH . '/app/middleware/auth.php';
require_once ROOT_PATH . '/app/middleware/seller.php';
require_once ROOT_PATH . '/app/controllers/SellerDashboardController.php';

requireAuth($pdo);
requireSeller(); // ← هذا السطر هو المفتاح


$controller = new SellerProductFormController($pdo);

/* ===============================
   Seller + Store
================================ */
$sellerId = $controller->getSellerId($_SESSION['user_id']);
$storeId  = $controller->getStoreId($sellerId);

if ($storeId <= 0) {
    header("Location: store.php");
    exit;
}

$error   = null;
$success = false;

/* ===============================
   Handle Form Submit
================================ */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name   = trim($_POST['product_name'] ?? '');
    $desc   = trim($_POST['product_description'] ?? '');
    $price  = (float)($_POST['product_price'] ?? 0);
    $qty    = (int)($_POST['product_quantity'] ?? 0);
    $status = $_POST['product_status'] ?? 'active';

    if ($name === '' || $desc === '' || $price <= 0 || $qty < 0) {
        $error = 'Please fill all fields correctly.';
    }

    // ✅ الصور المتعددة (تمرير فقط – بدون منطق)
    $images = null;
    if (!$error && !empty($_FILES['product_images']['name'][0])) {
        $images = $_FILES['product_images'];
    }

    if (!$error) {
        $controller->createProduct(
            $storeId,
            $name,
            $desc,
            $price,
            $qty,
            $status,
            $images
        );

        $success = true;
    }
}

/* ===============================
   Render View
================================ */
$pageTitle = 'Add Product';

ob_start();
require __DIR__ . '/pages/add_product_content.php';
$content = ob_get_clean();

include __DIR__ . '/layouts/dashboard_layout.php';
