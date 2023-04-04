<?php

namespace Emporium\Prison\Menus;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\Variables;
use EmporiumData\DataManager;

use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\InvMenuTransaction;
use muqsit\invmenu\type\InvMenuTypeIds;

use pocketmine\block\VanillaBlocks;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\ClickSound;
use pocketmine\world\sound\XpLevelUpSound;

class PlayerPrestige {

    public function Inventory(Player $player): void {

        $menu = InvMenu::create(InvMenuTypeIds::TYPE_CHEST);
        $menu->setName("Player Prestige");
        $menu->setListener(InvMenu::readonly(function(InvMenuTransaction $transaction) use ($player) {

            $itemClicked = $transaction->getItemClicked();

            # prestige 1
            if($itemClicked->getNamedTag()->getTag("prestige1")) {

                if($itemClicked->getNamedTag()->getString("prestige1") == "lockedNoRequirements") {
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You have not met the requirements for this prestige");
                    $player->broadcastSound(new ClickSound(0), [$player]);
                }
                if($itemClicked->getNamedTag()->getString("prestige1") == "lockedRequirements") {
                    # send confirmations
                    $player->broadcastSound(new XpLevelUpSound(1000), [$player]);
                    $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have prestiged to Prestige " . TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "I" . TF::LIGHT_PURPLE . ">");
                    # prestige player
                    EmporiumPrison::getInstance()->getPlayerLevelManager()->prestigePlayer($player);
                }
                if($itemClicked->getNamedTag()->getString("prestige1") == "unlocked") {
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You have already completed this prestige");
                    $player->broadcastSound(new ClickSound(0), [$player]);
                }
            }

            # prestige 2
            if($itemClicked->getNamedTag()->getTag("prestige2")) {

                if($itemClicked->getNamedTag()->getString("prestige2") == "lockedNoRequirements") {
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You have not met the requirements for this prestige");
                    $player->broadcastSound(new ClickSound(0), [$player]);
                }
                if($itemClicked->getNamedTag()->getString("prestige2") == "lockedRequirements") {
                    # send confirmations
                    $player->broadcastSound(new XpLevelUpSound(1000), [$player]);
                    $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have prestiged to Prestige " . TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "II" . TF::LIGHT_PURPLE . ">");
                    # prestige player
                    EmporiumPrison::getInstance()->getPlayerLevelManager()->prestigePlayer($player);
                }
                if($itemClicked->getNamedTag()->getString("prestige2") == "unlocked") {
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You have already completed this prestige");
                    $player->broadcastSound(new ClickSound(0), [$player]);
                }
            }

            # prestige 3
            if($itemClicked->getNamedTag()->getTag("prestige3")) {

                if($itemClicked->getNamedTag()->getString("prestige3") == "lockedNoRequirements") {
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You have not met the requirements for this prestige");
                    $player->broadcastSound(new ClickSound(0), [$player]);
                }
                if($itemClicked->getNamedTag()->getString("prestige3") == "lockedRequirements") {
                    # send confirmations
                    $player->broadcastSound(new XpLevelUpSound(1000), [$player]);
                    $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have prestiged to Prestige " . TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "III" . TF::LIGHT_PURPLE . ">");
                    # prestige player
                    EmporiumPrison::getInstance()->getPlayerLevelManager()->prestigePlayer($player);
                }
                if($itemClicked->getNamedTag()->getString("prestige3") == "unlocked") {
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You have already completed this prestige");
                    $player->broadcastSound(new ClickSound(0), [$player]);
                }
            }

            # prestige 4
            if($itemClicked->getNamedTag()->getTag("prestige4")) {

                if($itemClicked->getNamedTag()->getString("prestige4") == "lockedNoRequirements") {
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You have not met the requirements for this prestige");
                    $player->broadcastSound(new ClickSound(0), [$player]);
                }
                if($itemClicked->getNamedTag()->getString("prestige4") == "lockedRequirements") {
                    # send confirmations
                    $player->broadcastSound(new XpLevelUpSound(1000), [$player]);
                    $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have prestiged to Prestige " . TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "IV" . TF::LIGHT_PURPLE . ">");
                    # prestige player
                    EmporiumPrison::getInstance()->getPlayerLevelManager()->prestigePlayer($player);
                }
                if($itemClicked->getNamedTag()->getString("prestige4") == "unlocked") {
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You have already completed this prestige");
                    $player->broadcastSound(new ClickSound(0), [$player]);
                }
            }

            # prestige 5
            if($itemClicked->getNamedTag()->getTag("prestige5")) {

                if($itemClicked->getNamedTag()->getString("prestige5") == "lockedNoRequirements") {
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You have not met the requirements for this prestige");
                    $player->broadcastSound(new ClickSound(0), [$player]);
                }
                if($itemClicked->getNamedTag()->getString("prestige5") == "lockedRequirements") {
                    # send confirmations
                    $player->broadcastSound(new XpLevelUpSound(1000), [$player]);
                    $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have prestiged to Prestige " . TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "V" . TF::LIGHT_PURPLE . ">");
                    # prestige player
                    EmporiumPrison::getInstance()->getPlayerLevelManager()->prestigePlayer($player);
                }
                if($itemClicked->getNamedTag()->getString("prestige5") == "unlocked") {
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You have already completed this prestige");
                    $player->broadcastSound(new ClickSound(0), [$player]);
                }
            }

            # prestige 6
            if($itemClicked->getNamedTag()->getTag("prestige6")) {

                if($itemClicked->getNamedTag()->getString("prestige6") == "lockedNoRequirements") {
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You have not met the requirements for this prestige");
                    $player->broadcastSound(new ClickSound(0), [$player]);
                }
                if($itemClicked->getNamedTag()->getString("prestige6") == "lockedRequirements") {
                    # send confirmations
                    $player->broadcastSound(new XpLevelUpSound(1000), [$player]);
                    $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have prestiged to Prestige " . TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "VI" . TF::LIGHT_PURPLE . ">");
                    # prestige player
                    EmporiumPrison::getInstance()->getPlayerLevelManager()->prestigePlayer($player);
                }
                if($itemClicked->getNamedTag()->getString("prestige6") == "unlocked") {
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You have already completed this prestige");
                    $player->broadcastSound(new ClickSound(0), [$player]);
                }
            }

        }));
        $inventory = $menu->getInventory();

        $inventory->setItem(10, $this->prestige1Item($player));
        $inventory->setItem(11, $this->prestige2Item($player));
        $inventory->setItem(12, $this->prestige3Item($player));
        $inventory->setItem(13, $this->prestige4Item($player));
        $inventory->setItem(14, $this->prestige5Item($player));
        $inventory->setItem(15, $this->prestige6Item($player));
        $inventory->setItem(17, $this->prestigeInfoItem());

        $menu->send($player);
    }

