<style>
  :root {
    --mx-green: #22c55e;
    --mx-blue: #3b82f6;
    --mx-dark: #0f172a;
    --mx-dark-2: #111827;
    --mx-border: #1f2937;
    --mx-text: #e5e7eb;
    --mx-muted: #9ca3af;
  }

  /* ===== Sidebar ===== */
  .sidebar {
    width: 260px;
    background: var(--mx-dark);
    color: #fff;
    padding: 20px 15px;
  }

  .sidebar h5 {
    color: #fff;
    font-weight: 700;
    margin-bottom: 20px;
  }

  .sidebar a {
    color: var(--mx-text);
    text-decoration: none;
    display: flex;
    align-items: center;
    padding: 10px 14px;
    border-radius: 10px;
    margin-bottom: 6px;
    transition: background .25s, color .25s;
  }

  .sidebar a i {
    margin-right: 12px;
    width: 20px;
    color: var(--mx-muted);
  }

  /* Hover */
  .sidebar a:hover {
    background: var(--mx-dark-2);
    color: #fff;
  }

  .sidebar a:hover i {
    color: var(--mx-green);
  }

  /* Active */
  .sidebar a.active {
    background: linear-gradient(135deg, var(--mx-blue), var(--mx-green));
    color: #fff;
    font-weight: 600;
  }

  .sidebar a.active i {
    color: #fff;
  }

  .sidebar .section {
    margin-top: 25px;
    font-size: 11px;
    color: var(--mx-muted);
    text-transform: uppercase;
    padding-left: 10px;
    letter-spacing: .08em;
  }

  /* ===== Mobile Layout Fix (Admin) ===== */
  @media (max-width: 768px) {

    .dashboard-wrapper {
      flex-direction: column;
    }

    .sidebar {
      width: 100% !important;
      border-right: none;
      border-bottom: 1px solid var(--mx-border);
    }

    .dashboard-content {
      width: 100%;
      padding: 15px;
    }
  }
</style>

<div class="sidebar">
  <h5>Admin Panel</h5>

  <a href="dashboard.php" class="active">
    <i class="fa-solid fa-chart-line"></i> Dashboard
  </a>

  <a href="users.php">
    <i class="fa-solid fa-users"></i> Users
  </a>

  <a href="sellers.php">
    <i class="fa-solid fa-users"></i> Sellers
  </a>

  <a href="stores.php">
    <i class="fa-solid fa-store"></i> Stores
  </a>

  <a href="Products.php">
    <i class="fa-solid fa-box"></i> Products
  </a>

  <a href="orders.php">
    <i class="fa-solid fa-cart-shopping"></i> Orders
  </a>
    <a href="<?= BASE_URL ?>/public/profile.php" class="nav-link">
  <i class="fa-solid fa-user"></i> Profile
</a>

  <a href="<?= BASE_URL ?>/public/logout.php">
    <i class="fa-solid fa-right-from-bracket"></i> Logout
  </a>
</div>