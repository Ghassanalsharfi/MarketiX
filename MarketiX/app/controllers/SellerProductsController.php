<?php

/**
 * Class SellerProductsController
 *
 * Handles seller product management logic such as
 * listing, deleting, and ownership validation.
 */
class SellerProductsController
{
    /**
     * PDO database connection
     *
     * @var PDO
     */
    private PDO $pdo;

    /**
     * SellerProductsController constructor.
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
     * @param int $userId User ID
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

        $sellerId = (int)$stmt->fetchColumn();

        if ($sellerId <= 0) {
            die('Seller not found');
        }

        return $sellerId;
    }

    /**
     * Get store ID by seller ID.
     *
     * @param int $sellerId Seller ID
     * @return int Store ID
     */
    public function getStoreId(int $sellerId): int
    {
        $stmt = $this->pdo->prepare("
            SELECT store_id
            FROM stores
            WHERE seller_id = ?
            LIMIT 1
        ");
        $stmt->execute([$sellerId]);

        return (int)$stmt->fetchColumn();
    }

    /**
     * Get all products for a store.
     *
     * @param int $storeId Store ID
     * @return array Products list
     */
    public function getProducts(int $storeId): array
    {
        $stmt = $this->pdo->prepare("
            SELECT *
            FROM products
            WHERE store_id = ?
            ORDER BY product_id DESC
        ");
        $stmt->execute([$storeId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Check if product can be deleted (no orders).
     *
     * @param int $productId Product ID
     * @return bool
     */
    public function canDelete(int $productId): bool
    {
        $stmt = $this->pdo->prepare("
            SELECT COUNT(*)
            FROM order_items
            WHERE product_id = ?
        ");
        $stmt->execute([$productId]);

        return (int)$stmt->fetchColumn() === 0;
    }

    /**
     * Delete product owned by store.
     *
     * @param int $productId Product ID
     * @param int $storeId Store ID
     * @return void
     */
    public function deleteProduct(int $productId, int $storeId): void
    {
        $stmt = $this->pdo->prepare("
            DELETE FROM products
            WHERE product_id = ? AND store_id = ?
        ");
        $stmt->execute([$productId, $storeId]);
    }
}
