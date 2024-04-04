<?php

namespace App\Foundation;

use App\Foundation\Exceptions\FileMalformedException;
use App\Foundation\Exceptions\FileNotFoundException;
use RuntimeException;
use function explode;
use function file_get_contents;
use function is_file;

class FileSystem
{
    private ?string $fileContent = null;

    public function read(string $pathToFile): self
    {
        if (!$this->fileExists($pathToFile)) {
            throw new FileNotFoundException("'$pathToFile' is not a file!");
        }

        $content = file_get_contents($pathToFile);

        if ($content === false) {
            throw new FileMalformedException("'$pathToFile' is malformed and cannot be opened!");
        }

        $this->fileContent = $content;

        return $this;
    }

    public function toArray(): array
    {
        if ($this->fileContent === null) {
            throw new RuntimeException('A file must be read first to be formatted');
        }

        return explode("\n", $this->fileContent);
    }

    public function toString(): string
    {
        if ($this->fileContent === null) {
            throw new RuntimeException('A file must be read first to be formatted');
        }

        return $this->fileContent;
    }

    public function fileExists(string $pathToFile): bool
    {
        return is_file($pathToFile);
    }
}
