<?php

declare(strict_types=1);

namespace Webpack\Listener;

use Laminas\EventManager\EventManagerInterface;
use Laminas\EventManager\SharedEventManagerInterface;
use Laminas\Mvc\Controller\AbstractController;
use Laminas\Mvc\MvcEvent;
use Laminas\Router\RouteMatch;
use Laminas\View\Model\ViewModel;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use Webpack\Config\WebpackOptions;

/**
 * @coversDefaultClass \Webpack\Listener\WebpackRouteListener
 */
final class WebpackRouteListenerTest extends TestCase
{
    use ProphecyTrait;

    private WebpackRouteListener $listener;
    private ObjectProphecy $options;

    protected function setUp(): void
    {
        $this->options  = $this->prophesize(WebpackOptions::class);
        $this->listener = new WebpackRouteListener($this->options->reveal());
    }

    /**
     * @uses \Webpack\Listener\WebpackRouteListener::__construct
     *
     * @test
     * @covers ::attach
     */
    public function attach(): void
    {
        $events       = $this->prophesize(EventManagerInterface::class);
        $sharedEvents = $this->prophesize(SharedEventManagerInterface::class);
        $events->getSharedManager()
            ->willReturn($sharedEvents->reveal());

        $sharedEvents->attach(
            AbstractController::class,
            MvcEvent::EVENT_DISPATCH,
            [$this->listener, 'setScriptList'],
            100
        )
            ->shouldBeCalled();

        $this->listener->attach($events->reveal(), 100);
    }

    /**
     * @test
     * @covers ::__construct
     * @covers ::setScriptList
     */
    public function setScriptList(): void
    {
        $layout     = new ViewModel();
        $routeMatch = $this->prophesize(RouteMatch::class);
        $routeMatch->getMatchedRouteName()->willReturn('abcd');

        $e          = new MvcEvent();
        $controller = $this->prophesize(AbstractController::class);
        $e->setTarget($controller->reveal());
        $e->setRouteMatch($routeMatch->reveal());

        $controller->plugin('layout')
            ->willReturn($layout);

        $this->options->getScriptListByRoute('abcd')
            ->willReturn(['a.js', 'b.js']);

        $this->listener->setScriptList($e);

        $this->assertSame(['a.js', 'b.js'], $layout->getVariable('scriptlist'));
    }
}
