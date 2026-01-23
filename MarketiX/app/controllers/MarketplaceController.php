<?php

/**
 * Class MarketplaceController
 *
 * Handles all business logic related to the marketplace page,
 * including retrieving stores and resolving store statuses.
 */
class MarketplaceController
{
    private Store $storeModel;

    /**
     * MarketplaceController constructor.
     *
     * @param PDO $pdo Database connection instance
     */
    public function __construct(PDO $pdo)
    {
        $this->storeModel = new Store($pdo);
    }

    /**
     * Retrieve all active stores
     *
     * @return array List of stores
     */
    public function getStores(): array
    {
        return $this->storeModel->getAll();
    }

    /**
     * Resolve store status badge data
     *
     * @param string|null $status Store status
     * @return array Badge class and label
     */
    public function resolveStatus(?string $status): array
    {
        return match ($status ?? 'active') {
            'active'   => ['success', 'Active'],
            'inactive' => ['warning', 'Inactive'],
            'blocked'  => ['danger', 'Blocked'],
            default    => ['secondary', 'Unknown'],
        };
    }
}
