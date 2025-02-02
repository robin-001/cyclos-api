<?php

namespace Angstrom\CyclosApi\Traits;

trait AccountManagementTrait
{
    /**
     * Get account status
     *
     * @param string $accountId Account identifier
     * @return array
     */
    public function getAccountStatus(string $accountId): array
    {
        return $this->get("/accounts/{$accountId}/status");
    }

    /**
     * Get account history
     *
     * @param string $accountId Account identifier
     * @param array $params Query parameters
     * @return array
     */
    public function getAccountHistory(string $accountId, array $params = []): array
    {
        return $this->get("/accounts/{$accountId}/history", $params);
    }

    /**
     * Get user accounts
     *
     * @param string $userId User identifier
     * @return array
     */
    public function getUserAccounts(string $userId): array
    {
        return $this->get("/users/{$userId}/accounts");
    }

    /**
     * Get account balance limits
     *
     * @param string $accountId Account identifier
     * @return array
     */
    public function getAccountBalanceLimits(string $accountId): array
    {
        return $this->get("/accounts/{$accountId}/balance-limits");
    }

    /**
     * Update account balance limits
     *
     * @param string $accountId Account identifier
     * @param array $data Balance limit data
     * @return array
     */
    public function updateAccountBalanceLimits(string $accountId, array $data): array
    {
        return $this->put("/accounts/{$accountId}/balance-limits", $data);
    }

    /**
     * Get account payment limits
     *
     * @param string $accountId Account identifier
     * @return array
     */
    public function getAccountPaymentLimits(string $accountId): array
    {
        return $this->get("/accounts/{$accountId}/payment-limits");
    }

    /**
     * Update account payment limits
     *
     * @param string $accountId Account identifier
     * @param array $data Payment limit data
     * @return array
     */
    public function updateAccountPaymentLimits(string $accountId, array $data): array
    {
        return $this->put("/accounts/{$accountId}/payment-limits", $data);
    }

    /**
     * Get account data for search
     *
     * @param array $params Query parameters
     * @return array
     */
    public function getAccountDataForSearch(array $params = []): array
    {
        return $this->get("/accounts/data-for-search", $params);
    }

    /**
     * Search accounts
     *
     * @param array $params Search parameters
     * @return array
     */
    public function searchAccounts(array $params = []): array
    {
        return $this->get("/accounts", $params);
    }

    /**
     * Export account history
     *
     * @param string $accountId Account identifier
     * @param array $dateRange Date range
     * @return array
     */
    public function exportAccountHistory(string $accountId, array $dateRange): array
    {
        $params = [
            'dateRange' => implode(',', $dateRange),
            'format' => 'csv'
        ];
        return $this->get("/accounts/{$accountId}/history/export", $params);
    }
}
