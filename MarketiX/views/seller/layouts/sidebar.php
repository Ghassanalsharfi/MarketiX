

<?php
$storeInactive = false;

if (isset($_SESSION['user_id'])) {

    $stmt = $pdo->prepare("
        SELECT st.store_status
        FROM stores st
        INNER JOIN sellers se ON st.seller_id = se.seller_id
        WHERE se.user_id = ?
        LIMIT 1
    ");
    $stmt->execute([$_SESSION['user_id']]);
    $status = $stmt->fetchColumn();
   

    if ($status === false) {
        $storeInactive = true;
    } else {
        $storeInactive = (trim(strtolower($status)) !== 'active');
    }
}
?>
<style>
  .link-disabled {
  pointer-events: none;
  opacity: 0.45;
  cursor: not-allowed;
}

</style>
<aside class="sidebar">
  <h5>Seller Panel</h5>

 <a href="<?= BASE_URL ?>/views/seller/dashboard.php"
     class="nav-link d-flex align-items-center gap-2">
    <i class="bi bi-speedometer2"></i>
    Dashboard
  </a>

  <a href="<?= BASE_URL ?>/views/seller/store.php"
     class="nav-link d-flex align-items-center gap-2">
    <i class="bi bi-shop"></i>
    My Store
  </a>

  <a href="<?= BASE_URL ?>/views/seller/products.php"
     class="nav-link d-flex align-items-center gap-2 <?= $storeInactive ? 'link-disabled' : '' ?>">
    <i class="bi bi-box-seam"></i>
    My Products
  </a>

  <a href="<?= BASE_URL ?>/views/seller/add_product.php"
     class="nav-link d-flex align-items-center gap-2 <?= $storeInactive ? 'link-disabled' : '' ?>">
    <i class="bi bi-plus-square"></i>
    Add Product
  </a>

  <a href="<?= BASE_URL ?>/views/seller/orders.php"
     class="nav-link d-flex align-items-center gap-2 <?= $storeInactive ? 'link-disabled' : '' ?>">
    <i class="bi bi-receipt"></i>
    Orders
  </a>

  <hr>

  <a href="<?= BASE_URL ?>/public/profile.php"
     class="nav-link d-flex align-items-center gap-2">
    <i class="bi bi-person-circle"></i>
    Profile
  </a>

  <a href="<?= BASE_URL ?>/public/logout.php"
     class="nav-link d-flex align-items-center gap-2 text-danger">
    <i class="bi bi-box-arrow-right"></i>
    Logout
  </a>

</aside>
