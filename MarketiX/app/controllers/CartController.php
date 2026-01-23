<?php
/**
 * CartController
 * Handles cart session logic
 */

class CartController
{
    public function getCartData(): array
    {
        $cart = $_SESSION['cart'] ?? [];
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['product_price'] * $item['quantity'];
        }

        return [
            'cart'        => $cart,
            'total'       => $total,
            'total_items' => array_sum(array_column($cart, 'quantity'))
        ];
    }
}
