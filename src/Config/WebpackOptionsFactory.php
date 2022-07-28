<?php

declare(strict_types=1);

namespace Webpack\Config;

use Laminas\ServiceManager\Exception\ServiceNotCreatedException;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class WebpackOptionsFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): WebpackOptions
    {
        // Get configuration
        $config = $container->get('config');
        // Check for a webpack config
        if (! isset($config['webpack'])) {
            throw new ServiceNotCreatedException('Missing webpack configuration');
        }
        return new WebpackOptions($config['webpack']);
    }
}
