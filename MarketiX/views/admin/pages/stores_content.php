<?php
/**
 * Stores Content View (Admin)
 *
 * Pure View file.
 *
 * Expected variables:
 * @var array $stores
 */

$stores ??= [];
?>

<h3 class="fw-bold mb-4">Stores Management</h3>

<div class="card-custom p-4">

<?php if (!empty($_SESSION['flash'])): ?>
  <div class="alert alert-<?= $_SESSION['flash']['type'] ?> mt-3">
    <?= $_SESSION['flash']['message'] ?>
  </div>
  <?php unset($_SESSION['flash']); ?>
<?php endif; ?>

<?php if (empty($stores)): ?>

  <div class="alert alert-info">
    No stores found.
  </div>

<?php else: ?>

  <table class="table align-middle">
    <thead class="table-light">
      <tr>
        <th>Store</th>
        <th>Seller</th>
        <th>Stats</th>
        <th>Status</th>
        <th>Created</th>
        <th class="text-end">Action</th>
      </tr>
    </thead>

    <tbody>

    <?php foreach ($stores as $store): ?>
      <tr>

        <!-- Store -->
        <td>
          <strong><?= htmlspecialchars($store['store_name']) ?></strong>
        </td>

        <!-- Seller -->
        <td>
          <?= htmlspecialchars($store['seller_name']) ?><br>
          <small class="text-muted"><?= htmlspecialchars($store['user_email']) ?></small>

          <?php if ($store['seller_status'] === 'blocked'): ?>
            <div>
              <span class="badge bg-danger mt-1">Seller Blocked</span>
            </div>
          <?php endif; ?>
        </td>

        <!-- Stats -->
        <td>
          <small class="text-muted d-block">
            Products: <?= (int)$store['products_count'] ?>
          </small>
          <small class="text-muted d-block">
            Orders: <?= (int)$store['orders_count'] ?>
          </small>
        </td>

        <!-- Status -->
        <td>
          <?php
            $badge = match ($store['store_status']) {
              'active'   => 'success',
              'inactive' => 'warning',
              'blocked'  => 'danger',
              default    => 'secondary'
            };
          ?>
          <span class="badge bg-<?= $badge ?>">
            <?= ucfirst($store['store_status']) ?>
          </span>
        </td>

        <!-- Created -->
        <td>
          <?= date('Y-m-d', strtotime($store['created_at'])) ?>
        </td>

        <!-- Actions -->
        <td class="text-end">

          <?php if ($store['store_status'] !== 'active' && $store['seller_status'] === 'active'): ?>
            <a href="actions/store_action.php?id=<?= (int)$store['store_id'] ?>&action=activate"
               class="btn btn-sm btn-success">
              Activate
            </a>
          <?php endif; ?>

          <?php if ($store['store_status'] === 'active'): ?>
            <a href="actions/store_action.php?id=<?= (int)$store['store_id'] ?>&action=deactivate"
               class="btn btn-sm btn-warning">
              Deactivate
            </a>
          <?php endif; ?>

          <?php if ($store['store_status'] !== 'blocked'): ?>
            <a href="actions/store_action.php?id=<?= (int)$store['store_id'] ?>&action=block"
               class="btn btn-sm btn-danger"
               onclick="return confirm('Block this store?')">
              Block
            </a>
          <?php endif; ?>

        </td>

      </tr>
    <?php endforeach; ?>

    </tbody>
  </table>

<?php endif; ?>

</div>
