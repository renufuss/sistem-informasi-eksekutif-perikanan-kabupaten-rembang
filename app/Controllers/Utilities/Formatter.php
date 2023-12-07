<?php

namespace App\Controllers\Utilities;

class Formatter
{
    public function formatToIndonesianNumber($number)
    {
        return number_format($number, 2, ',', '.');
    }

    public function formatToRawNumber($input)
    {
        $withoutDots = str_replace('.', '', $input);
        $formattedNumber = str_replace(',', '.', $withoutDots);

        return $formattedNumber;
    }

}
