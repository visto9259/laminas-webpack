<?php

declare(strict_types=1);

namespace Webpack\Config;

use Laminas\ServiceManager\Exception\ServiceNotCreatedException;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Psr\Container\ContainerInterface;
use Webpack\Config\WebpackOptions;

use function is_callable;

/**
 * @coversDefaultClass \Webpack\Config\WebpackOptionsFactory
 */
final class WebpackOptionsFactoryTest extends TestCase
{
    use ProphecyTrait;

    private WebpackOptionsFactory $factory;

    protected function setUp(): void
    {
        $this->factory = new WebpackOptionsFactory();
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
     * @uses \Webpack\Config\WebpackOptions::__construct
     *
     * @test
     * @covers ::__invoke
     */
    public function invoke(): void
    {
        $container = $this->prophesize(ContainerInterface::class);
        $container->get('config')
            ->shouldBeCalled()
            ->willReturn([
                'webpack' => [],
            ]);

        $this->assertInstanceOf(
            WebpackOptions::class,
            $this->factory->__invoke($container->reveal(), WebpackOptions::class, [])
        );
    }

    /**
     * @test
     * @covers ::__invoke
     */
    public function invokeWithoutConfig(): void
    {
        $this->expectException(ServiceNotCreatedException::class);

        $container = $this->prophesize(ContainerInterface::class);
        $container->get('config')
            ->shouldBeCalled()
            ->willReturn([]);

        $this->factory->__invoke($container->reveal(), WebpackOptions::class, []);
    }
}
