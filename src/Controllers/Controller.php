<?php

namespace App\Controllers;

use App\Foundation\Http\Response;
use App\Foundation\ViewRenderer;
use App\Utils\StringUtils;
use ReflectionException;

abstract class Controller
{
  public function __construct(protected ViewRenderer $renderer)
  {
    //
  }

  /**
   * @throws ReflectionException
   */
  protected function render(string $viewPath, array $args = []): Response
  {
    $html         = $this->renderer->renderView($viewPath, StringUtils::getClassShortName($this), $args);
    $httpResponse = new Response();

    return $httpResponse->setHtml($html);
  }
}
