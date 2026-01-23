<?php

/**
 * Seller Store Page Controller
 *
 * Handles store data loading and saving,
 * then passes data to the view.
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/MarketiX/app/bootstrap.php';
require_once ROOT_PATH . '/app/middleware/auth.php';
require_once ROOT_PATH . '/app/middleware/seller.php';
require_once ROOT_PATH . '/app/controllers/SellerDashboardController.php';

requireAuth($pdo);
requireSeller(); // ← هذا السطر هو المفتاح



$userId = (int) $_SESSION['user_id'];

$storeController = new SellerStoreController($pdo);

/* =========================
   Seller & Store
========================= */
$sellerId = $storeController->getOrCreateSeller($userId);
$store    = $storeController->getStore($sellerId);

$error   = null;
$success = null;

/* =========================
   Save Store
========================= */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $name = trim($_POST['store_name'] ?? '');
  $desc = trim($_POST['store_description'] ?? '');
  $imageName = $store['store_image'] ?? null;

  if ($name === '') {
    $error = 'Store name is required';
  } else {

    if (!empty($_FILES['store_image']['name'])) {
      $allowed = ['jpg', 'jpeg', 'png', 'webp'];
      $ext = strtolower(pathinfo($_FILES['store_image']['name'], PATHINFO_EXTENSION));

      if (!in_array($ext, $allowed, true)) {
        $error = 'Invalid image type';
      } else {
        $imageName = uniqid('store_') . '.' . $ext;

        move_uploaded_file(
          $_FILES['store_image']['tmp_name'],
          ROOT_PATH . '/public/uploads/stores/' . $imageName
        );
      }
    }

    if (!$error) {
      $storeController->saveStore(
        $sellerId,
        $name,
        $desc,
        $imageName
      );

      $success = $store
        ? 'Store updated successfully'
        : 'Store created successfully';

      // Reload store data
      $store = $storeController->getStore($sellerId);
    }
  }
}

/* =========================
   Render View
========================= */
$pageTitle = 'My Store';

ob_start();
require __DIR__ . '/pages/store_content.php';
$content = ob_get_clean();

require ROOT_PATH . '/views/seller/layouts/dashboard_layout.php';
