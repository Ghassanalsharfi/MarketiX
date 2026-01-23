<?php
/**
 * ProductController
 * Handles product details logic
 */

class ProductController
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /* ===============================
       Validation
    ================================ */
    public function validateProductId(int $id): int
    {
        if ($id <= 0) {
            die('Invalid product');
        }
        return $id;
    }

    /* ===============================
       Product + Store
    ================================ */
    public function getProduct(int $productId): array
    {
        $stmt = $this->pdo->prepare("
            SELECT 
                p.product_id,
                p.product_name,
                p.product_price,
                p.product_quantity,
                p.product_description,
                p.product_image,
                s.store_id,
                s.store_name
            FROM products p
            JOIN stores s ON s.store_id = p.store_id
            WHERE p.product_id = ?
            LIMIT 1
        ");
        $stmt->execute([$productId]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            die('Product not found');
        }

        return $product;
    }

    /* ===============================
       Product Gallery
    ================================ */
    public function getProductImages(int $productId): array
    {
        $stmt = $this->pdo->prepare("
            SELECT image_path, is_main
            FROM product_images
            WHERE product_id = ?
            ORDER BY is_main DESC, image_id ASC
        ");
        $stmt->execute([$productId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* ===============================
       Main Image Resolver
    ================================ */
    public function resolveMainImage(array $images): ?string
    {
        if (empty($images)) {
            return null;
        }

        foreach ($images as $img) {
            if ((int)$img['is_main'] === 1) {
                return $img['image_path'];
            }
        }

        return $images[0]['image_path'];
    }
}
