<?php
/**
 * Admin Users Management Page
 *
 * Acts as a bootstrap file and delegates all
 * business logic to AdminUsersController.
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/MarketiX/app/bootstrap.php';
require_once ROOT_PATH . '/app/middleware/auth.php';
require_once ROOT_PATH . '/app/middleware/admin.php';

requireAuth($pdo);
requireAdmin();

$controller = new AdminUsersController($pdo);

/* ===============================
   Filters
================================ */
$filters = $controller->getFilters($_GET);
$statusFilter = $filters['status'];
$roleFilter   = $filters['role'];

/* ===============================
   Fetch Users
================================ */
$users = $controller->getUsers($statusFilter, $roleFilter);

/* ===== Page Settings ===== */
$pageTitle = "Users Management";
$content   = __DIR__ . '/pages/users_content.php';

require_once __DIR__ . '/layouts/layout.php';
