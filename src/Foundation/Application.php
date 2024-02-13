<?php

namespace App\Foundation;

use App\Foundation\Http\Request;

class Application
{
  private Request $request;

  private Router $router;

  public function __construct()
  {
    $this->request = new Request();
    $this->router  = new Router();
  }

  public function run(): void
  {
    [$class, $method] = $this->router->getAction($this->request->getPath());
    $controller       = new $class;

    echo call_user_func_array([$controller, $method], []);
  }
}
