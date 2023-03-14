<?php

declare(strict_types=1);

namespace Emporium\Prison;

use pocketmine\utils\TextFormat as TF;

interface Variables {

    public const SERVER_PREFIX = TF::BOLD . TF::AQUA . "Emporium" . TF::DARK_GRAY . " >> " . TF::RESET;
    public const ERROR_PREFIX = TF::BOLD . TF::RED . "Error" . TF::DARK_GRAY . " >> " . TF::RESET;

    public const PLUGIN_VERSION = "EmporiumPrison-alpha1.0.0";

}