<?php
/**
 * @author Eric Richer <eric.richer@vistoconsulting.com>
 */

namespace Webpack\Listener;


use Webpack\Config\WebpackOptions;
use Laminas\EventManager\AbstractListenerAggregate;
use Laminas\EventManager\EventManagerInterface;
use Laminas\Mvc\Controller\AbstractController;
use Laminas\Mvc\MvcEvent;

class WebpackRouteListener extends AbstractListenerAggregate
{

    /* @var WebpackOptions*/
    protected $options;

    public function __construct($options)
    {
        $this->options = $options;
    }

    /**
     * @inheritDoc
     */
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $sharedManager = $events->getSharedManager();
        // Attach to the dispatch event of the AbstractController
        $sharedManager->attach(AbstractController::class, 'dispatch', [$this, 'setScriptList'], $priority);
    }

    /**
     * @param MvcEvent $e
     */
    public function setScriptList( MvcEvent $e)
    {
        /* @var AbstractController $controller*/
        $controller = $e->getTarget();
        $layout = $controller->layout();
        $routeMatchedName = $e->getRouteMatch()->getMatchedRouteName();
        $layout->setVariable('scriptlist', $this->options->getScriptList($routeMatchedName));
    }

}