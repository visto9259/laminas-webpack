<?php


namespace Webpack\Listener;


use Laminas\EventManager\EventManagerInterface;
use Laminas\View\ViewEvent;
use Webpack\Config\WebpackOptions;

class WebpackViewListener extends \Laminas\EventManager\AbstractListenerAggregate
{

    /**
     * @var WebpackOptions
     */
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
        $events->attach(ViewEvent::EVENT_RENDERER, [$this, 'onRender'], $priority);
    }

    public function onRender(ViewEvent $event)
    {
        $model = $event->getModel();
        $template = $model->getTemplate();
        $list = $this->options->getScriptListByTemplate($template);
        if (empty($list)) return;
        $model->setVariable('scriptlist', $list);
    }
}