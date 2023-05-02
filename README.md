# Json

[![Compliance](https://github.com/ghostwriter/json/actions/workflows/compliance.yml/badge.svg)](https://github.com/ghostwriter/json/actions/workflows/compliance.yml)
[![Supported PHP Version](https://badgen.net/packagist/php/ghostwriter/json?color=8892bf)](https://www.php.net/supported-versions)
[![Code Coverage](https://codecov.io/gh/ghostwriter/json/branch/main/graph/badge.svg)](https://codecov.io/gh/ghostwriter/json)
[![Type Coverage](https://shepherd.dev/github/ghostwriter/json/coverage.svg)](https://shepherd.dev/github/ghostwriter/json)
[![Latest Version on Packagist](https://badgen.net/packagist/v/ghostwriter/json)](https://packagist.org/packages/ghostwriter/json)
[![Downloads](https://badgen.net/packagist/dt/ghostwriter/json?color=blue)](https://packagist.org/packages/ghostwriter/json)

Safely encode and decode JSON

## Installation

You can install the package via composer:

``` bash
composer require ghostwriter/json
```

## Usage

```php
use \Ghostwriter\Json\Json;

$encode = Json::encode(['foo'=>'bar']);
// {"foo":"bar"}

$decode = Json::decode($encode);
// ['foo'=>'bar']

Json::encode($decode, Json::PRETTY); 
// {
//    "foo":"bar"
// }
```

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG.md](./CHANGELOG.md) for more information what has changed recently.

## Security

If you discover any security related issues, please email `nathanael.esayeas@protonmail.com` instead of using the issue tracker.

## Sponsors

[[`Become a GitHub Sponsor`](https://github.com/sponsors/ghostwriter)]

## Credits

- [Nathanael Esayeas](https://github.com/ghostwriter)
- [All Contributors](https://github.com/ghostwriter/json/contributors)

## License

The BSD-3-Clause. Please see [License File](./LICENSE) for more information.
