<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;

class TranscribeCatastro {
    protected static function lines(string $file)
    {
        $handle = fopen($file, 'r');

        while (($line = fgets($handle)) !== false) {
            $line = mb_convert_encoding($line, 'UTF-8', 'Windows-1252'); // IGAC files arrive encoded in CP1252
            $line = rtrim($line, "\r\n");

            if (mb_strlen($line) !== 312) {
                Log::warning('IGAC line is not 312 characters long!: (' . mb_strlen($line) . ') ' . $line);
                continue;
            }

            yield $line;
        }
    }

    public static function transcribe(string $igac_r1)
    {
        $conversions = [];

        foreach (self::lines($igac_r1) as $line) {
            $current = mb_substr($line, 5, 25);
            $old = mb_substr($line, 297, 15);

            array_push($conversions, [
                'current' => $current,
                'old' => $old
            ]);
        }

        return Collection::make($conversions);
    }
}
