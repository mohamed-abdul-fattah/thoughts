<?php

namespace App\ViewHelpers\Composable;

use DateTime;

trait DatesHelper
{
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

    public function today(): DateTime
    {
        return new DateTime();
    }
}
