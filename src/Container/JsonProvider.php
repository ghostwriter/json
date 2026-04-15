<?php

declare(strict_types=1);

namespace Ghostwriter\Json\Container;

use Ghostwriter\Container\Interface\BuilderInterface;
use Ghostwriter\Container\Service\Provider\AbstractProvider;
use Ghostwriter\Json\Interface\JsonInterface;
use Ghostwriter\Json\Json;
use Override;
use Throwable;

/**
 * @see JsonProviderTest
 */
final class JsonProvider extends AbstractProvider
{
    /** @throws Throwable */
    #[Override]
    public function register(BuilderInterface $builder): void
    {
        $builder->alias(JsonInterface::class, Json::class);
    }
}
