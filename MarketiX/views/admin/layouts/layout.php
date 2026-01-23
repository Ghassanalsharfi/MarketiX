<?php
/**
 * Admin Dashboard Layout
 * مسؤول عن الشكل فقط
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $pageTitle ?? 'Admin Dashboard' ?> | MarketiX</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"
 href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
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

<body style="background:#f8fafc">

<div class="dashboard-wrapper" style="display:flex;min-height:100vh">

  <!-- Sidebar -->
  <?php require __DIR__ . '/sidebar.php'; ?>

  <!-- Content -->
  <main class="dashboard-content" style="flex:1;padding:32px">

    <?php
    if (isset($content) && file_exists($content)) {
        require $content;
    }
    ?>
<div class="dashboard-footer">
  <div class="footer-brand">
    <span>Marketi</span><span>X</span>
  </div>

  <div>
© <?= date('Y') ?> MarketiX — Admin Panel
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
