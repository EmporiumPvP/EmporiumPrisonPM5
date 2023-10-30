<?php

declare(strict_types=1);

namespace Emporium\Prison;

use pocketmine\utils\TextFormat as TF;

interface Variables {

    public const SERVER_PREFIX = TF::BOLD . TF::AQUA . "Emporium" . TF::DARK_GRAY . " >> " . TF::RESET;
    public const ERROR_PREFIX = TF::BOLD . TF::RED . "Error" . TF::DARK_GRAY . " >> " . TF::RESET;
    public const NO_PERMISSION_MESSAGE = TF::BOLD . TF::DARK_GRAY . "(" . TF::RED . "!" . TF::DARK_GRAY . ") " . TF::RESET . TF::RED . "No permission";
    public const PREFIX = TF::BOLD . TF::DARK_GRAY . "(" . TF::RED . "!" . TF::DARK_GRAY . ") " . TF::RESET . TF::RED;

    public const BOSS_SPAWN_LOCATION = ["x" => 65, "y" => 102, "z" => 69];
}