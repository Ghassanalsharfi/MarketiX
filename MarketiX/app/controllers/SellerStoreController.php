<?php

/**
 * Class SellerStoreController
 *
 * Handles seller store creation, retrieval,
 * and update logic.
 */
class SellerStoreController
{
    /**
     * PDO database connection
     *
     * @var PDO
     */
    private PDO $pdo;

    /**
     * SellerStoreController constructor.
     *
     * @param PDO $pdo Database connection instance
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Get existing seller or create a new one.
     *
     * @param int $userId User ID
     * @return int Seller ID
     */
    public function getOrCreateSeller(int $userId): int
    {
        $stmt = $this->pdo->prepare("
            SELECT seller_id
            FROM sellers
            WHERE user_id = ?
            LIMIT 1
        ");
        $stmt->execute([$userId]);

        $sellerId = (int)$stmt->fetchColumn();

        if ($sellerId === 0) {
            $stmt = $this->pdo->prepare("
                INSERT INTO sellers (user_id, seller_status)
                VALUES (?, 'active')
            ");
            $stmt->execute([$userId]);

            $sellerId = (int)$this->pdo->lastInsertId();
        }

        return $sellerId;
    }

    /**
     * Get store by seller ID.
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
     * Create or update store.
     *
     * @param int $sellerId Seller ID
     * @param string $name Store name
     * @param string $description Store description
     * @param string|null $image Store image filename
     * @return void
     */
    public function saveStore(
        int $sellerId,
        string $name,
        string $description,
        ?string $image
    ): void {
        $store = $this->getStore($sellerId);

        if ($store) {
            $stmt = $this->pdo->prepare("
                UPDATE stores
                SET store_name = ?, store_description = ?, store_image = ?
                WHERE store_id = ?
            ");
            $stmt->execute([
                $name,
                $description,
                $image,
                $store['store_id']
            ]);
        } else {
            $stmt = $this->pdo->prepare("
                INSERT INTO stores (seller_id, store_name, store_description, store_image)
                VALUES (?, ?, ?, ?)
            ");
            $stmt->execute([
                $sellerId,
                $name,
                $description,
                $image
            ]);
        }
    }
}
