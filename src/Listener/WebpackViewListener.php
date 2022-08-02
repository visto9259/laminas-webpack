<?php

declare(strict_types=1);

namespace Webpack\Listener;

use Laminas\EventManager\AbstractListenerAggregate;
use Laminas\EventManager\EventManagerInterface;
use Laminas\View\ViewEvent;
use Webpack\Config\WebpackOptions;

class WebpackViewListener extends AbstractListenerAggregate
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
        $events->attach(ViewEvent::EVENT_RENDERER, [$this, 'onRender'], $priority);
    }

    public function onRender(ViewEvent $event): void
    {
        $model    = $event->getModel();
        $template = $model->getTemplate();
        $list     = $this->options->getScriptListByTemplate($template);
        if (empty($list)) {
            return;
        }
        $model->setVariable('scriptlist', $list);
    }
}
