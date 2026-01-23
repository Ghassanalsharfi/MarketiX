<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h3 class="fw-bold mb-1">Welcome Admin 👋</h3>
    <p class="text-muted mb-0">Platform overview & financial summary</p>
  </div>
</div>

<!-- ===== Stats ===== -->
<div class="row g-4 mb-4">

  <div class="col-6 col-md-3">
    <div class="stat-card">
      <p class="text-muted small mb-1">Users</p>
      <h2 class="fw-bold mb-0"><?= $totalUsers ?></h2>
    </div>
  </div>

  <div class="col-6 col-md-3">
    <div class="stat-card">
      <p class="text-muted small mb-1">Sellers</p>
      <h2 class="fw-bold mb-0"><?= $totalSellers ?></h2>
    </div>
  </div>

  <div class="col-6 col-md-3">
    <div class="stat-card">
      <p class="text-muted small mb-1">Stores</p>
      <h2 class="fw-bold mb-0"><?= $totalStores ?></h2>
    </div>
  </div>

  <div class="col-6 col-md-3">
    <div class="stat-card">
      <p class="text-muted small mb-1">Completed Orders</p>
      <h2 class="fw-bold mb-0"><?= $totalOrders ?></h2>
    </div>
  </div>

</div>

<!-- ===== Financial ===== -->
<div class="row g-4 mb-4">

  <div class="col-md-6">
    <div class="stat-card">
      <p class="text-muted small mb-1">Total Platform Sales</p>
      <h2 class="fw-bold mb-0">
        $<?= number_format($totalSales, 2) ?>
      </h2>
      <small class="text-muted">Completed orders only</small>
    </div>
  </div>

  <div class="col-md-6">
    <div class="stat-card">
      <p class="text-muted small mb-1">
        Platform Profit (<?= $commissionRate * 100 ?>%)
      </p>
      <h2 class="fw-bold mb-0 text-success">
        $<?= number_format($platformProfit, 2) ?>
      </h2>
    </div>
  </div>

</div>

<!-- ===== Quick Actions ===== -->
<div class="card-custom p-4">
  <h5 class="fw-bold mb-3">Quick Management</h5>
  <div class="d-flex flex-wrap gap-3">
    <a href="users.php" class="btn btn-outline-dark">Manage Users</a>
    <a href="sellers.php" class="btn btn-outline-dark">Manage Sellers</a>
    <a href="stores.php" class="btn btn-outline-dark">Manage Stores</a>
    <a href="orders.php" class="btn btn-outline-dark">View Orders</a>
  </div>
</div>
