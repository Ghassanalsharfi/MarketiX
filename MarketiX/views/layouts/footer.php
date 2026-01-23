<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/MarketiX/app/bootstrap.php';
?>

<!-- ================= Footer ================= -->
<footer class="main-footer mt-5">
  <div class="container py-5">
    <div class="row g-4">

      <!-- Brand -->
      <div class="col-lg-4 col-md-6">
        <h4 class="footer-brand">Market<span>iX</span></h4>
        <p class="footer-desc">
          منصة <strong>MarketiX</strong> تتيح لك شراء المنتجات من متاجر متعددة
          بكل سهولة وأمان، مع تجربة تسوق حديثة وسريعة.
        </p>
      </div>

      <!-- Links -->
      <div class="col-lg-2 col-md-6">
        <h6 class="footer-title">روابط سريعة</h6>
        <ul class="footer-links">
          <li><a href="<?= BASE_URL ?>/public/index.php">الرئيسية</a></li>
          <li><a href="<?= BASE_URL ?>/public/products.php">المنتجات</a></li>
          <li><a href="<?= BASE_URL ?>/public/cart.php">السلة</a></li>
          <li><a href="<?= BASE_URL ?>/public/login.php">تسجيل الدخول</a></li>
        </ul>
      </div>

      <!-- Contact -->
      <div class="col-lg-3 col-md-6">
        <h6 class="footer-title">تواصل معنا</h6>
        <ul class="footer-contact">
          <li><i class="fa-solid fa-location-dot"></i> اليمن</li>
          <li><i class="fa-solid fa-phone"></i> +967 700 000 000</li>
          <li><i class="fa-solid fa-envelope"></i> support@marketix.com</li>
        </ul>
      </div>

      <!-- Social -->
      <div class="col-lg-3 col-md-6">
        <h6 class="footer-title">تابعنا</h6>
        <div class="footer-social">
          <a href="https://facebook.com" target="_blank" aria-label="Facebook">
            <i class="fa-brands fa-facebook-f"></i>
          </a>
          <a href="https://instagram.com" target="_blank" aria-label="Instagram">
            <i class="fa-brands fa-instagram"></i>
          </a>
          <a href="https://wa.me/967700000000" target="_blank" aria-label="WhatsApp">
            <i class="fa-brands fa-whatsapp"></i>
          </a>
          <a href="https://twitter.com" target="_blank" aria-label="Twitter">
            <i class="fa-brands fa-x-twitter"></i>
          </a>
        </div>
      </div>

    </div>
  </div>

  <!-- Bottom -->
  <div class="footer-bottom text-center py-3">
    <small>© <?= date('Y') ?> MarketiX. All rights reserved.</small>
  </div>
</footer>

<!-- Overlay for mobile sidebar -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function() {

    const toggleBtn = document.getElementById('toggleSidebar');
    const sidebar = document.querySelector('.sidebar');
    const overlay = document.getElementById('sidebarOverlay');

    if (toggleBtn && sidebar && overlay) {

      toggleBtn.addEventListener('click', function() {
        sidebar.classList.toggle('show');
        overlay.classList.toggle('show');
      });

      overlay.addEventListener('click', function() {
        sidebar.classList.remove('show');
        overlay.classList.remove('show');
      });
    }
  });
</script>

<style>
  /* ===============================
   MarketiX Footer – PRO UI
================================ */

  :root {
    --mx-green: #22c55e;
    --mx-blue: #3b82f6;
    --mx-dark: #0f172a;
    --mx-border: #e5e7eb;
    --mx-muted: #6b7280;
  }

  /* Wrapper */
  .main-footer {
    background: linear-gradient(180deg, #f9fafb, #ffffff);
    border-top: 1px solid var(--mx-border);
  }

  /* Brand */
  .footer-brand {
    font-weight: 900;
    font-size: 24px;
    letter-spacing: -.5px;
    color: var(--mx-blue);
  }

  .footer-brand {
    font-weight: 900;
    font-size: 24px;
    letter-spacing: -.5px;
    color: var(--mx-green);
    /* Market */
  }

  .footer-brand span {
    color: var(--mx-blue);
    /* iX */
  }


  .footer-desc {
    font-size: 14px;
    color: var(--mx-muted);
    line-height: 1.7;
  }

  /* Titles */
  .footer-title {
    font-weight: 700;
    margin-bottom: 14px;
    color: var(--mx-dark);
    font-size: 15px;
  }

  /* Links */
  .footer-links,
  .footer-contact {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .footer-links li,
  .footer-contact li {
    margin-bottom: 10px;
    font-size: 14px;
    color: var(--mx-muted);
  }

  .footer-links a {
    color: var(--mx-muted);
    text-decoration: none;
    transition: .25s;
  }

  .footer-links a:hover {
    color: var(--mx-blue);
    padding-right: 4px;
  }

  /* Contact Icons */
  .footer-contact i {
    margin-left: 6px;
    color: var(--mx-blue);
  }

  /* Social */
  .footer-social {
    display: flex;
    gap: 10px;
  }

  .footer-social a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: #ffffff;
    border: 1px solid var(--mx-border);
    color: var(--mx-dark);
    transition: .3s ease;
  }

  .footer-social a:hover {
    background: linear-gradient(135deg, var(--mx-green), var(--mx-blue));
    color: #ffffff;
    transform: translateY(-4px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, .12);
  }

  /* Bottom */
  .footer-bottom {
    background: #ffffff;
    border-top: 1px solid var(--mx-border);
    color: var(--mx-muted);
    font-size: 13px;
  }

  /* Overlay */
  .sidebar-overlay {
    display: none;
  }

  @media (max-width: 768px) {
    .sidebar-overlay {
      position: fixed;
      inset: 0;
      background: rgba(15, 23, 42, .4);
      z-index: 1040;
    }

    .sidebar-overlay.show {
      display: block;
    }
  }
</style>

</body>

</html>