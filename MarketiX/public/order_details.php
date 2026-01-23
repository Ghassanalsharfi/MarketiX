


<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/MarketiX/app/bootstrap.php';
require_once ROOT_PATH . '/app/middleware/auth.php';
require_once ROOT_PATH . '/app/controllers/OrdersController.php';

requireAuth($pdo);

$orderId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($orderId <= 0) {
    die('Invalid order');
}

$controller = new OrdersController($pdo);
$order  = $controller->getOrder($orderId, $_SESSION['user_id']);
$items  = $controller->getOrderItems($orderId);

include ROOT_PATH . '/views/orders/details.php';
