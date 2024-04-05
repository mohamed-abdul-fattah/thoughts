<?php

namespace App\ViewHelpers;

use App\Foundation\Exceptions\FileNotFoundException;
use App\Foundation\FileSystem;

class ViewHelper
{
  public function __construct(private readonly FileSystem $fileSystem) {}

  public function includePartial(string $filename): void
  {
    $path = app()->getViewPath() . "/$filename.phtml";

    if (!$this->fileSystem->fileExists($path)) {
      throw new FileNotFoundException("'$path' is not a file!");
    }

    include $path;
  }

    /**
     * Converts a given date string to a human-readable format.
     *
     * @param string $date The date string to be converted.
     * @return string The converted date in the format "Month day, Year".
     */
  public function humanDate(string $date): string
  {
      return date('F j, Y', strtotime($date));
  }
}
