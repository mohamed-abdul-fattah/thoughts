<?php

namespace App\ViewHelpers;

use App\Entities\Shelf;

class ShelvesHelper extends ViewHelper
{
    public function getTitle(Shelf $shelf): string
    {
        return app()->getLocale() === 'ar' ? $shelf->getArabicTitle() : $shelf->getEnglishTitte();
    }
}
