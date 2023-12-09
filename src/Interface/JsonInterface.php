<?php

declare(strict_types=1);

namespace Ghostwriter\Json\Interface;

use const JSON_BIGINT_AS_STRING;
use const JSON_INVALID_UTF8_IGNORE;
use const JSON_OBJECT_AS_ARRAY;
use const JSON_PRESERVE_ZERO_FRACTION;
use const JSON_PRETTY_PRINT;
use const JSON_THROW_ON_ERROR;
use const JSON_UNESCAPED_SLASHES;
use const JSON_UNESCAPED_UNICODE;

interface JsonInterface
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

    /**
     * @template TDecode
     * @return TDecode
     *
     * @throws JsonExceptionInterface
     */
    public function decode(string $json): mixed;

    /**
     * @template TEncode
     * @param TEncode $data
     *
     * @throws JsonExceptionInterface
     */
    public function encode(mixed $data, int $flags = 0): string;

    public function validate(string $json): bool;
}
