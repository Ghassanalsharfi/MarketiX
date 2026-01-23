<?php
/**
 * Cart Update API
 *
 * Supports:
 * - increase (+1)
 * - decrease (-1)
 * - set quantity directly (manual input)
 *
 * Session-based cart
 * JSON in / JSON out
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/MarketiX/app/bootstrap.php';

header('Content-Type: application/json');

/* ===============================
   Read JSON input
================================ */
$data = json_decode(file_get_contents("php://input"), true);

$productId = (int) ($data['product_id'] ?? 0);
$action    = $data['action']   ?? null;
$quantity  = isset($data['quantity']) ? (int)$data['quantity'] : null;

/* ===============================
   Basic validation
================================ */
if ($productId <= 0 || !isset($_SESSION['cart'][$productId])) {
    echo json_encode([
        'status'  => 'error',
        'message' => 'Invalid product'
    ]);
    exit;
}

/* ===============================
   Fetch product stock
================================ */
$stmt = $pdo->prepare("
    SELECT product_quantity, product_reserved
    FROM products
    WHERE product_id = ?
    LIMIT 1
");
$stmt->execute([$productId]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    echo json_encode([
        'status'  => 'error',
        'message' => 'Product not found'
    ]);
    exit;
}

$available =
    (int)$product['product_quantity']
  - (int)$product['product_reserved'];

$currentQty = (int) $_SESSION['cart'][$productId]['quantity'];

/* =========================================================
   1️⃣ SET QUANTITY (manual input – priority)
========================================================= */
if ($quantity !== null) {

    if ($quantity <= 0) {
        unset($_SESSION['cart'][$productId]);

        echo json_encode([
            'status'   => 'success',
            'quantity' => 0
        ]);
        exit;
    }

    if ($quantity > $available) {
        echo json_encode([
            'status'  => 'error',
            'message' => 'Only ' . $available . ' items available'
        ]);
        exit;
    }

    $_SESSION['cart'][$productId]['quantity'] = $quantity;

    echo json_encode([
        'status'   => 'success',
        'quantity' => $quantity
    ]);
    exit;
}

/* =========================================================
   2️⃣ INCREASE (+1)
========================================================= */
if ($action === 'increase') {

    if ($currentQty + 1 > $available) {
        echo json_encode([
            'status'  => 'error',
            'message' => 'Reached maximum available quantity'
        ]);
        exit;
    }

    $_SESSION['cart'][$productId]['quantity']++;

    echo json_encode([
        'status'   => 'success',
        'quantity' => $_SESSION['cart'][$productId]['quantity']
    ]);
    exit;
}

/* =========================================================
   3️⃣ DECREASE (-1)
========================================================= */
if ($action === 'decrease') {

    if ($currentQty - 1 <= 0) {
        unset($_SESSION['cart'][$productId]);

        echo json_encode([
            'status'   => 'success',
            'quantity' => 0
        ]);
        exit;
    }

    $_SESSION['cart'][$productId]['quantity']--;

    echo json_encode([
        'status'   => 'success',
        'quantity' => $_SESSION['cart'][$productId]['quantity']
    ]);
    exit;
}

/* ===============================
   Invalid request
================================ */
echo json_encode([
    'status'  => 'error',
    'message' => 'Invalid action'
]);
exit;
