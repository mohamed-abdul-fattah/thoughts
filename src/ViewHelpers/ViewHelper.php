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
}
