<?php

declare(strict_types=1);

namespace Webpack\View\Helper;

use Laminas\View\Helper\HeadScript as Helper;
use Laminas\View\Renderer\PhpRenderer;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;

use function is_callable;

/**
 * @coversDefaultClass \Webpack\View\Helper\ScriptLoaderHelper
 */
final class ScriptLoaderHelperTest extends TestCase
{
    use ProphecyTrait;

    private ScriptLoaderHelper $helper;
    private ObjectProphecy $renderer;

    protected function setUp(): void
    {
        $this->renderer = $this->prophesize(PhpRenderer::class);
        $this->helper   = new ScriptLoaderHelper($this->renderer->reveal());
    }

    /**
     * @test
     * @coversNothing
     */
    public function invokalbe(): void
    {
        $this->assertTrue(is_callable($this->helper));
    }

    /**
     * @test
     * @covers ::__construct
     * @covers ::__invoke
     */
    public function invoke(): void
    {
        $this->renderer->vars()->willReturn([
            'scriptlist' => [
                'test.js',
                'foo.js',
            ],
        ]);

        $headScript = $this->prophesize(Helper::class);
        $headScript->appendFile('test.js')
            ->shouldBeCalledTimes(1);
        $headScript->appendFile('foo.js')
            ->shouldBeCalledTimes(1);

        $view = $this->prophesize(PhpRenderer::class);

        $view->plugin('headScript')
            ->willReturn($headScript->reveal());

        $this->helper->setView($view->reveal());

        $this->helper->__invoke();
        $this->helper->__invoke(); // execute twice, appendFile()s should no be called again
    }

    /**
     * @test
     * @covers ::__construct
     * @covers ::__invoke
     * @dataProvider provideViewVars
     */
    public function invokeEmptyScriptList(array $vars): void
    {
        $this->renderer->vars()->willReturn($vars);

        $headScript = $this->prophesize(Helper::class);
        $headScript->appendFile()
            ->shouldNotBeCalled();

        $view = $this->prophesize(PhpRenderer::class);

        $view->plugin('headScript')
            ->willReturn($headScript->reveal());

        $this->helper->setView($view->reveal());
        $this->helper->__invoke();
    }

    public function provideViewVars(): array
    {
        return [
            [
                // empty
                'vars' => [
                    'scriptlist' => [],
                ],
            ],
            [
                // not an array
                'vars' => [
                    'scriptlist' => null,
                ],
            ],
            [
                // missing the var
                'vars' => [],
            ],
        ];
    }
}
