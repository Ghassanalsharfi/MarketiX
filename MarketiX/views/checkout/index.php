<?php include ROOT_PATH . '/views/layouts/header.php'; ?>

<style>
:root {
  --mx-green:#22c55e;
  --mx-blue:#3b82f6;
  --mx-dark:#0f172a;
  --mx-border:#e5e7eb;
  --mx-bg:#f8fafc;
}
.checkout-page { background:var(--mx-bg); }
.checkout-title { font-weight:900; color:var(--mx-dark); }
.checkout-card {
  background:#fff;
  border:1px solid var(--mx-border);
  border-radius:22px;
  padding:28px;
}
.checkout-card h5 { font-weight:800; }
.place-btn {
  font-weight:800;
  border-radius:999px;
  padding:14px;
}
.success-box { max-width:520px; margin:auto; }
.summary-item { font-size:15px; }
</style>

<div class="checkout-page">
<div class="container py-5">

<h2 class="checkout-title mb-4">✅ Checkout</h2>

<?php if ($error): ?>
  <div class="alert alert-danger rounded-4">
    <?= htmlspecialchars($error) ?>
  </div>
<?php endif; ?>

<?php if ($orderPlaced): ?>

  <div class="checkout-card success-box text-center">
    <h4 class="fw-bold mb-2">🎉 Order Placed Successfully</h4>
    <p class="text-muted mb-4">
      Your order is pending seller confirmation.
    </p>
    <a href="<?= BASE_URL ?>/public/products.php"
       class="btn btn-success px-5 rounded-pill fw-bold">
      Continue Shopping
    </a>
  </div>

<?php else: ?>

<div class="row g-4">

<!-- SHIPPING -->
<div class="col-lg-6">

  <!-- ✅ الفورم الصحيح (واحد فقط) -->
  <form method="POST" class="checkout-card needs-validation" novalidate>

    <h5 class="mb-3">📦 Shipping Information</h5>

    <input name="full_name"
      class="form-control mb-3"
      value="<?= htmlspecialchars($user['user_name']) ?>" required>

    <input name="email"
      type="email"
      class="form-control mb-3"
      value="<?= htmlspecialchars($user['user_email']) ?>" readonly>

  <input name="address"
  class="form-control mb-3"
  placeholder="Delivery Address" required>

<div class="invalid-feedback">
  Please enter your delivery address.
</div>

<input type="tel"
  name="phone"
  class="form-control mb-3"
  placeholder="Phone Number (e.g. 771234567)"
  pattern="^(77|78|73|71)[0-9]{7}$"
  required>

<div class="invalid-feedback">
  Phone number must start with 77, 78, 73, or 71 and be 9 digits.
</div>


<div class="invalid-feedback">
  Please enter a valid phone number (8–15 digits, numbers only).
</div>


    <textarea name="order_notes"
      class="form-control mb-4"
      placeholder="Order notes (optional)"
      rows="3"></textarea>

    <button type="submit"
      class="btn btn-success w-100 place-btn">
      Place Order
    </button>

  </form>
</div>

<!-- SUMMARY -->
<div class="col-lg-6">
  <div class="checkout-card">

    <h5 class="mb-3">🧾 Order Summary</h5>

    <?php foreach ($cart as $item): ?>
      <div class="d-flex justify-content-between summary-item mb-2">
        <span>
          <?= htmlspecialchars($item['product_name']) ?>
          × <?= $item['quantity'] ?>
        </span>
        <strong>
          $<?= number_format(
              $item['product_price'] * $item['quantity'], 2
          ) ?>
        </strong>
      </div>
    <?php endforeach; ?>

    <hr>

    <div class="d-flex justify-content-between fs-5 fw-bold">
      <span>Total</span>
      <span class="text-success">
        $<?= number_format($total,2) ?>
      </span>
    </div>

  </div>
</div>

</div>
<?php endif; ?>

</div>
</div>

<!-- ✅ JavaScript فقط (بدون form جديد) -->
<script>
(() => {
  const form = document.querySelector('.needs-validation');
  if (!form) return;

  form.addEventListener('submit', e => {
    if (!form.checkValidity()) {
      e.preventDefault();
      e.stopPropagation();
    }
    form.classList.add('was-validated');
  });
})();
</script>

<?php include ROOT_PATH . '/views/layouts/footer.php'; ?>
