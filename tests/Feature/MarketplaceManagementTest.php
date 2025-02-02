<?php

namespace Angstrom\CyclosApi\Tests\Feature;

use Angstrom\CyclosApi\CyclosApi;
use Angstrom\CyclosApi\Tests\TestCase;

class MarketplaceManagementTest extends TestCase
{
    private CyclosApi $api;

    protected function setUp(): void
    {
        parent::setUp();
        $this->api = $this->app->make(CyclosApi::class);
    }

    public function test_create_advertisement(): void
    {
        $adData = [
            'title' => 'Test Product',
            'description' => 'Product description',
            'price' => 100.00,
            'category' => 'electronics'
        ];

        $expectedResponse = array_merge(['id' => 'ad123'], $adData);

        $this->mockResponse(201, $expectedResponse);

        $response = $this->api->createAdvertisement('user123', $adData);

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals('POST', $this->getLastRequest()->getMethod());
        $this->assertEquals('/users/user123/marketplace', $this->getLastRequest()->getUri()->getPath());
    }

    public function test_search_advertisements(): void
    {
        $expectedResponse = [
            'advertisements' => [
                [
                    'id' => 'ad123',
                    'title' => 'Test Product',
                    'price' => 100.00
                ]
            ]
        ];

        $this->mockResponse(200, $expectedResponse);

        $response = $this->api->searchAdvertisements([
            'category' => 'electronics',
            'keywords' => 'test'
        ]);

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals('GET', $this->getLastRequest()->getMethod());
        $this->assertEquals('/marketplace', $this->getLastRequest()->getUri()->getPath());
    }

    public function test_view_advertisement(): void
    {
        $expectedResponse = [
            'id' => 'ad123',
            'title' => 'Test Product',
            'description' => 'Product description',
            'price' => 100.00,
            'category' => 'electronics'
        ];

        $this->mockResponse(200, $expectedResponse);

        $response = $this->api->viewAdvertisement('ad123');

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals('GET', $this->getLastRequest()->getMethod());
        $this->assertEquals('/marketplace/ad123', $this->getLastRequest()->getUri()->getPath());
    }

    public function test_update_advertisement(): void
    {
        $adData = [
            'title' => 'Updated Product',
            'price' => 150.00
        ];

        $expectedResponse = array_merge(['id' => 'ad123'], $adData);

        $this->mockResponse(200, $expectedResponse);

        $response = $this->api->updateAdvertisement('ad123', $adData);

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals('PUT', $this->getLastRequest()->getMethod());
        $this->assertEquals('/marketplace/ad123', $this->getLastRequest()->getUri()->getPath());
    }

    public function test_delete_advertisement(): void
    {
        $this->mockResponse(204);

        $this->api->deleteAdvertisement('ad123');

        $this->assertEquals('DELETE', $this->getLastRequest()->getMethod());
        $this->assertEquals('/marketplace/ad123', $this->getLastRequest()->getUri()->getPath());
    }

    public function test_get_advertisement_categories(): void
    {
        $expectedResponse = [
            'categories' => [
                [
                    'id' => 'cat123',
                    'name' => 'Electronics',
                    'description' => 'Electronic products'
                ]
            ]
        ];

        $this->mockResponse(200, $expectedResponse);

        $response = $this->api->getAdvertisementCategories();

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals('GET', $this->getLastRequest()->getMethod());
        $this->assertEquals('/marketplace/categories', $this->getLastRequest()->getUri()->getPath());
    }

    public function test_get_favorite_advertisements(): void
    {
        $expectedResponse = [
            'favorites' => [
                [
                    'id' => 'ad123',
                    'title' => 'Test Product',
                    'price' => 100.00
                ]
            ]
        ];

        $this->mockResponse(200, $expectedResponse);

        $response = $this->api->getFavoriteAdvertisements('user123');

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals('GET', $this->getLastRequest()->getMethod());
        $this->assertEquals('/users/user123/marketplace/favorites', $this->getLastRequest()->getUri()->getPath());
    }

    public function test_add_advertisement_to_favorites(): void
    {
        $this->mockResponse(204);

        $this->api->addAdvertisementToFavorites('user123', 'ad123');

        $this->assertEquals('POST', $this->getLastRequest()->getMethod());
        $this->assertEquals('/users/user123/marketplace/favorites/ad123', $this->getLastRequest()->getUri()->getPath());
    }

    public function test_remove_advertisement_from_favorites(): void
    {
        $this->mockResponse(204);

        $this->api->removeAdvertisementFromFavorites('user123', 'ad123');

        $this->assertEquals('DELETE', $this->getLastRequest()->getMethod());
        $this->assertEquals('/users/user123/marketplace/favorites/ad123', $this->getLastRequest()->getUri()->getPath());
    }
}
