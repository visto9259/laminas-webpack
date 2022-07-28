<?php

declare(strict_types=1);

namespace Webpack\View\Helper;

use interop\container\containerinterface;
use Laminas\View\Renderer\PhpRenderer;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

use function is_callable;

/**
 * @coversDefaultClass \Webpack\View\Helper\ScriptLoaderHelperFactory
 */
final class ScriptLoaderHelperFactoryTest extends TestCase
{
    use ProphecyTrait;

    private ScriptLoaderHelperFactory $factory;

    protected function setUp(): void
    {
        $this->factory = new ScriptLoaderHelperFactory();
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
     * @uses \Webpack\View\Helper\ScriptLoaderHelper::__construct
     *
     * @test
     * @covers ::__invoke
     */
    public function invoke(): void
    {
        $renderer = $this->prophesize(PhpRenderer::class);

        $container = $this->prophesize(containerinterface::class);
        $container->get(PhpRenderer::class)
            ->shouldBeCalled()
            ->willReturn($renderer->reveal());

        $this->assertInstanceOf(
            ScriptLoaderHelper::class,
            $this->factory->__invoke($container->reveal(), ScriptLoaderHelper::class, [])
        );
    }
}
