# Products management

[![Latest Version on Packagist](https://img.shields.io/packagist/v/keky/product-module.svg?style=flat-square)](https://packagist.org/packages/keky/product-module)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/keky/product-module/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/keky/product-module/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/keky/product-module/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/keky/product-module/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/keky/product-module.svg?style=flat-square)](https://packagist.org/packages/keky/product-module)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require keky/product-module
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="product-module-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="product-module-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="product-module-views"
```

## Usage

```php
$productModule = new Keky\Product\ProductModule();
echo $productModule->echoPhrase('Hello, Keky\Product!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Henoc Djabia](https://github.com/henoc35)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
