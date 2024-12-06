<?php

declare(strict_types=1);

namespace Tests\Unit;

use Ghostwriter\Json\Interface\JsonExceptionInterface;
use Ghostwriter\Json\Json;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use stdClass;
use Throwable;

use const JSON_PRETTY_PRINT;

#[CoversClass(Json::class)]
final class JsonTest extends TestCase
{
    /**
     * @throws Throwable
     */
    public function testDecodeArray(): void
    {
        self::assertSame(['test', 2], Json::new()->decode('["test",2]'));
    }

    /**
     * @throws Throwable
     */
    public function testDecodeWithEmptyArray(): void
    {
        self::assertSame([], Json::new()->decode('[]'));
    }

    /**
     * @throws Throwable
     */
    public function testDecodeWithEmptyObject(): void
    {
        self::assertSame([], Json::new()->decode('{}'));
    }

    /**
     * @throws Throwable
     */
    public function testDecodeWithEmptyStringObjectKeyAndValue(): void
    {
        self::assertSame([
            '' => '',
        ], Json::new()->decode('{"":""}'));
    }

    /**
     * @throws Throwable
     */
    public function testDecodeWithEmptyStringObjectValue(): void
    {
        self::assertSame([
            'test' => '',
        ], Json::new()->decode('{"test":""}'));
    }

    /**
     * @throws Throwable
     */
    public function testEncode(): void
    {
        $json = Json::new();

        self::assertSame('{}', $json->encode(new stdClass()));
        self::assertSame('0', $json->encode(0));
        self::assertSame('1.0', $json->encode(1.0));
        self::assertSame('true', $json->encode(true));
        self::assertSame('false', $json->encode(false));
        self::assertSame('null', $json->encode(null));
        self::assertSame('[]', $json->encode([]));
        self::assertSame('{"":""}', $json->encode([
            ''=>'',
        ]));
        self::assertSame('{"test":""}', $json->encode([
            'test' => '',
        ]));
        self::assertSame('["test",2]', $json->encode(['test', 2]));
    }

    /**
     * @throws JsonExceptionInterface
     */
    public function testItDecodesLargeIntegersToString(): void
    {
        /** @var array{large:int|string} $array */
        $array = Json::new()->decode('{"large": 9223372036854775808}');

        self::assertArrayHasKey('large', $array);

        self::assertIsString($array['large']);

        self::assertSame('9223372036854775808', $array['large']);
    }

    /**
     * @throws Throwable
     */
    public function testItDecodesToAnArrayByDefault(): void
    {
        self::assertIsArray(Json::new()->decode('{"foo": "bar"}'));
    }

    /**
     * @throws Throwable
     */
    public function testItDoesNotEscapeSlashes(): void
    {
        self::assertSame('{"slash":"/"}', Json::new()->encode([
            'slash' => '/',
        ]));
    }

    /**
     * @throws Throwable
     */
    public function testItDoesNotEscapeUnicode(): void
    {
        self::assertSame('{"emoji":"🚀"}', Json::new()->encode([
            'emoji' => '🚀',
        ]));
    }

    /**
     * @throws Throwable
     */
    public function testItPreservesZeroFraction(): void
    {
        self::assertSame('{"zero":0.0}', Json::new()->encode([
            'zero' => 0.0,
        ]));
    }

    /**
     * @throws Throwable
     */
    public function testItPrettyPrints(): void
    {
        $expected = \json_encode([
            'pretty'=>'print',
        ], JSON_PRETTY_PRINT);

        self::assertSame($expected, Json::new()->encode([
            'pretty' => 'print',
        ], true));
    }

    /**
     * @throws Throwable
     */
    public function testValidate(): void
    {
        $json = Json::new();

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

    /**
     * @throws Throwable
     */
    public function testValidateInvalidControlCharacter(): void
    {
        self::assertFalse(Json::new()->validate('\0'));

    }

    /**
     * @throws Throwable
     */
    public function testValidateInvalidEmptyString(): void
    {
        self::assertFalse(Json::new()->validate(''));
    }

    /**
     * @throws Throwable
     */
    public function testValidateInvalidObject(): void
    {
        self::assertFalse(Json::new()->validate('{ "": "": "" } }'));
    }

    /**
     * @throws Throwable
     */
    public function testValidateInvalidString(): void
    {
        self::assertFalse(Json::new()->validate('{1, 2, 3]'));
    }

    /**
     * @throws Throwable
     */
    public function testValidateInvalidStringWithInvalidUtf8(): void
    {
        self::assertFalse(Json::new()->validate("[\"\xc1\xc1\",\"a\"]"));
    }

    /**
     * @throws Throwable
     */
    public function testValidateValidArray(): void
    {
        self::assertTrue(Json::new()->validate('[1, 2, 3]'));
    }

    /**
     * @throws Throwable
     */
    public function testValidateValidArrayIgnoreInvalidUtf8(): void
    {
        self::assertTrue(Json::new()->validate('[1, 2, 3]', true));
    }

    /**
     * @throws Throwable
     */
    public function testValidateValidNull(): void
    {
        self::assertTrue(Json::new()->validate('null'));
    }

    /**
     * @throws Throwable
     */
    public function testValidateValidObject(): void
    {
        self::assertTrue(Json::new()->validate('{ "test": { "foo": "bar" } }'));

    }

    /**
     * @throws Throwable
     */
    public function testValidateValidStringWithIgnoreInvalidUtf8(): void
    {
        self::assertTrue(Json::new()->validate("[\"\xc1\xc1\",\"a\"]", true));
    }
}
