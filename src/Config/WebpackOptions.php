<?php
/**
 * Webpack options
 * @author Eric Richer <eric.richer@vistoconsulting.com>
 */

namespace Webpack\Config;

use Exception;
use Laminas\Stdlib\AbstractOptions;

class WebpackOptions extends AbstractOptions
{

    /**
     * @var array
     */
    protected $routes;
    /**
     * @var string
     */
    protected $dist_path;
    /**
     * @var string
     */
    protected $default_entry_point;
    /**
     * @var string
     */
    protected $entrypoint_map_file;

    /**
     * @var array
     */
    protected $entry_point_map = [];

    protected $templates = [];

    public function setRoutes($routes)
    {
        $this->routes = $routes;
    }

    public function setdistpath($path)
    {
        $this->dist_path = $path;
    }

    public function setDefaultEntryPoint($entryPoint)
    {
        $this->default_entry_point = $entryPoint;
    }

    /**
     * @param $entryPointMapFile
     * @throws Exception
     */
    public function setEntrypointMapFile($entryPointMapFile)
    {
        if (!file_exists($entryPointMapFile)) {
            throw new Exception("$entryPointMapFile does not exists.");
        }
        $this->entrypoint_map_file = $entryPointMapFile;
        $this->entry_point_map = include $entryPointMapFile;
    }

    /**
     * @param $templates array
     */
    public function setTemplates($templates)
    {
        $this->templates = $templates;
    }

    /**
     * @param $routeMatched string
     * @return array
     * @deprecated
     */
    public function getScriptList($routeMatched)
    {
        return $this->getScriptListByRoute($routeMatched);
    }


    /**
     * @param $routeMatched string
     * @return array
     */
    public function getScriptListByRoute($routeMatched)
    {
        foreach ($this->routes as $key=>$value) {
            if (fnmatch($key, $routeMatched)) {
                return $this->entry_point_map[$value];
            } elseif (fnmatch($value, $routeMatched)) {
                return $this->entry_point_map[$this->default_entry_point];
            }
        }
        return [];
    }

    /**
     * @param $template string
     * @return array
     */
    public function getScriptListByTemplate($template)
    {
        foreach ($this->templates as $key=>$value) {
            if (fnmatch($key, $template)) {
                return $this->entry_point_map[$value];
            } elseif (fnmatch($value, $template)) {
                return $this->entry_point_map[$this->default_entry_point];
            }
        }
        return [];
    }
}