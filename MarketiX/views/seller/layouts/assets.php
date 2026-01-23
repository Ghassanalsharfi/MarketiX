<?php
// views/seller/layouts/assets.php
?>

<style>
/* ===============================
   SELLER DASHBOARD – GLOBAL UI
   MarketiX Unified Colors
================================ */

:root {
  --mx-green:  #22c55e;
  --mx-blue:   #3b82f6;
  --mx-dark:   #0f172a;
  --mx-dark-2: #111827;
  --mx-bg:     #f8fafc;
  --mx-border: #e5e7eb;
  --mx-text:   #0f172a;
  --mx-muted:  #64748b;
}

/* ===============================
   Wrapper
================================ */
.dashboard-wrapper {
  display: flex;
  min-height: 100vh;
  background: var(--mx-bg);
}

/* ===============================
   Sidebar
================================ */
.sidebar {
  width: 260px;
  background: #ffffff;
  border-right: 1px solid var(--mx-border);
  padding: 24px;
}

.sidebar h5 {
  font-weight: 800;
  margin-bottom: 24px;
  color: var(--mx-dark);
}

/* Links */
.sidebar a {
  display: block;
  padding: 10px 14px;
  border-radius: 12px;
  color: var(--mx-dark);
  text-decoration: none;
  margin-bottom: 8px;
  font-weight: 500;
  transition: background .25s, color .25s;
}

/* Hover */
.sidebar a:hover {
  background: #f1f5f9;
  color: var(--mx-blue);
}

/* Active */
.sidebar a.active {
  background: linear-gradient(135deg, var(--mx-blue), var(--mx-green));
  color: #ffffff;
  font-weight: 700;
}

/* Disabled */
.sidebar a.disabled {
  pointer-events: none;
  opacity: .5;
}

/* Icons (future-proof) */
.sidebar a i {
  color: var(--mx-muted);
}

.sidebar a:hover i,
.sidebar a.active i {
  color: #ffffff;
}

/* ===============================
   Content
================================ */
.dashboard-content {
  flex: 1;
  padding: 32px;
  color: var(--mx-text);
}

/* ===============================
   Overlay
================================ */
.sidebar-overlay {
  display: none;
}

/* ===============================
   Mobile
================================ */
@media (max-width: 768px) {

  .dashboard-wrapper {
    flex-direction: column;
  }

  .sidebar {
    position: fixed;
    top: 0;
    left: -280px;
    height: 100%;
    z-index: 1050;
    transition: left .3s ease;
    background: #ffffff;
  }

  .sidebar.show {
    left: 0;
  }

  .sidebar-overlay {
    position: fixed;
    inset: 0;
    background: rgba(15,23,42,.4);
    z-index: 1040;
    display: none;
  }

  .sidebar-overlay.show {
    display: block;
  }

  .dashboard-content {
    padding: 16px;
  }
}
.link-disabled {
  pointer-events: none;
  opacity: 0.45;
  cursor: not-allowed;
}

</style>

<script>
function toggleSidebar() {
  document.querySelector('.sidebar')?.classList.toggle('show');
  document.querySelector('.sidebar-overlay')?.classList.toggle('show');
}
</script>
