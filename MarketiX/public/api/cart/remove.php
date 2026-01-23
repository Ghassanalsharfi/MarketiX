<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/MarketiX/app/bootstrap.php';

$data = json_decode(file_get_contents("php://input"), true);
$productId = (int)($data['product_id'] ?? 0);

if (isset($_SESSION['cart'][$productId])) {
    unset($_SESSION['cart'][$productId]);
}

echo json_encode([
    'status' => 'success',
    'cart' => $_SESSION['cart']
]);
