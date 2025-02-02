<?php

namespace Angstrom\CyclosApi\Traits;

trait UserManagementTrait
{
    /**
     * Search for users
     *
     * @param array $params Search parameters
     * @return array
     */
    public function searchUsers(array $params = []): array
    {
        return $this->get('/users', $params);
    }

    /**
     * Get user details
     *
     * @param string $userId User identifier
     * @return array
     */
    public function getUser(string $userId): array
    {
        return $this->get("/users/{$userId}");
    }

    /**
     * Create a new user
     *
     * @param array $data User data
     * @return array
     */
    public function createUser(array $data): array
    {
        return $this->post('/users', $data);
    }

    /**
     * View user details
     *
     * @param string $user User identifier
     * @param array $fields Fields to include in the response
     * @return array
     */
    public function viewUser(string $user, array $fields = []): array
    {
        return $this->get("/users/{$user}", ['fields' => $fields]);
    }

    /**
     * Update user details
     *
     * @param string $user User identifier
     * @param array $data Updated user data
     * @return array
     */
    public function updateUser(string $user, array $data): array
    {
        return $this->put("/users/{$user}", $data);
    }

    /**
     * Delete a pending user
     *
     * @param string $user User identifier
     */
    public function deletePendingUser(string $user): void
    {
        $this->delete("/users/{$user}");
    }

    /**
     * Delete a user
     *
     * @param string $userId User identifier
     * @return array
     */
    public function deleteUser(string $userId): array
    {
        $this->delete("/users/{$userId}");
        return ['success' => true];
    }

    /**
     * Get user data for search
     *
     * @return array
     */
    public function getUserDataForSearch(): array
    {
        return $this->get('/users/data-for-search');
    }

    /**
     * Get user data for new user registration
     *
     * @return array
     */
    public function getUserDataForNew(): array
    {
        return $this->get('/users/data-for-new');
    }

    /**
     * Get user data for edit
     *
     * @param string $userId User identifier
     * @return array
     */
    public function getUserDataForEdit(string $userId): array
    {
        return $this->get("/users/{$userId}/data-for-edit");
    }

    /**
     * Get groups for user registration
     *
     * @return array
     */
    public function getGroupsForUserRegistration(): array
    {
        return $this->get('/users/groups-for-registration');
    }

    /**
     * Validate user registration field
     *
     * @param string $group Group identifier
     * @param string $field Field name
     * @param array $params Validation parameters
     * @return array
     */
    public function validateUserRegistrationField(string $group, string $field, array $params = []): array
    {
        return $this->get("/users/validate/{$group}/{$field}", $params);
    }
}
