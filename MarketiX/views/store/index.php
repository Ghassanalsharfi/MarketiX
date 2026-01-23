<?php include ROOT_PATH . '/views/layouts/header.php'; ?>

<style>
/* ===============================
   STORE – PRO MARKETPLACE UI
================================ */
:root {
  --mx-primary:#3b82f6;
  --mx-green:#22c55e;
  --mx-muted:#64748b;
  --mx-border:#e5e7eb;
  --mx-bg:#f8fafc;
}

/* Hero */
.store-hero {
  background: linear-gradient(135deg, rgba(59,130,246,.08), rgba(34,197,94,.08));
  border-radius: 26px;
  padding: 36px;
  margin-bottom: 36px;
}

/* Product Card */
.product-card {
  border: 1px solid var(--mx-border);
  border-radius: 20px;
  overflow: hidden;
  background: #fff;
  transition: .25s ease;
  height: 100%;
}

.product-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 18px 36px rgba(15,23,42,.12);
  border-color: var(--mx-primary);
}

/* Image */
.product-img {
  height: 190px;
  background: var(--mx-bg);
  display: flex;
  align-items: center;
  justify-content: center;
}

.product-img img {
  width: 100%;
  height: 100%;
  object-fit: contain;
  transition: .25s ease;
}

.product-card:hover img {
  transform: scale(1.05);
}

/* Body */
.product-body {
  padding: 16px;
}

.product-name {
  font-weight: 800;
  margin-bottom: 6px;
  line-height: 1.3;
}

.product-price {
  font-weight: 900;
  color: var(--mx-green);
  margin-bottom: 4px;
}

.product-stock {
  font-size: 13px;
  color: var(--mx-muted);
  margin-bottom: 12px;
}

/* Buttons */
.btn-details {
  display: block;
  text-align: center;
  padding: 9px;
  border-radius: 12px;
  border: 1px solid var(--mx-border);
  text-decoration: none;
  font-weight: 700;
  margin-bottom: 10px;
  color: #111827;
}

.btn-details:hover {
  background: #f1f5f9;
}

.btn-cart {
  width: 100%;
  border-radius: 12px;
  font-weight: 800;
}
</style>

<!-- STATUS -->
<div class="container pt-4">
  <div class="alert alert-<?= $badgeClass ?> rounded-4">
    <strong><?= htmlspecialchars($statusText) ?></strong>

    <?php if (!$isLoggedIn): ?>
      <a href="<?= BASE_URL ?>/public/login.php"
         class="btn btn-sm btn-dark float-end">
        Login to view products
      </a>
    <?php endif; ?>
  </div>
</div>

<!-- STORE HERO -->
<div class="container">
  <div class="store-hero">
    <h2 class="fw-bold mb-2"><?= htmlspecialchars($store['store_name']) ?></h2>
    <p class="text-muted mb-3"><?= htmlspecialchars($store['store_description']) ?></p>
    <div class="text-muted small">
      👁 <?= (int)$store['store_views'] ?> views
    </div>
  </div>
</div>

<!-- PRODUCTS -->
<div class="container pb-5">

<?php if (!$isLoggedIn): ?>

  <div class="alert alert-info text-center rounded-4">
    Login required to view products.
  </div>

<?php else: ?>

<h4 class="fw-bold mb-4">Products</h4>

<div class="row g-4">

<?php if (empty($products)): ?>

  <div class="col-12">
    <div class="alert alert-warning rounded-4">
      No products available in this store.
    </div>
  </div>

<?php else: ?>

<?php foreach ($products as $product): ?>
<?php
$available =
  (int)$product['product_quantity']
- (int)($product['product_reserved'] ?? 0);
?>

<div class="col-lg-3 col-md-4 col-sm-6">
  <div class="product-card">

    <!-- IMAGE -->
    <a href="<?= BASE_URL ?>/public/product.php?id=<?= (int)$product['product_id'] ?>">
      <div class="product-img">
        <?php if (!empty($product['product_image'])): ?>
          <img
            src="<?= BASE_URL ?>/<?= htmlspecialchars($product['product_image']) ?>"
            alt="<?= htmlspecialchars($product['product_name']) ?>">
        <?php else: ?>
          <span class="text-muted small">No Image</span>
        <?php endif; ?>
      </div>
    </a>

    <!-- BODY -->
    <div class="product-body">

      <a href="<?= BASE_URL ?>/public/product.php?id=<?= (int)$product['product_id'] ?>"
         class="text-decoration-none text-dark">
        <div class="product-name">
          <?= htmlspecialchars($product['product_name']) ?>
        </div>
      </a>

      <div class="product-price">
        $<?= number_format((float)$product['product_price'], 2) ?>
      </div>

      <div class="product-stock">
        Available: <?= max(0, $available) ?>
      </div>

      <a href="<?= BASE_URL ?>/public/product.php?id=<?= (int)$product['product_id'] ?>"
         class="btn-details">
        🔍 View Product Details
      </a>

      <?php if ($available <= 0): ?>
        <button class="btn btn-secondary btn-cart" disabled>
          Out of Stock
        </button>
      <?php else: ?>
        <button class="btn btn-success btn-cart"
                onclick="addToCart(<?= (int)$product['product_id'] ?>)">
          🛒 Add to Cart
        </button>
      <?php endif; ?>

    </div>
  </div>
</div>

<?php endforeach; ?>
<?php endif; ?>

</div>
<?php endif; ?>
</div>

<script>
function addToCart(productId){
  fetch('<?= BASE_URL ?>/public/api/cart/add.php',{
    method:'POST',
    headers:{'Content-Type':'application/json'},
    body:JSON.stringify({product_id:productId})
  })
  .then(r=>r.json())
  .then(d=>alert(d.message ?? 'Added'));
}
</script>

<?php include ROOT_PATH . '/views/layouts/footer.php'; ?>
