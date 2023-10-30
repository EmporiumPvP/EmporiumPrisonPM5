<?php

namespace Emporium\Prison\Managers\misc;

use Exception;
use pocketmine\inventory\Inventory;
use pocketmine\utils\TextFormat;

class Utils {

    /**
     * @throws Exception
     */
    public static function colourConverter(String $colour): string
    {
        $translatedColour =  match ($colour) {
            "blue" => TextFormat::BLUE,
            "dark_blue" => TextFormat::DARK_BLUE,
            "green" => TextFormat::GREEN,
            "dark_green" => TextFormat::DARK_GREEN,
            "aqua" => TextFormat::AQUA,
            "dark_aqua" => TextFormat::DARK_AQUA,
            "red" => TextFormat::RED,
            "dark_red" => TextFormat::DARK_RED,
            "black" => TextFormat::BLACK,
            "yellow" => TextFormat::YELLOW,
            "gold" => TextFormat::GOLD,
            "gray" => TextFormat::GRAY,
            "dark_gray" => TextFormat::DARK_GRAY,
            "light_purple" => TextFormat::LIGHT_PURPLE,
            "purple" => TextFormat::DARK_PURPLE,
            "white" => TextFormat::WHITE,
        };
        return $translatedColour;
    }

    public static function getNextCenteredSlot(Inventory $inventory): ?int{
        $size = $inventory->getSize();
        $center = (int)floor(($size -1) / 2);
        for ($i = 0; $i < $size / 2; $i++) {
            if ($inventory->isSlotEmpty($slot = $center - $i) || $inventory->isSlotEmpty($slot = $center + $i)) return $slot;
        }
        return null;
    }

    public static function romanNumeral(int $number): String {

        return match ($number) {
            1 => "I",
            2 => "II",
            3 => "III",
            4 => "IV",
            5 => "V",
            6 => "VI",
            7 => "VII",
            8 => "VIII",
            9 => "IX",
            10 => "X"
        };
    }

}