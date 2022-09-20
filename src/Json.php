<?php

declare(strict_types=1);

namespace Ghostwriter\Json;

use Ghostwriter\Json\Contract\JsonInterface;
use JsonException;
use UnexpectedValueException;

final class Json implements JsonInterface
{
    /** @var int */
    public const DECODE = JSON_BIGINT_AS_STRING | JSON_OBJECT_AS_ARRAY | JSON_THROW_ON_ERROR;

    /** @var int */
    public const DEPTH = 512;

    /** @var int */
    public const EMPTY = 0;

    /** @var int */
    public const ENCODE = JSON_PRESERVE_ZERO_FRACTION | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR;

    /** @var int */
    public const PRETTY = self::ENCODE | JSON_PRETTY_PRINT;

    public static function decode(string $json): mixed
    {
        try {
            return json_decode($json, true, self::DEPTH, self::DECODE);
        } catch (JsonException $jsonException) {
            throw new UnexpectedValueException($jsonException->getMessage(), $jsonException->getCode(), $jsonException);
        }
    }

    public static function encode(mixed $data, int $flags = self::EMPTY): string
    {
        try {
            return json_encode($data, $flags | self::ENCODE, self::DEPTH);
        } catch (JsonException $jsonException) {
            throw new UnexpectedValueException($jsonException->getMessage(), $jsonException->getCode(), $jsonException);
        }
    }
}