    private function prestige1Item(Player $player): Item {
        $playerCurrentPrestige = DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.prestige");
        $playerLevel = DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.level");

        $item = VanillaBlocks::ENDER_CHEST()->asItem();
        $item->setCustomName(TF::BOLD . TF::RED . "Prestige " . TF::LIGHT_PURPLE . "<" . TF::AQUA . "I" . TF::LIGHT_PURPLE . ">");
        $lore = null;

        # locked requirements not met
        if($playerCurrentPrestige < 1) {
            $item->getNamedTag()->setString("prestige1", "lockedNoRequirements");
            $lore = [
                TF::BOLD . TF::RED . TF::UNDERLINE . "LOCKED",
                TF::EOL,
                TF::BOLD . TF::RED . "REQUIREMENTS",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Level: " . TF::BOLD . TF::WHITE . TF::UNDERLINE . "100 " . TF::RESET . TF::GRAY . "(need to calculate this XP)",
                TF::EOL,
                TF::BOLD . TF::RED . "UNLOCKS",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "+1 PV",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Lockbox: Prestige " . TF::LIGHT_PURPLE . "<" . TF::AQUA . "I" . TF::LIGHT_PURPLE . ">" . TF::GRAY . "(one time reward)",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Half /extract cost",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "$909,350,000 Bank Block Investment Limit (coming soon)",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Godly Contraband (one time reward)",
                TF::EOL,
                TF::RED . TF::UNDERLINE . "You have not met the requirements!"
            ];
        }
        # locked requirements met
        if($playerCurrentPrestige < 1 && $playerLevel == 100) {
            $item->getNamedTag()->setString("prestige1", "lockedRequirements");
            $lore = [
                TF::BOLD . TF::RED . TF::UNDERLINE . "LOCKED",
                TF::EOL,
                TF::BOLD . TF::RED . "REQUIREMENTS",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Level: " . TF::BOLD . TF::WHITE . TF::UNDERLINE . "100 " . TF::RESET . TF::GRAY . "(need to calculate this XP)",
                TF::EOL,
                TF::BOLD . TF::RED . "UNLOCKS",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "+1 PV",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Lockbox: Prestige " . TF::LIGHT_PURPLE . "<" . TF::AQUA . "I" . TF::LIGHT_PURPLE . ">" . TF::GRAY . "(one time reward)",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Half /extract cost",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "$909,350,000 Bank Block Investment Limit (coming soon)",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Godly Contraband (one time reward)",
                TF::EOL,
                TF::GREEN . TF::UNDERLINE . "You have met the requirements!",
                TF::GREEN . "Click to prestige.",
                TF::EOL,
                TF::BOLD . TF::RED . TF::UNDERLINE . "WARNING" . TF::RESET . TF::GRAY . " This process will reset your stats and",
                TF::GRAY . "is not reversible!"
            ];
        }
        # unlocked
        if($playerCurrentPrestige >= 1) {
            $item->getNamedTag()->setString("prestige1", "unlocked");
            $lore = [
                TF::BOLD . TF::GREEN . TF::UNDERLINE . "UNLOCKED",
                TF::EOL,
                TF::BOLD . TF::RED . "REQUIREMENTS",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Level: " . TF::BOLD . TF::WHITE . TF::UNDERLINE . "100 " . TF::RESET . TF::GRAY . "(need to calculate this XP)",
                TF::EOL,
                TF::BOLD . TF::RED . "UNLOCKS",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "+1 PV",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Lockbox: Prestige " . TF::LIGHT_PURPLE . "<" . TF::AQUA . "I" . TF::LIGHT_PURPLE . ">" . TF::GRAY . "(one time reward)",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Half /extract cost",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "$909,350,000 Bank Block Investment Limit (coming soon)",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Godly Contraband (one time reward)",
                TF::EOL,
                TF::RED . TF::UNDERLINE . "You have already unlocked this prestige"
            ];
        }

        $item->setLore($lore);
        return $item;
    }
    private function prestige2Item(Player $player): Item {
        $playerCurrentPrestige = DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.prestige");
        $playerLevel = DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.level");

        $item = VanillaBlocks::ENDER_CHEST()->asItem();
        $item->setCustomName(TF::BOLD . TF::RED . "Prestige " . TF::LIGHT_PURPLE . "<" . TF::AQUA . "II" . TF::LIGHT_PURPLE . ">");
        $lore = null;

        # locked requirements not met
        if($playerCurrentPrestige < 2) {
            $item->getNamedTag()->setString("prestige2", "lockedNoRequirements");
            $lore = [
                TF::BOLD . TF::RED . TF::UNDERLINE . "LOCKED",
                TF::EOL,
                TF::BOLD . TF::RED . "REQUIREMENTS",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Level: " . TF::BOLD . TF::WHITE . TF::UNDERLINE . "100 " . TF::RESET . TF::GRAY . "(need to calculate this XP)",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Level: " . TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "I" . TF::LIGHT_PURPLE . ">",
                TF::EOL,
                TF::BOLD . TF::RED . "UNLOCKS",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "+1 PV",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "+25% Energy from tinkerer",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Lockbox: Prestige " . TF::LIGHT_PURPLE . "<" . TF::AQUA . "II" . TF::LIGHT_PURPLE . ">" . TF::GRAY . "(one time reward)",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Half /extract cost",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "$2,409,350,000 Bank Block Investment Limit (coming soon)",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Godly Contraband (one time reward)",
                TF::EOL,
                TF::RED . TF::UNDERLINE . "You have not met the requirements!"
            ];
        }
        # locked requirements met
        if($playerCurrentPrestige < 2 && $playerLevel == 100) {
            $item->getNamedTag()->setString("prestige2", "lockedRequirements");
            $lore = [
                TF::BOLD . TF::RED . TF::UNDERLINE . "LOCKED",
                TF::EOL,
                TF::BOLD . TF::RED . "REQUIREMENTS",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Level: " . TF::BOLD . TF::WHITE . TF::UNDERLINE . "100 " . TF::RESET . TF::GRAY . "(need to calculate this XP)",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Level: " . TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "I" . TF::LIGHT_PURPLE . ">",
                TF::EOL,
                TF::BOLD . TF::RED . "UNLOCKS",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "+1 PV",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "+25% Energy from tinkerer",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Lockbox: Prestige " . TF::LIGHT_PURPLE . "<" . TF::AQUA . "II" . TF::LIGHT_PURPLE . ">" . TF::GRAY . "(one time reward)",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Half /extract cost",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "$2,409,350,000 Bank Block Investment Limit (coming soon)",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Godly Contraband (one time reward)",
                TF::EOL,
                TF::GREEN . TF::UNDERLINE . "You have met the requirements!",
                TF::GREEN . "Click to prestige.",
                TF::EOL,
                TF::BOLD . TF::RED . TF::UNDERLINE . "WARNING" . TF::RESET . TF::GRAY . " This process will reset your stats and",
                TF::GRAY . "is not reversible!"
            ];
        }
        # unlocked
        if($playerCurrentPrestige >= 2) {
            $item->getNamedTag()->setString("prestige2", "unlocked");
            $lore = [
                TF::BOLD . TF::GREEN . TF::UNDERLINE . "UNLOCKED",
                TF::EOL,
                TF::BOLD . TF::RED . "REQUIREMENTS",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Level: " . TF::BOLD . TF::WHITE . TF::UNDERLINE . "100 " . TF::RESET . TF::GRAY . "(need to calculate this XP)",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Level: " . TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "I" . TF::LIGHT_PURPLE . ">",
                TF::EOL,
                TF::BOLD . TF::RED . "UNLOCKS",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "+1 PV",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "+25% Energy from tinkerer",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Lockbox: Prestige " . TF::LIGHT_PURPLE . "<" . TF::AQUA . "II" . TF::LIGHT_PURPLE . ">" . TF::GRAY . "(one time reward)",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Half /extract cost",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "$2,409,350,000 Bank Block Investment Limit (coming soon)",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Godly Contraband (one time reward)",
                TF::EOL,
                TF::RED . TF::UNDERLINE . "You have already unlocked this prestige"
            ];
        }

        $item->setLore($lore);
        return $item;
    }
    private function prestige3Item(Player $player): Item {
        $playerCurrentPrestige = DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.prestige");
        $playerLevel = DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.level");

        $item = VanillaBlocks::ENDER_CHEST()->asItem();
        $item->setCustomName(TF::BOLD . TF::RED . "Prestige " . TF::LIGHT_PURPLE . "<" . TF::AQUA . "III" . TF::LIGHT_PURPLE . ">");
        $lore = null;

        # locked requirements not met
        if($playerCurrentPrestige < 3) {
            $item->getNamedTag()->setString("prestige3", "lockedNoRequirements");
            $lore = [
                TF::BOLD . TF::RED . TF::UNDERLINE . "LOCKED",
                TF::EOL,
                TF::BOLD . TF::RED . "REQUIREMENTS",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Level: " . TF::BOLD . TF::WHITE . TF::UNDERLINE . "100 " . TF::RESET . TF::GRAY . "(need to calculate this XP)",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Level: " . TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "II" . TF::LIGHT_PURPLE . ">",
                TF::EOL,
                TF::BOLD . TF::RED . "UNLOCKS",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "+1 PV",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Instant teleport from Safe Zones",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Lockbox: Prestige " . TF::LIGHT_PURPLE . "<" . TF::AQUA . "III" . TF::LIGHT_PURPLE . ">" . TF::GRAY . "(one time reward)",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "+200% Ores Prices",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "+40% Energy from Mining",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Godly Contraband (one time reward)",
                TF::EOL,
                TF::RED . TF::UNDERLINE . "You have not met the requirements!"
            ];
        }
        # locked requirements met
        if($playerCurrentPrestige < 3 && $playerLevel == 100) {
            $item->getNamedTag()->setString("prestige3", "lockedRequirements");
            $lore = [
                TF::BOLD . TF::RED . TF::UNDERLINE . "LOCKED",
                TF::EOL,
                TF::BOLD . TF::RED . "REQUIREMENTS",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Level: " . TF::BOLD . TF::WHITE . TF::UNDERLINE . "100 " . TF::RESET . TF::GRAY . "(need to calculate this XP)",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Level: " . TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "II" . TF::LIGHT_PURPLE . ">",
                TF::EOL,
                TF::BOLD . TF::RED . "UNLOCKS",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "+1 PV",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Instant teleport from Safe Zones",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Lockbox: Prestige " . TF::LIGHT_PURPLE . "<" . TF::AQUA . "III" . TF::LIGHT_PURPLE . ">" . TF::GRAY . "(one time reward)",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "+200% Ores Prices",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "+40% Energy from Mining",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Godly Contraband (one time reward)",
                TF::EOL,
                TF::GREEN . TF::UNDERLINE . "You have met the requirements!",
                TF::GREEN . "Click to prestige.",
                TF::EOL,
                TF::BOLD . TF::RED . TF::UNDERLINE . "WARNING" . TF::RESET . TF::GRAY . " This process will reset your stats and",
                TF::GRAY . "is not reversible!"
            ];
        }
        # unlocked
        if($playerCurrentPrestige >= 3) {
            $item->getNamedTag()->setString("prestige3", "unlocked");
            $lore = [
                TF::BOLD . TF::GREEN . TF::UNDERLINE . "UNLOCKED",
                TF::EOL,
                TF::BOLD . TF::RED . "REQUIREMENTS",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Level: " . TF::BOLD . TF::WHITE . TF::UNDERLINE . "100 " . TF::RESET . TF::GRAY . "(need to calculate this XP)",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Level: " . TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "II" . TF::LIGHT_PURPLE . ">",
                TF::EOL,
                TF::BOLD . TF::RED . "UNLOCKS",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "+1 PV",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Instant teleport from Safe Zones",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Lockbox: Prestige " . TF::LIGHT_PURPLE . "<" . TF::AQUA . "III" . TF::LIGHT_PURPLE . ">" . TF::GRAY . "(one time reward)",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "+200% Ores Prices",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "+40% Energy from Mining",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Godly Contraband (one time reward)",
                TF::EOL,
                TF::RED . TF::UNDERLINE . "You have already unlocked this prestige"
            ];
        }

        $item->setLore($lore);
        return $item;
    }
    private function prestige4Item(Player $player): Item {
        $playerCurrentPrestige = DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.prestige");
        $playerLevel = DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.level");

        $item = VanillaBlocks::ENDER_CHEST()->asItem();
        $item->setCustomName(TF::BOLD . TF::RED . "Prestige " . TF::LIGHT_PURPLE . "<" . TF::AQUA . "IV" . TF::LIGHT_PURPLE . ">");
        $lore = null;

        # locked requirements not met
        if($playerCurrentPrestige < 4) {
            $item->getNamedTag()->setString("prestige4", "lockedNoRequirements");
            $lore = [
                TF::BOLD . TF::RED . TF::UNDERLINE . "LOCKED",
                TF::EOL,
                TF::BOLD . TF::RED . "REQUIREMENTS",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Level: " . TF::BOLD . TF::WHITE . TF::UNDERLINE . "100 " . TF::RESET . TF::GRAY . "(need to calculate this XP)",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Level: " . TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "III" . TF::LIGHT_PURPLE . ">",
                TF::EOL,
                TF::BOLD . TF::RED . "UNLOCKS",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "+1 PV",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Lockbox: Prestige " . TF::LIGHT_PURPLE . "<" . TF::AQUA . "IV" . TF::LIGHT_PURPLE . ">" . TF::GRAY . "(one time reward)",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Permanent 2x Energy Booster",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Godly Contraband (one time reward)",
                TF::EOL,
                TF::RED . TF::UNDERLINE . "You have not met the requirements!"
            ];
        }
        # locked requirements met
        if($playerCurrentPrestige < 4 && $playerLevel == 100) {
            $item->getNamedTag()->setString("prestige4", "lockedRequirements");
            $lore = [
                TF::BOLD . TF::RED . TF::UNDERLINE . "LOCKED",
                TF::EOL,
                TF::BOLD . TF::RED . "REQUIREMENTS",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Level: " . TF::BOLD . TF::WHITE . TF::UNDERLINE . "100 " . TF::RESET . TF::GRAY . "(need to calculate this XP)",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Level: " . TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "III" . TF::LIGHT_PURPLE . ">",
                TF::EOL,
                TF::BOLD . TF::RED . "UNLOCKS",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "+1 PV",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Lockbox: Prestige " . TF::LIGHT_PURPLE . "<" . TF::AQUA . "IV" . TF::LIGHT_PURPLE . ">" . TF::GRAY . "(one time reward)",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Permanent 2x Energy Booster",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Godly Contraband (one time reward)",
                TF::EOL,
                TF::GREEN . TF::UNDERLINE . "You have met the requirements!",
                TF::GREEN . "Click to prestige.",
                TF::EOL,
                TF::BOLD . TF::RED . TF::UNDERLINE . "WARNING" . TF::RESET . TF::GRAY . " This process will reset your stats and",
                TF::GRAY . "is not reversible!"
            ];
        }
        # unlocked
        if($playerCurrentPrestige >= 4) {
            $item->getNamedTag()->setString("prestige4", "unlocked");
            $lore = [
                TF::BOLD . TF::GREEN . TF::UNDERLINE . "UNLOCKED",
                TF::EOL,
                TF::BOLD . TF::RED . "REQUIREMENTS",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Level: " . TF::BOLD . TF::WHITE . TF::UNDERLINE . "100 " . TF::RESET . TF::GRAY . "(need to calculate this XP)",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Level: " . TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "III" . TF::LIGHT_PURPLE . ">",
                TF::EOL,
                TF::BOLD . TF::RED . "UNLOCKS",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "+1 PV",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Lockbox: Prestige " . TF::LIGHT_PURPLE . "<" . TF::AQUA . "IV" . TF::LIGHT_PURPLE . ">" . TF::GRAY . "(one time reward)",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Permanent 2x Energy Booster",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Godly Contraband (one time reward)",
                TF::EOL,
                TF::RED . TF::UNDERLINE . "You have already unlocked this prestige"
            ];
        }

        $item->setLore($lore);
        return $item;
    }

