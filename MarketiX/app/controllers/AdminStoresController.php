<?php

/**
 * Class AdminStoresController
 *
 * Handles all administrative operations related to stores,
 * including retrieving store listings with statistics
 * such as products count and orders count.
 */
class AdminStoresController
{
    private PDO $pdo;

    /**
     * AdminStoresController constructor.
     *
     * @param PDO $pdo Database connection instance
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Retrieve all stores with statistics
     *
     * Fetches stores along with:
     * - Seller information
     * - Products count
     * - Orders count
     *
     * @return array List of stores with stats
     */
    public function getStores(): array
    {
        $stmt = $this->pdo->query("
            SELECT 
                s.store_id,
                s.store_name,
                s.store_status,
                s.created_at,

                u.user_name   AS seller_name,
                u.user_email,
                u.user_status AS seller_status,

                (
                  SELECT COUNT(*) 
                  FROM products p 
                  WHERE p.store_id = s.store_id
                ) AS products_count,

                (
                  SELECT COUNT(DISTINCT o.order_id)
                  FROM orders o
                  JOIN order_items oi ON o.order_id = oi.order_id
                  JOIN products p2 ON oi.product_id = p2.product_id
                  WHERE p2.store_id = s.store_id
                ) AS orders_count

            FROM stores s
            JOIN sellers se ON s.seller_id = se.seller_id
            JOIN users u    ON se.user_id = u.user_id
            ORDER BY s.created_at DESC
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
