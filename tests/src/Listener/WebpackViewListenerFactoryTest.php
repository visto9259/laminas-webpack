<?php

declare(strict_types=1);

namespace Webpack\Listener;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Psr\Container\ContainerInterface;
use Webpack\Config\WebpackOptions;
use Webpack\Listener\WebpackViewListener;

use function is_callable;

/**
 * @coversDefaultClass \Webpack\Listener\WebpackViewListenerFactory
 */
final class WebpackViewListenerFactoryTest extends TestCase
{
    use ProphecyTrait;

    private WebpackViewListenerFactory $factory;

    protected function setUp(): void
    {
        $this->factory = new WebpackViewListenerFactory();
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
     * @uses \Webpack\Listener\WebpackViewListener::__construct
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
            WebpackViewListener::class,
            $this->factory->__invoke($container->reveal(), WebpackViewListener::class, [])
        );
    }
}
