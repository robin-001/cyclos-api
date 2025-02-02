<?php

namespace Angstrom\CyclosApi\Traits;

trait AddressManagementTrait
{
    /**
     * List user addresses
     *
     * @param string $user User identifier
     * @param array $params Query parameters
     * @return array
     */
    public function listUserAddresses(string $user, array $params = []): array
    {
        return $this->get("/{$user}/addresses", $params);
    }

    /**
     * Create a new address
     *
     * @param string $user User identifier
     * @param array $data Address data
     * @return array
     */
    public function createAddress(string $user, array $data): array
    {
        return $this->post("/{$user}/addresses", $data);
    }

    /**
     * Update an address
     *
     * @param string $id Address identifier
     * @param array $data Updated address data
     * @return array
     */
    public function updateAddress(string $id, array $data): array
    {
        return $this->put("/addresses/{$id}", $data);
    }

    /**
     * Delete an address
     *
     * @param string $id Address identifier
     */
    public function deleteAddress(string $id): void
    {
        $this->delete("/addresses/{$id}");
    }

    /**
     * Get user's primary address
     *
     * @param string $user User identifier
     * @return array
     */
    public function getUserPrimaryAddress(string $user): array
    {
        return $this->get("/{$user}/addresses/primary");
    }

    /**
     * Get address data for edit
     *
     * @param string $id Address identifier
     * @return array
     */
    public function getAddressDataForEdit(string $id): array
    {
        return $this->get("/addresses/{$id}/data-for-edit");
    }

    /**
     * View address details
     *
     * @param string $id Address identifier
     * @return array
     */
    public function viewAddress(string $id): array
    {
        return $this->get("/addresses/{$id}");
    }

    /**
     * Get password input for removing address
     *
     * @param string $id Address identifier
     * @return array
     */
    public function getPasswordInputForRemoveAddress(string $id): array
    {
        return $this->get("/addresses/{$id}/password-for-remove");
    }
}
