<?php

namespace Angstrom\CyclosApi\Tests\Feature;

use Angstrom\CyclosApi\CyclosApi;
use Angstrom\CyclosApi\Tests\TestCase;

class TransferManagementTest extends TestCase
{
    private CyclosApi $api;

    protected function setUp(): void
    {
        parent::setUp();
        $this->api = $this->app->make(CyclosApi::class);
    }

    public function test_perform_transfer(): void
    {
        $transferData = [
            'amount' => 500.00,
            'description' => 'Test transfer',
            'subject' => 'user456'
        ];

        $expectedResponse = array_merge(['id' => 'tr123'], $transferData);

        $this->mockResponse(201, $expectedResponse);

        $response = $this->api->performTransfer('user123', $transferData);

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals('POST', $this->getLastRequest()->getMethod());
        $this->assertEquals('/users/user123/transfers', $this->getLastRequest()->getUri()->getPath());
    }

    public function test_preview_transfer(): void
    {
        $transferData = [
            'amount' => 500.00,
            'description' => 'Test transfer',
            'subject' => 'user456'
        ];

        $expectedResponse = [
            'fees' => 10.00,
            'totalAmount' => 510.00
        ];

        $this->mockResponse(200, $expectedResponse);

        $response = $this->api->previewTransfer('user123', $transferData);

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals('POST', $this->getLastRequest()->getMethod());
        $this->assertEquals('/users/user123/transfers/preview', $this->getLastRequest()->getUri()->getPath());
    }

    public function test_schedule_transfer(): void
    {
        $transferData = [
            'amount' => 500.00,
            'description' => 'Scheduled transfer',
            'subject' => 'user456',
            'scheduledFor' => '2025-03-01'
        ];

        $expectedResponse = array_merge(['id' => 'str123'], $transferData);

        $this->mockResponse(201, $expectedResponse);

        $response = $this->api->scheduleTransfer('user123', $transferData);

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals('POST', $this->getLastRequest()->getMethod());
        $this->assertEquals('/users/user123/scheduled-transfers', $this->getLastRequest()->getUri()->getPath());
    }

    public function test_search_transfers(): void
    {
        $expectedResponse = [
            'transfers' => [
                [
                    'id' => 'tr123',
                    'amount' => 500.00,
                    'description' => 'Test transfer'
                ]
            ]
        ];

        $this->mockResponse(200, $expectedResponse);

        $response = $this->api->searchTransfers([
            'user' => 'user123',
            'dateRange' => ['2025-01-01', '2025-02-01']
        ]);

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals('GET', $this->getLastRequest()->getMethod());
        $this->assertEquals('/transfers', $this->getLastRequest()->getUri()->getPath());
    }

    public function test_view_transfer(): void
    {
        $expectedResponse = [
            'id' => 'tr123',
            'amount' => 500.00,
            'description' => 'Test transfer',
            'from' => 'user123',
            'to' => 'user456'
        ];

        $this->mockResponse(200, $expectedResponse);

        $response = $this->api->viewTransfer('tr123');

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals('GET', $this->getLastRequest()->getMethod());
        $this->assertEquals('/transfers/tr123', $this->getLastRequest()->getUri()->getPath());
    }

    public function test_cancel_scheduled_transfer(): void
    {
        $this->mockResponse(204);

        $this->api->cancelScheduledTransfer('user123', 'str123');

        $this->assertEquals('DELETE', $this->getLastRequest()->getMethod());
        $this->assertEquals('/users/user123/scheduled-transfers/str123', $this->getLastRequest()->getUri()->getPath());
    }

    public function test_get_transfer_authorization_data(): void
    {
        $expectedResponse = [
            'level' => 'high',
            'requiredAuthorizations' => 2,
            'currentAuthorizations' => 1
        ];

        $this->mockResponse(200, $expectedResponse);

        $response = $this->api->getTransferAuthorizationData('tr123');

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals('GET', $this->getLastRequest()->getMethod());
        $this->assertEquals('/transfers/tr123/authorization-data', $this->getLastRequest()->getUri()->getPath());
    }

    public function test_authorize_transfer(): void
    {
        $authData = [
            'pin' => '1234',
            'comment' => 'Approved'
        ];

        $expectedResponse = [
            'status' => 'authorized'
        ];

        $this->mockResponse(200, $expectedResponse);

        $response = $this->api->authorizeTransfer('tr123', $authData);

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals('POST', $this->getLastRequest()->getMethod());
        $this->assertEquals('/transfers/tr123/authorize', $this->getLastRequest()->getUri()->getPath());
    }

    public function test_get_transfer_installments(): void
    {
        $expectedResponse = [
            'installments' => [
                [
                    'id' => 'inst123',
                    'amount' => 100.00,
                    'dueDate' => '2025-03-01'
                ]
            ]
        ];

        $this->mockResponse(200, $expectedResponse);

        $response = $this->api->getTransferInstallments('tr123');

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals('GET', $this->getLastRequest()->getMethod());
        $this->assertEquals('/transfers/tr123/installments', $this->getLastRequest()->getUri()->getPath());
    }
}
