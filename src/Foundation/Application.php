<?php

namespace App\Foundation;

use App\Foundation\Composable\LocaleHelpers;
use App\Foundation\Composable\PathHelpers;
use App\Foundation\Http\Request;
use ReflectionException;

class Application
{
    use PathHelpers, LocaleHelpers;

    private static ?Application $application = null;

    private Request      $request;
    private Router       $router;
    private ViewRenderer $renderer;
    private Config       $config;

    /**
     * @throws ReflectionException
     */
    private function __construct()
    {
        $this->request  = DependencyContainer::resolve(Request::class);
        $this->router   = DependencyContainer::resolve(Router::class);
        $this->renderer = DependencyContainer::resolve(ViewRenderer::class);
    }

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
        // TODO: Replace with dispatcher
        [$class, $method] = $this->router->getAction($this->request->getUri());
        $controller = new $class($this->renderer);

        echo call_user_func_array([$controller, $method], []);
    }
}
