<?php

namespace App\Foundation;

class DotEnv
{
  public static function get(string $key, mixed $default = null): mixed
  {
    $value = getenv($key);

    return $value === false ? $default : $value;
  }
}
