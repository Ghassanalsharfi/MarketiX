<?php
/**
 * Add Product View (Seller)
 *
 * @var string|null $error
 * @var bool $success
 */
?>

<div class="mb-4">
  <h3 class="fw-bold text-success">➕ Add New Product</h3>
  <p class="text-muted mb-0">
    Create a new product and upload multiple images to attract customers.
  </p>
</div>

<?php if (!empty($error)): ?>
  <div class="alert alert-danger rounded-4 shadow-sm">
    <?= htmlspecialchars($error) ?>
  </div>
<?php endif; ?>

<?php if ($success): ?>
  <div class="alert alert-success rounded-4 shadow-sm">
    ✅ Product added successfully.
    <a href="<?= BASE_URL ?>/views/seller/products.php"
       class="fw-bold text-decoration-none text-success ms-1">
      View products →
    </a>
  </div>
<?php endif; ?>

<form method="POST"
      enctype="multipart/form-data"
      class="card border-0 shadow rounded-4 p-4">

  <!-- Product Info -->
  <h6 class="fw-bold text-secondary mb-3">
    🧾 Product Information
  </h6>

  <div class="mb-3">
    <label class="form-label fw-semibold">Product Name</label>
    <input name="product_name"
           class="form-control rounded-3"
           placeholder="Enter product name"
           required>
  </div>

  <div class="mb-3">
    <label class="form-label fw-semibold">Description</label>
    <textarea name="product_description"
              class="form-control rounded-3"
              rows="4"
              placeholder="Describe your product"
              required></textarea>
  </div>

  <!-- Pricing & Status -->
  <h6 class="fw-bold text-secondary mt-4 mb-3">
    💰 Pricing & Availability
  </h6>

  <div class="row g-3">
    <div class="col-md-4">
      <label class="form-label fw-semibold">Price ($)</label>
      <input name="product_price"
             type="number"
             step="0.01"
             class="form-control rounded-3"
             required>
    </div>

    <div class="col-md-4">
      <label class="form-label fw-semibold">Quantity</label>
      <input name="product_quantity"
             type="number"
             class="form-control rounded-3"
             required>
    </div>

    <div class="col-md-4">
      <label class="form-label fw-semibold">Status</label>
      <select name="product_status"
              class="form-select rounded-3">
        <option value="active">Active</option>
        <option value="hidden">Hidden</option>
        <option value="out_of_stock">Out of Stock</option>
      </select>
    </div>
  </div>

  <!-- Images -->
  <h6 class="fw-bold text-secondary mt-4 mb-3">
    🖼 Product Images
  </h6>

  <div class="mb-3">
    <label class="form-label fw-semibold">
      Upload Images
      <span class="text-muted fw-normal">(Main + Gallery)</span>
    </label>

    <input type="file"
           name="product_images[]"
           class="form-control rounded-3"
           multiple
           accept="image/*" required>

    <small class="text-muted">
      • First image will be used as the main image<br>
      • Supported formats: JPG, PNG, WEBP
    </small>
  </div>

  <!-- Actions -->
  <div class="d-flex justify-content-end gap-2 mt-4">
    <a href="<?= BASE_URL ?>/views/seller/products.php"
       class="btn btn-outline-secondary px-4">
      Cancel
    </a>

    <button class="btn btn-success px-4">
      ➕ Add Product
    </button>
  </div>
</form>
