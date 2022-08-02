<?php

declare(strict_types=1);

namespace Webpack\Listener;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;
use Webpack\Config\WebpackOptions;

class WebpackRouteListenerFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        ?array $options = null
    ): WebpackRouteListener {
        $webpackOptions = $container->get(WebpackOptions::class);
        return new WebpackRouteListener($webpackOptions);
    }
}
