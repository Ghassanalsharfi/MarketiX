<?php

/**
 * Marketplace Page
 *
 * Displays all available stores in the system.
 * Acts as a View layer and delegates business logic
 * to MarketplaceController.
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/MarketiX/app/bootstrap.php';
$isLoggedIn = isset($_SESSION['user_id']);

$controller = new MarketplaceController($pdo);

/* ===============================
   Data
================================ */
$stores = $controller->getStores();
$products = [];
if ($isLoggedIn) {
   $stmt = $pdo->prepare("
    SELECT 
        p.product_id,
        p.product_name,
        p.product_price,
        s.store_name,
        pi.image_path AS product_image
    FROM products p
    JOIN stores s 
        ON p.store_id = s.store_id
    LEFT JOIN product_images pi 
        ON pi.product_id = p.product_id
       AND pi.is_main = 1
    WHERE p.product_status = 'active'
    ORDER BY p.product_id DESC
    LIMIT 8
");

    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
include __DIR__ . '/../views/layouts/header.php';
?>

<style>
  /* ===============================
   MARKETPLACE – MarketiX
================================ */

  .marketplace-hero {
    background: linear-gradient(135deg,
        rgba(59, 130, 246, .08),
        rgba(34, 197, 94, .08));
    border-radius: 24px;
    padding: 48px 32px;
    margin-bottom: 48px;
  }

  .marketplace-hero h2 {
    font-weight: 900;
    color: #0f172a;
  }

  .marketplace-hero p {
    color: #64748b;
  }

  /* ===============================
   Store Card
================================ */

  .store-card {
    border: 1px solid #e5e7eb;
    border-radius: 20px;
    overflow: hidden;
    background: #ffffff;
    transition: transform .25s ease, box-shadow .25s ease, border-color .25s;
  }

  .store-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 18px 36px rgba(15, 23, 42, .1);
    border-color: #3b82f6;
  }

  /* ===============================
   Store Image (Safe)
================================ */

  .store-cover {
    width: 100%;
    aspect-ratio: 15 / 12;
    background-size: contain;
    background-position: center;
    background-repeat: no-repeat;
    background-color: #f8fafc;
    border-bottom: 1px solid #e5e7eb;
  }

  /* Responsive heights */
  @media (min-width: 768px) {
    .store-cover {
      height: 180px;
    }
  }

  @media (min-width: 1200px) {
    .store-cover {
      height: 200px;
    }
  }

  /* Placeholder */
  .store-placeholder {
    height: 180px;
    background: linear-gradient(135deg,
        rgba(59, 130, 246, .06),
        rgba(34, 197, 94, .06));
    display: flex;
    align-items: center;
    justify-content: center;
    color: #64748b;
    font-size: 14px;
    border-bottom: 1px solid #e5e7eb;
  }

  /* ===============================
   Card Content
================================ */

  .store-card h5 {
    color: #0f172a;
  }

  .store-desc {
    font-size: 14px;
    color: #64748b;
    min-height: 42px;
  }

  /* ===============================
   Buttons
================================ */

  .store-card .btn-outline-success {
    border-radius: 999px;
    font-weight: 700;
    border-color: #22c55e;
    color: #22c55e;
  }

  .store-card .btn-outline-success:hover {
    background: linear-gradient(135deg, #22c55e, #16a34a);
    border-color: transparent;
    color: #ffffff;
  }

  .store-card .btn-outline-secondary {
    border-radius: 999px;
  }

  /* ===============================
   Badges
================================ */

  .badge {
    font-size: 11px;
    padding: 6px 10px;
    border-radius: 999px;
  }
</style>

<div class="container py-5">

  <!-- ===============================
       HERO
  ================================ -->
  <div class="marketplace-hero text-center">
    <h2>Marketplace</h2>
    <p class="fs-5 mt-2">
      Discover active stores and start shopping with confidence
    </p>
  </div>

  <!-- ===============================
       STORES GRID
  ================================ -->
  <div class="row g-4">

    <?php foreach ($stores as $store): ?>

      <?php
      [$badgeClass, $badgeText] =
        $controller->resolveStatus($store['store_status'] ?? 'active');
      ?>

      <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="card store-card h-100">

          <!-- Store Image -->
          <?php if (!empty($store['store_image'])): ?>
            <div class="store-cover"
              style="background-image:url('<?= BASE_URL ?>/public/uploads/stores/<?= htmlspecialchars($store['store_image']) ?>')">
            </div>
          <?php else: ?>
            <div class="store-placeholder">
              <i class="fa-solid fa-store me-2"></i> No Image
            </div>
          <?php endif; ?>

          <div class="p-3 d-flex flex-column h-100">

            <!-- Store Name -->
            <div class="d-flex justify-content-between align-items-center mb-1">
              <h5 class="fw-bold mb-0">
                <?= htmlspecialchars($store['store_name']) ?>
              </h5>
              <span class="badge bg-<?= $badgeClass ?>">
                <?= $badgeText ?>
              </span>
            </div>

            <!-- Description -->
            <p class="store-desc mb-3">
              <?= htmlspecialchars($store['store_description']) ?>
            </p>

            <!-- Action -->
            <div class="mt-auto">
              <?php if (($store['store_status'] ?? 'active') === 'blocked'): ?>
                <button class="btn btn-outline-secondary w-100" disabled>
                  Store Blocked
                </button>
              <?php else: ?>
                <a href="<?= BASE_URL ?>/public/store.php?id=<?= $store['store_id'] ?>"
                  class="btn btn-outline-success w-100">
                  View Store
                </a>
              <?php endif; ?>
            </div>

          </div>

        </div>
      </div>

    <?php endforeach; ?>

  </div>
</div>
<!-- ===============================
     PRODUCTS
================================ -->
<?php if ($isLoggedIn): ?>
  <section class="container pb-5">
    <h3 class="fw-bold mb-4 section-title">Latest Products</h3>

    <div class="row g-4">
      <?php foreach ($products as $p): ?>
        <div class="col-md-3">
          <div class="card h-100 shadow-sm">

            <?php if ($p['product_image']): ?>
              <img src="<?= BASE_URL ?>/<?= htmlspecialchars($p['product_image']) ?>"
                class="card-img-top" style="height:180px;object-fit:cover;">
            <?php endif; ?>

            <div class="card-body">
              <h6 class="fw-bold"><?= htmlspecialchars($p['product_name']) ?></h6>
              <p class="text-success fw-bold mb-1">
                $<?= number_format($p['product_price'], 2) ?>
              </p>
              <small class="text-muted">
                <?= htmlspecialchars($p['store_name']) ?>
              </small>
            </div>

          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
<?php endif; ?>

<?php include __DIR__ . '/../views/layouts/footer.php'; ?>