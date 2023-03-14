<?php

namespace Menus;

use Emporium\Prison\Managers\misc\GlowManager;
use Emporium\Prison\Managers\misc\Translator;
use EmporiumCore\Managers\Data\DataManager;
use Items\RankKits;
use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\DeterministicInvMenuTransaction;
use muqsit\invmenu\type\InvMenuTypeIds;
use pocketmine\item\Item;
use pocketmine\item\StringToItemParser;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\BlazeShootSound;
use pocketmine\world\sound\ItemFrameAddItemSound;

class RankKitsMenu {

    public function Inventory($player): void {
        $menu = InvMenu::create(InvMenuTypeIds::TYPE_CHEST);
        $menu->setName("Rank Kits");
        $menu->setListener(InvMenu::readonly(function(DeterministicInvMenuTransaction $transaction) {

            $player = $transaction->getPlayer();
            $itemClicked = $transaction->getItemClicked();

            # noble
            if($itemClicked->getNamedTag()->getTag("Noble")) {
                if($player->getInventory()->canAddItem((new RankKits())->noble(1))) {
                    $player->getInventory()->addItem((new RankKits())->noble(1));
                    DataManager::setData($player, "Cooldowns", "RankKitNoble", 259200); # 3 day cooldown
                    $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::DARK_GRAY . "Noble Rank Kit");
                    $player->broadcastSound(new BlazeShootSound(), [$player]);
                    $player->removeCurrentWindow();
                    self::Inventory($player);
                } else {
                    $player->sendTitle(TF::RED . "Inventory Full");
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                }
            }
            # cooldown
            if($itemClicked->getNamedTag()->getTag("NobleCooldown")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                $player->sendMessage(TF::BOLD . TF::RED . "That Kit is on Cooldown");
            }
            # locked
            if($itemClicked->getNamedTag()->getTag("NobleLocked")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                $player->sendMessage(TF::BOLD . TF::RED . "That Kit is locked");
            }

            # imperial
            if($itemClicked->getNamedTag()->getTag("Imperial")) {
                if($player->getInventory()->canAddItem((new RankKits())->imperial(1))) {
                    $player->getInventory()->addItem((new RankKits())->imperial(1));
                    DataManager::setData($player, "Cooldowns", "RankKitImperial", 259200); # 3 day cooldown
                    $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::LIGHT_PURPLE . "Imperial Rank Kit");
                    $player->broadcastSound(new BlazeShootSound(), [$player]);
                    $player->removeCurrentWindow();
                    self::Inventory($player);
                } else {
                    $player->sendTitle(TF::RED . "Inventory Full");
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                }
            }
            # cooldown
            if($itemClicked->getNamedTag()->getTag("ImperialCooldown")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                $player->sendMessage(TF::BOLD . TF::RED . "That Kit is on Cooldown");
            }
            # locked
            if($itemClicked->getNamedTag()->getTag("ImperialLocked")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                $player->sendMessage(TF::BOLD . TF::RED . "That Kit is locked");
            }

            # supreme
            if($itemClicked->getNamedTag()->getTag("Supreme")) {
                if($player->getInventory()->canAddItem((new RankKits())->supreme(1))) {
                    $player->getInventory()->addItem((new RankKits())->supreme(1));
                    DataManager::setData($player, "Cooldowns", "RankKitSupreme", 259200); # 3 day cooldown
                    $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::DARK_AQUA . "Supreme Rank Kit");
                    $player->broadcastSound(new BlazeShootSound(), [$player]);
                    $player->removeCurrentWindow();
                    self::Inventory($player);
                } else {
                    $player->removeCurrentWindow();
                    $player->sendTitle(TF::RED . "Inventory Full");
                }
            }
            # cooldown
            if($itemClicked->getNamedTag()->getTag("SupremeCooldown")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                $player->sendMessage(TF::BOLD . TF::RED . "That Kit is on Cooldown");
            }
            # locked
            if($itemClicked->getNamedTag()->getTag("SupremeLocked")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                $player->sendMessage(TF::BOLD . TF::RED . "That Kit is locked");
            }

            # majesty
            if($itemClicked->getNamedTag()->getTag("Majesty")) {
                if($player->getInventory()->canAddItem((new RankKits())->majesty(1))) {
                    $player->getInventory()->addItem((new RankKits())->majesty(1));
                    DataManager::setData($player, "Cooldowns", "RankKitMajesty", 259200); # 3 day cooldown
                    $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::DARK_PURPLE . "Majesty Rank Kit");
                    $player->broadcastSound(new BlazeShootSound(), [$player]);
                    $player->removeCurrentWindow();
                    self::Inventory($player);
                } else {
                    $player->sendTitle(TF::RED . "Inventory Full");
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                }
            }
            # cooldown
            if($itemClicked->getNamedTag()->getTag("MajestyCooldown")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                $player->sendMessage(TF::BOLD . TF::RED . "That Kit is on Cooldown");
            }
            # locked
            if($itemClicked->getNamedTag()->getTag("MajestyLocked")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                $player->sendMessage(TF::BOLD . TF::RED . "That Kit is locked");
            }

