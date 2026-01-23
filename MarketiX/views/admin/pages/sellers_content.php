<?php
/**
 * Sellers Content View (Admin)
 *
 * Expected variables:
 * @var array  $sellers
 * @var string $statusFilter
 */

// Safety guards
$sellers      ??= [];
$statusFilter ??= 'all';
?>

<h3 class="fw-bold mb-3">Sellers Management</h3>

<!-- Filter -->
<form method="GET" class="row g-3 mb-4">
  <div class="col-md-3">
    <select name="status" class="form-select">
      <option value="all">All Status</option>
      <option value="active" <?= $statusFilter==='active'?'selected':'' ?>>Active</option>
      <option value="inactive" <?= $statusFilter==='inactive'?'selected':'' ?>>Inactive</option>
    </select>
  </div>

  <div class="col-md-2">
    <button class="btn btn-dark w-100">Filter</button>
  </div>
</form>

<!-- Table -->
<div class="card-custom p-4">

<?php if (empty($sellers)): ?>

  <div class="alert alert-info mb-0">
    No sellers found.
  </div>

<?php else: ?>

  <table class="table align-middle">
    <thead class="table-light">
      <tr>
        <th>Seller</th>
        <th>Email</th>
        <th>User Status</th>
        <th>Seller Status</th>
        <th class="text-end">Action</th>
      </tr>
    </thead>
    <tbody>

    <?php foreach ($sellers as $s): ?>
      <tr>
        <td><strong><?= htmlspecialchars($s['user_name']) ?></strong></td>
        <td><?= htmlspecialchars($s['user_email']) ?></td>

        <!-- User Status -->
        <td>
          <?php if ($s['user_status'] === 'active'): ?>
            <span class="badge bg-success">Active</span>
          <?php else: ?>
            <span class="badge bg-danger">Blocked</span>
          <?php endif; ?>
        </td>

        <!-- Seller Status -->
        <td>
          <?php if ($s['seller_status'] === 'active'): ?>
            <span class="badge bg-success">Active</span>
          <?php else: ?>
            <span class="badge bg-secondary">Inactive</span>
          <?php endif; ?>
        </td>

        <!-- Action -->
        <td class="text-end">
          <?php if ($s['user_status'] !== 'active'): ?>
            <span class="text-muted small">User Blocked</span>
          <?php else: ?>
            <a href="seller_action.php?id=<?= (int)$s['seller_id'] ?>&action=toggle"
               class="btn btn-sm <?= $s['seller_status'] === 'active' ? 'btn-warning' : 'btn-success' ?>"
               onclick="return confirm('Are you sure you want to change seller status?')">
              <?= $s['seller_status'] === 'active' ? 'Deactivate' : 'Activate' ?>
            </a>
          <?php endif; ?>
        </td>
      </tr>
    <?php endforeach; ?>

    </tbody>
  </table>

<?php endif; ?>

</div>
