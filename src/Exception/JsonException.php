<?php

declare(strict_types=1);

namespace Ghostwriter\Json\Exception;

use Ghostwriter\JsonTests\Unit\Exception\JsonExceptionTest;
use Ghostwriter\Json\Interface\JsonExceptionInterface;
use RuntimeException;

/**
 * @see JsonExceptionTest
 */
final class JsonException extends RuntimeException implements JsonExceptionInterface
{
}
