<?php

namespace Angstrom\CyclosApi\Traits;

trait TransactionManagementTrait
{
    /**
     * Get data for performing a transaction
     *
     * @param string $user User identifier
     * @param array $params Query parameters
     * @return array
     */
    public function getDataForPerformTransaction(string $user, array $params = []): array
    {
        return $this->get("/users/{$user}/transactions/data-for-perform", $params);
    }

    /**
     * Perform a transaction
     *
     * @param string $user User identifier
     * @param array $data Transaction data
     * @return array
     */
    public function performTransaction(string $user, array $data): array
    {
        return $this->post("/users/{$user}/transactions", $data);
    }

    /**
     * Get transaction preview
     *
     * @param string $user User identifier
     * @param array $data Transaction data
     * @return array
     */
    public function previewTransaction(string $user, array $data): array
    {
        return $this->post("/users/{$user}/transactions/preview", $data);
    }

    /**
     * Get data for searching transactions
     *
     * @param array $params Query parameters
     * @return array
     */
    public function getTransactionDataForSearch(array $params = []): array
    {
        return $this->get("/transactions/data-for-search", $params);
    }

    /**
     * Search transactions
     *
     * @param array $params Search parameters
     * @return array
     */
    public function searchTransactions(array $params = []): array
    {
        return $this->get("/transactions", $params);
    }

    /**
     * View transaction details
     *
     * @param string $transactionId Transaction identifier
     * @param array $fields Fields to include in response
     * @return array
     */
    public function viewTransaction(string $transactionId, array $fields = []): array
    {
        return $this->get("/transactions/{$transactionId}", ['fields' => $fields]);
    }

    /**
     * Get transaction authorization data
     *
     * @param string $transactionId Transaction identifier
     * @return array
     */
    public function getTransactionAuthorizationData(string $transactionId): array
    {
        return $this->get("/transactions/{$transactionId}/authorization-data");
    }

    /**
     * Authorize transaction
     *
     * @param string $transactionId Transaction identifier
     * @param array $data Authorization data
     * @return array
     */
    public function authorizeTransaction(string $transactionId, array $data): array
    {
        return $this->post("/transactions/{$transactionId}/authorize", $data);
    }

    /**
     * Cancel transaction authorization
     *
     * @param string $transactionId Transaction identifier
     * @param array $data Cancellation data
     * @return array
     */
    public function cancelTransactionAuthorization(string $transactionId, array $data): array
    {
        return $this->post("/transactions/{$transactionId}/cancel-authorization", $data);
    }

    /**
     * Get transaction fees
     *
     * @param string $transactionId Transaction identifier
     * @return array
     */
    public function getTransactionFees(string $transactionId): array
    {
        return $this->get("/transactions/{$transactionId}/fees");
    }

    /**
     * Get transaction occurrences
     *
     * @param string $transactionId Transaction identifier
     * @return array
     */
    public function getTransactionOccurrences(string $transactionId): array
    {
        return $this->get("/transactions/{$transactionId}/occurrences");
    }

    /**
     * Process bulk transactions
     *
     * @param array $data Bulk transaction data
     * @return array
     */
    public function processBulkTransactions(array $data): array
    {
        return $this->post("/transactions/bulk", $data);
    }

    /**
     * Get bulk transaction status
     *
     * @param string $bulkId Bulk transaction identifier
     * @return array
     */
    public function getBulkTransactionStatus(string $bulkId): array
    {
        return $this->get("/transactions/bulk/{$bulkId}/status");
    }

    /**
     * Cancel bulk transaction
     *
     * @param string $bulkId Bulk transaction identifier
     * @return void
     */
    public function cancelBulkTransaction(string $bulkId): void
    {
        $this->delete("/transactions/bulk/{$bulkId}");
    }

    /**
     * Export transactions
     *
     * @param string $format Export format (e.g., 'csv', 'xlsx')
     * @param array $params Export parameters
     * @return array
     */
    public function exportTransactions(string $format, array $params = []): array
    {
        return $this->get("/transactions/export/{$format}", $params);
    }

    /**
     * Get transaction categories
     *
     * @param array $params Query parameters
     * @return array
     */
    public function getTransactionCategories(array $params = []): array
    {
        return $this->get("/transaction-categories", $params);
    }

    /**
     * Get transaction category details
     *
     * @param string $categoryId Category identifier
     * @param array $fields Fields to include in response
     * @return array
     */
    public function getTransactionCategory(string $categoryId, array $fields = []): array
    {
        return $this->get("/transaction-categories/{$categoryId}", ['fields' => $fields]);
    }

    /**
     * Get transaction flow settings
     *
     * @param array $params Query parameters
     * @return array
     */
    public function getTransactionFlowSettings(array $params = []): array
    {
        return $this->get("/transaction-flow-settings", $params);
    }

    /**
     * Get transaction custom fields
     *
     * @param array $params Query parameters
     * @return array
     */
    public function getTransactionCustomFields(array $params = []): array
    {
        return $this->get("/transaction-custom-fields", $params);
    }
}
