<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/MarketiX/app/bootstrap.php';
include __DIR__ . '/../views/layouts/header.php';

$isLoggedIn = isset($_SESSION['user_id']);
$userRole  = $_SESSION['user_role'] ?? null;

/* ===============================
   Active Stores (always visible)
================================ */
$stmt = $pdo->prepare("
    SELECT store_id, store_name, store_description, store_image
    FROM stores
    WHERE store_status = 'active'
    ORDER BY store_id DESC
");
$stmt->execute();
$stores = $stmt->fetchAll(PDO::FETCH_ASSOC);

/* ===============================
   Products (only for logged users)
   ✅ FIXED: Use product_images (main image)
================================ */
$products = [];
if ($isLoggedIn) {
   $stmt = $pdo->prepare("
    SELECT 
        p.product_id,
        p.product_name,
        p.product_price,
            p.store_id,      

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
    LIMIT 1000000
");

    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<style>
/* ===============================
   MarketiX Public UI Enhancements
================================ */

.btn-primary-custom {
  background: linear-gradient(135deg, #3b82f6, #22c55e);
  border: none;
  color: #fff;
  font-weight: 600;
  padding: 10px 22px;
  border-radius: 12px;
}

.btn-primary-custom:hover {
  opacity: .9;
}

.hero-section {
  background: linear-gradient(
    135deg,
    rgba(59,130,246,.05),
    rgba(34,197,94,.05)
  );
}

.card {
  border-radius: 18px;
  border: 1px solid #e5e7eb;
  overflow: hidden;
  transition: transform .25s ease, box-shadow .25s ease, border-color .25s;
  background: #ffffff;
}

.card:hover {
  transform: translateY(-6px);
  box-shadow: 0 16px 32px rgba(15,23,42,.1);
  border-color: #3b82f6;
}

.card-img-top {
  height: 200px;
  object-fit: cover;
  background: linear-gradient(
    135deg,
    rgba(59,130,246,.08),
    rgba(34,197,94,.08)
  );
}

.card-body h5,
.card-body h6 {
  color: #0f172a;
}

.card-body p {
  color: #64748b;
}

.card-footer {
  background: #ffffff;
  border-top: none;
}

.card-footer .btn-outline-primary {
  border-radius: 999px;
  padding: 8px 22px;
  font-weight: 600;
  border-color: #3b82f6;
  color: #3b82f6;
}

.card-footer .btn-outline-primary:hover {
  background: linear-gradient(135deg, #3b82f6, #22c55e);
  border-color: transparent;
  color: #ffffff;
}
</style>

<!-- ===============================
     HERO
================================ -->
<section class="py-5 hero-section text-center">
  <div class="container">
    <h1 class="fw-bold mb-3 section-title">Welcome to MarketiX</h1>
    <p class="text-muted fs-5 mb-4">
      Discover trusted stores and products
    </p>

    <?php if (!$isLoggedIn): ?>
      <a href="<?= BASE_URL ?>/public/register.php" class="btn btn-primary-custom me-2">
        Create Account
      </a>
      <a href="<?= BASE_URL ?>/public/login.php" class="btn btn-outline-dark">
        Login
      </a>
    <?php else: ?>

      <?php if ($userRole === 'admin'): ?>
        <a href="<?= BASE_URL ?>/views/admin/dashboard.php" class="btn btn-primary-custom">
          Admin Dashboard
        </a>
      <?php elseif ($userRole === 'seller'): ?>
        <a href="<?= BASE_URL ?>/views/seller/dashboard.php" class="btn btn-primary-custom">
          Seller Dashboard
        </a>
      <?php endif; ?>

    <?php endif; ?>
  </div>
</section>

<!-- ===============================
     STORES
================================ -->
<section class="container py-5">
  <h3 class="fw-bold mb-4 section-title">Stores</h3>

  <div class="row g-4">
    <?php foreach ($stores as $store): ?>
      <div class="col-md-4">
        <div class="card">

          <?php if ($store['store_image']): ?>
            <img src="<?= BASE_URL ?>/public/uploads/stores/<?= htmlspecialchars($store['store_image']) ?>"
                 class="card-img-top">
          <?php endif; ?>

          <div class="card-body">
            <h5 class="fw-bold"><?= htmlspecialchars($store['store_name']) ?></h5>
            <p class="text-muted small mb-0">
              <?= htmlspecialchars($store['store_description']) ?>
            </p>
          </div>

          <div class="card-footer text-center">
            <a href="<?= BASE_URL ?>/public/store.php?id=<?= $store['store_id'] ?>"
               class="btn btn-outline-primary">
              View Store
            </a>
          </div>

        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>
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
            <a href="<?= BASE_URL ?>/public/store.php?id=<?= (int)$p['store_id'] ?>">
              <img src="<?= BASE_URL ?>/<?= htmlspecialchars($p['product_image']) ?>"
                   class="card-img-top"
                   style="height:180px;object-fit:cover;">
            </a>
          <?php endif; ?>

          <div class="card-body">
            <h6 class="fw-bold">
              <?= htmlspecialchars($p['product_name']) ?>
            </h6>

            <p class="text-success fw-bold mb-1">
              $<?= number_format($p['product_price'], 2) ?>
            </p>

            <!-- رابط المتجر -->
            <small class="text-muted">
              <a href="<?= BASE_URL ?>/public/store.php?id=<?= (int)$p['store_id'] ?>"
                 class="text-decoration-none">
                <?= htmlspecialchars($p['store_name']) ?>
              </a>
            </small>
          </div>

        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>
<?php endif; ?>

<?php include __DIR__ . '/../views/layouts/footer.php'; ?>
