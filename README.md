# Json

[![Compliance](https://github.com/ghostwriter/json/actions/workflows/compliance.yml/badge.svg)](https://github.com/ghostwriter/json/actions/workflows/compliance.yml)
[![Supported PHP Version](https://badgen.net/packagist/php/ghostwriter/json?color=8892bf)](https://www.php.net/supported-versions)
[![GitHub Sponsors](https://img.shields.io/github/sponsors/ghostwriter?label=Sponsor+@ghostwriter/json&logo=GitHub+Sponsors)](https://github.com/sponsors/ghostwriter)
[![Mutation Coverage](https://img.shields.io/endpoint?style=flat&url=https%3A%2F%2Fbadge-api.stryker-mutator.io%2Fgithub.com%2Fghostwriter%2Fjson%2Fmain)](https://dashboard.stryker-mutator.io/reports/github.com/ghostwriter/json/main)
[![Code Coverage](https://codecov.io/gh/ghostwriter/json/branch/main/graph/badge.svg)](https://codecov.io/gh/ghostwriter/json)
[![Type Coverage](https://shepherd.dev/github/ghostwriter/json/coverage.svg)](https://shepherd.dev/github/ghostwriter/json)
[![Psalm Level](https://shepherd.dev/github/ghostwriter/json/level.svg)](https://psalm.dev/docs/running_psalm/error_levels)
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

$json = new Json();

$encode = $json->encode(['foo'=>'bar']);
// {"foo":"bar"}

$json->validate($encode); // true

$decode = $json->decode($encode);
// ['foo'=>'bar']

$json->encode($decode, true); 
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
