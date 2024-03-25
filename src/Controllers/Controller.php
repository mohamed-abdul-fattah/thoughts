<?php

namespace App\Controllers;

use App\Foundation\Http\Request;
use App\Foundation\Http\Response;
use App\Foundation\ViewRenderer;
use App\Utils\StringUtils;
use JetBrains\PhpStorm\NoReturn;
use ReflectionException;

abstract class Controller
{
  public function __construct(private readonly ViewRenderer $renderer, protected readonly Request $request) {}

  /**
   * @throws ReflectionException
   */
  protected function render(string $viewPath, array $args = []): Response
  {
    $html         = $this->renderer->renderView($viewPath, StringUtils::getClassShortName($this), $args);
    $httpResponse = new Response();

    return $httpResponse->setHtml($html);
  }

  #[NoReturn]
  protected function redirectToUrl(string $url): void
  {
      header("Location: $url");
      die;
  }
}
