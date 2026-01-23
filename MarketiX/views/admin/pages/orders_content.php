<?php
/**
 * Orders Content View (Admin)
 *
 * Pure View file.
 * Expected variables:
 *
 * @var array  $orders
 * @var array  $stores
 * @var int    $storeFilter
 * @var array  $stats  ['totalOrders','totalSales','platformProfit','storeRevenue']
 */

// Safety guards
$orders      ??= [];
$stores      ??= [];
$storeFilter ??= 0;
$stats       ??= [
    'totalOrders'    => 0,
    'totalSales'     => 0,
    'platformProfit' => 0,
    'storeRevenue'   => 0
];

$totalOrders    = $stats['totalOrders'];
$totalSales     = $stats['totalSales'];
$platformProfit = $stats['platformProfit'];
$storeRevenue   = $stats['storeRevenue'];
?>

<h3 class="fw-bold mb-4">Orders Management</h3>

<!-- ===============================
     Filter
================================ -->
<form method="GET" class="mb-4 d-flex gap-3 align-items-center">
  <label class="fw-bold">Filter by Store:</label>

  <select name="store_id"
          class="form-select"
          style="max-width:300px"
          onchange="this.form.submit()">
    <option value="0">All Stores</option>

    <?php foreach ($stores as $store): ?>
      <option value="<?= (int)$store['store_id'] ?>"
        <?= $storeFilter === (int)$store['store_id'] ? 'selected' : '' ?>>
        <?= htmlspecialchars($store['store_name']) ?>
      </option>
    <?php endforeach; ?>

  </select>
</form>

<!-- ===============================
     Stats
================================ -->
<div class="row g-4 mb-4">

  <div class="col-md-3">
    <div class="stat-card">
      <p class="text-muted small mb-1">Completed Orders</p>
      <h2 class="fw-bold mb-0"><?= (int)$totalOrders ?></h2>
    </div>
  </div>

  <div class="col-md-3">
    <div class="stat-card">
      <p class="text-muted small mb-1">Total Sales</p>
      <h2 class="fw-bold mb-0">$<?= number_format((float)$totalSales, 2) ?></h2>
    </div>
  </div>

  <div class="col-md-3">
    <div class="stat-card">
      <p class="text-muted small mb-1">Platform Profit</p>
      <h2 class="fw-bold mb-0 text-success">
        $<?= number_format((float)$platformProfit, 2) ?>
      </h2>
    </div>
  </div>

  <div class="col-md-3">
    <div class="stat-card">
      <p class="text-muted small mb-1">Store Revenue</p>
      <h2 class="fw-bold mb-0 text-primary">
        $<?= number_format((float)$storeRevenue, 2) ?>
      </h2>
    </div>
  </div>

</div>

<!-- ===============================
     Orders Table
================================ -->
<div class="card p-4 shadow-sm rounded-4">

<?php if (empty($orders)): ?>

  <div class="alert alert-info mb-0">
    No orders found for the selected filter.
  </div>

<?php else: ?>

  <table class="table align-middle">
    <thead class="table-light">
      <tr>
        <th>#</th>
        <th>Customer</th>
        <th>Store</th>
        <th>Seller</th>
        <th>Total</th>
        <th>Status</th>
        <th>Date</th>
      </tr>
    </thead>

    <tbody>
    <?php foreach ($orders as $o): ?>

      <?php
        $statusClass = match ($o['order_status']) {
          'pending'   => 'warning',
          'completed' => 'success',
          'cancelled' => 'danger',
          default     => 'secondary'
        };
      ?>

      <tr>
        <td>#<?= (int)$o['order_id'] ?></td>

        <td>
          <strong><?= htmlspecialchars($o['customer_name']) ?></strong><br>
          <small class="text-muted"><?= htmlspecialchars($o['customer_email']) ?></small>
        </td>

        <td><?= htmlspecialchars($o['store_name']) ?></td>
        <td><?= htmlspecialchars($o['seller_name']) ?></td>

        <td class="fw-bold">
          $<?= number_format((float)$o['order_total'], 2) ?>
        </td>

        <td>
          <span class="badge bg-<?= $statusClass ?>">
            <?= ucfirst($o['order_status']) ?>
          </span>
        </td>

        <td>
          <?= date('Y-m-d H:i', strtotime($o['created_at'])) ?>
        </td>
      </tr>

    <?php endforeach; ?>
    </tbody>
  </table>

<?php endif; ?>

</div>