    private function prestige5Item(Player $player): Item {
        $playerCurrentPrestige = DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.prestige");
        $playerLevel = DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.level");

        $item = VanillaBlocks::ENDER_CHEST()->asItem();
        $item->setCustomName(TF::BOLD . TF::RED . "Prestige " . TF::LIGHT_PURPLE . "<" . TF::AQUA . "V" . TF::LIGHT_PURPLE . ">");
        $lore = null;

        # locked requirements not met
        if($playerCurrentPrestige < 5) {
            $item->getNamedTag()->setString("prestige5", "lockedNoRequirements");
            $lore = [
                TF::BOLD . TF::RED . TF::UNDERLINE . "LOCKED",
                TF::EOL,
                TF::BOLD . TF::RED . "REQUIREMENTS",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Level: " . TF::BOLD . TF::WHITE . TF::UNDERLINE . "100 " . TF::RESET . TF::GRAY . "(need to calculate this XP)",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Level: " . TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "IV" . TF::LIGHT_PURPLE . ">",
                TF::EOL,
                TF::BOLD . TF::RED . "UNLOCKS",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "+1 PV",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Lockbox: Prestige " . TF::LIGHT_PURPLE . "<" . TF::AQUA . "V" . TF::LIGHT_PURPLE . ">" . TF::GRAY . "(one time reward)",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "5x Godly Contraband (one time reward)",
                TF::EOL,
                TF::RED . TF::UNDERLINE . "You have not met the requirements!"
            ];
        }
        # locked requirements met
        if($playerCurrentPrestige < 5 && $playerLevel == 100) {
            $item->getNamedTag()->setString("prestige5", "lockedRequirements");
            $lore = [
                TF::BOLD . TF::RED . TF::UNDERLINE . "LOCKED",
                TF::EOL,
                TF::BOLD . TF::RED . "REQUIREMENTS",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Level: " . TF::BOLD . TF::WHITE . TF::UNDERLINE . "100 " . TF::RESET . TF::GRAY . "(need to calculate this XP)",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Level: " . TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "IV" . TF::LIGHT_PURPLE . ">",
                TF::EOL,
                TF::BOLD . TF::RED . "UNLOCKS",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "+1 PV",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Lockbox: Prestige " . TF::LIGHT_PURPLE . "<" . TF::AQUA . "V" . TF::LIGHT_PURPLE . ">" . TF::GRAY . "(one time reward)",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "5x Godly Contraband (one time reward)",
                TF::EOL,
                TF::GREEN . TF::UNDERLINE . "You have met the requirements!",
                TF::GREEN . "Click to prestige.",
                TF::EOL,
                TF::BOLD . TF::RED . TF::UNDERLINE . "WARNING" . TF::RESET . TF::GRAY . " This process will reset your stats and",
                TF::GRAY . "is not reversible!"
            ];
        }
        # unlocked
        if($playerCurrentPrestige >= 5) {
            $item->getNamedTag()->setString("prestige5", "unlocked");
            $lore = [
                TF::BOLD . TF::GREEN . TF::UNDERLINE . "UNLOCKED",
                TF::EOL,
                TF::BOLD . TF::RED . "REQUIREMENTS",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Level: " . TF::BOLD . TF::WHITE . TF::UNDERLINE . "100 " . TF::RESET . TF::GRAY . "(need to calculate this XP)",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Level: " . TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "IV" . TF::LIGHT_PURPLE . ">",
                TF::EOL,
                TF::BOLD . TF::RED . "UNLOCKS",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "+1 PV",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Lockbox: Prestige " . TF::LIGHT_PURPLE . "<" . TF::AQUA . "V" . TF::LIGHT_PURPLE . ">" . TF::GRAY . "(one time reward)",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "5x Godly Contraband (one time reward)",
                TF::EOL,
                TF::RED . TF::UNDERLINE . "You have already unlocked this prestige"
            ];
        }

        $item->setLore($lore);
        return $item;
    }
    private function prestige6Item(Player $player): Item {
        $playerCurrentPrestige = DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.prestige");
        $playerLevel = DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.level");

        $item = VanillaBlocks::ENDER_CHEST()->asItem();
        $item->setCustomName(TF::BOLD . TF::RED . "Prestige " . TF::LIGHT_PURPLE . "<" . TF::AQUA . "VI" . TF::LIGHT_PURPLE . ">");
        $lore = null;

        # locked requirements not met
        if($playerCurrentPrestige < 6) {
            $item->getNamedTag()->setString("prestige6", "lockedNoRequirements");
            $lore = [
                TF::BOLD . TF::RED . TF::UNDERLINE . "LOCKED",
                TF::EOL,
                TF::BOLD . TF::RED . "REQUIREMENTS",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Level: " . TF::BOLD . TF::WHITE . TF::UNDERLINE . "100 " . TF::RESET . TF::GRAY . "(need to calculate this XP)",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Level: " . TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "V" . TF::LIGHT_PURPLE . ">",
                TF::EOL,
                TF::BOLD . TF::RED . "UNLOCKS",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "+1 PV",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Lockbox: Prestige " . TF::LIGHT_PURPLE . "<" . TF::AQUA . "VI" . TF::LIGHT_PURPLE . ">" . TF::GRAY . "(one time reward)",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "10x Godly Contraband (one time reward)",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Heroic Pickaxe Prestige XI Token (one time reward)",
                TF::EOL,
                TF::RED . TF::UNDERLINE . "You have not met the requirements!"
            ];
        }
        # locked requirements met
        if($playerCurrentPrestige < 6 && $playerLevel == 100) {
            $item->getNamedTag()->setString("prestige5", "lockedRequirements");
            $lore = [
                TF::BOLD . TF::RED . TF::UNDERLINE . "LOCKED",
                TF::EOL,
                TF::BOLD . TF::RED . "REQUIREMENTS",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Level: " . TF::BOLD . TF::WHITE . TF::UNDERLINE . "100 " . TF::RESET . TF::GRAY . "(need to calculate this XP)",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Level: " . TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "V" . TF::LIGHT_PURPLE . ">",
                TF::EOL,
                TF::BOLD . TF::RED . "UNLOCKS",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "+1 PV",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Lockbox: Prestige " . TF::LIGHT_PURPLE . "<" . TF::AQUA . "VI" . TF::LIGHT_PURPLE . ">" . TF::GRAY . "(one time reward)",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "10x Godly Contraband (one time reward)",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Heroic Pickaxe Prestige XI Token (one time reward)",
                TF::EOL,
                TF::GREEN . TF::UNDERLINE . "You have met the requirements!",
                TF::GREEN . "Click to prestige.",
                TF::EOL,
                TF::BOLD . TF::RED . TF::UNDERLINE . "WARNING" . TF::RESET . TF::GRAY . " This process will reset your stats and",
                TF::GRAY . "is not reversible!"
            ];
        }
        # unlocked
        if($playerCurrentPrestige >= 6) {
            $item->getNamedTag()->setString("prestige5", "unlocked");
            $lore = [
                TF::BOLD . TF::GREEN . TF::UNDERLINE . "UNLOCKED",
                TF::EOL,
                TF::BOLD . TF::RED . "REQUIREMENTS",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Level: " . TF::BOLD . TF::WHITE . TF::UNDERLINE . "100 " . TF::RESET . TF::GRAY . "(need to calculate this XP)",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Level: " . TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "V" . TF::LIGHT_PURPLE . ">",
                TF::EOL,
                TF::BOLD . TF::RED . "UNLOCKS",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "+1 PV",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Lockbox: Prestige " . TF::LIGHT_PURPLE . "<" . TF::AQUA . "VI" . TF::LIGHT_PURPLE . ">" . TF::GRAY . "(one time reward)",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "10x Godly Contraband (one time reward)",
                TF::BOLD . TF::RED . " * " . TF::RESET . TF::GRAY . "Heroic Pickaxe Prestige XI Token (one time reward)",
                TF::EOL,
                TF::RED . TF::UNDERLINE . "You have already unlocked this prestige"
            ];
        }

        $item->setLore($lore);
        return $item;
    }

    private function prestigeInfoItem(): Item {

        $item = VanillaItems::BOOK();
        $item->setCustomName("Player Prestige Information");
        $lore = [
            TF::EOL,
            "Input information here"
        ];
        $item->setLore($lore);
        return $item;
    }
}