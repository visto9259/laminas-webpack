<?php


namespace Webpack\Config;


use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Exception\ServiceNotCreatedException;

class WebpackOptionsFactory implements \Laminas\ServiceManager\Factory\FactoryInterface
{

    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        // Get configuration
        $config = $container->get('config');
        // Check for a webpack config
        if (!isset($config['webpack'])) {
            throw new ServiceNotCreatedException('Missing webpack configuration');
        }
        return new WebpackOptions($config['webpack']);
    }
}