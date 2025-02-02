<?php

namespace Angstrom\CyclosApi\Tests\Feature;

use Angstrom\CyclosApi\CyclosApi;
use Angstrom\CyclosApi\Tests\TestCase;

class TransactionManagementTest extends TestCase
{
    private CyclosApi $api;

    protected function setUp(): void
    {
        parent::setUp();
        $this->api = $this->app->make(CyclosApi::class);
    }

    public function test_perform_transaction(): void
    {
        $transactionData = [
            'amount' => 100.00,
            'description' => 'Test transaction',
            'type' => 'payment'
        ];

        $expectedResponse = array_merge(['id' => 'tx123'], $transactionData);

        $this->mockResponse(201, $expectedResponse);

        $response = $this->api->performTransaction('user123', $transactionData);

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals('POST', $this->getLastRequest()->getMethod());
        $this->assertEquals('/users/user123/transactions', $this->getLastRequest()->getUri()->getPath());
    }

    public function test_get_transaction_preview(): void
    {
        $transactionData = [
            'amount' => 100.00,
            'description' => 'Test transaction',
            'type' => 'payment'
        ];

        $expectedResponse = [
            'fees' => 5.00,
            'totalAmount' => 105.00
        ];

        $this->mockResponse(200, $expectedResponse);

        $response = $this->api->previewTransaction('user123', $transactionData);

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals('POST', $this->getLastRequest()->getMethod());
        $this->assertEquals('/users/user123/transactions/preview', $this->getLastRequest()->getUri()->getPath());
    }

    public function test_search_transactions(): void
    {
        $expectedResponse = [
            'transactions' => [
                [
                    'id' => 'tx123',
                    'amount' => 100.00,
                    'type' => 'payment'
                ]
            ]
        ];

        $this->mockResponse(200, $expectedResponse);

        $response = $this->api->searchTransactions([
            'user' => 'user123',
            'dateRange' => ['2025-01-01', '2025-02-01']
        ]);

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals('GET', $this->getLastRequest()->getMethod());
        $this->assertEquals('/transactions', $this->getLastRequest()->getUri()->getPath());
    }

    public function test_view_transaction(): void
    {
        $expectedResponse = [
            'id' => 'tx123',
            'amount' => 100.00,
            'type' => 'payment',
            'description' => 'Test transaction'
        ];

        $this->mockResponse(200, $expectedResponse);

        $response = $this->api->viewTransaction('tx123');

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals('GET', $this->getLastRequest()->getMethod());
        $this->assertEquals('/transactions/tx123', $this->getLastRequest()->getUri()->getPath());
    }

    public function test_process_bulk_transactions(): void
    {
        $bulkData = [
            'transactions' => [
                [
                    'amount' => 100.00,
                    'description' => 'Bulk transaction 1',
                    'type' => 'payment'
                ],
                [
                    'amount' => 200.00,
                    'description' => 'Bulk transaction 2',
                    'type' => 'payment'
                ]
            ]
        ];

        $expectedResponse = [
            'bulkId' => 'bulk123',
            'status' => 'processing'
        ];

        $this->mockResponse(202, $expectedResponse);

        $response = $this->api->processBulkTransactions($bulkData);

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals('POST', $this->getLastRequest()->getMethod());
        $this->assertEquals('/transactions/bulk', $this->getLastRequest()->getUri()->getPath());
    }

    public function test_get_bulk_transaction_status(): void
    {
        $expectedResponse = [
            'bulkId' => 'bulk123',
            'status' => 'completed',
            'processedCount' => 2,
            'totalCount' => 2
        ];

        $this->mockResponse(200, $expectedResponse);

        $response = $this->api->getBulkTransactionStatus('bulk123');

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals('GET', $this->getLastRequest()->getMethod());
        $this->assertEquals('/transactions/bulk/bulk123/status', $this->getLastRequest()->getUri()->getPath());
    }

    public function test_get_transaction_categories(): void
    {
        $expectedResponse = [
            'categories' => [
                [
                    'id' => 'cat123',
                    'name' => 'Payments',
                    'description' => 'Payment transactions'
                ]
            ]
        ];

        $this->mockResponse(200, $expectedResponse);

        $response = $this->api->getTransactionCategories();

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals('GET', $this->getLastRequest()->getMethod());
        $this->assertEquals('/transaction-categories', $this->getLastRequest()->getUri()->getPath());
    }

    public function test_export_transactions(): void
    {
        $expectedResponse = [
            'downloadUrl' => 'https://example.com/download/transactions.csv'
        ];

        $this->mockResponse(200, $expectedResponse);

        $response = $this->api->exportTransactions('csv', [
            'dateRange' => ['2025-01-01', '2025-02-01']
        ]);

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals('GET', $this->getLastRequest()->getMethod());
        $this->assertEquals('/transactions/export/csv', $this->getLastRequest()->getUri()->getPath());
    }
}
