<?php

namespace Angstrom\CyclosApi\Traits;

trait AuthenticationTrait
{
    /**
     * Login with credentials
     *
     * @param array $credentials Login credentials
     * @return array
     */
    public function login(array $credentials): array
    {
        return $this->post("/auth/session", $credentials);
    }

    /**
     * Logout current session
     *
     * @return array
     */
    public function logout(): array
    {
        return $this->delete("/auth/session") ?? ['success' => true];
    }

    /**
     * Get current authentication status
     *
     * @return array
     */
    public function getCurrentAuth(): array
    {
        return $this->get("/auth");
    }

    /**
     * Request password reset
     *
     * @param array $data Password reset request data
     * @return array
     */
    public function forgotPassword(array $data): array
    {
        return $this->post("/auth/forgot-password", $data);
    }

    /**
     * Reset password
     *
     * @param string $token Password reset token
     * @param array $data New password data
     * @return array
     */
    public function resetPassword(string $token, array $data): array
    {
        return $this->post("/auth/reset-password/{$token}", $data);
    }

    /**
     * Get session properties
     *
     * @return array
     */
    public function getSessionProperties(): array
    {
        return $this->get('/auth/session');
    }

    /**
     * Replace session token
     *
     * @param string $sessionToken
     * @return array
     */
    public function replaceSession(string $sessionToken): array
    {
        return $this->post("/auth/session/replace/{$sessionToken}", []);
    }
}
