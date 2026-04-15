<?php

declare(strict_types=1);

namespace Tests\Unit\Container;

use Ghostwriter\Container\Interface\BuilderInterface;
use Ghostwriter\Container\Interface\Service\ProviderInterface;
use Ghostwriter\Container\Service\Provider\AbstractProvider;
use Ghostwriter\Json\Container\JsonProvider;
use Ghostwriter\Json\Interface\JsonInterface;
use Ghostwriter\Json\Json;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Throwable;

#[CoversClass(JsonProvider::class)]
final class JsonProviderTest extends TestCase
{
    /** @throws Throwable */
    public function testExtendsAbstractProvider(): void
    {
        self::assertInstanceOf(AbstractProvider::class, new JsonProvider());
    }

    /** @throws Throwable */
    public function testImplementsProviderInterface(): void
    {
        self::assertInstanceOf(ProviderInterface::class, new JsonProvider());
    }

    /** @throws Throwable */
    public function testJsonProviderRegister(): void
    {
        $jsonProvider = new JsonProvider();

        $builder = $this->createMock(BuilderInterface::class);

        $builder->expects(self::once())
            ->method('alias')
            ->with(JsonInterface::class, Json::class)
            ->seal();

        $jsonProvider->register($builder);
    }
}
