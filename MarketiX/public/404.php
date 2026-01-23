<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/MarketiX/app/bootstrap.php';
require_once ROOT_PATH . '/app/middleware/auth.php';

include __DIR__ . '/../views/layouts/header.php';
?>

<style>
/* ===============================
   404 PAGE STYLE
================================ */

.page-404 {
  min-height: 70vh;
  display: flex;
  align-items: center;
  justify-content: center;
}

.error-box {
  max-width: 520px;
  padding: 50px 30px;
  border-radius: 24px;
  background: linear-gradient(135deg, #f8fafc, #ecfdf5);
  box-shadow: 0 20px 40px rgba(0,0,0,.08);
}

.error-code {
  font-size: 120px;
  font-weight: 900;
  line-height: 1;
  color: #2ecc71;
}

.error-text {
  font-size: 18px;
  color: #6b7280;
}

.error-actions a {
  padding: 12px 26px;
  border-radius: 30px;
  font-weight: 600;
}
</style>

<div class="container page-404">
  <div class="error-box text-center">

    <div class="error-code">404</div>

    <h4 class="fw-bold mt-3 mb-2">
      Oops! Page not found
    </h4>

    <p class="error-text mb-4">
      The page you’re looking for doesn’t exist or was moved.
    </p>

    <div class="error-actions d-flex justify-content-center gap-3 flex-wrap">
      <a href="<?= BASE_URL ?>/public/index.php"
         class="btn btn-success">
        Go Home
      </a>

      <button onclick="history.back()"
              class="btn btn-outline-secondary">
        Go Back
      </button>
    </div>

  </div>
</div>

<?php include __DIR__ . '/../views/layouts/footer.php'; ?>