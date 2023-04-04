<?php

namespace Emporium\Prison\Managers\misc;

class Translator {

    public static function timeConvert($seconds): string {

        $d = floor(($seconds%2592000)/86400);

        return "$d " . ($d > 1 ? "days" : "day") . ", " . gmdate("H:i:s", $seconds);
    }

    # Short Number Converter
    public static function shortNumber(float $n, $precision = 2): string
    {
        if ($n < 900) {
            $n_format = number_format($n, $precision);
        } else if ($n < 900000) {
            $n_format = number_format($n, $precision);
        } else if ($n < 900000000) {
            $n_format = number_format($n, $precision);
        } else if ($n < 900000000000) {
            $n_format = number_format($n, $precision);
        } else if ($n < 900000000000000){
            $n_format = number_format($n, $precision);
        } else if ($n < 900000000000000000){
            $n_format = number_format($n, $precision);
        } else if ($n < 900000000000000000000){
            $n_format = number_format($n, $precision);
        } else if ($n < 900000000000000000000000){
            $n_format = number_format($n, $precision);
        } else if ($n < 900000000000000000000000000){
            $n_format = number_format($n, $precision);
        } else if ($n < 900000000000000000000000000000){
            $n_format = number_format($n, $precision);
        } else {
            $n_format = number_format($n, $precision);
        }
        if ($precision > 0) {
            $dotzero = '.' . str_repeat( '0', $precision );
            $n_format = str_replace( $dotzero, '', $n_format );
        }
        return $n_format;
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