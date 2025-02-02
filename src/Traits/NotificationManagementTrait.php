<?php

namespace Angstrom\CyclosApi\Traits;

trait NotificationManagementTrait
{
    /**
     * Get user notifications
     *
     * @param string $user User identifier
     * @param array $params Query parameters
     * @return array
     */
    public function getUserNotifications(string $user, array $params = []): array
    {
        return $this->get("/users/{$user}/notifications", $params);
    }

    /**
     * Get notification settings
     *
     * @param string $user User identifier
     * @return array
     */
    public function getNotificationSettings(string $user): array
    {
        return $this->get("/users/{$user}/notification-settings");
    }

    /**
     * Update notification settings
     *
     * @param string $user User identifier
     * @param array $data Notification settings data
     * @return array
     */
    public function updateNotificationSettings(string $user, array $data): array
    {
        return $this->put("/users/{$user}/notification-settings", $data);
    }

    /**
     * Mark notification as read
     *
     * @param string $user User identifier
     * @param string $notificationId Notification identifier
     * @return void
     */
    public function markNotificationAsRead(string $user, string $notificationId): void
    {
        $this->post("/users/{$user}/notifications/{$notificationId}/mark-as-read", []);
    }

    /**
     * Mark all notifications as read
     *
     * @param string $user User identifier
     * @return void
     */
    public function markAllNotificationsAsRead(string $user): void
    {
        $this->post("/users/{$user}/notifications/mark-all-as-read", []);
    }

    /**
     * Remove notification
     *
     * @param string $user User identifier
     * @param string $notificationId Notification identifier
     * @return void
     */
    public function removeNotification(string $user, string $notificationId): void
    {
        $this->delete("/users/{$user}/notifications/{$notificationId}");
    }

    /**
     * Remove all notifications
     *
     * @param string $user User identifier
     * @return void
     */
    public function removeAllNotifications(string $user): void
    {
        $this->delete("/users/{$user}/notifications");
    }
}
