<?php

declare(strict_types=1);

namespace Ghostwriter\Json\Tests\Unit;

use Ghostwriter\Json\Json;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use stdClass;
use UnexpectedValueException;

#[CoversClass(Json::class)]
final class JsonTest extends TestCase
{
    public function testDecode(): void
    {
        self::assertSame([], Json::decode('{}'));
        self::assertSame([], Json::decode('[]'));
        self::assertSame([
            'test'=>'',
        ], Json::decode('{"test":""}'));
        self::assertSame(['test', 2], Json::decode('["test",2]'));
    }

    public function testEncode(): void
    {
        self::assertSame('{}', Json::encode(new stdClass()));
        self::assertSame('[]', Json::encode([]));
        self::assertSame('{"test":""}', Json::encode([
            'test'=>'',
        ]));
        self::assertSame('["test",2]', Json::encode(['test', 2]));
    }

    public function testItDecodesLargeIntegersToString(): void
    {
        /** @var array $array */
        $array = Json::decode('{"large": 9223372036854775808}');
        self::assertArrayHasKey('large', $array);
        self::assertIsString($array['large']);
        self::assertSame('9223372036854775808', $array['large']);
    }

    public function testItDecodesToAnArrayByDefault(): void
    {
        self::assertIsArray(Json::decode('{"foo": "bar"}'));
    }

    public function testItDoesNotEscapeSlashes(): void
    {
        self::assertSame('{"slash":"/"}', Json::encode([
            'slash' => '/',
        ]));
    }

    public function testItDoesNotEscapeUnicode(): void
    {
        self::assertSame('{"emoji":"🚀"}', Json::encode([
            'emoji' => '🚀',
        ]));
    }

    public function testItPrettyPrints(): void
    {
        $expected = <<<'CODE_SAMPLE'
        {
            "pretty": "print"
        }
        CODE_SAMPLE;

        self::assertSame($expected, Json::encode([
            'pretty' => 'print',
        ], Json::PRETTY));
    }

    public function testThrowsOnControlCharacterError(): void
    {
        $this->expectException(UnexpectedValueException::class);
        $this->expectExceptionMessage('Control character error, possibly incorrectly encoded');
        Json::decode("\0");
    }

    public function testThrowsOnMalformedUtf8Characters(): void
    {
        $this->expectException(UnexpectedValueException::class);
        $this->expectExceptionMessage('Malformed UTF-8 characters, possibly incorrectly encoded');
        Json::encode(["bad utf\xFF"]);
    }

    public function testThrowsOnSyntaxError(): void
    {
        $this->expectException(UnexpectedValueException::class);
        $this->expectExceptionMessage('Syntax error');
        Json::decode('{');
    }
}
