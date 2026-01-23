<?php
/**
 * Store View (Seller)
 *
 * @var array|null $store
 * @var string|null $error
 * @var string|null $success
 */
?>

<h3 class="fw-bold mb-4">🏪 My Store</h3>

<?php if (!empty($error)): ?>
  <div class="alert alert-danger rounded-4">
    <?= htmlspecialchars($error) ?>
  </div>
<?php endif; ?>

<?php if (!empty($success)): ?>
  <div class="alert alert-success rounded-4">
    <?= htmlspecialchars($success) ?>
  </div>
<?php endif; ?>

<div class="card shadow-sm rounded-4 p-4">

  <?php if (!empty($store['store_image'])): ?>
    <img
      src="<?= BASE_URL ?>/public/uploads/stores/<?= htmlspecialchars($store['store_image']) ?>"
      class="rounded mb-3"
      style="max-height:180px;object-fit:cover;width:100%;">
  <?php endif; ?>

  <form method="POST" enctype="multipart/form-data">

    <div class="mb-3">
      <label class="form-label fw-semibold">Store Name</label>
      <input
        name="store_name"
        class="form-control"
        value="<?= htmlspecialchars($store['store_name'] ?? '') ?>"
        required>
    </div>

    <div class="mb-3">
      <label class="form-label fw-semibold">Description</label>
      <textarea
        name="store_description"
        class="form-control"
        rows="3"><?= htmlspecialchars($store['store_description'] ?? '') ?></textarea>
    </div>

    <div class="mb-4">
      <label class="form-label fw-semibold">Store Image</label>
      <input
        type="file"
        name="store_image"
        class="form-control"
        accept="image/*">
    </div>

    <button class="btn btn-primary-custom w-100">
      <?= $store ? 'Update Store' : 'Create Store' ?>
    </button>

  </form>
</div>
