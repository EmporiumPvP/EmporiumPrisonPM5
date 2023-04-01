<?php

namespace Emporium\Prison\Managers\misc;

use Exception;
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

}