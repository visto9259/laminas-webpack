<?php
/**
 * @author Eric Richer <eric.richer@vistoconsulting.com>
 *
 * Help Plugin to add the script list set by the variable 'scriptlist'
 */

namespace Webpack\View\Helper;


use Laminas\View\Helper\AbstractHelper;
use Laminas\View\Renderer\PhpRenderer;

class ScriptLoaderHelper extends AbstractHelper
{

    /**
     * @var PhpRenderer
     */
    protected $renderer;

    protected $rendered = false;

    public function __construct($renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * TODO Add other methods than append
     * TODO Add the possibility to pass the list as an argument
     */
    public function __invoke()
    {
        // If not already rendered.  To add the list of scripts multiple times
        if ($this->rendered) return;

        $view = $this->getView();
        // Get the list of scripts
        $scriptlist = $this->renderer->scriptlist;
        if ($scriptlist && is_array($scriptlist)) {
            if (method_exists($view, 'plugin')) {
                $helper = $view->plugin('headScript');
                foreach ($scriptlist as $key => $script) {
                    // Append the list of scripts in the HEAD section
                    $helper->appendFile($script);
                }
                $this->rendered = true;
            }
        }
    }
}