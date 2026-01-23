<?php
/**
 * Cart Page – Entry Point + Cart Actions
 *
 * - Handles cart actions (add / remove / update / clear)
 * - Prepares cart data
 * - Renders cart view
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/MarketiX/app/bootstrap.php';
require_once ROOT_PATH . '/app/controllers/CartController.php';

/* ===============================
   Ensure cart exists
================================ */
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

/* ===============================
   CART ACTION LOGIC
   (merged from cart_action.php)
================================ */
$action = $_GET['action'] ?? $_POST['action'] ?? null;

/* ===== ADD TO CART ===== */
if ($action === 'add') {

    $productId = (int) ($_GET['id'] ?? 0);

    if ($productId > 0) {

        $stmt = $pdo->prepare("
            SELECT product_id, product_name, product_price
            FROM products
            WHERE product_id = ? AND product_status = 'active'
            LIMIT 1
        ");
        $stmt->execute([$productId]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($product) {
            if (isset($_SESSION['cart'][$productId])) {
                $_SESSION['cart'][$productId]['quantity']++;
            } else {
                $_SESSION['cart'][$productId] = [
                    'product_id'    => $product['product_id'],
                    'product_name'  => $product['product_name'],
                    'product_price' => (float) $product['product_price'],
                    'quantity'      => 1
                ];
            }

            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => 'Product added to cart'
            ];
        }
    }
}

/* ===== REMOVE FROM CART ===== */
if ($action === 'remove') {

    $productId = (int) ($_GET['id'] ?? 0);

    if ($productId > 0 && isset($_SESSION['cart'][$productId])) {
        unset($_SESSION['cart'][$productId]);
    }
}

/* ===== UPDATE CART ===== */
if ($action === 'update' && $_SERVER['REQUEST_METHOD'] === 'POST') {

    foreach ($_POST['quantities'] ?? [] as $productId => $qty) {
        $qty = (int) $qty;

        if ($qty > 0 && isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]['quantity'] = $qty;
        }
    }
}

/* ===== CLEAR CART ===== */
if ($action === 'clear') {
    $_SESSION['cart'] = [];
}

/* ===============================
   CART DATA (View Logic)
================================ */
$controller = new CartController();
$cartData   = $controller->getCartData();

$cart       = $cartData['cart'];
$total      = $cartData['total'];
$totalItems = $cartData['total_items'];

/* ===============================
   Render View
================================ */
include ROOT_PATH . '/views/cart/index.php';
