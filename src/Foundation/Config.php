<?php

namespace App\Foundation;

class Config
{
    private const string CONFIGS_DIR = __DIR__.'/../config';

    private array $routes = [];
    private array $databaseConfigs = [];

    public function getRoutes(): array
    {
        if (empty($this->routes)) {
            /** @noinspection PhpIncludeInspection */
            $this->routes = include(self::CONFIGS_DIR.'/routes.php');
        }

        return $this->routes;
    }

    public function getDatabaseConfigs(): array
    {
        if (empty($this->databaseConfigs)) {
            /** @noinspection PhpIncludeInspection */
            $this->databaseConfigs = include(self::CONFIGS_DIR.'/database.php');
        }

        return $this->databaseConfigs;
    }
}
