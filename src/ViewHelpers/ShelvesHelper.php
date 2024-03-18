<?php

namespace App\ViewHelpers;

use App\Entities\Notebook;
use App\Entities\Shelf;

class ShelvesHelper extends ViewHelper
{
    public function getShelfTitle(Shelf $shelf): string
    {
        return app()->getLocale() === 'ar' ? $shelf->getArabicTitle() : $shelf->getEnglishTitte();
    }

    public function getNotebookTitle(Notebook $notebook): string
    {
        return app()->getLocale() === 'ar' ? $notebook->getArabicTitle() : $notebook->getEnglishTitle();
    }
}
