<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/MarketiX/app/bootstrap.php';
require_once ROOT_PATH . '/app/middleware/auth.php';
require_once ROOT_PATH . '/app/controllers/OrdersController.php';

requireAuth($pdo);

$controller = new OrdersController($pdo);
$orders = $controller->getUserOrders($_SESSION['user_id']);

include ROOT_PATH . '/views/orders/index.php';
