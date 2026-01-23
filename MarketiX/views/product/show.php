
<?php include ROOT_PATH . '/views/layouts/header.php'; ?>

<style>
/* ===============================
   PRODUCT PAGE – FINAL UI
================================ */
.product-container {
  height: calc(100vh - 140px);
  display: flex;
  align-items: center;
}

.product-wrapper {
  width: 100%;
  background: #fff;
  border-radius: 24px;
  padding: 32px;
  border: 1px solid #e5e7eb;
}

.product-grid {
  display: grid;
  grid-template-columns: 460px 1fr;
  gap: 48px;
}

/* ===== Gallery ===== */
.product-gallery {
  display: flex;
  flex-direction: column;
  gap: 14px;
}

.main-image-box {
  background: #f8fafc;
  border-radius: 18px;
  height: 360px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.main-image-box img {
  max-width: 100%;
  max-height: 100%;
  object-fit: contain;
}

.thumb-list {
  display: flex;
  gap: 10px;
}

.thumb {
  width: 68px;
  height: 68px;
  border-radius: 12px;
  border: 2px solid transparent;
  background: #f8fafc;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
}

.thumb img {
  max-width: 100%;
  max-height: 100%;
  object-fit: contain;
}

.thumb.active {
  border-color: #22c55e;
}

/* ===== Info ===== */
.product-title {
  font-size: 28px;
  font-weight: 900;
  margin-bottom: 6px;
}

.product-store {
  font-size: 14px;
  color: #64748b;
  margin-bottom: 12px;
}

.product-price {
  font-size: 26px;
  font-weight: 900;
  color: #16a34a;
  margin-bottom: 6px;
}

.product-stock {
  font-weight: 600;
  margin-bottom: 24px;
}

.in-stock { color:#16a34a; }
.out-stock { color:#dc2626; }

.add-cart-btn {
  width: 100%;
  padding: 14px;
  border-radius: 14px;
  border: none;
  font-weight: 800;
  font-size: 16px;
  background: #22c55e;
  color: #fff;
}

.add-cart-btn:disabled {
  background: #9ca3af;
}

/* Description */
.product-desc {
  margin-top: 28px;
}

.product-desc h4 {
  font-weight: 900;
  margin-bottom: 10px;
}
</style>

<div class="container product-container">
  <div class="product-wrapper">

    <div class="product-grid">

      <!-- ===== GALLERY ===== -->
      <div class="product-gallery">

        <div class="main-image-box">
          <?php if (!empty($mainImage)): ?>
            <img id="mainImage"
                 src="<?= BASE_URL ?>/<?= htmlspecialchars($mainImage) ?>">
          <?php else: ?>
            <span class="text-muted">No Image</span>
          <?php endif; ?>
        </div>

        <?php if (!empty($productImages)): ?>
          <div class="thumb-list">
            <?php foreach ($productImages as $img): ?>
              <div class="thumb <?= $img['image_path'] === $mainImage ? 'active' : '' ?>"
                   onclick="switchImage(this,'<?= BASE_URL ?>/<?= htmlspecialchars($img['image_path']) ?>')">
                <img src="<?= BASE_URL ?>/<?= htmlspecialchars($img['image_path']) ?>">
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>

      </div>

      <!-- ===== INFO ===== -->
      <div>

        <div class="product-title">
          <?= htmlspecialchars($product['product_name']) ?>
        </div>

        <div class="product-store">
          Sold by
          <a href="<?= BASE_URL ?>/public/store.php?id=<?= $product['store_id'] ?>">
            <?= htmlspecialchars($product['store_name']) ?>
          </a>
        </div>

        <div class="mb-3">
          <a href="<?= BASE_URL ?>/public/store.php?id=<?= $product['store_id'] ?>"
             class="btn btn-outline-secondary btn-sm rounded-pill px-3">
            ← Back to Store
          </a>
        </div>

        <div class="product-price">
          $<?= number_format($product['product_price'], 2) ?>
        </div>

        <div class="product-stock <?= $product['product_quantity'] > 0 ? 'in-stock' : 'out-stock' ?>">
          <?= $product['product_quantity'] > 0 ? '✔ In Stock' : '✖ Out of Stock' ?>
        </div>

        <button class="add-cart-btn"
                onclick="addToCart(<?= $product['product_id'] ?>)"
                <?= $product['product_quantity'] <= 0 ? 'disabled' : '' ?>>
          🛒 Add to Cart
        </button>

        <div class="product-desc">
          <h4>Product Description</h4>
          <p>
            <?= nl2br(htmlspecialchars($product['product_description'] ?? 'No description available.')) ?>
          </p>
        </div>

      </div>

    </div>

  </div>
</div>

<script>
function switchImage(el, src) {
  document.getElementById('mainImage').src = src;
  document.querySelectorAll('.thumb').forEach(t => t.classList.remove('active'));
  el.classList.add('active');
}

function addToCart(productId){
  fetch('<?= BASE_URL ?>/public/api/cart/add.php',{
    method:'POST',
    headers:{'Content-Type':'application/json'},
    body:JSON.stringify({product_id:productId})
  })
  .then(r => r.json())
  .then(d => alert(d.message ?? 'Added to cart'));
}
</script>

<?php include ROOT_PATH . '/views/layouts/footer.php'; ?>