            # emperor
            if($itemClicked->getNamedTag()->getTag("Emperor")) {
                if($player->getInventory()->canAddItem((new RankKits())->emperor(1))) {
                    $player->getInventory()->addItem((new RankKits())->emperor(1));
                    DataManager::setData($player, "Cooldowns", "RankKitEmperor", 259200); # 3 day cooldown
                    $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::AQUA . "Emperor Rank Kit");
                    $player->broadcastSound(new BlazeShootSound(), [$player]);
                    $player->removeCurrentWindow();
                    self::Inventory($player);
                } else {
                    $player->sendTitle(TF::RED . "Inventory Full");
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                }
            }
            # cooldown
            if($itemClicked->getNamedTag()->getTag("EmperorCooldown")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                $player->sendMessage(TF::BOLD . TF::RED . "That Kit is on Cooldown");
            }
            # locked
            if($itemClicked->getNamedTag()->getTag("EmperorLocked")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                $player->sendMessage(TF::BOLD . TF::RED . "That Kit is locked");
            }

            # president
            if($itemClicked->getNamedTag()->getTag("President")) {
                if($player->getInventory()->canAddItem((new RankKits())->president(1))) {
                    $player->getInventory()->addItem((new RankKits())->president(1));
                    DataManager::setData($player, "Cooldowns", "RankKitPresident", 259200); # 3 day cooldown
                    $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::RED . "President Rank Kit");
                    $player->broadcastSound(new BlazeShootSound(), [$player]);
                    $player->removeCurrentWindow();
                    self::Inventory($player);
                } else {
                    $player->sendTitle(TF::RED . "Inventory Full");
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                }
            }
            # cooldown
            if($itemClicked->getNamedTag()->getTag("PresidentCooldown")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                $player->sendMessage(TF::BOLD . TF::RED . "That Kit is on Cooldown");
            }
            # locked
            if($itemClicked->getNamedTag()->getTag("PresidentLocked")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                $player->sendMessage(TF::BOLD . TF::RED . "That Kit is locked");
            }

        }));
        $inventory = $menu->getInventory();
        $inventory->setItem(10, $this->nobleItem($player));
        $inventory->setItem(12, $this->imperialItem($player));
        $inventory->setItem(14, $this->supremeItem($player));
        $inventory->setItem(16, $this->majestyItem($player));
        $inventory->setItem(20, $this->emperorItem($player));
        $inventory->setItem(24, $this->presidentItem($player));

        $menu->send($player);
    }

    # noble
    public function nobleItem($player): Item {

        $nobleCooldown = DataManager::getData($player, "Cooldowns", "RankKitNoble");
        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::DARK_GRAY . "Noble " . TF::RESET . TF::GRAY . "Rank Kit");
        $permission = DataManager::getData($player, "Permissions", "emporiumcore.rankkit.noble");

        if($permission) {
            if($nobleCooldown > 0) {
                # kit on cooldown
                $lore = [
                    "§r",
                    TF::BOLD . TF::RED . "ON COOLDOWN " . Translator::timeConvert($nobleCooldown)
                ];
                $item->getNamedTag()->setString("NobleCooldown", 1);
            } else {
                # kit available
                $lore = [
                    "§r",
                    TF::BOLD . TF::GREEN . "AVAILABLE NOW " . TF::GRAY . "(Click)"
                ];
                $item->getNamedTag()->setString("Noble", 1);
            }
        } else {
            # kit locked
            $lore = [
                "§r",
                TF::BOLD . TF::RED . "LOCKED"
            ];
            $item->getNamedTag()->setString("NobleLocked", 1);
        }
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    # imperial
    public function imperialItem($player): Item {

        $imperialCooldown = DataManager::getData($player, "Cooldowns", "RankKitImperial");
        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::DARK_PURPLE . "Imperial " . TF::RESET . TF::GRAY . "Rank Kit");
        $permission = DataManager::getData($player, "Permissions", "emporiumcore.rankkit.imperial");

        if($permission) {
            if($imperialCooldown > 0) {
                # kit on cooldown
                $lore = [
                    "§r",
                    TF::BOLD . TF::RED . "ON COOLDOWN " . Translator::timeConvert($imperialCooldown)
                ];
                $item->getNamedTag()->setString("ImperialCooldown", 1);
            } else {
                # kit available
                $lore = [
                    "§r",
                    TF::BOLD . TF::GREEN . "AVAILABLE NOW " . TF::GRAY . "(Click)"
                ];
                $item->getNamedTag()->setString("Imperial", 1);
            }
        } else {
            # kit locked
            $lore = [
                "§r",
                TF::BOLD . TF::RED . "LOCKED"
            ];
            $item->getNamedTag()->setString("ImperialLocked", 1);
        }
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    # supreme
    public function supremeItem($player): Item {

        $supremeCooldown = DataManager::getData($player, "Cooldowns", "RankKitSupreme");
        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::DARK_AQUA . "Supreme " . TF::RESET . TF::GRAY . "Rank Kit");
        $permission = DataManager::getData($player, "Permissions", "emporiumcore.rankkit.supreme");

        if($permission) {
            if($supremeCooldown > 0) {
                # kit on cooldown
                $lore = [
                    "§r",
                    TF::BOLD . TF::RED . "ON COOLDOWN " . Translator::timeConvert($supremeCooldown)
                ];
                $item->getNamedTag()->setString("SupremeCooldown", 1);
            } else {
                # kit available
                $lore = [
                    "§r",
                    TF::BOLD . TF::GREEN . "AVAILABLE NOW " . TF::GRAY . "(Click)"
                ];
                $item->getNamedTag()->setString("Supreme", 1);
            }
        } else {
            # kit locked
            $lore = [
                "§r",
                TF::BOLD . TF::RED . "LOCKED"
            ];
            $item->getNamedTag()->setString("SupremeLocked", 1);
        }
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    # majesty
    public function majestyItem($player): Item {

        $majestyCooldown = DataManager::getData($player, "Cooldowns", "RankKitMajesty");
        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::DARK_PURPLE . "Majesty " . TF::RESET . TF::GRAY . "Rank Kit");
        $permission = DataManager::getData($player, "Permissions", "emporiumcore.rankkit.majesty");

        if($permission) {
            if($majestyCooldown > 0) {
                # kit on cooldown
                $lore = [
                    "§r",
                    TF::BOLD . TF::RED . "ON COOLDOWN " . Translator::timeConvert($majestyCooldown)
                ];
                $item->getNamedTag()->setString("MajestyCooldown", 1);
            } else {
                # kit available
                $lore = [
                    "§r",
                    TF::BOLD . TF::GREEN . "AVAILABLE NOW " . TF::GRAY . "(Click)"
                ];
                $item->getNamedTag()->setString("Majesty", 1);
            }
        } else {
            # kit locked
            $lore = [
                "§r",
                TF::BOLD . TF::RED . "LOCKED"
            ];
            $item->getNamedTag()->setString("MajestyLocked", 1);
        }
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    # emperor
    public function emperorItem($player): Item {

        $emperorCooldown = DataManager::getData($player, "Cooldowns", "RankKitEmperor");
        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::AQUA . "Emperor " . TF::RESET . TF::GRAY . "Rank Kit");
        $permission = DataManager::getData($player, "Permissions", "emporiumcore.rankkit.emperor");

        if($permission) {
            if($emperorCooldown > 0) {
                # kit on cooldown
                $lore = [
                    "§r",
                    TF::BOLD . TF::RED . "ON COOLDOWN " . Translator::timeConvert($emperorCooldown)
                ];
                $item->getNamedTag()->setString("EmperorCooldown", 1);
            } else {
                # kit available
                $lore = [
                    "§r",
                    TF::BOLD . TF::GREEN . "AVAILABLE NOW " . TF::GRAY . "(Click)"
                ];
                $item->getNamedTag()->setString("Emperor", 1);
            }
        } else {
            # kit locked
            $lore = [
                "§r",
                TF::BOLD . TF::RED . "LOCKED"
            ];
            $item->getNamedTag()->setString("EmperorLocked", 1);
        }
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    # president
    public function presidentItem($player): Item {

        $presidentCooldown = DataManager::getData($player, "Cooldowns", "RankKitPresident");
        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::RED . "President " . TF::RESET . TF::GRAY . "Rank Kit");
        $permission = DataManager::getData($player, "Permissions", "emporiumcore.rankkit.president");

        if($permission) {
            if($presidentCooldown > 0) {
                # kit on cooldown
                $lore = [
                    "§r",
                    TF::BOLD . TF::RED . "ON COOLDOWN " . Translator::timeConvert($presidentCooldown)
                ];
                $item->getNamedTag()->setString("PresidentCooldown", 1);
            } else {
                # kit available
                $lore = [
                    "§r",
                    TF::BOLD . TF::GREEN . "AVAILABLE NOW " . TF::GRAY . "(Click)"
                ];
                $item->getNamedTag()->setString("President", 1);
            }
        } else {
            # kit locked
            $lore = [
                "§r",
                TF::BOLD . TF::RED . "LOCKED"
            ];
            $item->getNamedTag()->setString("PresidentLocked", 1);
        }
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }
}