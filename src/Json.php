<?php

declare(strict_types=1);

namespace Ghostwriter\Json;

use Ghostwriter\Json\Contract\JsonInterface;
use JsonException;
use UnexpectedValueException;

final class Json implements JsonInterface
{
    public static function decode(string $json): mixed
    {
        try {
            return json_decode($json, true, 512, self::DECODE);
        } catch (JsonException $e) {
            throw new UnexpectedValueException($e->getMessage());
        }
    }

    public static function encode(mixed $data, ?int $options = null): string
    {
        try {
            return json_encode($data, ($options ?? 0) | self::ENCODE);
        } catch (JsonException $e) {
            throw new UnexpectedValueException($e->getMessage());
        }
    }

    public static function prettyPrint(mixed $value, ?int $options = null): string
    {
        return self::encode($value, ($options ?? 0) | self::PRETTY);
    }
}
