<?php

namespace App\Controllers\Utilities;

class Color
{
    public function randomRGBA()
    {
        // Generate random values for red, green, blue, and alpha (transparency)
        $red = rand(0, 255);
        $green = rand(0, 255);
        $blue = rand(0, 255);
        $alphaBackground = 0.6; // Background transparency
        $alphaBorder = 1.0; // Border transparency

        // Format the RGBA values
        $backgroundColor = "rgba($red, $green, $blue, $alphaBackground)";
        $borderColor = "rgba($red, $green, $blue, $alphaBorder)";

        // Return an array with background and border colors
        return [
            'background_color' => $backgroundColor,
            'border_color' => $borderColor,
        ];
    }
}
