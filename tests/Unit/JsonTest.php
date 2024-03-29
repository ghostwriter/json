<?php

declare(strict_types=1);

namespace Ghostwriter\JsonTests\Unit;

use Ghostwriter\Json\Json;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use stdClass;

#[CoversClass(Json::class)]
final class JsonTest extends TestCase
{
    public function testDecode(): void
    {
        $json = new Json();

        self::assertSame([], $json->decode('{}'));
        self::assertSame([], $json->decode('[]'));
        self::assertSame(['test' => ''], $json->decode('{"test":""}'));
        self::assertSame(['test', 2], $json->decode('["test",2]'));
    }

    public function testEncode(): void
    {
        $json = new Json();

        self::assertSame('{}', $json->encode(new stdClass()));
        self::assertSame('0', $json->encode(0));
        self::assertSame('1.0', $json->encode(1.0));
        self::assertSame('true', $json->encode(true));
        self::assertSame('false', $json->encode(false));
        self::assertSame('null', $json->encode(null));
        self::assertSame('[]', $json->encode([]));
        self::assertSame('{"":""}', $json->encode([''=>'']));
        self::assertSame('{"test":""}', $json->encode(['test' => '']));
        self::assertSame('["test",2]', $json->encode(['test', 2]));
    }

    public function testItDecodesLargeIntegersToString(): void
    {
        $json = new Json();

        /** @var array $array */
        $array = $json->decode('{"large": 9223372036854775808}');
        self::assertArrayHasKey('large', $array);
        self::assertIsString($array['large']);
        self::assertSame('9223372036854775808', $array['large']);
    }

    public function testItDecodesToAnArrayByDefault(): void
    {
        $json = new Json();

        self::assertIsArray($json->decode('{"foo": "bar"}'));
    }

    public function testItDoesNotEscapeSlashes(): void
    {
        $json = new Json();

        self::assertSame('{"slash":"/"}', $json->encode([
            'slash' => '/',
        ]));
    }

    public function testItDoesNotEscapeUnicode(): void
    {
        $json = new Json();

        self::assertSame('{"emoji":"🚀"}', $json->encode(['emoji' => '🚀']));
    }

    public function testItPrettyPrints(): void
    {
        $expected = <<<'CODE_SAMPLE'
        {
            "pretty": "print"
        }
        CODE_SAMPLE;

        $json = new Json();
        self::assertSame($expected, $json->encode(['pretty' => 'print'], true));
    }

    public function testValidate(): void
    {
        $json = new Json();
        self::assertTrue($json->validate('[1, 2, 3]'));

        self::assertFalse($json->validate('{1, 2, 3]'));

        self::assertTrue($json->validate('[1, 2, 3]', true));

        self::assertFalse($json->validate("[\"\xc1\xc1\",\"a\"]"));

        self::assertTrue($json->validate("[\"\xc1\xc1\",\"a\"]", true));

        self::assertFalse($json->validate(''));

        self::assertTrue($json->validate('null'));

        self::assertFalse($json->validate('\0'));

        self::assertTrue($json->validate('{ "test": { "foo": "bar" } }'));

        self::assertFalse($json->validate('{ "": "": "" } }'));
    }
}
