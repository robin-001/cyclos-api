<?php

namespace Angstrom\CyclosApi\Traits;

trait MessageManagementTrait
{
    /**
     * Get data for sending a message
     *
     * @param string $user User identifier
     * @param array $params Query parameters
     * @return array
     */
    public function getDataForSendMessage(string $user, array $params = []): array
    {
        return $this->get("/users/{$user}/messages/data-for-send", $params);
    }

    /**
     * Send a message
     *
     * @param string $user User identifier
     * @param array $data Message data
     * @return array
     */
    public function sendMessage(string $user, array $data): array
    {
        return $this->post("/users/{$user}/messages", $data);
    }

    /**
     * Search messages
     *
     * @param string $user User identifier
     * @param array $params Search parameters
     * @return array
     */
    public function searchMessages(string $user, array $params = []): array
    {
        return $this->get("/users/{$user}/messages", $params);
    }

    /**
     * View message details
     *
     * @param string $user User identifier
     * @param string $messageId Message identifier
     * @param array $fields Fields to include in response
     * @return array
     */
    public function viewMessage(string $user, string $messageId, array $fields = []): array
    {
        return $this->get("/users/{$user}/messages/{$messageId}", ['fields' => $fields]);
    }

    /**
     * Mark message as read
     *
     * @param string $user User identifier
     * @param string $messageId Message identifier
     * @return void
     */
    public function markMessageAsRead(string $user, string $messageId): void
    {
        $this->post("/users/{$user}/messages/{$messageId}/mark-as-read", []);
    }

    /**
     * Mark all messages as read
     *
     * @param string $user User identifier
     * @return void
     */
    public function markAllMessagesAsRead(string $user): void
    {
        $this->post("/users/{$user}/messages/mark-all-as-read", []);
    }

    /**
     * Remove message
     *
     * @param string $user User identifier
     * @param string $messageId Message identifier
     * @return void
     */
    public function removeMessage(string $user, string $messageId): void
    {
        $this->delete("/users/{$user}/messages/{$messageId}");
    }

    /**
     * Remove all messages
     *
     * @param string $user User identifier
     * @return void
     */
    public function removeAllMessages(string $user): void
    {
        $this->delete("/users/{$user}/messages");
    }

    /**
     * Get message categories
     *
     * @param array $params Query parameters
     * @return array
     */
    public function getMessageCategories(array $params = []): array
    {
        return $this->get("/message-categories", $params);
    }
}
