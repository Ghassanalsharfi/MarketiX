<?php

/**
 * Class SellerDashboardController
 *
 * Handles all business logic related to the seller dashboard.
 * This includes fetching seller/store data and calculating statistics.
 */
class SellerDashboardController
{
    /**
     * PDO database connection
     *
     * @var PDO
     */
    private PDO $pdo;

    /**
     * SellerDashboardController constructor.
     *
     * @param PDO $pdo Database connection instance
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Get seller ID by user ID.
     *
     * @param int $userId Logged-in user ID
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

        $sellerId = $stmt->fetchColumn();

        if (!$sellerId) {
            die('Seller not found');
        }

        return (int)$sellerId;
    }

    /**
     * Get store information for a seller.
     *
     * @param int $sellerId Seller ID
     * @return array|null Store data
     */
    public function getStore(int $sellerId): ?array
    {
        $stmt = $this->pdo->prepare("
            SELECT *
            FROM stores
            WHERE seller_id = ?
            LIMIT 1
        ");
        $stmt->execute([$sellerId]);

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    /**
     * Get dashboard statistics for a store.
     *
     * @param int $storeId Store ID
     * @return array Statistics
     */
    public function getStatistics(int $storeId): array
    {
        // Products
        $stmt = $this->pdo->prepare("
            SELECT COUNT(*)
            FROM products
            WHERE store_id = ?
              AND product_status = 'active'
        ");
        $stmt->execute([$storeId]);
        $totalProducts = (int)$stmt->fetchColumn();

        // Orders
        $stmt = $this->pdo->prepare("
            SELECT COUNT(DISTINCT o.order_id)
            FROM orders o
            JOIN order_items oi ON o.order_id = oi.order_id
            JOIN products p ON oi.product_id = p.product_id
            WHERE p.store_id = ?
        ");
        $stmt->execute([$storeId]);
        $totalOrders = (int)$stmt->fetchColumn();

        // Revenue
        $stmt = $this->pdo->prepare("
            SELECT IFNULL(SUM(oi.quantity * oi.product_price), 0)
            FROM orders o
            JOIN order_items oi ON o.order_id = oi.order_id
            JOIN products p ON oi.product_id = p.product_id
            WHERE p.store_id = ?
              AND o.order_status = 'completed'
        ");
        $stmt->execute([$storeId]);
        $totalRevenue = (float)$stmt->fetchColumn();

        return [
            'totalProducts' => $totalProducts,
            'totalOrders'   => $totalOrders,
            'totalRevenue'  => $totalRevenue
        ];
    }
}

