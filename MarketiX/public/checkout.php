<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/MarketiX/app/bootstrap.php';
require_once ROOT_PATH . '/app/middleware/auth.php';
require_once ROOT_PATH . '/app/controllers/CheckoutController.php';

requireAuth($pdo);

$cart = $_SESSION['cart'] ?? [];
if (empty($cart)) {
    header("Location: cart.php");
    exit;
}

$controller = new CheckoutController($pdo);

$user  = $controller->getUser($_SESSION['user_id']);
$total = $controller->calculateTotal($cart);

$error = null;
$orderPlaced = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = $controller->placeOrder(
        $_SESSION['user_id'],
        $user,
        $cart,
        $_POST
    );

    if (isset($result['error'])) {
        $error = $result['error'];
    } else {
        $orderPlaced = true;
    }
}

include ROOT_PATH . '/views/checkout/index.php';
