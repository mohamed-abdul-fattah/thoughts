<?php

namespace App\Foundation\Composable;

trait LocaleHelpers
{
  private string $locale = 'en';

  public function getLocale(): string
  {
    return $this->locale;
  }
}
