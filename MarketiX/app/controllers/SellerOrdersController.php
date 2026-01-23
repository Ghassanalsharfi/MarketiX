<?php

/**
 * Class SellerOrdersController
 *
 * Handles seller orders:
 * - Fetching orders
 * - Calculating totals
 * - Handling order actions (confirm / cancel / complete)
 *
 * All business logic related to seller orders lives here.
 */
class SellerOrdersController
{
    /**
     * PDO database connection
     *
     * @var PDO
     */
    private PDO $pdo;

    /**
     * Platform commission rate (10%)
     *
     * @var float
     */
    private float $commissionRate = 0.10;

    /**
     * SellerOrdersController constructor.
     *
     * @param PDO $pdo Database connection
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Get seller ID by user ID.
     *
     * @param int $userId
     * @return int Seller ID
     */
    public function getSellerId(int $userId): int
    {
        $stmt = $this->pdo->prepare("
            SELECT seller_id
            FROM sellers
            WHERE user_id = ?
            LIMIT 1
        ");
        $stmt->execute([$userId]);

        return (int) $stmt->fetchColumn();
    }

    /**
     * Get all orders for a seller.
     *
     * @param int $sellerId
     * @return array Orders list
     */
    public function getOrders(int $sellerId): array
    {
        $stmt = $this->pdo->prepare("
            SELECT 
                o.order_id,
                o.order_status,
                o.created_at,
                oi.quantity,
                oi.product_price,
                (oi.quantity * oi.product_price) AS gross_amount,
                p.product_name,
                p.product_id
            FROM orders o
            JOIN order_items oi ON o.order_id = oi.order_id
            JOIN products p ON oi.product_id = p.product_id
            JOIN stores s ON p.store_id = s.store_id
            WHERE s.seller_id = ?
            ORDER BY o.created_at DESC
        ");
        $stmt->execute([$sellerId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Calculate financial totals for completed orders only.
     *
     * @param array $orders
     * @return array Totals (gross, commission, net)
     */
    public function calculateTotals(array $orders): array
    {
        $totals = [
            'gross'      => 0,
            'commission' => 0,
            'net'        => 0,
        ];

        foreach ($orders as $order) {
            if ($order['order_status'] === 'completed') {
                $fee = $order['gross_amount'] * $this->commissionRate;

                $totals['gross']      += $order['gross_amount'];
                $totals['commission'] += $fee;
                $totals['net']        += ($order['gross_amount'] - $fee);
            }
        }

        return $totals;
    }

    /**
     * Get platform commission rate.
     *
     * @return float
     */
    public function getCommissionRate(): float
    {
        return $this->commissionRate;
    }

    /**
     * Handle order action based on POST data.
     *
     * @param int $orderId
     * @param int $userId
     * @param string $action
     * @return void
     *
     * @throws Exception
     */
    public function handleOrderAction(int $orderId, int $userId, string $action): void
    {
        $this->pdo->beginTransaction();

        /* Verify ownership */
        $stmt = $this->pdo->prepare("
            SELECT o.order_status
            FROM orders o
            JOIN order_items oi ON o.order_id = oi.order_id
            JOIN products p ON oi.product_id = p.product_id
            JOIN stores s ON p.store_id = s.store_id
            JOIN sellers se ON s.seller_id = se.seller_id
            WHERE o.order_id = ?
              AND se.user_id = ?
            LIMIT 1
        ");
        $stmt->execute([$orderId, $userId]);
        $orderStatus = $stmt->fetchColumn();

        if (!$orderStatus) {
            throw new Exception('Unauthorized order');
        }

        /* Fetch order items */
        $itemsStmt = $this->pdo->prepare("
            SELECT product_id, quantity
            FROM order_items
            WHERE order_id = ?
        ");
        $itemsStmt->execute([$orderId]);
        $items = $itemsStmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$items) {
            throw new Exception('Order items not found');
        }

        /* Actions */
        if ($action === 'confirm' && $orderStatus === 'pending') {

            foreach ($items as $item) {
                $this->pdo->prepare("
                    UPDATE products
                    SET 
                        product_quantity = product_quantity - ?,
                        product_reserved = product_reserved - ?
                    WHERE product_id = ?
                ")->execute([
                    $item['quantity'],
                    $item['quantity'],
                    $item['product_id']
                ]);
            }

            $this->pdo->prepare("
                UPDATE orders
                SET order_status = 'paid'
                WHERE order_id = ?
            ")->execute([$orderId]);

        } elseif ($action === 'cancel' && $orderStatus === 'pending') {

            foreach ($items as $item) {
                $this->pdo->prepare("
                    UPDATE products
                    SET product_reserved = product_reserved - ?
                    WHERE product_id = ?
                ")->execute([
                    $item['quantity'],
                    $item['product_id']
                ]);
            }

            $this->pdo->prepare("
                UPDATE orders
                SET order_status = 'cancelled'
                WHERE order_id = ?
            ")->execute([$orderId]);

        } elseif ($action === 'complete' && $orderStatus === 'paid') {

            $this->pdo->prepare("
                UPDATE orders
                SET order_status = 'completed'
                WHERE order_id = ?
            ")->execute([$orderId]);

        } else {
            throw new Exception('Invalid order state transition');
        }

        $this->pdo->commit();
    }
}
