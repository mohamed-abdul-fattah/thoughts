<?php

namespace App\Foundation;

use App\ViewHelpers\ViewHelper;
use App\Utils\StringUtils;

class ViewRenderer
{
  public function renderView(string $viewPath, string $controllerName, array $args): string
  {
    ob_start();
    $this->loadView($viewPath, $controllerName, $args);
    return ob_get_clean();
  }

  private function loadView(string $viewPath, string $controllerName, array $args): void
  {
    extract($args);
    $helper = $this->getViewHelper($controllerName);
    include app()->getViewPath() . '/' . $this->resolveViewNotationToPath($viewPath) . '.phtml';
  }

  private function resolveViewNotationToPath(string $viewPath): string
  {
    return str_replace('.', '/', $viewPath);
  }

  private function getViewHelper(string $controllerName): ViewHelper
  {
    $domainName = StringUtils::replace($controllerName, 'Controller', '');
    $className  = "\\App\\ViewHelpers\\{$domainName}Helper";
    $class      = class_exists($className) ? $className : ViewHelper::class;

    return new $class(new FileSystem());
  }
}
