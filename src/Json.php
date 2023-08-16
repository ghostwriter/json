<?php

declare(strict_types=1);

namespace Ghostwriter\Json;

use Throwable;
use UnexpectedValueException;
use const JSON_ERROR_NONE;
use const JSON_INVALID_UTF8_IGNORE;
use function json_decode;
use function json_last_error;

/** @psalm-immutable */
final readonly class Json implements JsonInterface
{
    /** @var int */
    public const DECODE = JSON_BIGINT_AS_STRING | JSON_OBJECT_AS_ARRAY | JSON_THROW_ON_ERROR;

    /** @var int */
    public const DEPTH = 512;

    /** @var int */
    public const EMPTY = 0;

    /** @var int */
    public const ENCODE = JSON_PRESERVE_ZERO_FRACTION | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR;

    public const IGNORE = JSON_INVALID_UTF8_IGNORE;

    /** @var int */
    public const PRETTY = self::ENCODE | JSON_PRETTY_PRINT;

    public static function decode(string $json): mixed
    {
        try {
            return json_decode($json, true, self::DEPTH, self::DECODE);
        } catch (Throwable $throwable) {
            throw new UnexpectedValueException($throwable->getMessage());
        }
    }

    public static function encode(mixed $data, int $flags = self::EMPTY): string
    {
        try {
            return json_encode($data, $flags | self::ENCODE, self::DEPTH);
        } catch (Throwable $throwable) {
            throw new UnexpectedValueException($throwable->getMessage());
        }
    }

    /**
     * @psalm-assert-if-true non-empty-string $json
     */
    public static function validate(string $json, int $flags = self::EMPTY): bool
    {
        try {
            /** @psalm-suppress UnusedFunctionCall */
            json_decode(
                $json,
                true,
                self::DEPTH,
                $flags === self::EMPTY ? self::EMPTY : self::IGNORE
            );

            return json_last_error() === JSON_ERROR_NONE;
        } catch (Throwable $throwable) {
            return false;
        }

        // return \json_validate($json, $flags === self::EMPTY ? self::EMPTY : self::IGNORE);
    }
}
