<?php

/**
 * Class Store
 *
 * Represents the Store model in the MarketX project.
 * This class is responsible for handling all database
 * operations related to stores such as creation, retrieval,
 * and public listing.
 *
 * ❌ No presentation logic (HTML)
 * ✔ Database operations only using PDO
 */
class Store
{
    /**
     * PDO database connection instance
     *
     * @var PDO
     */
    private PDO $pdo;

    /**
     * Store constructor.
     *
     * Initializes the Store model with a PDO database connection.
     *
     * @param PDO $pdo Database connection object
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /* ================= SELLER METHODS ================= */

    /**
     * Get store by seller ID
     *
     * Retrieves a single store associated with a specific seller.
     * Commonly used in the seller dashboard.
     *
     * @param int $sellerId Seller unique identifier
     * @return array|false Store data if found, false otherwise
     */
    public function getBySellerId(int $sellerId)
    {
        $stmt = $this->pdo->prepare("
            SELECT *
            FROM stores
            WHERE seller_id = ?
            LIMIT 1
        ");
        $stmt->execute([$sellerId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Create a new store
     *
     * Creates a new store associated with a seller.
     * The store status is set to 'active' by default.
     *
     * @param int $sellerId Seller unique identifier
     * @param string $name Store name
     * @param string $description Store description
     * @param string|null $image Store image (optional)
     * @return bool True on success, false on failure
     */
    public function create(
        int $sellerId,
        string $name,
        string $description,
        ?string $image
    ): bool {
        $stmt = $this->pdo->prepare("
            INSERT INTO stores
            (seller_id, store_name, store_description, store_image, store_status)
            VALUES (?, ?, ?, ?, 'active')
        ");
        return $stmt->execute([
            $sellerId,
            $name,
            $description,
            $image
        ]);
    }

    /* ================= PUBLIC METHODS ================= */

    /**
     * Get all active stores
     *
     * Retrieves all stores that are currently active.
     * Used in public-facing pages.
     *
     * @return array List of active stores
     */
    public function getAllActive(): array
    {
        $stmt = $this->pdo->query("
            SELECT store_id, store_name, store_description, store_image
            FROM stores
            WHERE store_status = 'active'
            ORDER BY store_id DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get store by ID
     *
     * Retrieves a single active store using its unique ID.
     *
     * @param int $storeId Store unique identifier
     * @return array|false Store data if found, false otherwise
     */
    public function getById(int $storeId)
    {
        $stmt = $this->pdo->prepare("
            SELECT *
            FROM stores
            WHERE store_id = ? AND store_status = 'active'
            LIMIT 1
        ");
        $stmt->execute([$storeId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Get all stores (active only)
     *
     * Retrieves all active stores.
     * Commonly used in admin or management pages.
     *
     * @return array List of stores
     */
    public function getAll(): array
    {
        $stmt = $this->pdo->query("
            SELECT store_id, store_name, store_description, store_image
            FROM stores
            WHERE store_status = 'active'
            ORDER BY store_id DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
