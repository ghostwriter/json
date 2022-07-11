<?php

declare(strict_types=1);

namespace Ghostwriter\Json\Tests\Unit;

use Ghostwriter\Json\Json;
use PHPUnit\Framework\TestCase;
use stdClass;
use UnexpectedValueException;

/**
 * @coversDefaultClass \Ghostwriter\Json\Json
 *
 * @internal
 *
 * @small
 */
final class JsonTest extends TestCase
{
    /**
     * @covers \Ghostwriter\Json\Json::decode
     */
    public function testDecode(): void
    {
        self::assertSame([], Json::decode('{}'));
        self::assertSame([], Json::decode('[]'));
        self::assertSame([
            'test'=>'',
        ], Json::decode('{"test":""}'));
        self::assertSame(['test', 2], Json::decode('["test",2]'));
    }

    /** @covers \Ghostwriter\Json\Json::encode */
    public function testEncode(): void
    {
        self::assertSame('{}', Json::encode(new stdClass()));
        self::assertSame('[]', Json::encode([]));
        self::assertSame('{"test":""}', Json::encode([
            'test'=>'',
        ]));
        self::assertSame('["test",2]', Json::encode(['test', 2]));
    }

    /** @covers \Ghostwriter\Json\Json::decode */
    public function testItDecodesLargeIntegersToString(): void
    {
        /** @var array $array */
        $array = JSON::decode('{"large": 9223372036854775808}');
        self::assertArrayHasKey('large', $array);
        self::assertIsString($array['large']);
        self::assertSame('9223372036854775808', $array['large']);
    }

    /** @covers \Ghostwriter\Json\Json::decode */
    public function testItDecodesToAnArrayByDefault(): void
    {
        self::assertIsArray(JSON::decode('{"foo": "bar"}'));
    }

    /** @covers \Ghostwriter\Json\Json::encode */
    public function testItDoesNotEscapeSlashes(): void
    {
        self::assertSame('{"slash":"/"}', Json::encode([
            'slash' => '/',
        ]));
    }

    /** @covers \Ghostwriter\Json\Json::encode */
    public function testItDoesNotEscapeUnicode(): void
    {
        self::assertSame('{"emoji":"🚀"}', Json::encode([
            'emoji' => '🚀',
        ]));
    }

    /** @covers \Ghostwriter\Json\Json::encode */
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

    /** @covers \Ghostwriter\Json\Json::decode */
    public function testThrowsOnControlCharacterError(): void
    {
        $this->expectException(UnexpectedValueException::class);
        Json::decode("\0");
    }

    /** @covers \Ghostwriter\Json\Json::encode */
    public function testThrowsOnMalformedUtf8Characters(): void
    {
        $this->expectException(UnexpectedValueException::class);
        Json::encode(["bad utf\xFF"]);
    }

    /** @covers \Ghostwriter\Json\Json::decode */
    public function testThrowsOnSyntaxError(): void
    {
        $this->expectException(UnexpectedValueException::class);
        Json::decode('{');
    }
}
