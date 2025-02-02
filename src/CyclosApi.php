<?php

namespace Angstrom\CyclosApi;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;
use Angstrom\CyclosApi\Traits\AccountManagementTrait;
use Angstrom\CyclosApi\Traits\AddressManagementTrait;
use Angstrom\CyclosApi\Traits\AuthenticationTrait;
use Angstrom\CyclosApi\Traits\MarketplaceManagementTrait;
use Angstrom\CyclosApi\Traits\MessageManagementTrait;
use Angstrom\CyclosApi\Traits\NotificationManagementTrait;
use Angstrom\CyclosApi\Traits\OperatorManagementTrait;
use Angstrom\CyclosApi\Traits\PaymentManagementTrait;
use Angstrom\CyclosApi\Traits\PhoneManagementTrait;
use Angstrom\CyclosApi\Traits\RecordManagementTrait;
use Angstrom\CyclosApi\Traits\TransactionManagementTrait;
use Angstrom\CyclosApi\Traits\TransferManagementTrait;
use Angstrom\CyclosApi\Traits\UserManagementTrait;

class CyclosApi
{
    use AccountManagementTrait;
    use AddressManagementTrait;
    use AuthenticationTrait;
    use MarketplaceManagementTrait;
    use MessageManagementTrait;
    use NotificationManagementTrait;
    use OperatorManagementTrait;
    use PaymentManagementTrait;
    use PhoneManagementTrait;
    use RecordManagementTrait;
    use TransactionManagementTrait;
    use TransferManagementTrait;
    use UserManagementTrait;

    protected Client $client;
    protected string $baseUrl;
    protected string $apiKey;

    public function __construct(string $baseUrl, string $apiKey, ?HandlerStack $handler = null)
    {
        $this->baseUrl = rtrim($baseUrl, '/');
        $this->apiKey = $apiKey;

        $config = [
            'base_uri' => $this->baseUrl,
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ];

        if ($handler) {
            $config['handler'] = $handler;
        }

        $this->client = new Client($config);
    }

    protected function get(string $endpoint, array $query = []): array
    {
        try {
            $response = $this->client->get($endpoint, [
                RequestOptions::QUERY => $query,
            ]);

            return $this->handleResponse($response);
        } catch (\Exception $e) {
            throw new RuntimeException('API request failed: ' . $e->getMessage());
        }
    }

    protected function post(string $endpoint, array $data = []): array
    {
        try {
            $response = $this->client->post($endpoint, [
                RequestOptions::JSON => $data,
            ]);

            return $this->handleResponse($response);
        } catch (\Exception $e) {
            throw new RuntimeException('API request failed: ' . $e->getMessage());
        }
    }

    protected function put(string $endpoint, array $data = []): array
    {
        try {
            $response = $this->client->put($endpoint, [
                RequestOptions::JSON => $data,
            ]);

            return $this->handleResponse($response);
        } catch (\Exception $e) {
            throw new RuntimeException('API request failed: ' . $e->getMessage());
        }
    }

    protected function delete(string $endpoint): array
    {
        try {
            $response = $this->client->delete($endpoint);

            return $this->handleResponse($response);
        } catch (\Exception $e) {
            throw new RuntimeException('API request failed: ' . $e->getMessage());
        }
    }

    protected function handleResponse(ResponseInterface $response): array
    {
        $contents = $response->getBody()->getContents();

        if (empty($contents)) {
            return ['success' => true];
        }

        $data = json_decode($contents, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new RuntimeException('Failed to parse API response');
        }

        return $data;
    }
}
