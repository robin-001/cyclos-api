# Cyclos API Laravel Package

This Laravel package provides a convenient way to interact with the Cyclos API.

## Installation

You can install the package via composer:

```bash
composer require robinson/cyclos-api
```

## Configuration

Publish the configuration file:

```bash
php artisan vendor:publish --provider="Robinson\CyclosApi\CyclosApiServiceProvider"
```

Add the following environment variables to your `.env` file:

```env
CYCLOS_API_URL=http://13.61.126.103:8080/cyclos/api
CYCLOS_API_KEY=your-api-key
```

## Usage

You can use the facade to interact with the Cyclos API:

```php
use Robinson\CyclosApi\Facades\CyclosApi;

// Make a GET request
$response = CyclosApi::get('/endpoint', ['param' => 'value']);

// Make a POST request
$response = CyclosApi::post('/endpoint', ['data' => 'value']);
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
