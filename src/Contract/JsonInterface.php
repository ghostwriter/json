<?php

declare(strict_types=1);

namespace Ghostwriter\Json\Contract;

interface JsonInterface
{
    /** @var int */
    public const DECODE = JSON_BIGINT_AS_STRING | JSON_OBJECT_AS_ARRAY | JSON_THROW_ON_ERROR;

    /** @var int */
    public const ENCODE = JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR;

    /** @var int */
    public const PRETTY = self::ENCODE | JSON_PRETTY_PRINT;

    public static function decode(string $json): mixed;

    public static function encode(mixed $data, ?int $options = null): string;

    public static function prettyPrint(mixed $value, ?int $options = null): string;
}
