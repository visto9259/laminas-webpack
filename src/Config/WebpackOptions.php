<?php

declare(strict_types=1);

namespace Webpack\Config;

use Exception;
use Laminas\Stdlib\AbstractOptions;

use function file_exists;
use function fnmatch;

/**
 * Webpack options
 */
class WebpackOptions extends AbstractOptions
{
    protected array $routes    = [];
    protected array $templates = [];

    // phpcs:ignore WebimpressCodingStandard.NamingConventions.ValidVariableName.NotCamelCapsProperty
    protected ?string $dist_path = null;

    // phpcs:ignore WebimpressCodingStandard.NamingConventions.ValidVariableName.NotCamelCapsProperty
    protected ?string $default_entry_point = null;

    // phpcs:ignore WebimpressCodingStandard.NamingConventions.ValidVariableName.NotCamelCapsProperty
    protected ?string $entrypoint_map_file = null;

    // phpcs:ignore WebimpressCodingStandard.NamingConventions.ValidVariableName.NotCamelCapsProperty
    protected array $entry_point_map = [];

    public function setRoutes(array $routes): void
    {
        $this->routes = $routes;
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }

    public function setDistPath(string $path): void
    {
        $this->dist_path = $path;
    }

    public function getDistPath(): ?string
    {
        return $this->dist_path;
    }

    public function setDefaultEntryPoint(string $entryPoint): void
    {
        $this->default_entry_point = $entryPoint;
    }

    public function getDefaultEntryPoint(): ?string
    {
        return $this->default_entry_point;
    }

    /**
     * @throws Exception
     */
    public function setEntrypointMapFile(string $entryPointMapFile): void
    {
        if (! file_exists($entryPointMapFile)) {
            throw new Exception("$entryPointMapFile does not exists.");
        }
        $this->entrypoint_map_file = $entryPointMapFile;
        $this->entry_point_map     = include $entryPointMapFile;
    }

    public function getEntrypointMapFile(): ?string
    {
        return $this->entrypoint_map_file;
    }

    public function setTemplates(array $templates): void
    {
        $this->templates = $templates;
    }

    public function getTemplates(): array
    {
        return $this->templates;
    }

    public function getScriptListByRoute(string $routeMatched): array
    {
        foreach ($this->routes as $key => $value) {
            if (fnmatch($key, $routeMatched)) {
                return $this->entry_point_map[$value];
            } elseif (fnmatch($value, $routeMatched)) {
                return $this->entry_point_map[$this->default_entry_point];
            }
        }
        return [];
    }

    public function getScriptListByTemplate(string $template): array
    {
        foreach ($this->templates as $key => $value) {
            if (fnmatch($key, $template)) {
                return $this->entry_point_map[$value];
            } elseif (fnmatch($value, $template)) {
                return $this->entry_point_map[$this->default_entry_point];
            }
        }
        return [];
    }
}
