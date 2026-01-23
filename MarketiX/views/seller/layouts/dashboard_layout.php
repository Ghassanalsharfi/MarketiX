<?php
/**
 * Seller Dashboard Layout
 * مسؤول عن الشكل فقط (Header + Sidebar + Content + Footer)
 * ❌ لا منطق صلاحيات
 * ❌ لا رسائل حالة متجر
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Seller Dashboard | MarketiX</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"
 href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    :root {
    --mx-green:  #22c55e;
  --mx-blue:   #3b82f6;
  --mx-dark:   #0f172a;
  --mx-dark-2: #111827;
  --mx-border: #1f2937;
  --mx-text:   #e5e7eb;
  --mx-muted:  #9ca3af;
    }
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



    .dashboard-wrapper {
      display: flex;
      min-height: 100vh;
    }

    /* ===== Sidebar ===== */
    /* =
    /* ===== Header ===== */
    .dashboard-header {
      border-bottom: 1px solid var(--mx-border);
      padding: 16px 24px;
      font-weight: 800;
      font-size: 16px;
    }

    /* ===== Content ===== */
    .dashboard-content {
      flex: 1;
      padding: 32px;
    }

    /* ===== Footer ===== */
    .dashboard-footer {
      margin-top: 48px;
      text-align: center;
      font-size: 13px;
      color: var(--mx-muted);
    }

    /* ===== Mobile ===== */
    @media (max-width: 768px) {
      .dashboard-wrapper {
        flex-direction: column;
      }

      .sidebar {
        width: 100%;
        border-right: 0;
        border-bottom: 1px solid var(--mx-border);
      }

      .dashboard-content {
        padding: 20px;
      }
    }
    /* ===============================
   Dashboard Footer (Admin + Seller)
================================ */
.dashboard-footer {
  margin-top: 48px;
  padding: 18px 24px;
  border-top: 1px solid var(--mx-border);
  display: flex;
  align-items: center;
  justify-content: space-between;
  font-size: 13px;
  color: var(--mx-muted);
  background: #ffffff;
}

/* Brand */
.dashboard-footer .footer-brand {
  font-weight: 700;
  color: var(--mx-text);
}

.dashboard-footer .footer-brand span:first-child {
  color: var(--mx-green);
}

.dashboard-footer .footer-brand span:last-child {
  color: var(--mx-blue);
}

/* Links */
.dashboard-footer .footer-links a {
  margin-left: 16px;
  text-decoration: none;
  color: var(--mx-muted);
  transition: color .2s;
}

.dashboard-footer .footer-links a:hover {
  color: var(--mx-blue);
}

/* Mobile */
@media (max-width: 768px) {
  .dashboard-footer {
    flex-direction: column;
    gap: 10px;
    text-align: center;
  }

  .dashboard-footer .footer-links a {
    margin: 0 8px;
  }
}
/* ===== Social Icons ===== */
.dashboard-footer .footer-links a {
  margin-left: 12px;
  font-size: 15px;
  color: var(--mx-muted);
  transition: color .25s, transform .25s;
}

.dashboard-footer .footer-links a:hover {
  color: var(--mx-blue);
  transform: translateY(-2px);
}

/* WhatsApp لون خاص */
.dashboard-footer .footer-links a:hover .fa-whatsapp {
  color: var(--mx-green);
}

  </style>
</head>
<?php
/**
 * Store status resolver (Layout-level)
 * Single source of truth for store state
 */

$storeStatus   = 'active';
$storeBlocked  = false;
$storeInactive = false;

if (isset($_SESSION['user_id'])) {

    $stmt = $pdo->prepare("
        SELECT st.store_status
        FROM stores st
        JOIN sellers se ON st.seller_id = se.seller_id
        WHERE se.user_id = ?
        LIMIT 1
    ");
    $stmt->execute([$_SESSION['user_id']]);
    $status = $stmt->fetchColumn();

    if ($status !== false) {
        $storeStatus = trim(strtolower($status));
    }

    $storeBlocked  = ($storeStatus === 'blocked');
    $storeInactive = ($storeStatus === 'inactive' || $storeStatus === 'blocked');
}
?>

<body>

<?php if ($storeBlocked): ?>
  <div class="alert alert-danger rounded-4 mb-4">
    🚫 Your store is <strong>blocked</strong>.
    Please contact support to restore access.
  </div>
<?php elseif ($storeStatus === 'inactive'): ?>
  <div class="alert alert-warning rounded-4 mb-4">
    ⚠ Your store is inactive. Some actions are disabled.
  </div>
<?php endif; ?>


<div class="dashboard-wrapper">

  <!-- ===== Sidebar ===== -->
  <?php

  include __DIR__ . '/sidebar.php'; ?>

  <!-- ===== Main Content ===== -->
  <main class="dashboard-content">

    <?= $content ?? '' ?>

   <<div class="dashboard-footer">
  <div class="footer-brand">
    <span>Marketi</span><span>X</span>
  </div>

  <div>
    © <?= date('Y') ?> MarketiX — Seller Panel
  </div>

  <div class="footer-links">
    <a href="https://facebook.com" target="_blank" title="Facebook">
      <i class="fa-brands fa-facebook-f"></i>
    </a>

    <a href="https://instagram.com" target="_blank" title="Instagram">
      <i class="fa-brands fa-instagram"></i>
    </a>

    <a href="https://twitter.com" target="_blank" title="X (Twitter)">
      <i class="fa-brands fa-x-twitter"></i>
    </a>

    <a href="https://wa.me/967700000000" target="_blank" title="WhatsApp">
      <i class="fa-brands fa-whatsapp"></i>
    </a>
  </div>
</div>


  </main>

</div>



</body>
</html>
