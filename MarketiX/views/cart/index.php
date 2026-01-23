<?php include ROOT_PATH . '/views/layouts/header.php'; ?>

<style>
/* ===============================
   Brand Colors
================================ */
:root {
  --mx-green: #22c55e;
  --mx-green-dark: #16a34a;
  --mx-blue:  #3b82f6;
  --mx-dark:  #0f172a;
  --mx-muted: #6b7280;
  --mx-border:#e5e7eb;
  --mx-bg:    #f8fafc;
}

/* ===============================
   Page Base
================================ */
.cart-page {
  background: var(--mx-bg);
}

.cart-title {
  font-weight: 900;
  color: var(--mx-dark);
}

/* ===============================
   Cart Item
================================ */
.cart-item {
  border: 1px solid var(--mx-border);
  border-radius: 20px;
  padding: 22px;
  background: #fff;
  transition: box-shadow .25s ease, transform .25s ease;
}

.cart-item:hover {
  box-shadow: 0 16px 32px rgba(15,23,42,.08);
  transform: translateY(-2px);
}

.cart-name {
  font-weight: 700;
  font-size: 17px;
}

.price {
  font-weight: 800;
  color: var(--mx-green);
  font-size: 16px;
}

/* ===============================
   Quantity Controls
================================ */
.qty-box {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-top: 6px;
}

.qty-box input {
  width: 80px;
  text-align: center;
  border-radius: 10px;
  font-weight: 600;
}

/* + / - */
.qty-btn {
  width: 36px;
  height: 36px;
  border-radius: 50%;
  border: 2px solid var(--mx-blue);
  background: transparent;
  color: var(--mx-blue);
  font-weight: 900;
  line-height: 1;
  transition: all .25s ease;
}

.qty-btn:hover {
  background: linear-gradient(135deg, var(--mx-blue), var(--mx-green));
  color: #fff;
  border-color: transparent;
  transform: translateY(-1px);
}

/* Update */
.qty-update {
  border-radius: 10px;
  padding: 6px 16px;
  font-weight: 700;
  background: linear-gradient(135deg, var(--mx-green), var(--mx-green-dark));
  border: none;
  color: #fff;
  transition: all .25s ease;
}

.qty-update:hover {
  background: linear-gradient(135deg, var(--mx-blue), var(--mx-green));
  transform: translateY(-1px);
}

/* ===============================
   Item Total + Remove
================================ */
.item-total {
  font-weight: 800;
  font-size: 16px;
}

.remove-btn {
  font-size: 14px;
  color: #ef4444;
  background: transparent;
  border: none;
  padding: 0;
  transition: color .2s ease;
}

.remove-btn:hover {
  color: var(--mx-blue);
}

/* ===============================
   Summary Box
================================ */
.summary-box {
  border: 1px solid var(--mx-border);
  border-radius: 22px;
  padding: 26px;
  background: #fff;
  position: sticky;
  top: 100px;
}

.summary-box h5 {
  font-weight: 800;
}

.summary-row {
  display: flex;
  justify-content: space-between;
  margin-bottom: 10px;
  color: var(--mx-muted);
}

.summary-total {
  font-size: 20px;
  font-weight: 900;
  color: var(--mx-green);
}

/* ===============================
   Checkout Button
================================ */
.checkout-btn {
  margin-top: 16px;
  font-size: 18px;
  font-weight: 800;
  border-radius: 999px;
  padding: 14px;
  background: linear-gradient(135deg, var(--mx-green), var(--mx-green-dark));
  border: none;
  transition: opacity .2s ease;
}

.checkout-btn:hover {
  opacity: .9;
}

/* ===============================
   Empty Cart
================================ */
.empty-cart {
  background: #fff;
  border: 1px dashed var(--mx-border);
  border-radius: 22px;
  padding: 60px 20px;
}
</style>

<div class="cart-page">
<div class="container py-5">

  <h2 class="cart-title mb-4">🛒 Shopping Cart</h2>

<?php if (empty($cart)): ?>

  <div class="empty-cart text-center">
    <h4 class="fw-bold mb-2">Your cart is empty</h4>
    <p class="text-muted mb-4">
      Add some products to start your order.
    </p>
    <a href="<?= BASE_URL ?>/public/products.php"
       class="btn btn-success px-5 py-2 rounded-pill fw-bold">
      Browse Marketplace
    </a>
  </div>

<?php else: ?>

<div class="row g-4">

<!-- CART ITEMS -->
<div class="col-lg-8">
<?php foreach ($cart as $item):
  $subtotal = $item['product_price'] * $item['quantity'];
  $total += $subtotal;
?>
<div class="cart-item mb-3">
  <div class="d-flex justify-content-between align-items-start flex-wrap gap-4">

    <div>
      <div class="cart-name"><?= htmlspecialchars($item['product_name']) ?></div>
      <div class="price mb-1">$<?= number_format($item['product_price'],2) ?></div>

      <div class="qty-box">
        <button class="qty-btn"
          onclick="updateQty(<?= $item['product_id'] ?>,'decrease')">−</button>

        <input type="number"
               min="1"
               id="qty-<?= $item['product_id'] ?>"
               class="form-control form-control-sm"
               value="<?= $item['quantity'] ?>">

        <button class="qty-btn"
          onclick="updateQty(<?= $item['product_id'] ?>,'increase')">+</button>

        <button class="qty-update"
          onclick="applyQty(
            <?= $item['product_id'] ?>,
            document.getElementById('qty-<?= $item['product_id'] ?>').value
          )">
          Update
        </button>
      </div>
    </div>

    <div class="text-end">
      <div class="item-total mb-2">
        $<?= number_format($subtotal,2) ?>
      </div>
      <button class="remove-btn"
        onclick="removeItem(<?= $item['product_id'] ?>)">
        🗑 Remove
      </button>
    </div>

  </div>
</div>
<?php endforeach; ?>
</div>

<!-- SUMMARY -->
<div class="col-lg-4">
  <div class="summary-box">
    <h5 class="mb-4">Order Summary</h5>

    <div class="summary-row">
      <span>Items</span>
      <span><?= array_sum(array_column($cart,'quantity')) ?></span>
    </div>

    <div class="summary-row">
      <span>Total</span>
      <span class="summary-total">$<?= number_format($total,2) ?></span>
    </div>

    <a href="<?= BASE_URL ?>/public/checkout.php"
       class="btn btn-success w-100 checkout-btn">
      Proceed to Checkout
    </a>

    <p class="text-muted small text-center mt-3">
      🔒 Secure & trusted checkout
    </p>
  </div>
</div>

</div>
<?php endif; ?>
</div>
</div>

<script>
function updateQty(productId, action) {
  fetch('<?= BASE_URL ?>/public/api/cart/update.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ product_id: productId, action })
  })
  .then(r => r.json())
  .then(d => {
    if (d.status === 'error') { alert(d.message); return; }
    location.reload();
  });
}

function applyQty(productId, qty) {
  qty = parseInt(qty);
  if (isNaN(qty) || qty < 1) return;

  fetch('<?= BASE_URL ?>/public/api/cart/update.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ product_id: productId, quantity: qty })
  })
  .then(r => r.json())
  .then(d => {
    if (d.status === 'error') { alert(d.message); return; }
    location.reload();
  });
}

function removeItem(productId) {
  fetch('<?= BASE_URL ?>/public/api/cart/remove.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ product_id: productId })
  }).then(() => location.reload());
}
</script>

<?php include ROOT_PATH . '/views/layouts/footer.php'; ?>
