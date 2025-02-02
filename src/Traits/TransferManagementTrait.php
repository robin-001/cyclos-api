<?php

namespace Angstrom\CyclosApi\Traits;

trait TransferManagementTrait
{
    /**
     * Get data for performing a transfer
     *
     * @param string $user User identifier
     * @param array $params Query parameters
     * @return array
     */
    public function getDataForPerformTransfer(string $user, array $params = []): array
    {
        return $this->get("/users/{$user}/transfers/data-for-perform", $params);
    }

    /**
     * Perform a transfer
     *
     * @param string $user User identifier
     * @param array $data Transfer data
     * @return array
     */
    public function performTransfer(string $user, array $data): array
    {
        return $this->post("/users/{$user}/transfers", $data);
    }

    /**
     * Preview a transfer
     *
     * @param string $user User identifier
     * @param array $data Transfer data
     * @return array
     */
    public function previewTransfer(string $user, array $data): array
    {
        return $this->post("/users/{$user}/transfers/preview", $data);
    }

    /**
     * Get data for scheduling a transfer
     *
     * @param string $user User identifier
     * @param array $params Query parameters
     * @return array
     */
    public function getDataForScheduleTransfer(string $user, array $params = []): array
    {
        return $this->get("/users/{$user}/scheduled-transfers/data-for-schedule", $params);
    }

    /**
     * Schedule a transfer
     *
     * @param string $user User identifier
     * @param array $data Scheduled transfer data
     * @return array
     */
    public function scheduleTransfer(string $user, array $data): array
    {
        return $this->post("/users/{$user}/scheduled-transfers", $data);
    }

    /**
     * Get data for searching transfers
     *
     * @param array $params Query parameters
     * @return array
     */
    public function getTransferDataForSearch(array $params = []): array
    {
        return $this->get("/transfers/data-for-search", $params);
    }

    /**
     * Search transfers
     *
     * @param array $params Search parameters
     * @return array
     */
    public function searchTransfers(array $params = []): array
    {
        return $this->get("/transfers", $params);
    }

    /**
     * View transfer details
     *
     * @param string $transferId Transfer identifier
     * @param array $fields Fields to include in response
     * @return array
     */
    public function viewTransfer(string $transferId, array $fields = []): array
    {
        return $this->get("/transfers/{$transferId}", ['fields' => $fields]);
    }

    /**
     * Cancel a scheduled transfer
     *
     * @param string $user User identifier
     * @param string $transferId Transfer identifier
     * @return void
     */
    public function cancelScheduledTransfer(string $user, string $transferId): void
    {
        $this->delete("/users/{$user}/scheduled-transfers/{$transferId}");
    }

    /**
     * Get transfer authorization data
     *
     * @param string $transferId Transfer identifier
     * @return array
     */
    public function getTransferAuthorizationData(string $transferId): array
    {
        return $this->get("/transfers/{$transferId}/authorization-data");
    }

    /**
     * Authorize a transfer
     *
     * @param string $transferId Transfer identifier
     * @param array $data Authorization data
     * @return array
     */
    public function authorizeTransfer(string $transferId, array $data): array
    {
        return $this->post("/transfers/{$transferId}/authorize", $data);
    }

    /**
     * Cancel transfer authorization
     *
     * @param string $transferId Transfer identifier
     * @param array $data Cancellation data
     * @return array
     */
    public function cancelTransferAuthorization(string $transferId, array $data): array
    {
        return $this->post("/transfers/{$transferId}/cancel-authorization", $data);
    }

    /**
     * Get transfer installments
     *
     * @param string $transferId Transfer identifier
     * @return array
     */
    public function getTransferInstallments(string $transferId): array
    {
        return $this->get("/transfers/{$transferId}/installments");
    }

    /**
     * Block a transfer installment
     *
     * @param string $transferId Transfer identifier
     * @param string $installmentId Installment identifier
     * @param array $data Block data
     * @return array
     */
    public function blockTransferInstallment(string $transferId, string $installmentId, array $data): array
    {
        return $this->post("/transfers/{$transferId}/installments/{$installmentId}/block", $data);
    }

    /**
     * Unblock a transfer installment
     *
     * @param string $transferId Transfer identifier
     * @param string $installmentId Installment identifier
     * @param array $data Unblock data
     * @return array
     */
    public function unblockTransferInstallment(string $transferId, string $installmentId, array $data): array
    {
        return $this->post("/transfers/{$transferId}/installments/{$installmentId}/unblock", $data);
    }

    /**
     * Settle a transfer installment
     *
     * @param string $transferId Transfer identifier
     * @param string $installmentId Installment identifier
     * @param array $data Settlement data
     * @return array
     */
    public function settleTransferInstallment(string $transferId, string $installmentId, array $data): array
    {
        return $this->post("/transfers/{$transferId}/installments/{$installmentId}/settle", $data);
    }

    /**
     * Export transfers
     *
     * @param string $format Export format (e.g., 'csv', 'xlsx')
     * @param array $params Export parameters
     * @return array
     */
    public function exportTransfers(string $format, array $params = []): array
    {
        return $this->get("/transfers/export/{$format}", $params);
    }
}
