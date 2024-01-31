<?php

namespace App\Helpers;

class Round
{
    public static function pesos(int|float $value) {
        $value = ceil($value);

        return $value;

        /*
        $last_digits = (int) substr((int) $value, -2);

        if ($last_digits > 50) {
            return $value + (100 - $last_digits);
        } else if ($last_digits > 0 && $last_digits < 50) {
            return $value + (50 - $last_digits);
        } else {
            return $value;
        }
        */
    }
}
