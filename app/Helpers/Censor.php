<?php

namespace App\Helpers;

class Censor
{
    public static function str($string, $uncensoredChars = 2) {
        if ($uncensoredChars > strlen($string)) {
            return $string;
        }

        if ($uncensoredChars > 0) {
            $uncensoredPart = mb_substr($string, 0, $uncensoredChars);
            $censoredPart = mb_substr($string, $uncensoredChars);

            $censoredPart = preg_replace('/[a-zA-Z0-9]/', '*', $censoredPart);

            return $uncensoredPart . $censoredPart;
        } else {
            $uncensoredPart = mb_substr($string, $uncensoredChars);
            $censoredPart = mb_substr($string, 0, strlen($string) - $uncensoredChars);

            $censoredPart = preg_replace('/[a-zA-Z0-9]/', '*', $censoredPart);

            return $censoredPart . $uncensoredPart;
        }
    }
}
