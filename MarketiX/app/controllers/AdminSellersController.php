<?php

/**
 * Class AdminSellersController
 *
 * Handles administrative logic for sellers management,
 * including filtering sellers by status and fetching
 * sellers list for the admin panel.
 */
class AdminSellersController
{
    private PDO $pdo;

    /**
     * AdminSellersController constructor.
     *
     * @param PDO $pdo Database connection instance
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Resolve status filter from GET request
     *
     * @param array $query
     * @return string
     */
    public function getStatusFilter(array $query): string
    {
        return $query['status'] ?? 'all';
    }

    /**
     * Retrieve sellers list based on status filter
     *
     * @param string $statusFilter
     * @return array
     */
    public function getSellers(string $statusFilter): array
    {
        $where  = [];
        $params = [];

        if ($statusFilter === 'active') {
            $where[] = "s.seller_status = 'active'";
        }

        if ($statusFilter === 'inactive') {
            $where[] = "s.seller_status = 'inactive'";
        }

        $sql = "
            SELECT 
                s.seller_id,
                s.seller_status,
                u.user_id,
                u.user_name,
                u.user_email,
                u.user_status
            FROM sellers s
            JOIN users u ON s.user_id = u.user_id
        ";

        if (!empty($where)) {
            $sql .= " WHERE " . implode(" AND ", $where);
        }

        $sql .= " ORDER BY s.seller_id DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        $sellers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        /* ✅ Admin Activity Log (View Sellers List) */
        ActivityLogger::log(
            $this->pdo,
            $_SESSION['user_id'] ?? null,
            'ADMIN_VIEW_SELLERS',
            "Admin viewed sellers list (filter: {$statusFilter})"
        );

        return $sellers;
    }
}
