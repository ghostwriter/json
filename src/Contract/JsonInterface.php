<?php

declare(strict_types=1);

namespace Ghostwriter\Json\Contract;

interface JsonInterface
{
    public static function decode(string $json): mixed;

    public static function encode(mixed $data, int $flags = 0): string;
}
