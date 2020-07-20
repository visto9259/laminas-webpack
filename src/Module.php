<?php
/**
 * Module configuration
 * @author Eric Richer <eric.richer@vistoconsulting.com>
 */

namespace Webpack;

use Laminas\View\View;
use Webpack\Config\WebpackOptions;
use Webpack\Config\WebpackOptionsFactory;
use Webpack\Listener\WebpackRouteListener;
use Webpack\Listener\WebpackRouteListenerFactory;
use Webpack\Listener\WebpackViewListener;
use Webpack\Listener\WebpackViewListenerFactory;
use Webpack\View\Helper\ScriptLoaderHelper;
use Webpack\View\Helper\ScriptLoaderHelperFactory;
use Laminas\ModuleManager\Feature\ServiceProviderInterface;
use Laminas\ModuleManager\Feature\ViewHelperProviderInterface;
use Laminas\Mvc\MvcEvent;

class Module implements ViewHelperProviderInterface, ServiceProviderInterface
{

    /**
     * @inheritDoc
     */
    public function getViewHelperConfig()
    {
        return [
            'aliases' => [
                'webpackscriptloader' => ScriptLoaderHelper::class,
                'webpackScriptLoader' => ScriptLoaderHelper::class,
            ],
            'factories' => [
                ScriptLoaderHelper::class => ScriptLoaderHelperFactory::class,
            ]
        ];
    }

    /**
     * @inheritDoc
     */
    public function getServiceConfig()
    {

        return [
            'factories' => [
                WebpackRouteListener::class => WebpackRouteListenerFactory::class,
                WebpackViewListener::class => WebpackViewListenerFactory::class,
                WebpackOptions::class => WebpackOptionsFactory::class,
            ],
        ];
    }


    /**
     * @inheritDoc
     */
    public function onBootstrap(MvcEvent $e)
    {
        $application = $e->getApplication();
        $sm = $application->getServiceManager();
        $eventManager = $application->getEventManager();

        // Attach the listeners
        $webpackRouteListener = $sm->get(WebpackRouteListener::class);
        $webpackRouteListener->attach($eventManager);

        $view = $sm->get(View::class);
        $webpackViewListener = $sm->get(WebpackViewListener::class);
        $webpackViewListener->attach($view->getEventManager(), 100);
    }
}