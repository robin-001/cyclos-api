<?php

namespace Angstrom\CyclosApi\Tests\Feature;

use Angstrom\CyclosApi\CyclosApi;
use Angstrom\CyclosApi\Tests\TestCase;

class UserManagementTest extends TestCase
{
    protected CyclosApi $api;

    protected function setUp(): void
    {
        parent::setUp();
        $this->api = $this->app->make(CyclosApi::class);
    }

    public function test_search_users()
    {
        $expectedResponse = [
            'users' => [
                [
                    'id' => 'user1',
                    'name' => 'Test User',
                    'email' => 'test@example.com',
                ],
            ],
        ];

        $this->mockResponse(200, $expectedResponse);

        $response = $this->api->searchUsers(['keywords' => 'test']);

        $this->assertEquals($expectedResponse, $response);
        $request = $this->getLastRequest();
        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/users', $request->getUri()->getPath());
        $this->assertEquals('keywords=test', $request->getUri()->getQuery());
    }

    public function test_get_user()
    {
        $expectedResponse = [
            'id' => 'user123',
            'name' => 'Test User',
            'email' => 'test@example.com',
        ];

        $this->mockResponse(200, $expectedResponse);

        $response = $this->api->getUser('user123');

        $this->assertEquals($expectedResponse, $response);
        $request = $this->getLastRequest();
        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/users/user123', $request->getUri()->getPath());
    }

    public function test_create_user()
    {
        $userData = [
            'name' => 'New User',
            'email' => 'new@example.com',
            'password' => 'password123',
        ];

        $expectedResponse = array_merge(['id' => 'user123'], $userData);

        $this->mockResponse(201, $expectedResponse);

        $response = $this->api->createUser($userData);

        $this->assertEquals($expectedResponse, $response);
        $request = $this->getLastRequest();
        $this->assertEquals('POST', $request->getMethod());
        $this->assertEquals('/users', $request->getUri()->getPath());
        $this->assertEquals(json_encode($userData), (string) $request->getBody());
    }

    public function test_update_user()
    {
        $userData = [
            'name' => 'Updated User',
            'email' => 'updated@example.com',
        ];

        $this->mockResponse(200, $userData);

        $response = $this->api->updateUser('123', $userData);

        $this->assertEquals($userData, $response);
        $request = $this->getLastRequest();
        $this->assertEquals('PUT', $request->getMethod());
        $this->assertEquals('/users/123', $request->getUri()->getPath());
        $this->assertEquals(json_encode($userData), (string) $request->getBody());
    }

    public function test_delete_user()
    {
        $this->mockResponse(204);

        $this->api->deleteUser('123');

        $request = $this->getLastRequest();
        $this->assertEquals('DELETE', $request->getMethod());
        $this->assertEquals('/users/123', $request->getUri()->getPath());
    }

    public function test_get_user_data_for_edit()
    {
        $expectedResponse = [
            'id' => '123',
            'name' => 'Test User',
            'email' => 'test@example.com',
            'groups' => ['users'],
            'customFields' => [],
        ];

        $this->mockResponse(200, $expectedResponse);

        $response = $this->api->getUserDataForEdit('123');

        $this->assertEquals($expectedResponse, $response);
        $request = $this->getLastRequest();
        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/users/123/data-for-edit', $request->getUri()->getPath());
    }
}
