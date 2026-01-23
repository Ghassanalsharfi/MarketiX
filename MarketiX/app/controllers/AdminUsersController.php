<?php

/**
 * Class AdminUsersController
 *
 * Handles administrative user management logic such as:
 * - Filtering users by status and role
 * - Fetching users list for admin panel
 */
class AdminUsersController
{
    private PDO $pdo;

    /**
     * AdminUsersController constructor.
     *
     * @param PDO $pdo Database connection instance
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Resolve filters from GET request
     *
     * @param array $query
     * @return array{status:string, role:string}
     */
    public function getFilters(array $query): array
    {
        return [
            'status' => $query['status'] ?? 'all',
            'role'   => $query['role']   ?? 'all',
        ];
    }

    /**
     * Retrieve users list based on filters
     *
     * @param string $statusFilter
     * @param string $roleFilter
     * @return array
     */
    public function getUsers(string $statusFilter, string $roleFilter): array
    {
        $where  = [];
        $params = [];

        if ($statusFilter === 'active') {
            $where[] = "user_status = 'active'";
        }

        if ($statusFilter === 'blocked') {
            $where[] = "(user_status = 'blocked' OR user_status IS NULL)";
        }

        if ($roleFilter !== 'all') {
            $where[]  = "user_role = ?";
            $params[] = $roleFilter;
        }

        $sql = "
            SELECT user_id, user_name, user_email, user_role, user_status, created_at
            FROM users
        ";

        if (!empty($where)) {
            $sql .= " WHERE " . implode(" AND ", $where);
        }

        $sql .= " ORDER BY created_at DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
