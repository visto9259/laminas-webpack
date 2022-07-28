<?php

declare(strict_types=1);

namespace Webpack;

use Laminas\ModuleManager\Feature\ServiceProviderInterface;
use Laminas\ModuleManager\Feature\ViewHelperProviderInterface;
use Laminas\Mvc\MvcEvent;
use Laminas\View\View;
use Webpack\Config\WebpackOptions;
use Webpack\Config\WebpackOptionsFactory;
use Webpack\Listener\WebpackRouteListener;
use Webpack\Listener\WebpackRouteListenerFactory;
use Webpack\Listener\WebpackViewListener;
use Webpack\Listener\WebpackViewListenerFactory;
use Webpack\View\Helper\ScriptLoaderHelper;
use Webpack\View\Helper\ScriptLoaderHelperFactory;

/**
 * Module configuration
 */
class Module implements ViewHelperProviderInterface, ServiceProviderInterface
{
    /**
     * @inheritDoc
     */
    public function getViewHelperConfig(): iterable
    {
        return [
            'aliases'   => [
                'webpackscriptloader' => ScriptLoaderHelper::class,
                'webpackScriptLoader' => ScriptLoaderHelper::class,
            ],
            'factories' => [
                ScriptLoaderHelper::class => ScriptLoaderHelperFactory::class,
            ],
        ];
    }

    /**
     * @inheritDoc
     */
    public function getServiceConfig(): iterable
    {
        return [
            'factories' => [
                WebpackRouteListener::class => WebpackRouteListenerFactory::class,
                WebpackViewListener::class  => WebpackViewListenerFactory::class,
                WebpackOptions::class       => WebpackOptionsFactory::class,
            ],
        ];
    }

    /**
     * @inheritDoc
     */
    public function onBootstrap(MvcEvent $e): void
    {
        $application  = $e->getApplication();
        $sm           = $application->getServiceManager();
        $eventManager = $application->getEventManager();

        // Attach the listeners
        $webpackRouteListener = $sm->get(WebpackRouteListener::class);
        $webpackRouteListener->attach($eventManager);

        $view                = $sm->get(View::class);
        $webpackViewListener = $sm->get(WebpackViewListener::class);
        $webpackViewListener->attach($view->getEventManager(), 100);
    }
}
