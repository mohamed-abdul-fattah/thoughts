<?php

namespace App\Foundation;

use App\Foundation\Http\Exceptions\HttpNotFoundException;
use App\Utils\StringUtils;

class Router
{
  private array $routes;

  public function __construct()
  {
    $this->routes = include(__DIR__.'/../config/routes.php');
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
    $className             = StringUtils::toTitleCase($controller) . 'Controller';

    return [
      "\App\Controllers\\{$className}",
      "{$action}Action"
    ];
  }
}
