<?php

namespace App\ViewHelpers\Composable;

use App\Foundation\Exceptions\FileNotFoundException;

trait FileHelpers
{
    public function includePartial(string $filename, array $variables = []): void
    {
        $path = app()->getViewPath() . "/$filename.phtml";

        if (!$this->fileSystem->fileExists($path)) {
            throw new FileNotFoundException("'$path' is not a file!");
        }

        $variables['helper'] = $this;
        extract($variables);

        include $path;
    }
}
