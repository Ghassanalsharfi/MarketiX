<?php

/**
 * Class SellerProductFormController
 *
 * Responsible for handling all business logic related to
 * creating and updating seller products.
 *
 * This controller ensures:
 * - Seller ownership validation
 * - Store ownership validation
 * - Product creation
 * - Product update
 * - Product images (main + gallery)
 *
 * All database interactions related to product forms
 * are encapsulated in this controller.
 */
class SellerProductFormController
{
    /**
     * PDO database connection instance.
     *
     * @var PDO
     */
    private PDO $pdo;

    /**
     * Base upload directory for product images.
     *
     * @var string
     */
    private string $uploadBasePath;

    /**
     * Allowed image extensions.
     *
     * @var array
     */
    private array $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];

    /**
     * SellerProductFormController constructor.
     *
     * @param PDO $pdo Database connection instance
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->uploadBasePath = ROOT_PATH . '/public/uploads/products/';
    }

    /* =====================================================
       Seller & Store Helpers
    ====================================================== */

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
            throw new RuntimeException('Seller not found.');
        }

        return $sellerId;
    }

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

    /* =====================================================
       Product Retrieval
    ====================================================== */

    public function getProduct(int $productId, int $sellerId): ?array
    {
        $stmt = $this->pdo->prepare("
            SELECT p.*
            FROM products p
            INNER JOIN stores s ON p.store_id = s.store_id
            WHERE p.product_id = ?
              AND s.seller_id = ?
            LIMIT 1
        ");
        $stmt->execute([$productId, $sellerId]);

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    /* =====================================================
       Product Creation
    ====================================================== */

    public function createProduct(
        int $storeId,
        string $name,
        string $description,
        float $price,
        int $quantity,
        string $status,
        ?array $images = null
    ): int {
        $stmt = $this->pdo->prepare("
            INSERT INTO products (
                store_id,
                product_name,
                product_description,
                product_price,
                product_quantity,
                product_reserved,
                product_status,
                product_image
            )
            VALUES (?, ?, ?, ?, ?, 0, ?, NULL)
        ");

        $stmt->execute([
            $storeId,
            $name,
            $description,
            $price,
            $quantity,
            $status
        ]);

        $productId = (int)$this->pdo->lastInsertId();

        if ($images) {
            $this->saveProductImages($productId, $images);
        }

        return $productId;
    }

    /* =====================================================
       Product Update
    ====================================================== */

    public function updateProduct(
        int $productId,
        string $name,
        string $description,
        float $price,
        int $quantity,
        string $status,
        ?array $images = null
    ): void {
        $stmt = $this->pdo->prepare("
            UPDATE products
            SET
                product_name        = ?,
                product_description = ?,
                product_price       = ?,
                product_quantity    = ?,
                product_status      = ?
            WHERE product_id = ?
        ");

        $stmt->execute([
            $name,
            $description,
            $price,
            $quantity,
            $status,
            $productId
        ]);

        if ($images) {
            $this->saveProductImages($productId, $images, true);
        }
    }

    /* =====================================================
       Product Images (Main + Gallery)
    ====================================================== */

    /**
     * Save uploaded images for a product.
     *
     * @param int   $productId Product ID
     * @param array $files     $_FILES['product_images']
     * @param bool  $replace   Whether to replace existing images
     *
     * @return void
     */
 private function saveProductImages(
    int $productId,
    array $files,
    bool $replace = false
): void {

    // نفس المجلد القديم (بدون product_id)
    $productDir = $this->uploadBasePath;

    if (!is_dir($productDir)) {
        mkdir($productDir, 0775, true);
    }

    // عند التعديل: حذف صور المنتج من الجدول فقط
    if ($replace) {
        $this->pdo->prepare("
            DELETE FROM product_images
            WHERE product_id = ?
        ")->execute([$productId]);
    }

    $isMain = 1;

    foreach ($files['tmp_name'] as $index => $tmpName) {

        if (empty($tmpName)) {
            continue;
        }

        $ext = strtolower(pathinfo($files['name'][$index], PATHINFO_EXTENSION));

        if (!in_array($ext, $this->allowedExtensions, true)) {
            continue;
        }

        if (!getimagesize($tmpName)) {
            continue;
        }

        // نفس التسمية القديمة
        $fileName = 'product_' . uniqid() . '.' . $ext;
        $destination = $productDir . $fileName;

        if (!move_uploaded_file($tmpName, $destination)) {
            continue;
        }

        // المسار كما كان سابقًا
        $imagePath = 'public/uploads/products/' . $fileName;

        // حفظ في جدول الصور
        $this->pdo->prepare("
            INSERT INTO product_images (
                product_id,
                image_path,
                is_main
            )
            VALUES (?, ?, ?)
        ")->execute([
            $productId,
            $imagePath,
            $isMain
        ]);

        // حفظ الصورة الرئيسية في products (Fallback)
        if ($isMain === 1) {
            $this->pdo->prepare("
                UPDATE products
                SET product_image = ?
                WHERE product_id = ?
            ")->execute([
                $imagePath,
                $productId
            ]);
        }

        $isMain = 0;
    }
}

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
public function setMainImage(int $productId, int $imageId): void
{
    $this->pdo->prepare("
        UPDATE product_images
        SET is_main = 0
        WHERE product_id = ?
    ")->execute([$productId]);

    $stmt = $this->pdo->prepare("
        UPDATE product_images
        SET is_main = 1
        WHERE image_id = ?
          AND product_id = ?
    ");
    $stmt->execute([$imageId, $productId]);

    // تحديث fallback
    $path = $this->pdo->prepare("
        SELECT image_path FROM product_images WHERE image_id = ?
    ");
    $path->execute([$imageId]);

    $this->pdo->prepare("
        UPDATE products SET product_image = ?
        WHERE product_id = ?
    ")->execute([$path->fetchColumn(), $productId]);
}

public function deleteImage(int $imageId, int $productId): void
{
    $stmt = $this->pdo->prepare("
        SELECT image_path, is_main
        FROM product_images
        WHERE image_id = ? AND product_id = ?
    ");
    $stmt->execute([$imageId, $productId]);
    $img = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$img) return;

    @unlink(ROOT_PATH . '/' . $img['image_path']);

    $this->pdo->prepare("
        DELETE FROM product_images WHERE image_id = ?
    ")->execute([$imageId]);

    if ($img['is_main']) {
        $this->pdo->prepare("
            UPDATE products SET product_image = NULL
            WHERE product_id = ?
        ")->execute([$productId]);
    }
}


}
