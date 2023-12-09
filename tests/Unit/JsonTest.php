<?php

declare(strict_types=1);

namespace Ghostwriter\Json\Tests\Unit;

use Ghostwriter\Json\Json;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use stdClass;

#[CoversClass(Json::class)]
final class JsonTest extends TestCase
{
    private Json $json;

    protected function setUp(): void
    {
        $this->json = new Json();
    }

    public function testDecode(): void
    {
        self::assertSame([], $this->json->decode('{}'));
        self::assertSame([], $this->json->decode('[]'));
        self::assertSame([
            'test' => '',
        ], $this->json->decode('{"test":""}'));
        self::assertSame(['test', 2], $this->json->decode('["test",2]'));
    }

    public function testEncode(): void
    {
        self::assertSame('{}', $this->json->encode(new stdClass()));
        self::assertSame('0', $this->json->encode(0));
        self::assertSame('1.0', $this->json->encode(1.0));
        self::assertSame('true', $this->json->encode(true));
        self::assertSame('false', $this->json->encode(false));
        self::assertSame('null', $this->json->encode(null));
        self::assertSame('[]', $this->json->encode([]));
        self::assertSame('{"":""}', $this->json->encode([''=>'']));
        self::assertSame('{"test":""}', $this->json->encode([
            'test' => '',
        ]));
        self::assertSame('["test",2]', $this->json->encode(['test', 2]));
    }

    public function testItDecodesLargeIntegersToString(): void
    {
        /** @var array $array */
        $array = $this->json->decode('{"large": 9223372036854775808}');
        self::assertArrayHasKey('large', $array);
        self::assertIsString($array['large']);
        self::assertSame('9223372036854775808', $array['large']);
    }

    public function testItDecodesToAnArrayByDefault(): void
    {
        self::assertIsArray($this->json->decode('{"foo": "bar"}'));
    }

    public function testItDoesNotEscapeSlashes(): void
    {
        self::assertSame('{"slash":"/"}', $this->json->encode([
            'slash' => '/',
        ]));
    }

    public function testItDoesNotEscapeUnicode(): void
    {
        self::assertSame('{"emoji":"🚀"}', $this->json->encode([
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

        self::assertSame($expected, $this->json->encode([
            'pretty' => 'print',
        ], Json::PRETTY));
    }

    public function testValidate(): void
    {
        self::assertTrue($this->json->validate('[1, 2, 3]'));

        self::assertFalse($this->json->validate('{1, 2, 3]'));

        self::assertTrue($this->json->validate('[1, 2, 3]', Json::IGNORE));

        self::assertFalse($this->json->validate("[\"\xc1\xc1\",\"a\"]"));

        self::assertTrue($this->json->validate("[\"\xc1\xc1\",\"a\"]", Json::IGNORE));

        self::assertFalse($this->json->validate(''));

        self::assertTrue($this->json->validate('null'));

        self::assertFalse($this->json->validate('\0'));

        self::assertTrue($this->json->validate('{ "test": { "foo": "bar" } }'));

        self::assertFalse($this->json->validate('{ "": "": "" } }'));
    }
}
