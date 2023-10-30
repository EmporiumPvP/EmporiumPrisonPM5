<?php

namespace EmporiumCore\Menus;

use Emporium\Prison\Managers\misc\GlowManager;
use Emporium\Prison\Managers\misc\Translator;
use EmporiumCore\EmporiumCore;
use EmporiumData\DataManager;
use EmporiumData\PermissionsManager;
use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\DeterministicInvMenuTransaction;
use muqsit\invmenu\type\InvMenuTypeIds;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\item\StringToItemParser;
use pocketmine\player\Player;
use pocketmine\scheduler\ClosureTask;
use pocketmine\utils\TextFormat;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\BlazeShootSound;
use pocketmine\world\sound\ItemFrameAddItemSound;

class RankKitsMenu {

    public function Inventory($player): void {
        $menu = InvMenu::create(InvMenuTypeIds::TYPE_CHEST);
        $menu->setName("Rank Kits");
        $menu->setListener(InvMenu::readonly(function(DeterministicInvMenuTransaction $transaction) use ($menu) {

            $player = $transaction->getPlayer();
            $itemClicked = $transaction->getItemClicked();

            # noble
            if($itemClicked->getNamedTag()->getTag("Noble")) {
                if($player->getInventory()->canAddItem((EmporiumCore::getInstance()->getRankKits())->noble(1))) {
                    $player->getInventory()->addItem((EmporiumCore::getInstance()->getRankKits())->noble(1));
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "cooldown.rank_kit_noble", 259200); # 3 day cooldown
                    $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::DARK_GRAY . "Noble Rank Kit");
                    $player->broadcastSound(new BlazeShootSound(), [$player]);
                    $this->evaluateItems($menu, $player);
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
                if($player->getInventory()->canAddItem((EmporiumCore::getInstance()->getRankKits())->imperial(1))) {
                    $player->getInventory()->addItem((EmporiumCore::getInstance()->getRankKits())->imperial(1));
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "cooldown.rank_kit_imperial", 259200); # 3 day cooldown
                    $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::LIGHT_PURPLE . "Imperial Rank Kit");
                    $player->broadcastSound(new BlazeShootSound(), [$player]);
                    $this->evaluateItems($menu, $player);
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
                if($player->getInventory()->canAddItem((EmporiumCore::getInstance()->getRankKits())->supreme(1))) {
                    $player->getInventory()->addItem((EmporiumCore::getInstance()->getRankKits())->supreme(1));
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "cooldown.rank_kit_supreme", 259200); # 3 day cooldown
                    $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::DARK_AQUA . "Supreme Rank Kit");
                    $player->broadcastSound(new BlazeShootSound(), [$player]);
                    $this->evaluateItems($menu, $player);
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
                if($player->getInventory()->canAddItem((EmporiumCore::getInstance()->getRankKits())->majesty(1))) {
                    $player->getInventory()->addItem((EmporiumCore::getInstance()->getRankKits())->majesty(1));
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "cooldown.rank_kit_majesty", 259200); # 3 day cooldown
                    $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::DARK_PURPLE . "Majesty Rank Kit");
                    $player->broadcastSound(new BlazeShootSound(), [$player]);
                    $this->evaluateItems($menu, $player);
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
                if($player->getInventory()->canAddItem((EmporiumCore::getInstance()->getRankKits())->emperor(1))) {
                    $player->getInventory()->addItem((EmporiumCore::getInstance()->getRankKits())->emperor(1));
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "cooldown.rank_kit_emperor", 259200); # 3 day cooldown
                    $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::AQUA . "Emperor Rank Kit");
                    $player->broadcastSound(new BlazeShootSound(), [$player]);
                    $this->evaluateItems($menu, $player);
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
                if($player->getInventory()->canAddItem((EmporiumCore::getInstance()->getRankKits())->president(1))) {
                    $player->getInventory()->addItem((EmporiumCore::getInstance()->getRankKits())->president(1));
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "cooldown.rank_kit_president", 259200); # 3 day cooldown
                    $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::RED . "President Rank Kit");
                    $player->broadcastSound(new BlazeShootSound(), [$player]);
                    $this->evaluateItems($menu, $player);
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


        $this->evaluateItems($menu, $player);
        $menu->send($player);

        $task = new ClosureTask(function () use ($menu, $player) {
            $this->evaluateItems($menu, $player);
        });

        $menu->setInventoryCloseListener(function (Player $player, Inventory $inventory) use ($task) {
            $task->getHandler()->cancel();
        });

        EmporiumCore::getInstance()->getScheduler()->scheduleRepeatingTask($task, 4);
    }

    private function evaluateItems (InvMenu $menu, Player $player) : void
    {
        $inventory = $menu->getInventory();
        $inventory->setItem(10, $this->nobleItem($player));
        $inventory->setItem(12, $this->imperialItem($player));
        $inventory->setItem(14, $this->supremeItem($player));
        $inventory->setItem(16, $this->majestyItem($player));
        $inventory->setItem(20, $this->emperorItem($player));
        $inventory->setItem(24, $this->presidentItem($player));
    }

    # noble
    public function nobleItem($player): Item {

        $nobleCooldown = (int) DataManager::getInstance()->getPlayerData($player->getXuid(), "cooldown.rank_kit_noble");
        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::DARK_GRAY . "Noble " . TF::RESET . TF::GRAY . "Rank Kit");
        $permission = PermissionsManager::getInstance()->checkPermission($player->getXuid(), ["emporiumcore.rank_kit.noble"]);

        if($permission) {
            if($nobleCooldown > 0) {
                # kit on cooldown
                $lore = [
                    "§r",
                    TF::BOLD . TF::RED . "ON COOLDOWN " . TextFormat::WHITE . Translator::timeConvert($nobleCooldown)
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

        $imperialCooldown = (int) DataManager::getInstance()->getPlayerData($player->getXuid(), "cooldown.rank_kit_imperial");
        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::DARK_PURPLE . "Imperial " . TF::RESET . TF::GRAY . "Rank Kit");
        $permission = PermissionsManager::getInstance()->checkPermission($player->getXuid(), ["emporiumcore.rank_kit.imperial"]);

        if($permission) {
            if($imperialCooldown > 0) {
                # kit on cooldown
                $lore = [
                    "§r",
                    TF::BOLD . TF::RED . "ON COOLDOWN " . TextFormat::WHITE . Translator::timeConvert($imperialCooldown)
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

        $supremeCooldown = (int) DataManager::getInstance()->getPlayerData($player->getXuid(), "cooldown.rank_kit_supreme");
        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::DARK_AQUA . "Supreme " . TF::RESET . TF::GRAY . "Rank Kit");
        $permission = PermissionsManager::getInstance()->checkPermission($player->getXuid(), ["emporiumcore.rank_kit.supreme"]);

        if($permission) {
            if($supremeCooldown > 0) {
                # kit on cooldown
                $lore = [
                    "§r",
                    TF::BOLD . TF::RED . "ON COOLDOWN " . TextFormat::WHITE . Translator::timeConvert($supremeCooldown)
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

        $majestyCooldown = (int) DataManager::getInstance()->getPlayerData($player->getXuid(), "cooldown.rank_kit_majesty");
        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::DARK_PURPLE . "Majesty " . TF::RESET . TF::GRAY . "Rank Kit");
        $permission = PermissionsManager::getInstance()->checkPermission($player->getXuid(), ["emporiumcore.rank_kit.majesty"]);

        if($permission) {
            if($majestyCooldown > 0) {
                # kit on cooldown
                $lore = [
                    "§r",
                    TF::BOLD . TF::RED . "ON COOLDOWN " . TextFormat::WHITE . Translator::timeConvert($majestyCooldown)
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

        $emperorCooldown = (int) DataManager::getInstance()->getPlayerData($player->getXuid(), "cooldown.rank_kit_emperor");
        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::AQUA . "Emperor " . TF::RESET . TF::GRAY . "Rank Kit");
        $permission = PermissionsManager::getInstance()->checkPermission($player->getXuid(), ["emporiumcore.rank_kit.emperor"]);

        if($permission) {
            if($emperorCooldown > 0) {
                # kit on cooldown
                $lore = [
                    "§r",
                    TF::BOLD . TF::RED . "ON COOLDOWN " . TextFormat::WHITE . Translator::timeConvert($emperorCooldown)
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
        $presidentCooldown = (int) DataManager::getInstance()->getPlayerData($player->getXuid(), "cooldown.rank_kit_president");
        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::RED . "President " . TF::RESET . TF::GRAY . "Rank Kit");
        $permission = PermissionsManager::getInstance()->checkPermission($player->getXuid(), ["emporiumcore.rank_kit.president"]);

        if($permission) {
            if($presidentCooldown > 0) {
                # kit on cooldown
                $lore = [
                    "§r",
                    TF::BOLD . TF::RED . "ON COOLDOWN " . TextFormat::WHITE . Translator::timeConvert($presidentCooldown)
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