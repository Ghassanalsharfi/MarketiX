<?php
/**
 * Products Content View (Admin)
 *
 * This file is a pure View.
 * It expects the following variables to be defined before inclusion:
 *
 * @var array  $products
 * @var string $statusFilter
 */

// Safety guards (prevent warnings if accessed directly)
$products ??= [];
$statusFilter ??= 'all';
?>

<h3 class="fw-bold mb-3">Products Management</h3>

<!-- ===============================
     Filter
================================ -->
<form method="GET" class="mb-3">
  <select name="status" onchange="this.form.submit()" class="form-select w-auto">
    <option value="all" <?= $statusFilter==='all'?'selected':'' ?>>All Products</option>
    <option value="active" <?= $statusFilter==='active'?'selected':'' ?>>Active</option>
    <option value="hidden" <?= $statusFilter==='hidden'?'selected':'' ?>>Hidden</option>
    <option value="out_of_stock" <?= $statusFilter==='out_of_stock'?'selected':'' ?>>Out of stock</option>
  </select>
</form>

<!-- ===============================
     Table
================================ -->
<div class="card p-4 shadow-sm rounded-4">

<?php if (empty($products)): ?>

  <div class="alert alert-info mb-0">
    No products found for the selected filter.
  </div>

<?php else: ?>

  <table class="table align-middle">
    <thead class="table-light">
      <tr>
        <th>Image</th>
        <th>Product</th>
        <th>Store</th>
        <th>Seller</th>
        <th>Price</th>
        <th>Stock</th>
        <th>Status</th>
        <th class="text-end">Action</th>
      </tr>
    </thead>

    <tbody>
    <?php foreach ($products as $p): ?>
      <tr>

       <td>
  <?php if (!empty($p['product_image'])): ?>
    <img
      src="<?= BASE_URL ?>/<?= htmlspecialchars($p['product_image']) ?>"
      alt="<?= htmlspecialchars($p['product_name']) ?>"
      width="55"
      height="55"
      class="rounded border object-fit-cover"
    >
  <?php else: ?>
    <span class="text-muted">No Image</span>
  <?php endif; ?>
</td>

    


        <!-- Name -->
        <td>
          <strong><?= htmlspecialchars($p['product_name']) ?></strong>
        </td>

        <!-- Store -->
        <td><?= htmlspecialchars($p['store_name']) ?></td>

        <!-- Seller -->
        <td><?= htmlspecialchars($p['seller_name']) ?></td>

        <!-- Price -->
        <td>$<?= number_format((float)$p['product_price'], 2) ?></td>

        <!-- Stock -->
        <td>
          <?= max(0, (int)$p['available_quantity']) ?>
          <small class="text-muted d-block">
            Reserved: <?= (int)$p['product_reserved'] ?>
          </small>
        </td>

        <!-- Status -->
        <td>
          <?php
            $badge = match ($p['product_status']) {
              'active'       => 'success',
              'hidden'       => 'secondary',
              'out_of_stock' => 'warning',
              default        => 'dark'
            };
          ?>
          <span class="badge bg-<?= $badge ?>">
            <?= ucfirst($p['product_status']) ?>
          </span>
        </td>

        <!-- Action -->
        <td class="text-end">
          <?php if ($p['product_status'] === 'active'): ?>
            <form method="POST" class="d-inline">
              <input type="hidden" name="product_id" value="<?= (int)$p['product_id'] ?>">
              <input type="hidden" name="action" value="hide">
              <button class="btn btn-sm btn-outline-danger">Hide</button>
            </form>
          <?php else: ?>
            <form method="POST" class="d-inline">
              <input type="hidden" name="product_id" value="<?= (int)$p['product_id'] ?>">
              <input type="hidden" name="action" value="activate">
              <button class="btn btn-sm btn-outline-success">Activate</button>
            </form>
          <?php endif; ?>
        </td>

      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>

<?php endif; ?>

</div>
