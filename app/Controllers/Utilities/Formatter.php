<?php

namespace App\Controllers\Utilities;

class Formatter
{
    public function formatToIndonesianNumber($number)
    {
        return number_format($number, 2, ',', '.');
    }
}
