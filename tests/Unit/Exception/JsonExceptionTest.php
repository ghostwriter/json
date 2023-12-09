<?php

declare(strict_types=1);

namespace Ghostwriter\Json\Tests\Unit\Exception;

use Ghostwriter\Json\Exception\JsonException;
use Ghostwriter\Json\Interface\JsonExceptionInterface;
use Ghostwriter\Json\Json;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Json::class)]
#[CoversClass(JsonException::class)]
final class JsonExceptionTest extends TestCase
{
    private Json $json;

    protected function setUp(): void
    {
        $this->json = new Json();
    }

    public function testDecodeThrowsOnControlCharacterError(): void
    {
        $this->expectException(JsonExceptionInterface::class);
        $this->expectException(JsonException::class);
        $this->expectExceptionMessage('Control character error, possibly incorrectly encoded');
        $this->json->decode("\0");
    }

    public function testEncodeThrowsOnMalformedUtf8Characters(): void
    {
        $this->expectException(JsonExceptionInterface::class);
        $this->expectException(JsonException::class);
        $this->expectExceptionMessage('Malformed UTF-8 characters, possibly incorrectly encoded');
        $this->json->encode(["bad utf\xFF"]);
    }

    public function testDecodeThrowsOnSyntaxError(): void
    {
        $this->expectException(JsonExceptionInterface::class);
        $this->expectException(JsonException::class);
        $this->expectExceptionMessage('Syntax error');
        $this->json->decode('{');
    }
}
