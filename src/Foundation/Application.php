<?php

namespace App\Foundation;

use App\Foundation\Http\Request;

class Application
{
  private Request      $request;
  private Router       $router;
  private ViewRenderer $renderer;

  public function __construct()
  {
    $this->request  = new Request();
    $this->router   = new Router();
    $this->renderer = new ViewRenderer();
  }

  public function run(): void
  {
    [$class, $method] = $this->router->getAction($this->request->getUri());
    $controller       = new $class($this->renderer);

    echo call_user_func_array([$controller, $method], []);
  }
}
