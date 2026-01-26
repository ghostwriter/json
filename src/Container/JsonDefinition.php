<?php

declare(strict_types=1);

namespace Ghostwriter\Json\Container;

use Ghostwriter\Container\Interface\ContainerInterface;
use Ghostwriter\Container\Interface\Service\DefinitionInterface;
use Ghostwriter\Json\Interface\JsonInterface;
use Ghostwriter\Json\Json;
use Override;
use Throwable;

/**
 * @see JsonDefinitionTest
 */
final readonly class JsonDefinition implements DefinitionInterface
{
    /** @throws Throwable */
    #[Override]
    public function __invoke(ContainerInterface $container): void
    {
        $container->alias(Json::class, JsonInterface::class);
    }
}
