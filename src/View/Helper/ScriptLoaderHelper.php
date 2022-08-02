<?php

declare(strict_types=1);

namespace Webpack\View\Helper;

use Laminas\View\Helper\AbstractHelper;
use Laminas\View\Renderer\PhpRenderer;

use function is_array;
use function method_exists;

class ScriptLoaderHelper extends AbstractHelper
{
    protected PhpRenderer $renderer;
    protected bool $rendered = false;

    public function __construct(PhpRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * TODO Add other methods than append
     * TODO Add the possibility to pass the list as an argument
     */
    public function __invoke(): void
    {
        // If not already rendered.  To add the list of scripts multiple times
        if ($this->rendered) {
            return;
        }

        $view = $this->getView();
        // Get the list of scripts
        if (isset($this->renderer->scriptlist) && is_array($this->renderer->scriptlist)) {
            $scriptlist = $this->renderer->scriptlist;
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
