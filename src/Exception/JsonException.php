<?php

declare(strict_types=1);

namespace Ghostwriter\Json\Exception;

use Ghostwriter\Json\Interface\JsonExceptionInterface;
use RuntimeException;

final class JsonException extends RuntimeException implements JsonExceptionInterface
{
}
