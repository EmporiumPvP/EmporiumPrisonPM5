<?php

namespace Emporium\Prison\Managers\misc;

class Translator {

    public static function timeConvert($seconds): string {

        $s = $seconds%60;
        $m = floor(($seconds%3600)/60);
        $h = floor(($seconds%86400)/3600);
        $d = floor(($seconds%2592000)/86400);

        if($d == 0) {
            if($h < 10) {
                $h = "0" . $h;
            }
            if($m < 10) {
                $m = "0" . $m;
            }
            if($s < 10) {
                $s = "0" . $s;
            }
            return "$h:$m:$s";
        } else {
            if($d > 1) {
                $output = "$d day, $h:$m:$s";
            } else {
                $output = "$d days, $h:$m:$s";
            }
        }
        return $output;
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