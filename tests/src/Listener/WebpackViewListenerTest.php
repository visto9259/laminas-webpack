<?php

declare(strict_types=1);

namespace Webpack\Listener;

use Laminas\EventManager\EventManagerInterface;
use Laminas\View\Model\ViewModel;
use Laminas\View\ViewEvent;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use Webpack\Config\WebpackOptions;

/**
 * @coversDefaultClass \Webpack\Listener\WebpackViewListener
 */
final class WebpackViewListenerTest extends TestCase
{
    use ProphecyTrait;

    private WebpackViewListener $listener;
    private ObjectProphecy $options;

    protected function setUp(): void
    {
        $this->options  = $this->prophesize(WebpackOptions::class);
        $this->listener = new WebpackViewListener($this->options->reveal());
    }

    /**
     * @uses \Webpack\Listener\WebpackViewListener::__construct
     *
     * @test
     * @covers ::attach
     */
    public function attach(): void
    {
        $events = $this->prophesize(EventManagerInterface::class);

        $events->attach(
            ViewEvent::EVENT_RENDERER,
            [$this->listener, 'onRender'],
            100
        )
            ->shouldBeCalled();

        $this->listener->attach($events->reveal(), 100);
    }

    /**
     * @test
     * @covers ::__construct
     * @covers ::onRender
     */
    public function onRender(): void
    {
        $e     = new ViewEvent();
        $model = new ViewModel();
        $model->setTemplate('testtemplate');
        $e->setModel($model);

        $this->options->getScriptListByTemplate('testtemplate')
            ->shouldBeCalled()
            ->willReturn(['c.js', 'd.js']);

        $this->listener->onRender($e);

        $this->assertSame(['c.js', 'd.js'], $model->getVariable('scriptlist'));
    }

    /**
     * @test
     * @covers ::__construct
     * @covers ::onRender
     */
    public function onRenderEmptyScriptList(): void
    {
        $e     = new ViewEvent();
        $model = new ViewModel();
        $model->setTemplate('testtemplate');
        $e->setModel($model);

        $this->options->getScriptListByTemplate('testtemplate')
            ->shouldBeCalled()
            ->willReturn([]);

        $this->listener->onRender($e);

        $this->assertNull($model->getVariable('scriptlist'));
    }
}
