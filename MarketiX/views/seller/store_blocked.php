<?php
/**
 * Store Blocked Page
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/MarketiX/app/bootstrap.php';
require_once ROOT_PATH . '/app/middleware/auth.php';
require_once ROOT_PATH . '/app/middleware/seller.php';

requireAuth($pdo);
requireSeller();

$pageTitle = 'Store Disabled';

ob_start();
?>

<div class="d-flex justify-content-center align-items-center" style="min-height:70vh;">
  <div class="card shadow-sm border-0 rounded-4 p-5 text-center" style="max-width:520px;">
    
    <div class="mb-4">
      <span style="font-size:64px;">🚫</span>
    </div>

    <h3 class="fw-bold mb-3">Store Temporarily Disabled</h3>

    <p class="text-muted mb-4">
      Your store is currently <strong>inactive</strong> and cannot be accessed.<br>
      Please contact the administration to reactivate your store.
    </p>

    <div class="d-flex gap-2 justify-content-center">
     
    <a href="<?= BASE_URL ?>/public/contact.php" class="btn btn-primary">
  Contact Administration
</a>

    </div>

  </div>
</div>

<?php
$content = ob_get_clean();

/* ✅ استخدم نفس Layout الخاص بالبائع */
include __DIR__ . '/layouts/dashboard_layout.php';
