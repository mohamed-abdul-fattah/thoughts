<?php

namespace App\Foundation;

class ViewRenderer
{
  private const string VIEWS_PATH = __DIR__.'/../views/';

  public function renderView(string $viewPath, array $args): string
  {
    ob_start();
    $this->loadView($viewPath);
    return ob_get_clean();
  }

  private function loadView(string $viewPath): void
  {
    include self::VIEWS_PATH . $this->resolveViewNotationToPath($viewPath) . '.phtml';
  }

  private function resolveViewNotationToPath(string $viewPath): string
  {
    return str_replace('.', '/', $viewPath);
  }
}
