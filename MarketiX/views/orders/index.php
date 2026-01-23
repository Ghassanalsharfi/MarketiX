<?php include ROOT_PATH . '/views/layouts/header.php'; ?>
<style>
/* ===============================
   MY ORDERS – FINAL DESIGN
================================ */
.orders-title {
  font-weight: 900;
  margin-bottom: 24px;
}

.orders-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 24px;
}

.order-card {
  background: #ffffff;
  border-radius: 18px;
  padding: 20px;
  border: 1px solid #e5e7eb;
  transition: .25s ease;
}

.order-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 14px 35px rgba(0,0,0,.08);
}

.order-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 10px;
}

.order-id {
  font-weight: 800;
}

.order-date {
  font-size: 14px;
  color: #6b7280;
  margin-bottom: 14px;
}

.order-total {
  font-size: 18px;
  font-weight: 800;
  color: #16a34a;
}

/* Status */
.status {
  padding: 6px 14px;
  border-radius: 20px;
  font-size: 13px;
  font-weight: 700;
}

.status-pending {
  background: #fef3c7;
  color: #92400e;
}

.status-completed {
  background: #dcfce7;
  color: #166534;
}

.status-cancelled {
  background: #fee2e2;
  color: #991b1b;
}

.order-actions {
  margin-top: 16px;
}

.order-actions a {
  display: block;
  text-align: center;
  padding: 10px 0;
  border-radius: 12px;
  font-size: 14px;
  font-weight: 600;
  text-decoration: none;
  background: #f3f4f6;
  color: #111827;
}

.order-actions a:hover {
  background: #e5e7eb;
}
</style>

<div class="container py-5">

  <h2 class="orders-title">📦 My Orders</h2>

  <?php if (empty($orders)): ?>
    <div class="alert alert-info text-center rounded-4">
      You haven’t placed any orders yet.
    </div>
  <?php else: ?>

    <div class="orders-grid">

      <?php foreach ($orders as $order): ?>

        <?php
        $statusClass = match ($order['order_status']) {
          'pending'   => 'status-pending',
          'completed' => 'status-completed',
          'cancelled' => 'status-cancelled',
          default     => 'status-pending'
        };
        ?>

        <div class="order-card">

          <div class="order-header">
            <div class="order-id">Order #<?= $order['order_id'] ?></div>
            <span class="status <?= $statusClass ?>">
              <?= ucfirst($order['order_status']) ?>
            </span>
          </div>

          <div class="order-date">
            📅 <?= date('d M Y, h:i A', strtotime($order['created_at'])) ?>
          </div>

          <div class="order-total">
            $<?= number_format($order['order_total'], 2) ?>
          </div>

          <div class="order-actions">
            <a href="order_details.php?id=<?= $order['order_id'] ?>">
              View Details
            </a>
          </div>

        </div>

      <?php endforeach; ?>

    </div>

  <?php endif; ?>

</div>

<?php include ROOT_PATH . '/views/layouts/footer.php'; ?>
