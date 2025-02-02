<?php

namespace Angstrom\CyclosApi\Traits;

trait MarketplaceManagementTrait
{
    /**
     * Get data for creating an advertisement
     *
     * @param string $user User identifier
     * @param array $params Query parameters
     * @return array
     */
    public function getDataForCreateAdvertisement(string $user, array $params = []): array
    {
        return $this->get("/users/{$user}/marketplace/data-for-create", $params);
    }

    /**
     * Create an advertisement
     *
     * @param string $user User identifier
     * @param array $data Advertisement data
     * @return array
     */
    public function createAdvertisement(string $user, array $data): array
    {
        return $this->post("/users/{$user}/marketplace", $data);
    }

    /**
     * Search advertisements
     *
     * @param array $params Search parameters
     * @return array
     */
    public function searchAdvertisements(array $params = []): array
    {
        return $this->get("/marketplace", $params);
    }

    /**
     * View advertisement details
     *
     * @param string $adId Advertisement identifier
     * @param array $fields Fields to include in response
     * @return array
     */
    public function viewAdvertisement(string $adId, array $fields = []): array
    {
        return $this->get("/marketplace/{$adId}", ['fields' => $fields]);
    }

    /**
     * Update advertisement
     *
     * @param string $adId Advertisement identifier
     * @param array $data Advertisement data
     * @return array
     */
    public function updateAdvertisement(string $adId, array $data): array
    {
        return $this->put("/marketplace/{$adId}", $data);
    }

    /**
     * Delete advertisement
     *
     * @param string $adId Advertisement identifier
     * @return array
     */
    public function deleteAdvertisement(string $adId): array
    {
        $this->delete("/marketplace/{$adId}");
        return ['success' => true];
    }

    /**
     * Get advertisement categories
     *
     * @param array $params Query parameters
     * @return array
     */
    public function getAdvertisementCategories(array $params = []): array
    {
        return $this->get("/marketplace/categories", $params);
    }

    /**
     * Get advertisement category details
     *
     * @param string $categoryId Category identifier
     * @param array $fields Fields to include in response
     * @return array
     */
    public function getAdvertisementCategory(string $categoryId, array $fields = []): array
    {
        return $this->get("/marketplace/categories/{$categoryId}", ['fields' => $fields]);
    }

    /**
     * Get favorite advertisements
     *
     * @param string $user User identifier
     * @param array $params Query parameters
     * @return array
     */
    public function getFavoriteAdvertisements(string $user, array $params = []): array
    {
        return $this->get("/users/{$user}/marketplace/favorites", $params);
    }

    /**
     * Add advertisement to favorites
     *
     * @param string $user User identifier
     * @param string $adId Advertisement identifier
     * @return array
     */
    public function addAdvertisementToFavorites(string $user, string $adId): array
    {
        $this->post("/users/{$user}/marketplace/favorites/{$adId}", []);
        return ['success' => true];
    }

    /**
     * Remove advertisement from favorites
     *
     * @param string $user User identifier
     * @param string $adId Advertisement identifier
     * @return array
     */
    public function removeAdvertisementFromFavorites(string $user, string $adId): array
    {
        $this->delete("/users/{$user}/marketplace/favorites/{$adId}");
        return ['success' => true];
    }
}
