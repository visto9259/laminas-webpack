<?php

declare(strict_types=1);

namespace Webpack\Listener;

use Laminas\EventManager\AbstractListenerAggregate;
use Laminas\EventManager\EventManagerInterface;
use Laminas\Mvc\Controller\AbstractController;
use Laminas\Mvc\MvcEvent;
use Webpack\Config\WebpackOptions;

class WebpackRouteListener extends AbstractListenerAggregate
{
    protected WebpackOptions $options;

    public function __construct(WebpackOptions $options)
    {
        $this->options = $options;
    }

    /**
     * @inheritDoc
     */
    public function attach(EventManagerInterface $events, $priority = 1): void
    {
        $sharedManager = $events->getSharedManager();
        // Attach to the dispatch event of the AbstractController
        $sharedManager->attach(
            AbstractController::class,
            MvcEvent::EVENT_DISPATCH,
            [$this, 'setScriptList'],
            $priority
        );
    }

    public function setScriptList(MvcEvent $e): void
    {
        /** @var AbstractController $controller */
        $controller       = $e->getTarget();
        $layout           = $controller->plugin('layout');
        $routeMatchedName = $e->getRouteMatch()->getMatchedRouteName();
        $layout->setVariable('scriptlist', $this->options->getScriptListByRoute($routeMatchedName));
    }
}
