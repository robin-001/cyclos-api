<?php

namespace Angstrom\CyclosApi\Tests\Feature;

use Angstrom\CyclosApi\CyclosApi;
use Angstrom\CyclosApi\Tests\TestCase;

class AccountManagementTest extends TestCase
{
    protected CyclosApi $api;

    protected function setUp(): void
    {
        parent::setUp();
        $this->api = $this->app->make(CyclosApi::class);
    }

    public function test_get_account_status()
    {
        $expectedResponse = [
            'status' => 'active',
            'balance' => 1000.00,
        ];

        $this->mockResponse(200, $expectedResponse);

        $response = $this->api->getAccountStatus('acc123');

        $this->assertEquals($expectedResponse, $response);
        $request = $this->getLastRequest();
        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/accounts/acc123/status', $request->getUri()->getPath());
    }

    public function test_get_account_history()
    {
        $expectedResponse = [
            'transactions' => [
                [
                    'id' => 'tx1',
                    'amount' => 100.00,
                    'date' => '2025-02-01',
                ],
            ],
        ];

        $this->mockResponse(200, $expectedResponse);

        $response = $this->api->getAccountHistory('acc123', ['2025-01-01', '2025-02-01']);

        $this->assertEquals($expectedResponse, $response);
        $request = $this->getLastRequest();
        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/accounts/acc123/history', $request->getUri()->getPath());
    }

    public function test_get_user_accounts()
    {
        $expectedResponse = [
            'accounts' => [
                [
                    'id' => 'acc1',
                    'type' => 'savings',
                ],
            ],
        ];

        $this->mockResponse(200, $expectedResponse);

        $response = $this->api->getUserAccounts('user123');

        $this->assertEquals($expectedResponse, $response);
        $request = $this->getLastRequest();
        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/users/user123/accounts', $request->getUri()->getPath());
    }

    public function test_get_account_balance_limits()
    {
        $expectedResponse = [
            'upperLimit' => 10000.00,
            'lowerLimit' => 0.00,
        ];

        $this->mockResponse(200, $expectedResponse);

        $response = $this->api->getAccountBalanceLimits('acc123');

        $this->assertEquals($expectedResponse, $response);
        $request = $this->getLastRequest();
        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/accounts/acc123/balance-limits', $request->getUri()->getPath());
    }

    public function test_update_account_balance_limits()
    {
        $data = [
            'upperLimit' => 20000.00,
            'lowerLimit' => 100.00,
        ];

        $this->mockResponse(200, $data);

        $response = $this->api->updateAccountBalanceLimits('acc123', $data);

        $this->assertEquals($data, $response);
        $request = $this->getLastRequest();
        $this->assertEquals('PUT', $request->getMethod());
        $this->assertEquals('/accounts/acc123/balance-limits', $request->getUri()->getPath());
        $this->assertEquals(json_encode($data), (string) $request->getBody());
    }

    public function test_search_accounts()
    {
        $expectedResponse = [
            'accounts' => [
                [
                    'id' => 'acc1',
                    'type' => 'savings',
                ],
            ],
        ];

        $this->mockResponse(200, $expectedResponse);

        $response = $this->api->searchAccounts(['type' => 'savings']);

        $this->assertEquals($expectedResponse, $response);
        $request = $this->getLastRequest();
        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/accounts', $request->getUri()->getPath());
        $this->assertEquals('type=savings', $request->getUri()->getQuery());
    }

    public function test_export_account_history()
    {
        $expectedResponse = [
            'downloadUrl' => 'http://test.api.cyclos/export/123.csv',
        ];

        $this->mockResponse(200, $expectedResponse);

        $response = $this->api->exportAccountHistory('acc123', ['2025-01-01', '2025-02-01']);

        $this->assertEquals($expectedResponse, $response);
        $request = $this->getLastRequest();
        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/accounts/acc123/history/export', $request->getUri()->getPath());
    }
}
