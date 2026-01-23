<?php
/**
 * OrdersController
 * Handles user orders logic
 */
class OrdersController
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /* ===============================
       User Orders
    ================================ */
    public function getUserOrders(int $userId): array
    {
        $stmt = $this->pdo->prepare("
            SELECT order_id, order_status, order_total, created_at
            FROM orders
            WHERE user_id = ?
            ORDER BY created_at DESC
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* ===============================
       Single Order (Owner Only)
    ================================ */
    public function getOrder(int $orderId, int $userId): array
    {
        $stmt = $this->pdo->prepare("
            SELECT order_id, order_status, order_total, created_at
            FROM orders
            WHERE order_id = ? AND user_id = ?
            LIMIT 1
        ");
        $stmt->execute([$orderId, $userId]);
        $order = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$order) {
            die('Order not found');
        }

        return $order;
    }

    /* ===============================
       Order Items
    ================================ */
    public function getOrderItems(int $orderId): array
    {
        $stmt = $this->pdo->prepare("
            SELECT 
                p.product_name,
                oi.product_price,
                oi.quantity
            FROM order_items oi
            JOIN products p ON p.product_id = oi.product_id
            WHERE oi.order_id = ?
        ");
        $stmt->execute([$orderId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
