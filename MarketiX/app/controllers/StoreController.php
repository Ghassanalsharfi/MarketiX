<?php

/**
 * Class StoreController
 *
 * Handles all business logic related to displaying a store page,
 * including store retrieval, view counting, and product loading.
 *
 * This controller acts as a bridge between:
 * - Store model
 * - Product model
 * - Public store view
 */
class StoreController
{
    private PDO $pdo;
    private Store $storeModel;
    private Product $productModel;

    /**
     * StoreController constructor.
     *
     * @param PDO $pdo Database connection instance
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo          = $pdo;
        $this->storeModel   = new Store($pdo);
        $this->productModel = new Product($pdo);
    }

    /* =====================================================
       Store Helpers
    ====================================================== */

    /**
     * Validate store ID from request
     *
     * @param mixed $id Store ID from GET request
     * @return int Valid store ID
     */
    public function validateStoreId($id): int
    {
        if (!isset($id) || !is_numeric($id)) {
            header("Location: index.php");
            exit;
        }

        return (int) $id;
    }

    /**
     * Increment store view count (once per session)
     *
     * @param int $storeId Store ID
     * @return void
     */
    public function incrementViews(int $storeId): void
    {
        $_SESSION['viewed_stores'] ??= [];

        if (!in_array($storeId, $_SESSION['viewed_stores'], true)) {
            $stmt = $this->pdo->prepare("
                UPDATE stores
                SET store_views = store_views + 1
                WHERE store_id = ?
            ");
            $stmt->execute([$storeId]);

            $_SESSION['viewed_stores'][] = $storeId;
        }
    }

    /**
     * Get active store by ID
     *
     * @param int $storeId Store ID
     * @return array Store data
     */
    public function getStore(int $storeId): array
    {
        $store = $this->storeModel->getById($storeId);

        if (!$store) {
            die('Store not found');
        }

        return $store;
    }

    /* =====================================================
       Products
    ====================================================== */

    /**
     * Get products for a store (only for logged-in users)
     *
     * @param int  $storeId     Store ID
     * @param bool $isLoggedIn  User login status
     * @return array List of products
     */
 public function getProducts(int $storeId): array
{
    $sql = "
        SELECT *
        FROM products
        WHERE store_id = :store_id
          AND product_status = 'active'
          AND product_quantity > 0
        ORDER BY created_at DESC
    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
        'store_id' => $storeId
    ]);

    return $stmt->fetchAll();
}

    /**
     * Get all images for a product (for slider/gallery)
     *
     * @param int $productId Product ID
     * @return array List of image paths (main first)
     */
   public function getProductImages(int $productId): array
{
    $stmt = $this->pdo->prepare("
        SELECT image_id, image_path, is_main
        FROM product_images
        WHERE product_id = ?
        ORDER BY is_main DESC, image_id ASC
    ");
    $stmt->execute([$productId]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    /* =====================================================
       Store Status
    ====================================================== */

    /**
     * Resolve store status display data
     *
     * @param string|null $status Store status
     * @return array Badge class and message
     */
    public function resolveStatus(?string $status): array
    {
        $statusMap = [
            'active'   => ['success', 'This store is active'],
            'inactive' => ['warning', 'This store is currently inactive'],
            'blocked'  => ['danger',  'This store has been blocked by admin']
        ];

        return $statusMap[$status ?? 'inactive']
            ?? ['secondary', 'Unknown store status'];
    }
}
