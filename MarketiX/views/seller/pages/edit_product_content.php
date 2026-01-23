<?php
/**
 * Edit Product View (Seller)
 *
 * @var array $product
 * @var array $productImages
 * @var string|null $error
 * @var bool $success
 */
?>

<div class="mb-4">
  <h3 class="fw-bold text-success">✏ Edit Product</h3>
  <p class="text-muted mb-0">
    Update product details and manage product images.
  </p>
</div>

<?php if (!empty($error)): ?>
  <div class="alert alert-danger rounded-4 shadow-sm">
    <?= htmlspecialchars($error) ?>
  </div>
<?php endif; ?>

<?php if ($success): ?>
  <div class="alert alert-success rounded-4 shadow-sm">
    ✅ Product updated successfully.
  </div>
<?php endif; ?>

<form method="POST"
      enctype="multipart/form-data"
      class="card border-0 shadow rounded-4 p-4">

  <!-- ================= Product Information ================= -->
  <h6 class="fw-bold text-secondary mb-3">🧾 Product Information</h6>

  <div class="mb-3">
    <label class="form-label fw-semibold">Product Name</label>
    <input name="product_name"
           class="form-control rounded-3"
           value="<?= htmlspecialchars($product['product_name']) ?>"
           required>
  </div>

  <div class="mb-3">
    <label class="form-label fw-semibold">Description</label>
    <textarea name="product_description"
              class="form-control rounded-3"
              rows="4"
              required><?= htmlspecialchars($product['product_description']) ?></textarea>
  </div>

  <!-- ================= Pricing & Stock ================= -->
  <h6 class="fw-bold text-secondary mt-4 mb-3">💰 Pricing & Stock</h6>

  <div class="row g-3">
    <div class="col-md-4">
      <label class="form-label fw-semibold">Price ($)</label>
      <input name="product_price"
             type="number"
             step="0.01"
             class="form-control rounded-3"
             value="<?= $product['product_price'] ?>"
             required>
    </div>

    <div class="col-md-4">
      <label class="form-label fw-semibold">
        Quantity
        <small class="text-muted">(Reserved: <?= (int)$product['product_reserved'] ?>)</small>
      </label>
      <input name="product_quantity"
             type="number"
             class="form-control rounded-3"
             value="<?= (int)$product['product_quantity'] ?>"
             required>
    </div>

    <div class="col-md-4">
      <label class="form-label fw-semibold">Status</label>
      <select name="product_status" class="form-select rounded-3">
        <option value="active" <?= $product['product_status'] === 'active' ? 'selected' : '' ?>>Active</option>
        <option value="hidden" <?= $product['product_status'] === 'hidden' ? 'selected' : '' ?>>Hidden</option>
        <option value="out_of_stock" <?= $product['product_status'] === 'out_of_stock' ? 'selected' : '' ?>>Out of Stock</option>
      </select>
    </div>
  </div>

  <!-- ================= Product Gallery ================= -->
  <h6 class="fw-bold text-secondary mt-4 mb-3">🖼 Product Gallery</h6>

  <?php if (!empty($productImages)): ?>
    <div class="row g-3">
      <?php foreach ($productImages as $img): ?>
        <div class="col-auto text-center">

          <img
            src="<?= BASE_URL ?>/<?= htmlspecialchars($img['image_path']) ?>"
            style="width:90px;height:90px;object-fit:contain"
            class="rounded border bg-light mb-1">

          <?php if ($img['is_main']): ?>
            <div class="badge bg-success mb-1">Main</div>
          <?php endif; ?>

          <div class="d-flex justify-content-center gap-1 mt-1">

            <?php if (!$img['is_main']): ?>
              <button type="submit"
                      name="set_main"
                      value="<?= $img['image_id'] ?>"
                      class="btn btn-sm btn-outline-success">
                Set Main
              </button>
            <?php endif; ?>

            <button type="submit"
                    name="delete_image"
                    value="<?= $img['image_id'] ?>"
                    class="btn btn-sm btn-outline-danger"
                    onclick="return confirm('Delete this image?')">
              Delete
            </button>

          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <p class="text-muted small">No images uploaded.</p>
  <?php endif; ?>

  <!-- ================= Replace Images ================= -->
  <h6 class="fw-bold text-secondary mt-4 mb-3">🔄 Replace Images</h6>

  <div class="mb-3">
    <label class="form-label fw-semibold">
      Upload New Images
      <span class="text-muted fw-normal">(Main + Gallery)</span>
    </label>

    <input type="file"
           name="product_images[]"
           class="form-control rounded-3"
           multiple
           accept="image/*">

    <small class="text-muted">
      • Uploading new images will replace all existing images<br>
      • First image will be set as the main image
    </small>
  </div>

  <!-- ================= Actions ================= -->
  <div class="d-flex justify-content-end gap-2 mt-4">
    <a href="<?= BASE_URL ?>/views/seller/products.php"
       class="btn btn-outline-secondary px-4">
      Back
    </a>

    <button type="submit"
            name="update_product"
            class="btn btn-success px-4">
      Update Product
    </button>
  </div>

</form>
