<?php

namespace Angstrom\CyclosApi\Traits;

trait OperatorManagementTrait
{
    /**
     * Search operators
     *
     * @param array $params Search parameters
     * @return array
     */
    public function searchOperators(array $params = []): array
    {
        return $this->get('/operators', $params);
    }

    /**
     * Register a new operator
     *
     * @param string $user User identifier
     * @param array $data Operator data
     * @return array
     */
    public function registerOperator(string $user, array $data): array
    {
        return $this->post("/{$user}/operators", $data);
    }

    /**
     * Get operator data for search
     *
     * @param string $user User identifier
     * @return array
     */
    public function getUserOperatorsDataForSearch(string $user): array
    {
        return $this->get("/{$user}/operators/data-for-search");
    }

    /**
     * Search user operators
     *
     * @param string $user User identifier
     * @param array $params Search parameters
     * @return array
     */
    public function searchUserOperators(string $user, array $params = []): array
    {
        return $this->get("/{$user}/operators", $params);
    }

    /**
     * Get operator data for new registration
     *
     * @param string $user User identifier
     * @return array
     */
    public function getOperatorDataForNew(string $user): array
    {
        return $this->get("/{$user}/operators/data-for-new");
    }

    /**
     * List operator groups by user
     *
     * @param string $user User identifier
     * @return array
     */
    public function listOperatorGroupsByUser(string $user): array
    {
        return $this->get("/{$user}/operator-groups");
    }

    /**
     * Create operator group
     *
     * @param string $user User identifier
     * @param array $data Group data
     * @return array
     */
    public function createOperatorGroup(string $user, array $data): array
    {
        return $this->post("/{$user}/operator-groups", $data);
    }

    /**
     * View operator group
     *
     * @param string $id Group identifier
     * @return array
     */
    public function viewOperatorGroup(string $id): array
    {
        return $this->get("/operator-groups/{$id}");
    }

    /**
     * Update operator group
     *
     * @param string $id Group identifier
     * @param array $data Updated group data
     * @return array
     */
    public function updateOperatorGroup(string $id, array $data): array
    {
        return $this->put("/operator-groups/{$id}", $data);
    }

    /**
     * Delete operator group
     *
     * @param string $id Group identifier
     */
    public function deleteOperatorGroup(string $id): void
    {
        $this->delete("/operator-groups/{$id}");
    }
}
