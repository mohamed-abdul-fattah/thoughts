<?php

namespace App\Foundation\Composable;

trait PathHelpers
{
  private const string APP_ROOT = __DIR__.'/../../..';

  public function getRootPath(): string
  {
    return self::APP_ROOT;
  }

  public function getViewPath(): string
  {
    return self::APP_ROOT . '/src/views';
  }
}
