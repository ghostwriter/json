<?php

declare(strict_types=1);

namespace Tests\Unit\Container;

use Ghostwriter\Container\Interface\ContainerInterface;
use Ghostwriter\Container\Interface\Service\DefinitionInterface;
use Ghostwriter\Json\Container\JsonDefinition;
use Ghostwriter\Json\Interface\JsonInterface;
use Ghostwriter\Json\Json;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Throwable;

use function is_a;

#[CoversClass(JsonDefinition::class)]
final class JsonDefinitionTest extends TestCase
{
    /** @throws Throwable */
    public function testImplementsDefinitionInterface(): void
    {
        self::assertTrue(is_a(JsonDefinition::class, DefinitionInterface::class, true));
    }

    /** @throws Throwable */
    public function testInvoke(): void
    {
        $container = $this->createMock(ContainerInterface::class);

        $container->expects(self::once())
            ->method('alias')
            ->with(self::equalTo(Json::class), self::equalTo(JsonInterface::class));

        (new JsonDefinition())($container);
    }
}
