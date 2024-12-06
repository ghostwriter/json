<?php

declare(strict_types=1);

namespace Ghostwriter\Json;

use Ghostwriter\Json\Exception\JsonException;
use Ghostwriter\Json\Interface\JsonExceptionInterface;
use Ghostwriter\Json\Interface\JsonInterface;
use Override;
use Tests\Unit\JsonTest;
use Throwable;

use const JSON_BIGINT_AS_STRING;
use const JSON_INVALID_UTF8_IGNORE;
use const JSON_OBJECT_AS_ARRAY;
use const JSON_PRESERVE_ZERO_FRACTION;
use const JSON_PRETTY_PRINT;
use const JSON_THROW_ON_ERROR;
use const JSON_UNESCAPED_SLASHES;
use const JSON_UNESCAPED_UNICODE;

/**
 * @see JsonTest
 *
 * @psalm-immutable
 */
final readonly class Json implements JsonInterface
{
    public static function new(): JsonInterface
    {
        return new self();
    }

    /**
     * @template TDecodeKey of array-key
     * @template TDecodeValue
     *
     * @throws JsonExceptionInterface
     *
     * @return array<TDecodeKey,TDecodeValue>
     *
     * @pure
     */
    #[Override]
    public function decode(string $json): array
    {
        try {
            /** @var array<TDecodeKey,TDecodeValue> $result */
            $result = \json_decode(
                $json,
                true,
                512,
                JSON_BIGINT_AS_STRING | JSON_OBJECT_AS_ARRAY | JSON_THROW_ON_ERROR
            );
        } catch (Throwable $throwable) {
            throw new JsonException($throwable->getMessage());
        }

        return $result;
    }

    /**
     * @template TEncode
     *
     * @param TEncode $data
     *
     * @throws JsonExceptionInterface
     *
     * @pure
     */
    #[Override]
    public function encode(mixed $data, bool $prettyPrint = false): string
    {
        try {
            /** @var false|non-empty-string $value */
            $value = \json_encode(
                $data,
                JSON_PRESERVE_ZERO_FRACTION
                | JSON_UNESCAPED_SLASHES
                | JSON_UNESCAPED_UNICODE
                | JSON_THROW_ON_ERROR
                | ($prettyPrint ? JSON_PRETTY_PRINT : 0)
            );

        } catch (Throwable $throwable) {
            throw new JsonException($throwable->getMessage(), 0, $throwable);
        }

        if ($value === false) {
            throw new JsonException('Failed to encode JSON data.');
        }

        return $value;
    }

    /**
     * @psalm-assert-if-true non-empty-string $json
     *
     * @pure
     */
    #[Override]
    public function validate(string $json, bool $ignoreInvalidUtf8 = false): bool
    {
        return \json_validate($json, 512, $ignoreInvalidUtf8 ? JSON_INVALID_UTF8_IGNORE : 0);
    }
}
