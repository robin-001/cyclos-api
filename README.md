# Cyclos API Laravel Package

A Laravel package that provides a clean and intuitive way to interact with the Cyclos API.

## Features

- Full Cyclos API support
- Laravel integration
- Type-safe methods
- Comprehensive test coverage
- Easy configuration

## Installation

You can install the package via composer:

```bash
composer require angstrom/cyclos-api
```

## Configuration

Publish the configuration file:

```bash
php artisan vendor:publish --provider="Angstrom\CyclosApi\CyclosApiServiceProvider"
```

Add the following environment variables to your `.env` file:

```env
CYCLOS_API_URL=your-cyclos-api-url
CYCLOS_API_KEY=your-api-key
```

## Usage

### Using the Facade

```php
use Angstrom\CyclosApi\Facades\CyclosApi;

// Authentication
$response = CyclosApi::login([
    'username' => 'user',
    'password' => 'password'
]);

// User Management
$users = CyclosApi::searchUsers([
    'keywords' => 'john',
    'groups' => ['customers']
]);

// Account Management
$balance = CyclosApi::getAccountStatus('account123');
$history = CyclosApi::getAccountHistory('account123', [
    'datePeriod' => ['begin' => '2023-01-01', 'end' => '2023-12-31']
]);

// Marketplace
$ads = CyclosApi::searchAdvertisements([
    'keywords' => 'electronics',
    'categories' => ['tech']
]);
```

### Using Dependency Injection

```php
use Angstrom\CyclosApi\CyclosApi;

class YourController extends Controller
{
    public function __construct(private CyclosApi $api)
    {
    }

    public function getUsers()
    {
        return $this->api->searchUsers([
            'status' => 'active'
        ]);
    }
}
```

## Available Methods

The package includes comprehensive traits for different Cyclos functionalities:

- Authentication (login, logout, password management)
- User Management (search, create, update, delete users)
- Account Management (balances, history, transfers)
- Marketplace Management (advertisements, favorites)
- Payment Management
- Transaction Management
- Message Management
- And more...

## Testing

```bash
composer test
```

## Security

If you discover any security-related issues, please email security@angstrom.dev instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
