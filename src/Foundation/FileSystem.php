<?php

namespace App\Foundation;

use App\Foundation\Exceptions\FileMalformedException;
use App\Foundation\Exceptions\FileNotFoundException;

class FileSystem
{
  public function read(string $pathToFile): array
  {
    if (!$this->doesExist($pathToFile)) {
      throw new FileNotFoundException("'{$pathToFile}' is not a file!");
    }

    $content = file_get_contents($pathToFile);

    if ($content === false) {
      throw new FileMalformedException("'{$pathToFile}' is malformed and cannot be opened!");
    }

    return explode("\n", $content);
  }

  public function doesExist(string $pathToFile): bool
  {
    return is_file($pathToFile);
  }
}
