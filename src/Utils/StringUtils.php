<?php

namespace App\Utils;

class StringUtils
{
  public static function splitBy(string $delimiter, string $string): array
  {
    return explode($delimiter, $string);
  }

  public static function toTitleCase(string $string): string
  {
    return strtoupper(substr($string, 0, 1)) . substr($string, 1);
  }
}
