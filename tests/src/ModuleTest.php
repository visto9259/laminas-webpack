<?php

declare(strict_types=1);

namespace Webpack;

use Laminas\EventManager\EventManagerInterface;
use Laminas\EventManager\ListenerAggregateInterface;
use Laminas\Mvc\ApplicationInterface;
use Laminas\Mvc\MvcEvent;
use Laminas\ServiceManager\ServiceManager;
use Laminas\View\View;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Webpack\Config\WebpackOptions;
use Webpack\Listener\WebpackRouteListener;
use Webpack\Listener\WebpackViewListener;
use Webpack\View\Helper\ScriptLoaderHelper;

/**
 * @coversDefaultClass \Webpack\Module
 */
final class ModuleTest extends TestCase
{
    use ProphecyTrait;

    private Module $module;

    protected function setUp(): void
    {
        $this->module = new Module();
    }

    /**
     * @test
     * @covers ::getViewHelperConfig
     */
    public function getViewHelperConfig(): void
    {
        $config = $this->module->getViewHelperConfig();
        $this->assertIsArray($config);

        $this->assertArrayHasKey('aliases', $config);
        $this->assertArrayHasKey('factories', $config);

        $sm = new ServiceManager($config);
        $this->assertTrue($sm->has(ScriptLoaderHelper::class));
        $this->assertTrue($sm->has('webpackscriptloader'));
        $this->assertTrue($sm->has('webpackScriptLoader'));
    }

    /**
     * @test
     * @covers ::getServiceConfig
     */
    public function getServiceConfig(): void
    {
        $config = $this->module->getServiceConfig();
        $this->assertIsArray($config);

        $this->assertArrayHasKey('factories', $config);

        $sm = new ServiceManager($config);
        $this->assertTrue($sm->has(WebpackRouteListener::class));
        $this->assertTrue($sm->has(WebpackViewListener::class));
        $this->assertTrue($sm->has(WebpackOptions::class));
    }

    /**
     * @test
     * @covers ::onBootstrap
     */
    public function onBootstrap(): void
    {
        $e      = new MvcEvent();
        $app    = $this->prophesize(ApplicationInterface::class);
        $events = $this->prophesize(EventManagerInterface::class)->reveal();
        $sm     = $this->prophesize(ServiceManager::class);

        $view       = $this->prophesize(View::class);
        $viewEvents = $this->prophesize(EventManagerInterface::class)->reveal();
        $view->getEventManager()->willReturn($viewEvents);

        $e->setApplication($app->reveal());
        $app->getEventManager()->willReturn($events);
        $app->getServiceManager()->willReturn($sm->reveal());

        $listener1 = $this->prophesize(ListenerAggregateInterface::class);
        $listener1->attach($events)
            ->shouldBeCalled();

        $sm->get(WebpackRouteListener::class)
            ->shouldBeCalled()
            ->willReturn($listener1->reveal());

        $listener2 = $this->prophesize(ListenerAggregateInterface::class);
        $listener2->attach($viewEvents, 100)
            ->shouldBeCalled();

        $sm->get(View::class)
            ->shouldBeCalled()
            ->willReturn($view->reveal());

        $sm->get(WebpackViewListener::class)
            ->shouldBeCalled()
            ->willReturn($listener2->reveal());

        $this->module->onBootstrap($e);
    }
}
