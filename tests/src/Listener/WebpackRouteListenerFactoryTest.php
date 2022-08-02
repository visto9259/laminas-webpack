<?php

declare(strict_types=1);

namespace Webpack\Listener;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Psr\Container\ContainerInterface;
use Webpack\Config\WebpackOptions;

use function is_callable;

/**
 * @coversDefaultClass \Webpack\Listener\WebpackRouteListenerFactory
 */
final class WebpackRouteListenerFactoryTest extends TestCase
{
    use ProphecyTrait;

    private WebpackRouteListenerFactory $factory;

    protected function setUp(): void
    {
        $this->factory = new WebpackRouteListenerFactory();
    }

    /**
     * @test
     * @coversNothing
     */
    public function invokalbe(): void
    {
        $this->assertTrue(is_callable($this->factory));
    }

    /**
     * @uses \Webpack\Listener\WebpackRouteListener::__construct
     *
     * @test
     * @covers ::__invoke
     */
    public function invoke(): void
    {
        $options = $this->prophesize(WebpackOptions::class);

        $container = $this->prophesize(ContainerInterface::class);
        $container->get(WebpackOptions::class)
            ->shouldBeCalled()
            ->willReturn($options->reveal());

        $this->assertInstanceOf(
            WebpackRouteListener::class,
            $this->factory->__invoke($container->reveal(), WebpackRouteListener::class, [])
        );
    }
}
