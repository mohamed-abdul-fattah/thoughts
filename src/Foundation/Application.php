<?php

namespace App\Foundation;

use App\Foundation\Composable\LocaleHelpers;
use App\Foundation\Composable\PathHelpers;
use App\Foundation\Http\Request;

class Application
{
  use PathHelpers,
      LocaleHelpers;

  private static ?Application $application = null;

  private Request      $request;
  private Router       $router;
  private ViewRenderer $renderer;

  public static function getInstance(): Application
  {
    if (self::$application) {
      return self::$application;
    }

    self::$application = new Application();
    return self::$application;
  }

  public function run(): void
  {
    [$class, $method] = $this->router->getAction($this->request->getUri());
    $controller       = new $class($this->renderer);

    echo call_user_func_array([$controller, $method], []);
  }

  private function __construct()
  {
    $this->request  = new Request();
    $this->router   = new Router();
    $this->renderer = new ViewRenderer();
  }
}
