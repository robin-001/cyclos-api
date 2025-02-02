<?php

namespace Angstrom\CyclosApi\Tests\Feature;

use Angstrom\CyclosApi\CyclosApi;
use Angstrom\CyclosApi\Tests\TestCase;

class AuthenticationTest extends TestCase
{
    protected CyclosApi $api;

    protected function setUp(): void
    {
        parent::setUp();
        $this->api = $this->app->make(CyclosApi::class);
    }

    public function test_login()
    {
        $expectedResponse = [
            'token' => 'test-token',
            'user' => ['id' => 'user123']
        ];

        $this->mockResponse(200, $expectedResponse);

        $response = $this->api->login(['username' => 'test', 'password' => 'test']);

        $this->assertEquals($expectedResponse, $response);
        $request = $this->getLastRequest();
        $this->assertEquals('POST', $request->getMethod());
        $this->assertEquals('/auth/session', $request->getUri()->getPath());
    }

    public function test_logout()
    {
        $this->mockResponse(200, ['success' => true]);

        $response = $this->api->logout();

        $this->assertEquals(['success' => true], $response);
        $request = $this->getLastRequest();
        $this->assertEquals('DELETE', $request->getMethod());
        $this->assertEquals('/auth/session', $request->getUri()->getPath());
    }

    public function test_get_current_auth()
    {
        $expectedResponse = [
            'user' => ['id' => 'user123']
        ];

        $this->mockResponse(200, $expectedResponse);

        $response = $this->api->getCurrentAuth();

        $this->assertEquals($expectedResponse, $response);
        $request = $this->getLastRequest();
        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/auth', $request->getUri()->getPath());
    }

    public function test_forgot_password()
    {
        $expectedResponse = ['success' => true];

        $this->mockResponse(200, $expectedResponse);

        $response = $this->api->forgotPassword(['email' => 'test@example.com']);

        $this->assertEquals($expectedResponse, $response);
        $request = $this->getLastRequest();
        $this->assertEquals('POST', $request->getMethod());
        $this->assertEquals('/auth/forgot-password', $request->getUri()->getPath());
    }

    public function test_reset_password()
    {
        $expectedResponse = ['success' => true];

        $this->mockResponse(200, $expectedResponse);

        $response = $this->api->resetPassword('token123', ['password' => 'newpass']);

        $this->assertEquals($expectedResponse, $response);
        $request = $this->getLastRequest();
        $this->assertEquals('POST', $request->getMethod());
        $this->assertEquals('/auth/reset-password/token123', $request->getUri()->getPath());
    }
}
