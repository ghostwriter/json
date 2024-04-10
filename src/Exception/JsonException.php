<?php

declare(strict_types=1);

namespace Ghostwriter\Json\Exception;

use Ghostwriter\Json\Interface\JsonExceptionInterface;
use Ghostwriter\JsonTests\Unit\Exception\JsonExceptionTest;
use RuntimeException;

/**
 * @see JsonExceptionTest
 */
final class JsonException extends RuntimeException implements JsonExceptionInterface {}
