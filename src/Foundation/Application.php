<?php

namespace App\Foundation;

use App\Foundation\Composable\LocaleHelpers;
use App\Foundation\Composable\PathHelpers;
use App\Foundation\Http\Exceptions\HttpNotFoundException;
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

    /**
     * @throws ReflectionException
     * @throws HttpNotFoundException
     */
    public function run(): void
    {
        $this->initLocale();

        $this->dispatchRequest();
    }

    private function initLocale(): void
    {
        $locale = $this->request->cookies->get('locale', $this->getLocale());
        $this->setLocale($locale);
    }

    /**
     * @return void
     * @throws HttpNotFoundException
     * @throws ReflectionException
     */
    private function dispatchRequest(): void
    {
        [$class, $method] = $this->router->getAction($this->request->getUri());
        $controller       = DependencyContainer::resolve($class);

        echo call_user_func_array([$controller, $method], []);
    }
}
