<?php

namespace App\Utils;

use ReflectionException;
use ReflectionClass;

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

  public static function toLower(string $string): string
  {
    return strtolower($string);
  }

  public static function replace(string $string, string $pattern, string $replace): string
  {
    return str_replace($pattern, $replace, $string);
  }

  /**
   * @throws ReflectionException
   */
  public static function getClassShortName($object): string
  {
    return (new ReflectionClass($object))->getShortName();
  }
}
