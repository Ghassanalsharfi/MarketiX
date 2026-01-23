<?php

/**
 * Class AdminOrdersController
 *
 * Handles all administrative operations related to orders,
 * including filtering by store, retrieving order listings,
 * and calculating platform statistics such as commissions
 * and revenues.
 */
class AdminOrdersController
{
    private PDO $pdo;

    /**
     * Platform commission rate
     *
     * @var float
     */
    private float $commissionRate = 0.10;

    /**
     * AdminOrdersController constructor.
     *
     * @param PDO $pdo Database connection instance
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Get platform commission rate
     *
     * @return float
     */
    public function getCommissionRate(): float
    {
        return $this->commissionRate;
    }

    /**
     * Retrieve stores list for filtering
     *
     * @return array List of stores
     */
    public function getStores(): array
    {
        $stmt = $this->pdo->query("
            SELECT store_id, store_name
            FROM stores
            ORDER BY store_name
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Resolve store filter from request
     *
     * @param array $query HTTP GET parameters
     * @return int Store ID or 0 for all
     */
    public function getStoreFilter(array $query): int
    {
        return (isset($query['store_id']) && is_numeric($query['store_id']))
            ? (int)$query['store_id']
            : 0;
    }

    /**
     * Retrieve orders based on store filter
     *
     * @param int $storeFilter Store ID filter
     * @return array List of orders
     */
 public function getOrders(int $storeFilter): array
{
    $sql = "
    SELECT DISTINCT
      o.order_id,
      o.order_status,
      o.order_total,
      o.created_at,

      u.user_name       AS customer_name,
      u.user_email      AS customer_email,

      s.store_id,
      s.store_name,
      us.user_name      AS seller_name

    FROM orders o
    JOIN users u        ON o.user_id = u.user_id
    JOIN order_items oi ON o.order_id = oi.order_id
    JOIN products p     ON oi.product_id = p.product_id
    JOIN stores s       ON p.store_id = s.store_id
    JOIN sellers se     ON s.seller_id = se.seller_id
    JOIN users us       ON se.user_id = us.user_id
    ";

    $params = [];

    if ($storeFilter > 0) {
        $sql .= " WHERE s.store_id = ? ";
        $params[] = $storeFilter;
    }

    $sql .= " ORDER BY o.order_id DESC ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($params);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    /**
     * Calculate platform statistics
     *
     * Computes:
     * - Total completed orders
     * - Total sales
     * - Platform profit (commission)
     * - Stores revenue
     *
     * @param array $orders Orders list
     * @return array Statistics data
     */
    public function calculateStats(array $orders): array
    {
        $totalOrders    = 0;
        $totalSales     = 0;
        $platformProfit = 0;
        $storeRevenue   = 0;

        foreach ($orders as $o) {
            if ($o['order_status'] === 'completed') {
                $totalOrders++;
                $totalSales += $o['order_total'];

                $commission = $o['order_total'] * $this->commissionRate;
                $platformProfit += $commission;
                $storeRevenue += ($o['order_total'] - $commission);
            }
        }

        return [
            'totalOrders'    => $totalOrders,
            'totalSales'     => $totalSales,
            'platformProfit' => $platformProfit,
            'storeRevenue'   => $storeRevenue,
        ];
    }
}
