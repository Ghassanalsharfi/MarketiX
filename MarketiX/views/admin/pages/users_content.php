<?php
/**
 * Users Content View (Admin)
 *
 * Expected variables:
 * @var array  $users
 * @var string $statusFilter
 * @var string $roleFilter
 */

// Safety guards
$users        ??= [];
$statusFilter ??= 'all';
$roleFilter   ??= 'all';
?>

<h3 class="fw-bold mb-3">Users Management</h3>

<!-- Filters -->
<form method="GET" class="row g-3 mb-4">
  <div class="col-md-3">
    <select name="status" class="form-select">
      <option value="all">All Status</option>
      <option value="active" <?= $statusFilter==='active'?'selected':'' ?>>Active</option>
      <option value="blocked" <?= $statusFilter==='blocked'?'selected':'' ?>>Blocked</option>
    </select>
  </div>

  <div class="col-md-3">
    <select name="role" class="form-select">
      <option value="all">All Roles</option>
      <option value="user" <?= $roleFilter==='user'?'selected':'' ?>>User</option>
      <option value="seller" <?= $roleFilter==='seller'?'selected':'' ?>>Seller</option>
      <option value="admin" <?= $roleFilter==='admin'?'selected':'' ?>>Admin</option>
    </select>
  </div>

  <div class="col-md-2">
    <button class="btn btn-dark w-100">Filter</button>
  </div>
</form>

<!-- Table -->
<div class="card-custom p-4">

<?php if (empty($users)): ?>

  <div class="alert alert-info mb-0">
    No users found.
  </div>

<?php else: ?>

  <table class="table align-middle">
    <thead class="table-light">
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Status</th>
        <th class="text-end">Actions</th>
      </tr>
    </thead>
    <tbody>

    <?php foreach ($users as $u):
      $status = $u['user_status'] ?? 'blocked';
    ?>
      <tr>
        <td><strong><?= htmlspecialchars($u['user_name']) ?></strong></td>
        <td><?= htmlspecialchars($u['user_email']) ?></td>
        <td><?= ucfirst($u['user_role']) ?></td>

        <td>
          <?php if ($status === 'active'): ?>
            <span class="badge bg-success">Active</span>
          <?php else: ?>
            <span class="badge bg-danger">Blocked</span>
          <?php endif; ?>
        </td>

        <td class="text-end">
          <?php if ($u['user_role'] !== 'admin'): ?>

            <!-- Toggle Status -->
            <a href="actions/user_action.php?id=<?= (int)$u['user_id'] ?>&action=toggle_status"
               class="btn btn-sm <?= $status==='active'?'btn-warning':'btn-success' ?>">
              <?= $status==='active'?'Block':'Activate' ?>
            </a>

            <!-- Toggle Role -->
            <a href="actions/user_action.php?id=<?= (int)$u['user_id'] ?>&action=toggle_role"
               class="btn btn-sm btn-outline-primary ms-1">
              <?= $u['user_role']==='seller'
                  ? 'Make User'
                  : 'Make Seller' ?>
            </a>

          <?php else: ?>
            <span class="text-muted small">Protected</span>
          <?php endif; ?>
        </td>
      </tr>
    <?php endforeach; ?>

    </tbody>
  </table>

<?php endif; ?>

</div>
