<?php

namespace App\Foundation\Composable;

trait LocaleHelpers
{
  private string $locale = 'ar';

  public function getLocale(): string
  {
    return $this->locale;
  }

  public function setLocale(string $locale): void
  {
      $this->locale = $locale;
  }
}
