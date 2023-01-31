<?php
/**
 * Factory for the ScriptLoaderHelper
 * Requires that the application has a PHP Renderer
 *
 * @author Eric Richer <eric.richer@vistoconsulting.com>
 *
 */


namespace Webpack\View\Helper;


use Exception;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\View\Renderer\PhpRenderer;
use Webpack\Config\WebpackOptions;

class ScriptLoaderHelperFactory implements FactoryInterface
{

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        // Get the PHP Renderer service
        $renderer = $container->get(PhpRenderer::class);
        if (!$renderer) throw new Exception('No PHP Renderer defined');
        $webpackOptions = $container->get(WebpackOptions::class);
        return new ScriptLoaderHelper($renderer, $webpackOptions);
    }
}
