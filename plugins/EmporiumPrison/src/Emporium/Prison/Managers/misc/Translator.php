<?php

namespace Emporium\Prison\Managers\misc;

class Translator {

    public static function timeConvert($seconds): string {

        $d = floor(($seconds%2592000)/86400);
        if($d == 0) {
            return gmdate("H:i:s", $seconds);
        }

        return "$d " . ($d > 1 ? "days" : "day") . ", " . gmdate("H:i:s", $seconds);
    }

    public static function numberFormat($number): string {
        return number_format($number);
    }

    # Short Number Converter
    public static function shortNumber($num): string {
        $units = ['', 'K', 'M', 'B', 'T'];
        for ($i = 0; $num >= 1000; $i++) {
            $num /= 1000;
        }
        return round($num, 1) . $units[$i];
    }

    # Roman Numeral Converter
    public static function romanNumber(int $integer): string {
        $romanNumeralConversionTable = [
            'M' => 1000,
            'CM' => 900,
            'D' => 500,
            'CD' => 400,
            'C' => 100,
            'XC' => 90,
            'L' => 50,
            'XL' => 40,
            'X' => 10,
            'IX' => 9,
            'V' => 5,
            'IV' => 4,
            'I' => 1
        ];
        $romanString = "";
        while ($integer > 0) {
            foreach ($romanNumeralConversionTable as $rom => $arb) {
                if ($integer >= $arb) {
                    $integer -= $arb;
                    $romanString .= $rom;
                    break;
                }
            }
        }
        return $romanString;
    }

}