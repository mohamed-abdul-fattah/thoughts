<?php

namespace App\ViewHelpers\Composable;

trait LocaleHelpers
{
    public function getLang(): string
    {
        return app()->getLocale();
    }

    public function getLocaleSwitch(): string
    {
        if (app()->getLocale() === 'ar') {
            $toLang   = 'English';
            $toLocale = 'en';
        } else {
            $toLang   = 'عربي';
            $toLocale = 'ar';
        }

        return "<a href='/locale/switch?toLocale=$toLocale'>$toLang</a>";
    }
}
