<?php

# Namespace
namespace Tetro\EmporiumEnchants\Utils;

# Pocketmine API
use pocketmine\utils\Utils as PMMPUtils;
use pocketmine\entity\Entity;
use pocketmine\player\Player;
use pocketmine\plugin\Plugin;

# Checks Class
class AllyChecks {

    private static array $checks = [];

    public static function addCheck(Plugin $plugin, callable $check): void {
        PMMPUtils::validateCallableSignature(function (Player $player, Entity $entity): bool {
            return true;
        }, $check);
        self::$checks[] = [$plugin, $check];
    }

    public static function isAlly(Player $player, Entity $entity): bool {
        foreach (self::$checks as $check) {
            if ($check[0]->isEnabled()) {
                if (($check[1])($player, $entity)) return true;
            }
        }
        return false;
    }
}