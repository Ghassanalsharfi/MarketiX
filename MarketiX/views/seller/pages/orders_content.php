<?php
/**
 * Orders View (Seller)
 *
 * @var array $orders
 * @var array $totals
 * @var float $commissionRate
 */
?>

<h4 class="fw-bold mb-4">📦 Orders</h4>

<!-- Totals -->
<div class="row g-3 mb-4">
  <div class="col-md-4">
    <div class="stat-card">
      <p class="text-muted mb-1">Gross Revenue</p>
      <h4 class="fw-bold">
        $<?= number_format($totals['gross'], 2) ?>
      </h4>
    </div>
  </div>

  <div class="col-md-4">
    <div class="stat-card">
      <p class="text-muted mb-1">
        Platform Fee (<?= $commissionRate * 100 ?>%)
      </p>
      <h4 class="fw-bold text-danger">
        - $<?= number_format($totals['commission'], 2) ?>
      </h4>
    </div>
  </div>

  <div class="col-md-4">
    <div class="stat-card">
      <p class="text-muted mb-1">Net Earnings</p>
      <h4 class="fw-bold text-success">
        $<?= number_format($totals['net'], 2) ?>
      </h4>
    </div>
  </div>
</div>

<div class="card shadow-sm rounded-4 p-4">

<?php if (empty($orders)): ?>
  <p class="text-muted mb-0">No orders yet.</p>
<?php else: ?>

<table class="table align-middle mb-0">
  <thead>
    <tr>
      <th>#</th>
      <th>Product</th>
      <th>Qty</th>
      <th>Gross</th>
      <th>Fee</th>
      <th>Net</th>
      <th>Status</th>
      <th class="text-end">Action</th>
    </tr>
  </thead>
  <tbody>

<?php foreach ($orders as $order): ?>

<?php
  $commission = $order['gross_amount'] * $commissionRate;
  $netAmount  = $order['gross_amount'] - $commission;

  $statusClass = match ($order['order_status']) {
      'pending'   => 'warning',
      'paid'      => 'success',
      'completed' => 'primary',
      'cancelled' => 'danger',
      default     => 'secondary'
  };
?>

<tr>
  <td>#<?= (int)$order['order_id'] ?></td>
  <td><?= htmlspecialchars($order['product_name']) ?></td>
  <td><?= (int)$order['quantity'] ?></td>
  <td>$<?= number_format($order['gross_amount'], 2) ?></td>
  <td class="text-danger">
    - $<?= number_format($commission, 2) ?>
  </td>
  <td class="text-success fw-bold">
    $<?= number_format($netAmount, 2) ?>
  </td>
  <td>
    <span class="badge bg-<?= $statusClass ?>">
      <?= ucfirst($order['order_status']) ?>
    </span>
  </td>
  <td class="text-end">

<?php if ($order['order_status'] === 'pending'): ?>

<form method="POST" action="orders.php" class="d-inline">
  <input type="hidden" name="order_id" value="<?= (int)$order['order_id'] ?>">
  <button
    type="submit"
    name="action"
    value="confirm"
    class="btn btn-sm btn-success"
  >
    Confirm
  </button>
</form>

<form method="POST" action="orders.php" class="d-inline">
  <input type="hidden" name="order_id" value="<?= (int)$order['order_id'] ?>">
  <button
    type="submit"
    name="action"
    value="cancel"
    class="btn btn-sm btn-danger"
  >
    Cancel
  </button>
</form>

<?php elseif ($order['order_status'] === 'paid'): ?>

<form method="POST" action="orders.php" class="d-inline">
  <input type="hidden" name="order_id" value="<?= (int)$order['order_id'] ?>">
  <button
    type="submit"
    name="action"
    value="complete"
    class="btn btn-sm btn-primary"
  >
    Complete
  </button>
</form>

<?php else: ?>
  —
<?php endif; ?>

  </td>
</tr>

<?php endforeach; ?>

  </tbody>
</table>

<?php endif; ?>

</div>
