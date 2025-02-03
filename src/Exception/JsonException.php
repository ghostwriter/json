<?php

declare(strict_types=1);

namespace Ghostwriter\Json\Exception;

use Ghostwriter\Json\Interface\JsonExceptionInterface;
use RuntimeException;
use Tests\Unit\Exception\JsonExceptionTest;

/**
 * @see JsonExceptionTest
 */
final class JsonException extends RuntimeException implements JsonExceptionInterface {}
