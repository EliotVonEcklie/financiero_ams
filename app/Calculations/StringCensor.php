<?php

namespace App\Calculations;

class StringCensor {
    private $uncensoredChars;

    public function __construct($uncensoredChars) {
        $this->uncensoredChars = $uncensoredChars;
    }

    public function censorString($string) {
        $uncensoredPart = substr($string, 0, $this->uncensoredChars);
        $censoredPart = str_repeat('*', strlen($string) - $this->uncensoredChars);
        return $uncensoredPart . $censoredPart;
    }
}
