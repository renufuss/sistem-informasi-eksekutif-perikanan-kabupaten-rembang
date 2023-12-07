<?php

namespace App\Controllers\Utilities;

class Converter
{
    public function convertTonToKuintal($ton)
    {
        return $ton * 10;
    }

    public function convertKuintalToTon($kuintal)
    {
        return $kuintal / 10;
    }
}
