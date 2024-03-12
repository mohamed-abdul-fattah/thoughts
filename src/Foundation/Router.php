<?php

namespace App\Foundation;

use App\Foundation\Http\Exceptions\HttpNotFoundException;
use App\Utils\StringUtils;
use ReflectionException;

class Router
{
    private array $routes;

    /**
     * @throws ReflectionException
     */
    public function __construct()
    {
        /** @var Config $config */
        $config = DependencyContainer::resolve(Config::class);
        $this->routes = $config->getRoutes();
    }

    /**
     * @throws HttpNotFoundException
     */
    public function getAction(string $path): array
    {
        if ($resolver = $this->routes[$path] ?? false) {
            return $this->getActionClass($resolver);
        }

        throw new HttpNotFoundException();
    }

    private function getActionClass(string $resolver): array
    {
        [$controller, $action] = StringUtils::splitBy('@', $resolver);
        $className = StringUtils::toTitleCase($controller) . 'Controller';

        return ["\App\Controllers\\{$className}", "{$action}Action"];
    }
}
