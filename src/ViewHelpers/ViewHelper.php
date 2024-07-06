<?php

namespace App\ViewHelpers;

use App\Foundation\FileSystem;
use App\ViewHelpers\Composable\DateHelpers;
use App\ViewHelpers\Composable\FileHelpers;
use App\ViewHelpers\Composable\LocaleHelpers;

class ViewHelper
{
    // TODO: Check whether using composition over inheritance for code organization like these helpers
    //  while they are not used elsewhere is right or not?
    use DateHelpers,
        LocaleHelpers,
        FileHelpers;

    public function __construct(private readonly FileSystem $fileSystem) {}

    public function getDirection(): string
    {
        return $this->getLang() === 'ar' ? 'rtl' : 'ltr';
    }
}
