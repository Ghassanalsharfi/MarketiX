<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/MarketiX/app/bootstrap.php';
require_once ROOT_PATH . '/app/middleware/auth.php';
require_once ROOT_PATH . '/app/middleware/seller.php';
require_once ROOT_PATH . '/app/controllers/SellerDashboardController.php';

requireAuth($pdo);
requireSeller(); // ← هذا السطر هو المفتاح


$userId = $_SESSION['user_id'];

$productsController = new SellerProductsController($pdo);

/* ===============================
   Seller + Store
================================ */
$sellerId = $productsController->getSellerId($userId);
$storeId  = $productsController->getStoreId($sellerId);

if ($storeId <= 0) {
    header("Location: store.php");
    exit;
}

/* ===============================
   Delete Product
================================ */
if (isset($_GET['delete'])) {

    $productId = (int)$_GET['delete'];

    if (!$productsController->canDelete($productId)) {
        $_SESSION['flash'] = [
            'type'    => 'danger',
            'message' => '❌ Cannot delete product. It has existing orders.'
        ];
    } else {
        $productsController->deleteProduct($productId, $storeId);
        $_SESSION['flash'] = [
            'type'    => 'success',
            'message' => '✅ Product deleted successfully.'
        ];
    }

    header("Location: products.php");
    exit;
}

/* ===============================
   Products
================================ */
$products = $productsController->getProducts($storeId);

/* ===============================
   Page Content
================================ */
$pageTitle = 'My Products';

ob_start();
?>

<h3 class="fw-bold mb-4">📦 My Products</h3>

<a href="add_product.php" class="btn btn-primary-custom mb-3">
  + Add Product
</a>

<?php if (!empty($_SESSION['flash'])): ?>
  <div class="alert alert-<?= $_SESSION['flash']['type'] ?> rounded-4">
    <?= $_SESSION['flash']['message'] ?>
  </div>
  <?php unset($_SESSION['flash']); ?>
<?php endif; ?>

<?php if (empty($products)): ?>
  <p class="text-muted">No products yet.</p>
<?php else: ?>

  <div class="card p-4 shadow-sm rounded-4">
    <table class="table align-middle">
      <thead>
        <tr>
          <th>Name</th>
          <th>Price</th>
          <th>Qty</th>
          <th>Status</th>
          <th>Image</th>
          <th width="140">Action</th>
        </tr>
      </thead>
      <tbody>

        <?php foreach ($products as $p): ?>
          <tr>
            <td><?= htmlspecialchars($p['product_name']) ?></td>

            <td>$<?= number_format($p['product_price'], 2) ?></td>

            <td><?= (int)$p['product_quantity'] ?></td>

            <td>
              <span class="badge bg-secondary">
                <?= ucfirst($p['product_status']) ?>
              </span>
            </td>

            <td>
              <?php if (!empty($p['product_image'])): ?>
                <img
                  src="<?= BASE_URL ?>/<?= htmlspecialchars($p['product_image']) ?>"
                  style="width:60px; height:60px; object-fit:contain;"
                  class="rounded border bg-light"
                  alt="Product Image">
              <?php else: ?>
                —
              <?php endif; ?>
            </td>

            <td class="d-flex gap-2">
              <a href="edit_product.php?id=<?= $p['product_id'] ?>"
                 class="btn btn-sm btn-outline-primary">
                Edit
              </a>

              <a href="?delete=<?= $p['product_id'] ?>"
                 class="btn btn-sm btn-outline-danger"
                 onclick="return confirm('Delete product?')">
                Delete
              </a>
            </td>
          </tr>
        <?php endforeach; ?>

      </tbody>
    </table>
  </div>

<?php endif; ?>

<?php
$content = ob_get_clean();

/* ===============================
   Layout include
================================ */
include __DIR__ . '/layouts/dashboard_layout.php';
