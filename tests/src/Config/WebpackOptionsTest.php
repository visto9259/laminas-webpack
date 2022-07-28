<?php

declare(strict_types=1);

namespace Webpack\Config;

use Exception;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

use function file_put_contents;
use function var_export;

/**
 * @coversDefaultClass \Webpack\Config\WebpackOptions
 */
final class WebpackOptionsTest extends TestCase
{
    use ProphecyTrait;

    private WebpackOptions $options;
    private vfsStreamDirectory $root;
    private string $entrypointFile;
    private array $entrypointFileContent = [
        'app1' => ['script1', 'script2'],
        'app2' => ['script3', 'script4'],
    ];

    protected function setUp(): void
    {
        $this->root           = vfsStream::setup('webpack');
        $this->entrypointFile = vfsStream::url('webpack/entrypoint.php');

        file_put_contents(
            $this->entrypointFile,
            '<?php return ' . var_export($this->entrypointFileContent, true) . ';'
        );

        $this->options = new WebpackOptions([
            'routes'              => [
                'route1' => 'app1',
                'route2' => 'app2',
            ],
            'templates'           => [
                'template1' => 'app1',
                'template2' => 'app2',
            ],
            'dist_path'           => 'dist/',
            'default_entry_point' => 'app2',
            'entrypoint_map_file' => $this->entrypointFile,
        ]);
    }

    /**
     * @test
     * @covers ::getRoutes
     * @covers ::setRoutes
     * @covers ::setDefaultEntryPoint
     * @covers ::getDefaultEntryPoint
     * @covers ::setEntrypointMapFile
     * @covers ::getEntrypointMapFile
     * @covers ::setTemplates
     * @covers ::getTemplates
     * @covers ::setDistPath
     * @covers ::getDistPath
     */
    public function constructorAndSetterPlusGetters(): void
    {
        $this->assertSame(
            [
                'route1' => 'app1',
                'route2' => 'app2',
            ],
            $this->options->routes
        );
        $this->assertSame(
            [
                'route1' => 'app1',
                'route2' => 'app2',
            ],
            $this->options->getRoutes()
        );

        $this->assertSame('dist/', $this->options->dist_path);
        $this->assertSame('dist/', $this->options->getDistPath());

        $this->assertSame('app2', $this->options->default_entry_point);
        $this->assertSame('app2', $this->options->getDefaultEntryPoint());

        $this->assertSame(['template1' => 'app1', 'template2' => 'app2'], $this->options->templates);
        $this->assertSame(['template1' => 'app1', 'template2' => 'app2'], $this->options->getTemplates());

        $this->assertSame($this->entrypointFile, $this->options->entrypoint_map_file);
        $this->assertSame($this->entrypointFile, $this->options->getEntrypointMapFile());
    }

    /**
     * @uses \Webpack\Config\WebpackOptions::setRoutes
     * @uses \Webpack\Config\WebpackOptions::setDefaultEntryPoint
     * @uses \Webpack\Config\WebpackOptions::setEntrypointMapFile
     * @uses \Webpack\Config\WebpackOptions::setTemplates
     * @uses \Webpack\Config\WebpackOptions::setDistPath
     *
     * @test
     * @covers ::getRoutes
     * @covers ::getDefaultEntryPoint
     * @covers ::getEntrypointMapFile
     * @covers ::getTemplates
     * @covers ::getDistPath
     */
    public function defaultValues(): void
    {
        $options = new WebpackOptions();

        $this->assertNull($options->dist_path);
        $this->assertNull($options->getDistPath());

        $this->assertNull($options->default_entry_point);
        $this->assertNull($options->getDefaultEntryPoint());

        $this->assertSame([], $options->templates);
        $this->assertSame([], $options->getTemplates());

        $this->assertSame([], $options->routes);
        $this->assertSame([], $options->getRoutes());

        $this->assertNull($options->entrypoint_map_file);
        $this->assertNull($options->getEntrypointMapFile());
    }

    /**
     * @uses \Webpack\Config\WebpackOptions::setDefaultEntryPoint
     * @uses \Webpack\Config\WebpackOptions::setDistPath
     * @uses \Webpack\Config\WebpackOptions::setRoutes
     * @uses \Webpack\Config\WebpackOptions::setTemplates
     *
     * @test
     * @covers ::setEntrypointMapFile
     */
    public function entryPointMapFileDoesntExist(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('error.php does not exists.');
        $this->options->setEntrypointMapFile('error.php');
    }

    /**
     * @uses \Webpack\Config\WebpackOptions::setDefaultEntryPoint
     * @uses \Webpack\Config\WebpackOptions::setDistPath
     * @uses \Webpack\Config\WebpackOptions::setRoutes
     * @uses \Webpack\Config\WebpackOptions::setTemplates
     * @uses \Webpack\Config\WebpackOptions::setEntrypointMapFile
     *
     * @test
     * @covers ::getScriptListByRoute
     */
    public function getScriptListByRoute(): void
    {
        $this->assertSame(['script1', 'script2'], $this->options->getScriptListByRoute('route1'));
        $this->assertSame([], $this->options->getScriptListByRoute('route3'));
        $this->assertSame(['script3', 'script4'], $this->options->getScriptListByRoute('app2'));
    }

    /**
     * @uses \Webpack\Config\WebpackOptions::setDefaultEntryPoint
     * @uses \Webpack\Config\WebpackOptions::setDistPath
     * @uses \Webpack\Config\WebpackOptions::setRoutes
     * @uses \Webpack\Config\WebpackOptions::setTemplates
     * @uses \Webpack\Config\WebpackOptions::setEntrypointMapFile
     *
     * @test
     * @covers ::getScriptListByTemplate
     */
    public function getScriptListByTemplate(): void
    {
        $this->assertSame(['script1', 'script2'], $this->options->getScriptListByTemplate('template1'));
        $this->assertSame([], $this->options->getScriptListByTemplate('template3'));
        $this->assertSame(['script3', 'script4'], $this->options->getScriptListByTemplate('app2'));
    }
}
