<?php

/**
 * Class Product
 *
 * Represents the Product model in the MarketX project.
 * This class is responsible for handling all database
 * operations related to products, including creation,
 * retrieval by store, and deletion.
 *
 * ❌ No presentation logic (HTML)
 * ✔ Database interaction only using PDO
 */
class Product
{
    /**
     * PDO database connection instance
     *
     * @var PDO
     */
    private PDO $pdo;

    /**
     * Product constructor.
     *
     * Initializes the Product model with a PDO database connection.
     *
     * @param PDO $pdo Database connection object
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /* =========================
       Create Product
    ========================= */

    /**
     * Create a new product
     *
     * Inserts a new product into the database and associates it
     * with a specific store.
     *
     * @param int $storeId Store unique identifier
     * @param string $name Product name
     * @param string $description Product description
     * @param float $price Product price
     * @param string|null $image Product image (optional)
     * @param int $quantity Product available quantity
     *
     * @return bool True on success, false on failure
     */
    public function create(
        int $storeId,
        string $name,
        string $description,
        float $price,
        ?string $image,
        int $quantity
    ): bool {

        $stmt = $this->pdo->prepare("
            INSERT INTO products
            (store_id, product_name, product_description, product_price, product_image, product_quantity)
            VALUES (?, ?, ?, ?, ?, ?)
        ");

        return $stmt->execute([
            $storeId,
            $name,
            $description,
            $price,
            $image,
            $quantity
        ]);
    }

    /* =========================
       Get Products By Store
    ========================= */

    /**
     * Get products by store
     *
     * Retrieves all active products that belong to a specific store.
     * Commonly used on the public store page.
     *
     * @param int $storeId Store unique identifier
     * @return array List of products
     */
    public function getByStore(int $storeId): array
    {
        $stmt = $this->pdo->prepare("
            SELECT *
            FROM products
            WHERE store_id = ? AND product_status = 'active'
            ORDER BY product_id DESC
        ");
        $stmt->execute([$storeId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* =========================
       Delete Product
    ========================= */

    /**
     * Delete a product
     *
     * Permanently deletes a product from the database.
     * The deletion is restricted to products belonging
     * to the specified store.
     *
     * @param int $productId Product unique identifier
     * @param int $storeId Store unique identifier
     * @return bool True on success, false on failure
     */
    public function delete(int $productId, int $storeId): bool
    {
        $stmt = $this->pdo->prepare("
            DELETE FROM products
            WHERE product_id = ? AND store_id = ?
        ");
        return $stmt->execute([$productId, $storeId]);
    }

    /**
     * Check if product can be deleted
     *
     * Determines whether a product can be safely deleted
     * by checking if it is referenced in any order items.
     *
     * @param int $productId Product unique identifier
     * @return bool True if the product is not used in any order, false otherwise
     */
    public function canDelete(int $productId): bool
    {
        $stmt = $this->pdo->prepare("
            SELECT COUNT(*)
            FROM order_items
            WHERE product_id = ?
        ");
        $stmt->execute([$productId]);
        return $stmt->fetchColumn() == 0;
    }
}
