<?php

namespace App\Controllers;

use App\Foundation\Http\Response;
use App\Foundation\ViewRenderer;

abstract class Controller
{
  public function __construct(protected ViewRenderer $renderer)
  {
    //
  }

  protected function render(string $viewPath, array $args = []): Response
  {
    $html         = $this->renderer->renderView($viewPath, $args);
    $httpResponse = new Response();

    return $httpResponse->setHtml($html);
  }
}
