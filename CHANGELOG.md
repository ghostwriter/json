# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/)
and this project adheres to [Semantic Versioning](https://semver.org/).

## 3.0.0 - 2024-02-09

### Removed

- Constant `Ghostwriter\Json\Interface\JsonInterface::DECODE` was removed
- Constant `Ghostwriter\Json\Interface\JsonInterface::DEPTH` was removed
- Constant `Ghostwriter\Json\Interface\JsonInterface::EMPTY` was removed
- Constant `Ghostwriter\Json\Interface\JsonInterface::ENCODE` was removed
- Constant `Ghostwriter\Json\Interface\JsonInterface::IGNORE` was removed
- Constant `Ghostwriter\Json\Interface\JsonInterface::PRETTY` was removed

### Changed

- The return type of `Ghostwriter\Json\Interface\JsonInterface#decode()` changed from `mixed` to `array`
- Parameter 1 of `Ghostwriter\Json\Interface\JsonInterface#encode()` changed name from `int $flags = 0` to `bool $prettyPrint = false`
- Parameter 1 of `Ghostwriter\Json\Interface\JsonInterface#validate()` changed name from `int $flags = 0` to `bool $ignoreInvalidUtf8 = false`

## 2.0.0 - 2023-12-09

- Drop PHP <= 8.2
- Add `validate` method
- `Json` class methods are now, non-static 

## 1.1.0 - 2023-01-17

- Drop PHP 8.0
- Add Changelog
- Add coding-standard
