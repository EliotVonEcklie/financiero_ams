<?php

namespace App\Helpers;

class Censor
{
    public static function str($string, $uncensoredChars = 2) {
        $uncensoredPart = mb_substr($string, 0, $uncensoredChars);
        $censoredPart = mb_substr($string, $uncensoredChars);

        $censoredPart = preg_replace('/[a-zA-Z0-9]/', '*', $censoredPart);

        return $uncensoredPart . $censoredPart;
    }
}
