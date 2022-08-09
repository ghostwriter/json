<?php

declare(strict_types=1);

namespace Ghostwriter\Json\Contract;

interface JsonInterface
{
    public static function decode(string $json): mixed;

    /**
     * @template T
     *
     * @param T $data
     */
    public static function encode(mixed $data, int $flags = 0): string;
}
