# Json

[![Automation](https://github.com/ghostwriter/json/actions/workflows/automation.yml/badge.svg)](https://github.com/ghostwriter/json/actions/workflows/automation.yml)
[![PHP Version](https://badgen.net/packagist/php/ghostwriter/json?color=777BB4)](https://www.php.net/supported-versions)
[![Packagist Downloads](https://badgen.net/packagist/dt/ghostwriter/json?color=F28D1A)](https://packagist.org/packages/ghostwriter/json)
[![PayPal](https://img.shields.io/badge/paypal-@codepoet-0079C1?logo=paypal&logoColor=002991)](https://paypal.me/codepoet)
[![Sponsors via GitHub](https://img.shields.io/github/sponsors/ghostwriter?label=Sponsor+@ghostwriter/json&logo=GitHub+Sponsors)](https://github.com/sponsors/ghostwriter)

Safely encode and decode JSON

## Installation

You can install the package via composer:

``` bash
composer require ghostwriter/json
```

### Star ⭐️ this repo if you find it useful

You can also star (🌟) this repo to find it easier later.

## Usage

```php
use \Ghostwriter\Json\Json;

$json = new Json();

$encode = $json->encode(['foo'=>'bar']);
// {"foo":"bar"}

$json->validate($encode); // true

$decode = $json->decode($encode);
// ['foo'=>'bar']

$prettyPrint = true;
$json->encode($decode, $prettyPrint); 
// {
//    "foo":"bar"
// }
```

### Credits

- [Nathanael Esayeas](https://github.com/ghostwriter)
- [All Contributors](https://github.com/ghostwriter/json/contributors)

### Changelog

Please see [CHANGELOG.md](./CHANGELOG.md) for more information on what has changed recently.

### License

Please see [LICENSE](./LICENSE) for more information on the license that applies to this project.

### Security

Please see [SECURITY.md](./SECURITY.md) for more information on security disclosure process.
