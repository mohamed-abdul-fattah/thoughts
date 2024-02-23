<?php

namespace App\Foundation;

use App\Foundation\Http\Request;

class Application
{
  private const string APP_ROOT = __DIR__.'/../..';

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

  public function getRootPath(): string
  {
    return self::APP_ROOT;
  }

  public function getConfigPath(): string
  {
    return self::APP_ROOT . '/src/config';
  }

  private function __construct()
  {
    $this->request  = new Request();
    $this->router   = new Router();
    $this->renderer = new ViewRenderer();
  }
}
