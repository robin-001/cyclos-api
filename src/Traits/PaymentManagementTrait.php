<?php

namespace Angstrom\CyclosApi\Traits;

trait PaymentManagementTrait
{
    /**
     * Get data for performing a payment
     *
     * @param string $fromUser User making the payment
     * @param array $params Query parameters
     * @return array
     */
    public function getDataForPerformPayment(string $fromUser, array $params = []): array
    {
        return $this->get("/users/{$fromUser}/payments/data-for-perform", $params);
    }

    /**
     * Perform a payment
     *
     * @param string $fromUser User making the payment
     * @param array $data Payment data
     * @return array
     */
    public function performPayment(string $fromUser, array $data): array
    {
        return $this->post("/users/{$fromUser}/payments", $data);
    }

    /**
     * Get payment preview
     *
     * @param string $fromUser User making the payment
     * @param array $data Payment data
     * @return array
     */
    public function getPaymentPreview(string $fromUser, array $data): array
    {
        return $this->post("/users/{$fromUser}/payments/preview", $data);
    }

    /**
     * Get data for scheduling a payment
     *
     * @param string $fromUser User scheduling the payment
     * @param array $params Query parameters
     * @return array
     */
    public function getDataForSchedulePayment(string $fromUser, array $params = []): array
    {
        return $this->get("/users/{$fromUser}/scheduled-payments/data-for-schedule", $params);
    }

    /**
     * Schedule a payment
     *
     * @param string $fromUser User scheduling the payment
     * @param array $data Scheduled payment data
     * @return array
     */
    public function schedulePayment(string $fromUser, array $data): array
    {
        return $this->post("/users/{$fromUser}/scheduled-payments", $data);
    }

    /**
     * Cancel a scheduled payment
     *
     * @param string $fromUser User who scheduled the payment
     * @param string $scheduledPaymentId Scheduled payment identifier
     * @return void
     */
    public function cancelScheduledPayment(string $fromUser, string $scheduledPaymentId): void
    {
        $this->delete("/users/{$fromUser}/scheduled-payments/{$scheduledPaymentId}");
    }

    /**
     * Get payment data for search
     *
     * @param array $params Query parameters
     * @return array
     */
    public function getPaymentDataForSearch(array $params = []): array
    {
        return $this->get("/payments/data-for-search", $params);
    }

    /**
     * Search payments
     *
     * @param array $params Search parameters
     * @return array
     */
    public function searchPayments(array $params = []): array
    {
        return $this->get("/payments", $params);
    }

    /**
     * View payment details
     *
     * @param string $paymentId Payment identifier
     * @param array $fields Fields to include in response
     * @return array
     */
    public function viewPayment(string $paymentId, array $fields = []): array
    {
        return $this->get("/payments/{$paymentId}", ['fields' => $fields]);
    }

    /**
     * Get payment installments
     *
     * @param string $paymentId Payment identifier
     * @return array
     */
    public function getPaymentInstallments(string $paymentId): array
    {
        return $this->get("/payments/{$paymentId}/installments");
    }

    /**
     * Get payment authorization data
     *
     * @param string $paymentId Payment identifier
     * @return array
     */
    public function getPaymentAuthorizationData(string $paymentId): array
    {
        return $this->get("/payments/{$paymentId}/authorization-data");
    }

    /**
     * Authorize payment
     *
     * @param string $paymentId Payment identifier
     * @param array $data Authorization data
     * @return array
     */
    public function authorizePayment(string $paymentId, array $data): array
    {
        return $this->post("/payments/{$paymentId}/authorize", $data);
    }

    /**
     * Cancel payment authorization
     *
     * @param string $paymentId Payment identifier
     * @param array $data Cancellation data
     * @return array
     */
    public function cancelPaymentAuthorization(string $paymentId, array $data): array
    {
        return $this->post("/payments/{$paymentId}/cancel-authorization", $data);
    }

    /**
     * Block scheduled payment installment
     *
     * @param string $paymentId Payment identifier
     * @param string $installmentId Installment identifier
     * @param array $data Block data
     * @return array
     */
    public function blockScheduledPaymentInstallment(string $paymentId, string $installmentId, array $data): array
    {
        return $this->post("/payments/{$paymentId}/installments/{$installmentId}/block", $data);
    }

    /**
     * Unblock scheduled payment installment
     *
     * @param string $paymentId Payment identifier
     * @param string $installmentId Installment identifier
     * @param array $data Unblock data
     * @return array
     */
    public function unblockScheduledPaymentInstallment(string $paymentId, string $installmentId, array $data): array
    {
        return $this->post("/payments/{$paymentId}/installments/{$installmentId}/unblock", $data);
    }

    /**
     * Settle payment installment
     *
     * @param string $paymentId Payment identifier
     * @param string $installmentId Installment identifier
     * @param array $data Settlement data
     * @return array
     */
    public function settlePaymentInstallment(string $paymentId, string $installmentId, array $data): array
    {
        return $this->post("/payments/{$paymentId}/installments/{$installmentId}/settle", $data);
    }
}
