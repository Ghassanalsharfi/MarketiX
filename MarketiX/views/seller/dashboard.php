<?php
/**
 * Seller Dashboard Page Controller
 *
 * Displays store overview and statistics.
 * ❌ No redirect before layout
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/MarketiX/app/bootstrap.php';
require_once ROOT_PATH . '/app/middleware/auth.php';
require_once ROOT_PATH . '/app/middleware/seller.php';
require_once ROOT_PATH . '/app/controllers/SellerDashboardController.php';

requireAuth($pdo);
requireSeller(); // ← هذا السطر هو المفتاح



$userId = (int) $_SESSION['user_id'];

$dashboardController = new SellerDashboardController($pdo);

/* ===============================
   Seller & Store
================================ */
$sellerId = $dashboardController->getSellerId($userId);
$store    = $dashboardController->getStore($sellerId);

/**
 * IMPORTANT:
 * ❌ لا redirect هنا
 * Dashboard يجب أن يُحمّل دائمًا
 */
$storeExists = (bool) $store;

/* ===============================
   Statistics (only if store exists)
================================ */
$totalProducts = 0;
$totalOrders   = 0;
$totalRevenue  = 0;
$storeViews    = 0;

if ($storeExists) {
    $storeId    = (int) $store['store_id'];
    $storeViews = (int) $store['store_views'];

    $stats = $dashboardController->getStatistics($storeId);

    $totalProducts = (int) $stats['totalProducts'];
    $totalOrders   = (int) $stats['totalOrders'];
    $totalRevenue  = (float) $stats['totalRevenue'];
}

/* ===============================
   Page Content
================================ */
$pageTitle = 'Dashboard';

ob_start();
?>

<?php if (!$storeExists): ?>
  <div class="alert alert-warning rounded-4 mb-4">
    ⚠ You don’t have a store yet. Please create your store to unlock all features.
  </div>
<?php endif; ?>

<?php if (!empty($_SESSION['store_blocked_message'])): ?>
  <div class="alert alert-danger rounded-4 mb-4">
    ⚠ Your store is inactive. Actions are disabled.
  </div>
  <?php unset($_SESSION['store_blocked_message']); ?>
<?php endif; ?>

<?php if ($storeExists): ?>

<!-- Store Info -->
<div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
  <div class="d-flex align-items-center gap-3">

    <?php if (!empty($store['store_image'])): ?>
      <img
        src="<?= BASE_URL ?>/public/uploads/stores/<?= htmlspecialchars($store['store_image']) ?>"
        width="90" height="90"
        style="border-radius:16px;object-fit:cover;">
    <?php else: ?>
      <div style="width:90px;height:90px;background:#e5e7eb;border-radius:16px;
                  display:flex;align-items:center;justify-content:center;">
        No Image
      </div>
    <?php endif; ?>

    <div>
      <h4 class="fw-bold mb-1"><?= htmlspecialchars($store['store_name']) ?></h4>
      <p class="text-muted mb-1"><?= htmlspecialchars($store['store_description']) ?></p>

      <?php
      $statusMap = [
        'active'   => ['Active', 'bg-success'],
        'inactive' => ['Inactive', 'bg-secondary'],
        'blocked'  => ['Blocked', 'bg-danger']
      ];
      $badge = $statusMap[$store['store_status']] ?? $statusMap['inactive'];
      ?>

      <span class="badge <?= $badge[1] ?>">
        <?= $badge[0] ?>
      </span>
    </div>

  </div>
</div>

<!-- Stats -->
<div class="row g-4">

  <div class="col-md-3">
    <div class="stat-card">
      <p class="text-muted small mb-1">Products</p>
      <h2 class="fw-bold"><?= $totalProducts ?></h2>
    </div>
  </div>

  <div class="col-md-3">
    <div class="stat-card">
      <p class="text-muted small mb-1">Orders</p>
      <h2 class="fw-bold"><?= $totalOrders ?></h2>
    </div>
  </div>

  <div class="col-md-3">
    <div class="stat-card">
      <p class="text-muted small mb-1">Revenue</p>
      <h2 class="fw-bold">$<?= number_format($totalRevenue, 2) ?></h2>
    </div>
  </div>

  <div class="col-md-3">
    <div class="stat-card">
      <p class="text-muted small mb-1">Store Views</p>
      <h2 class="fw-bold"><?= $storeViews ?></h2>
    </div>
  </div>

</div>

<?php endif; ?>

<?php
$content = ob_get_clean();

/* ===============================
   Layout Include
================================ */
include __DIR__ . '/layouts/dashboard_layout.php';
