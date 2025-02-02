<?php

namespace Angstrom\CyclosApi\Traits;

trait PhoneManagementTrait
{
    /**
     * List user phones
     *
     * @param string $user User identifier
     * @param array $params Query parameters
     * @return array
     */
    public function listUserPhones(string $user, array $params = []): array
    {
        return $this->get("/{$user}/phones", $params);
    }

    /**
     * Create a new phone
     *
     * @param string $user User identifier
     * @param array $data Phone data
     * @return array
     */
    public function createPhone(string $user, array $data): array
    {
        return $this->post("/{$user}/phones", $data);
    }

    /**
     * Update a phone
     *
     * @param string $idOrNumber Phone identifier or number
     * @param array $data Updated phone data
     * @return array
     */
    public function updatePhone(string $idOrNumber, array $data): array
    {
        return $this->put("/phones/{$idOrNumber}", $data);
    }

    /**
     * Delete a phone
     *
     * @param string $idOrNumber Phone identifier or number
     */
    public function deletePhone(string $idOrNumber): void
    {
        $this->delete("/phones/{$idOrNumber}");
    }

    /**
     * Send phone verification code
     *
     * @param string $idOrNumber Phone identifier or number
     * @return array
     */
    public function sendPhoneVerificationCode(string $idOrNumber): array
    {
        return $this->post("/phones/{$idOrNumber}/send-verification-code", []);
    }

    /**
     * Verify phone with code
     *
     * @param string $idOrNumber Phone identifier or number
     * @param string $code Verification code
     */
    public function verifyPhone(string $idOrNumber, string $code): void
    {
        $this->post("/phones/{$idOrNumber}/verify", ['code' => $code]);
    }

    /**
     * Get phone data for new
     *
     * @param string $user User identifier
     * @return array
     */
    public function getPhoneDataForNew(string $user): array
    {
        return $this->get("/{$user}/phones/data-for-new");
    }

    /**
     * Get password input for removing phone
     *
     * @param string $idOrNumber Phone identifier or number
     * @return array
     */
    public function getPasswordInputForRemovePhone(string $idOrNumber): array
    {
        return $this->get("/phones/{$idOrNumber}/password-for-remove");
    }
}
