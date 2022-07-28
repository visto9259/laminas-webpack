<?php

declare(strict_types=1);

namespace Webpack\Listener;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;
use Webpack\Config\WebpackOptions;

class WebpackViewListenerFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): WebpackViewListener
    {
        return new WebpackViewListener($container->get(WebpackOptions::class));
    }
}
