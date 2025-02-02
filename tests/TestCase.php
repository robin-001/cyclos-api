<?php

namespace Angstrom\CyclosApi\Tests;

use Angstrom\CyclosApi\CyclosApiServiceProvider;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected MockHandler $mockHandler;
    protected HandlerStack $handlerStack;
    protected array $requestHistory = [];

    protected function setUp(): void
    {
        parent::setUp();

        $this->mockHandler = new MockHandler();
        $this->handlerStack = HandlerStack::create($this->mockHandler);

        // Add history middleware to track requests
        $history = Middleware::history($this->requestHistory);
        $this->handlerStack->push($history);

        // Bind the handler stack to the container
        $this->app->instance('cyclos.handler', $this->handlerStack);

        $this->app->bind(Client::class, function () {
            return new Client([
                'handler' => $this->handlerStack,
                'base_uri' => config('cyclos.api_url'),
                'headers' => [
                    'Authorization' => 'Bearer ' . config('cyclos.api_key'),
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
            ]);
        });
    }

    protected function getPackageProviders($app)
    {
        return [
            CyclosApiServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app)
    {
        $app['config']->set('cyclos.api_url', 'http://test.api.cyclos');
        $app['config']->set('cyclos.api_key', 'test-api-key');
    }

    protected function mockResponse($status, $body = [], $headers = [])
    {
        $response = new Response(
            $status,
            array_merge(['Content-Type' => 'application/json'], $headers),
            $body ? json_encode($body) : null
        );
        $this->mockHandler->append($response);
    }

    protected function getLastRequest()
    {
        if (empty($this->requestHistory)) {
            return null;
        }
        return end($this->requestHistory)['request'];
    }
}
