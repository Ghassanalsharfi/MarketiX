<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/MarketiX/app/bootstrap.php';

$isDashboard = str_starts_with(
  trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'),
  'views/'
);

$userName = $_SESSION['user_name'] ?? null;
$userRole = $_SESSION['user_role'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>MarketiX</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">

<!-- Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
/* ===============================
   ROOT
================================ */
:root {
  --mx-green:#22c55e;
  --mx-blue:#3b82f6;
  --mx-dark:#0f172a;
  --mx-bg:#f8fafc;
  --mx-border:#e5e7eb;
  --mx-text:#0f172a;
  --navbar-height:78px;
}

/* ===============================
   GLOBAL
================================ */
body {
  font-family:'Inter',sans-serif;
  background:var(--mx-bg);
  color:var(--mx-text);
  padding-top:var(--navbar-height);
}

/* ===============================
   BRAND
================================ */
.brand-logo {
  font-weight:900;
  font-size:22px;
  text-decoration:none;
  color:var(--mx-green);
}
.brand-logo .x { color:var(--mx-blue); }

/* ===============================
   NAVBAR
================================ */
.main-navbar {
  position:fixed;
  top:0;
  left:0;
  width:100%;
  height:var(--navbar-height);
  z-index:1000;
  background:#fff;
  border-bottom:1px solid var(--mx-border);
  display:flex;
  align-items:center;
}

/* ===============================
   NAV LINKS
================================ */
.nav-link {
  font-weight:600;
  font-size:14px;
  color:var(--mx-text);
}
.nav-link:hover { color:var(--mx-green); }

/* ===============================
   BUTTON SYSTEM
================================ */
.navbar .btn {
  border-radius:999px;
  font-size:13px;
  font-weight:700;
  padding:7px 18px;
  white-space:nowrap;
}

.btn-mx-outline {
  border:1.5px solid var(--mx-border);
  background:#fff;
  color:var(--mx-text);
}
.btn-mx-outline:hover {
  background:var(--mx-bg);
  color:var(--mx-green);
  border-color:var(--mx-green);
}

.btn-mx-primary {
  background:linear-gradient(135deg,var(--mx-blue),var(--mx-green));
  border:none;
  color:#fff!important;
}
.btn-mx-primary:hover { opacity:.9; }

.btn-mx-danger {
  background:#ef4444;
  border:none;
  color:#fff!important;
}
.btn-mx-danger:hover { background:#dc2626; }

/* ===============================
   OFFCANVAS
================================ */
.offcanvas .btn {
  width:100%;
  text-align:left;
}

.btn.active {
  background: var(--mx-bg);
  border-color: var(--mx-green);
  color: var(--mx-green);
}
.offcanvas .btn {
  border-radius: 12px;
  padding: 12px 14px;
  font-weight: 600;
}

.offcanvas .btn i {
  width: 18px;
  text-align: center;
}

</style>
</head>

<body>

<?php if (!$isDashboard): ?>

<!-- ===============================
   PUBLIC NAVBAR
================================ -->
<nav class="navbar navbar-expand-lg main-navbar px-3">

  <a class="brand-logo" href="<?= BASE_URL ?>/public/index.php">
    Market<span class="x">iX</span>
  </a>

  <!-- Mobile Toggle -->
  <button class="btn btn-outline-secondary d-lg-none ms-auto"
          data-bs-toggle="offcanvas"
          data-bs-target="#mobileMenu">
    <i class="fa-solid fa-bars"></i>
  </button>

  <!-- Desktop Menu -->
  <div class="collapse navbar-collapse d-none d-lg-flex">
    <ul class="navbar-nav ms-auto align-items-center gap-3">

      <li class="nav-item">
        <a class="nav-link" href="<?= BASE_URL ?>/public/products.php">Marketplace</a>
      </li>

      <?php if ($userName): ?>

        <li class="nav-item text-muted small fw-semibold">
          <i class="fa-regular fa-user me-1"></i><?= htmlspecialchars($userName) ?>
        </li>

           
           <li class="nav-item">
                <a class="nav-link nav-icon" href="<?= BASE_URL ?>/public/cart.php">
                  <i class="fa-solid fa-cart-shopping"></i>
                </a>
              </li>

        <li class="nav-item">
          <a class="nav-link" href="<?= BASE_URL ?>/public/my_orders.php">My Orders</a>
        </li>

        <?php if ($userRole === 'seller'): ?>
          <li class="nav-item">
            <a class="btn btn-mx-outline" href="<?= BASE_URL ?>/views/seller/dashboard.php">
              Seller Panel
            </a>
          </li>
        <?php endif; ?>

        <?php if ($userRole === 'admin'): ?>
          <li class="nav-item">
            <a class="btn btn-mx-outline" href="<?= BASE_URL ?>/views/admin/dashboard.php">
              Admin Panel
            </a>
          </li>
        <?php endif; ?>

        <li class="nav-item">
          <a class="nav-link" href="<?= BASE_URL ?>/public/profile.php">
            <i class="fa-solid fa-user"></i> Profile
          </a>
        </li>

        <li class="nav-item">
          <a class="btn btn-mx-primary" href="<?= BASE_URL ?>/public/contact.php">
            Contact
          </a>
        </li>

        <li class="nav-item">
          <a class="btn btn-mx-danger" href="<?= BASE_URL ?>/public/logout.php">
            Logout
          </a>
        </li>

      <?php else: ?>

        <li class="nav-item">
          <a class="btn btn-mx-primary" href="<?= BASE_URL ?>/public/login.php">
            Login
          </a>
        </li>

      <?php endif; ?>

    </ul>
  </div>
</nav>

<!-- ===============================
   MOBILE OFFCANVAS
================================ -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="mobileMenu">
  <div class="offcanvas-header border-bottom">
    <h5 class="fw-bold mb-0">MarketiX</h5>
    <button class="btn-close" data-bs-dismiss="offcanvas"></button>
  </div>

  <div class="offcanvas-body d-flex flex-column gap-2">

    <!-- Marketplace -->
    <a href="<?= BASE_URL ?>/public/products.php"
       class="btn btn-mx-outline text-start">
      <i class="fa-solid fa-store me-2"></i>
      Marketplace
    </a>

    <?php if ($userName): ?>

           
           <li class="nav-item">
                <a class="nav-link nav-icon" href="<?= BASE_URL ?>/public/cart.php">
                  <i class="fa-solid fa-cart-shopping"></i>
                </a>
              </li>

      <!-- My Orders -->
      <a href="<?= BASE_URL ?>/public/my_orders.php"
         class="btn btn-mx-outline text-start">
        <i class="fa-solid fa-box me-2"></i>
        My Orders
      </a>

      <!-- Seller Panel -->
      <?php if ($userRole === 'seller'): ?>
        <a href="<?= BASE_URL ?>/views/seller/dashboard.php"
           class="btn btn-mx-outline text-start">
          <i class="fa-solid fa-gauge-high me-2"></i>
          Seller Panel
        </a>
      <?php endif; ?>

      <!-- Admin Panel -->
      <?php if ($userRole === 'admin'): ?>
        <a href="<?= BASE_URL ?>/views/admin/dashboard.php"
           class="btn btn-mx-outline text-start">
          <i class="fa-solid fa-shield-halved me-2"></i>
          Admin Panel
        </a>
      <?php endif; ?>

      <!-- Profile -->
      <a href="<?= BASE_URL ?>/public/profile.php"
         class="btn btn-mx-outline text-start">
        <i class="fa-solid fa-user me-2"></i>
        Profile
      </a>

      <!-- Contact -->
      <a href="<?= BASE_URL ?>/public/contact.php"
         class="btn btn-mx-primary text-start">
        <i class="fa-solid fa-headset me-2"></i>
        Contact
      </a>

      <!-- Logout -->
      <a href="<?= BASE_URL ?>/public/logout.php"
         class="btn btn-mx-danger text-start">
        <i class="fa-solid fa-right-from-bracket me-2"></i>
        Logout
      </a>

    <?php else: ?>

      <!-- Login -->
      <a href="<?= BASE_URL ?>/public/login.php"
         class="btn btn-mx-primary text-start">
        <i class="fa-solid fa-right-to-bracket me-2"></i>
        Login
      </a>

    <?php endif; ?>

  </div>
</div>
<?php endif; ?>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


           
           
           
           