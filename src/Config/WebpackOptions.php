<?php
/**
 * Webpack options
 * @author Eric Richer <eric.richer@vistoconsulting.com>
 */

namespace Webpack\Config;


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

    public function setEntrypointMapFile($entryPointMapFile)
    {
        $this->entrypoint_map_file = $entryPointMapFile;
        $this->entry_point_map = include $entryPointMapFile;

    }

    /**
     * @param $routeMatched string
     * @return array
     */
    public function getScriptList($routeMatched)
    {
        $found = false;
        foreach ($this->routes as $key=>$value) {
            if (fnmatch($key, $routeMatched)) {
                return $this->entry_point_map[$value];
            } elseif (fnmatch($value, $routeMatched)) {
                return $this->entry_point_map[$this->default_entry_point];
            }
        }
        return [];

    }


}