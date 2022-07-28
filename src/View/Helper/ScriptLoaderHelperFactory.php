<?php

declare(strict_types=1);

namespace Webpack\View\Helper;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\View\Renderer\PhpRenderer;
use Psr\Container\ContainerInterface;

/**
 * Factory for the ScriptLoaderHelper
 * Requires that the application has a PHP Renderer
 */
class ScriptLoaderHelperFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): ScriptLoaderHelper
    {
        return new ScriptLoaderHelper($container->get(PhpRenderer::class));
    }
}
