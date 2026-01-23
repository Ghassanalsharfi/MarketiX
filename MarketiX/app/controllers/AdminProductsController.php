<?php

/**
 * Class AdminProductsController
 *
 * Handles all administrative operations related to products,
 * including filtering, status updates (hide / activate),
 * and retrieving product listings for the admin dashboard.
 */
class AdminProductsController
{
    private PDO $pdo;

    /**
     * AdminProductsController constructor.
     *
     * @param PDO $pdo Database connection instance
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Get selected status filter
     *
     * @param array $query HTTP GET parameters
     * @return string Selected status filter
     */
    public function getStatusFilter(array $query): string
    {
        return $query['status'] ?? 'all';
    }

    /**
     * Handle product status actions (hide / activate)
     *
     * @param array $post HTTP POST parameters
     * @param string $statusFilter Current status filter
     * @return void
     */
    public function handleActions(array $post, string $statusFilter): void
    {
        if (!isset($post['product_id'], $post['action'])) {
            return;
        }

        $productId = (int) $post['product_id'];
        $action    = $post['action'];

        if ($action === 'hide') {
            $stmt = $this->pdo->prepare("
                UPDATE products
                SET product_status = 'hidden'
                WHERE product_id = ?
            ");
            $stmt->execute([$productId]);
        }

        if ($action === 'activate') {
            $stmt = $this->pdo->prepare("
                UPDATE products
                SET product_status = 'active'
                WHERE product_id = ?
            ");
            $stmt->execute([$productId]);
        }

        header("Location: products.php?status=" . urlencode($statusFilter));
        exit;
    }

    /**
     * Retrieve products for admin listing
     *
     * @param string $statusFilter Selected status filter
     * @return array List of products
     */
    public function getProducts(string $statusFilter): array
    {
        $sql = "
        SELECT 
          p.product_id,
          p.product_name,
          p.product_price,
          p.product_image,
          p.product_status,
          p.product_quantity,
          p.product_reserved,
          (p.product_quantity - p.product_reserved) AS available_quantity,
          s.store_name,
          u.user_name AS seller_name
        FROM products p
        JOIN stores s   ON p.store_id = s.store_id
        JOIN sellers se ON s.seller_id = se.seller_id
        JOIN users u    ON se.user_id = u.user_id
        ";

      $params = [];

switch ($statusFilter) {

    case 'out_of_stock':
        // ✅ المنتج يعتبر out of stock إذا المتاح = 0
        $sql .= " WHERE (p.product_quantity - p.product_reserved) <= 0";
        break;

    case 'active':
        // منتجات فعالة ولديها كمية
        $sql .= " WHERE p.product_status = 'active'
                  AND (p.product_quantity - p.product_reserved) > 0";
        break;

    case 'hidden':
        $sql .= " WHERE p.product_status = 'hidden'";
        break;

    case 'all':
    default:
        // بدون فلترة
        break;
}


        $sql .= " ORDER BY p.product_id DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
