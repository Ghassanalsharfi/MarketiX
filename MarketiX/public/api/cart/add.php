<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/MarketiX/app/bootstrap.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);
$productId = (int)($data['product_id'] ?? 0);

if ($productId <= 0) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid product']);
    exit;
}

/* ===============================
   جلب المنتج
================================ */
$stmt = $pdo->prepare("
    SELECT 
        product_id,
        product_name,
        product_price,
        product_quantity,
        product_reserved
    FROM products
    WHERE product_id = ?
    LIMIT 1
");
$stmt->execute([$productId]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    echo json_encode(['status' => 'error', 'message' => 'Product not found']);
    exit;
}

/* ===============================
   حساب الكمية المتاحة
================================ */
$available =
    (int)$product['product_quantity']
  - (int)$product['product_reserved'];

if ($available <= 0) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Out of stock'
    ]);
    exit;
}

/* ===============================
   تهيئة السلة
================================ */
$_SESSION['cart'] ??= [];

$currentQty =
    $_SESSION['cart'][$productId]['quantity'] ?? 0;

/* ===============================
   منع تجاوز المخزون
================================ */
if ($currentQty + 1 > $available) {
    echo json_encode([
        'status' => 'error',
        'message' => 'No more quantity available'
    ]);
    exit;
}

/* ===============================
   إضافة منتج ( +1 فقط )
================================ */
$_SESSION['cart'][$productId] = [
    'product_id'    => $product['product_id'],
    'product_name'  => $product['product_name'],
    'product_price' => (float)$product['product_price'],
    'quantity'      => $currentQty + 1
];

echo json_encode([
    'status'      => 'success',
    'cart_count'  =>
        array_sum(array_column($_SESSION['cart'], 'quantity')),
    'available'   => $available - ($currentQty + 1)
]);