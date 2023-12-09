<?php

declare(strict_types=1);

namespace Ghostwriter\Json;

use Ghostwriter\Json\Exception\JsonException;
use Ghostwriter\Json\Interface\JsonExceptionInterface;
use Ghostwriter\Json\Interface\JsonInterface;
use Throwable;
use function json_decode;
use function json_encode;
use function json_validate;

/** @psalm-immutable */
final readonly class Json implements JsonInterface
{
    /**
     * @template TDecode
     * @return TDecode
     *
     * @throws JsonExceptionInterface
     * @pure
     */
    public function decode(string $json): mixed
    {
        try {
            /** @var TDecode $value */
            $value = json_decode(
                $json,
                true,
                self::DEPTH,
                self::DECODE
            );
        } catch (Throwable $throwable) {
            throw new JsonException($throwable->getMessage());
        }

        return $value;
    }
    /**
     * @template TEncode
     * @param TEncode $data
     *
     * @throws JsonExceptionInterface
     * @pure
     */
    public function encode(mixed $data, int $flags = self::EMPTY): string
    {
        try {
            /** @var string $value */
            $value = json_encode(
                $data,
                $flags | self::ENCODE,
                self::DEPTH
            );
        } catch (Throwable $throwable) {
            throw new JsonException($throwable->getMessage(), 0, $throwable);
        }

        return $value;
    }

    /**
     * @psalm-assert-if-true non-empty-string $json
     * @pure
     */
    public function validate(string $json, int $flags = self::EMPTY): bool
    {
        return json_validate($json, self::DEPTH, $flags === self::EMPTY ? self::EMPTY : self::IGNORE);
    }
}
