<?php

declare(strict_types=1);

namespace Ghostwriter\Json\Interface;

interface JsonInterface
{
    /**
     * @template TDecodeKey
     * @template TDecodeValue
     *
     * @return array<TDecodeKey,TDecodeValue>
     *
     * @throws JsonExceptionInterface
     */
    public function decode(string $json): array;

    /**
     * @template TEncode
     *
     * @param TEncode $data
     *
     * @throws JsonExceptionInterface
     */
    public function encode(mixed $data, bool $prettyPrint = false): string;

    public function validate(string $json, bool $ignoreInvalidUtf8 = false): bool;
}
