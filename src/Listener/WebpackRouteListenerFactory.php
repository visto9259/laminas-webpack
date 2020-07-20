<?php


namespace Webpack\Listener;


use Exception;
use Interop\Container\ContainerInterface;
use Webpack\Config\WebpackOptions;
use Laminas\ServiceManager\Factory\FactoryInterface;

class WebpackRouteListenerFactory implements FactoryInterface
{

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $webpackOptions = $container->get(WebpackOptions::class);
        return new WebpackRouteListener($webpackOptions);
    }
}