<?php include ROOT_PATH . '/views/layouts/header.php'; ?>

<style>
/* ===============================
   ORDER DETAILS – FINAL DESIGN
================================ */
.order-wrapper {
  max-width: 900px;
  margin: auto;
}

.order-box {
  background: #fff;
  border-radius: 20px;
  padding: 24px;
  border: 1px solid #e5e7eb;
  margin-bottom: 24px;
}

.order-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.order-title {
  font-size: 22px;
  font-weight: 900;
}

.order-meta {
  margin-top: 10px;
  color: #6b7280;
  font-size: 14px;
}

.status {
  padding: 6px 16px;
  border-radius: 20px;
  font-size: 13px;
  font-weight: 700;
}

.status-pending { background:#fef3c7; color:#92400e; }
.status-completed { background:#dcfce7; color:#166534; }
.status-cancelled { background:#fee2e2; color:#991b1b; }

/* Items */
.items-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 16px;
}

.items-table th,
.items-table td {
  padding: 14px;
  border-bottom: 1px solid #e5e7eb;
}

.items-table th {
  font-size: 14px;
  color: #6b7280;
}

.total-row {
  text-align: right;
  font-size: 20px;
  font-weight: 900;
  color: #16a34a;
  padding-top: 16px;
}

.back-btn {
  display: inline-block;
  margin-top: 16px;
  text-decoration: none;
  padding: 10px 18px;
  border-radius: 14px;
  background: #f3f4f6;
  color: #111827;
  font-weight: 600;
}

.back-btn:hover {
  background: #e5e7eb;
}
</style>

<div class="container py-5">
  <div class="order-wrapper">

    <!-- Order Summary -->
    <div class="order-box">
      <div class="order-header">
        <div class="order-title">Order #<?= $order['order_id'] ?></div>

        <?php
        $statusClass = match ($order['order_status']) {
            'pending'   => 'status-pending',
            'completed' => 'status-completed',
            'cancelled' => 'status-cancelled',
            default     => 'status-pending'
        };
        ?>

        <span class="status <?= $statusClass ?>">
          <?= ucfirst($order['order_status']) ?>
        </span>
      </div>

      <div class="order-meta">
        📅 <?= date('d M Y, h:i A', strtotime($order['created_at'])) ?>
      </div>
    </div>

    <!-- Order Items -->
    <div class="order-box">
      <h5 class="fw-bold mb-3">🛒 Order Items</h5>

      <table class="items-table">
        <thead>
          <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Subtotal</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($items as $item): ?>
            <tr>
              <td><?= htmlspecialchars($item['product_name']) ?></td>
              <td>$<?= number_format($item['product_price'], 2) ?></td>
              <td><?= $item['quantity'] ?></td>
              <td>
                $<?= number_format($item['product_price'] * $item['quantity'], 2) ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <div class="total-row">
        Total: $<?= number_format($order['order_total'], 2) ?>
      </div>
    </div>

    <a href="<?= BASE_URL ?>/public/my_orders.php" class="back-btn">
      ← Back to My Orders
    </a>

  </div>
</div>

<?php include ROOT_PATH . '/views/layouts/footer.php'; ?>

