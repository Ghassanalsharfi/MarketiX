<!-- 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $pageTitle ?? 'Admin Dashboard' ?> | MarketiX</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: #f8fafc;
      margin: 0;
      font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    .dashboard-wrapper {
      display: flex;
      min-height: 100vh;
    }

    /* ===== Sidebar ===== */
    .sidebar {
      width: 260px;
      background: #0f172a;
      color: #fff;
      padding: 24px;
    }

    .sidebar h5 {
      font-weight: 800;
      margin-bottom: 24px;
    }

    .sidebar a {
      display: block;
      padding: 10px 14px;
      border-radius: 12px;
      color: #e5e7eb;
      text-decoration: none;
      margin-bottom: 8px;
      font-weight: 500;
    }

    .sidebar a:hover {
      background: #1e293b;
    }

    .sidebar a.active {
      background: #2563eb;
      color: #fff;
      font-weight: 700;
    }

    /* ===== Header ===== */
    .dashboard-header {
      background: #ffffff;
      border-bottom: 1px solid #e5e7eb;
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
      color: #6b7280;
    }

    /* ===== Mobile (نفس حل السيلر تمامًا) ===== */
    @media (max-width: 768px) {
      .dashboard-wrapper {
        flex-direction: column;
      }

      .sidebar {
        width: 100%;
      }

      .dashboard-content {
        padding: 20px;
      }
    }
  </style>
</head>

<body>
 ===== Header ===== 
<div class="dashboard-header">
  MarketiX — Admin Panel
</div>

<div class="dashboard-wrapper">

  <?php include __DIR__ . '/sidebar.php'; ?>

  <main class="dashboard-content">

    <?= $content ?? '' ?>

    <div class="dashboard-footer">
      © <?= date('Y') ?> MarketiX — Admin Panel
    </div>

  </main>

</div>

</body>
</html>
 



-->