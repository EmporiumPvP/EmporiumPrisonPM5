<?php

namespace Emporium\Prison\Menus;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\library\formapi\SimpleForm;
use Emporium\Prison\Managers\misc\GlowManager;

use EmporiumData\DataManager;
use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\DeterministicInvMenuTransaction;

use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\world\sound\EnderChestCloseSound;
use pocketmine\world\sound\NoteInstrument;
use pocketmine\item\Item;
use pocketmine\item\ItemIds;
use pocketmine\item\StringToItemParser;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\NoteSound;

class Vaults extends Menu {

    public function open(Player $player): void
    {
        $this->Form($player);
    }

    public function Inventory($player): void {

        $menu = InvMenu::create(EmporiumPrison::TYPE_DISPENSER);
        $menu->setName(TF::BOLD . "Vaults");
        $menu->setListener(InvMenu::readonly(function(DeterministicInvMenuTransaction $transaction) {
            $player = $transaction->getPlayer();
            $itemClicked = $transaction->getItemClicked();
            $itemClickedId = $itemClicked->getId();

            /** @var PlayerVaults $vaults */
            $vaults = Server::getInstance()->getPluginManager()->getPlugin("PlayerVaults");

            if($itemClickedId === ItemIds::OBSIDIAN) {
                $player->broadcastSound(new NoteSound(NoteInstrument::DOUBLE_BASS(), 12), [$player]);
            } elseif($itemClickedId === ItemIds::ENDER_CHEST) {
                if ($itemClicked->getNamedTag()->getInt("pv") === 1) {
                    $vaults->openVault($player, $player->getName(), 1);
                } elseif ($itemClicked->getNamedTag()->getInt("pv") === 2) {
                    $vaults->openVault($player, $player->getName(), 2);
                } elseif ($itemClicked->getNamedTag()->getInt("pv") === 3) {
                    $vaults->openVault($player, $player->getName(), 3);
                } elseif ($itemClicked->getNamedTag()->getInt("pv") === 4) {
                    $vaults->openVault($player, $player->getName(), 4);
                } elseif ($itemClicked->getNamedTag()->getInt("pv") === 5) {
                    $vaults->openVault($player, $player->getName(), 5);
                } elseif ($itemClicked->getNamedTag()->getInt("pv") === 6) {
                    $vaults->openVault($player, $player->getName(), 6);
                } elseif ($itemClicked->getNamedTag()->getInt("pv") === 7) {
                    $vaults->openVault($player, $player->getName(), 7);
                } elseif ($itemClicked->getNamedTag()->getInt("pv") === 8) {
                    $vaults->openVault($player, $player->getName(), 8);
                } elseif ($itemClicked->getNamedTag()->getInt("pv") === 9) {
                    $vaults->openVault($player, $player->getName(), 9);
                }
                $player->broadcastSound(new NoteSound(NoteInstrument::CLICKS_AND_STICKS(), 10), [$player]);
            }
        }));
        $inventory = $menu->getInventory();

        $inventory->setItem(0, $this->pv1());
        $inventory->setItem(1, $this->pv2($player));
        $inventory->setItem(2, $this->pv3($player));
        $inventory->setItem(3, $this->pv4($player));
        $inventory->setItem(4, $this->pv5($player));
        $inventory->setItem(5, $this->pv6($player));
        $inventory->setItem(6, $this->pv7($player));
        $inventory->setItem(7, $this->pv8($player));
        $inventory->setItem(8, $this->pv9($player));

        $menu->send($player);
    }
    # inventory items
    public function pv1(): Item {
        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->getNamedTag()->setInt("pv", 1);
        $item->setCustomName(TF::BOLD . TF::AQUA . "Vault " . TF::WHITE . "1");
        $lore = [
            "",
            TF::GRAY . "(Click to open)"
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);
        return $item;
    } # all players have minimum 1 pv
    public function pv2($player): Item {
        $permission = DataManager::getInstance()->getPlayerData($player->getXuid(), "playervaults.vault.2");
        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->getNamedTag()->setInt("pv", 2);
        if($permission) {
            $item->setCustomName(TF::BOLD . TF::AQUA . "Vault " . TF::WHITE . "2");
            $lore = [
                "",
                TF::GRAY . "(Click to open)"
            ];
            $item->setLore($lore);
        } else {
            $item = StringToItemParser::getInstance()->parse("obsidian");
            $item->setCustomName(TF::RED . "This vault slot is locked.\n" . TF::GRAY . "To unlock more Vaults visit the\n" . TF::GRAY . "store or use a Vault Slot Token.");
        }
        $item->addEnchantment(GlowManager::$enchInst);
        return $item;
    }
    public function pv3($player): Item {
        $permission = DataManager::getInstance()->getPlayerData($player->getXuid(), "playervaults.vault.3");
        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->getNamedTag()->setInt("pv", 3);
        if($permission) {
            $item->setCustomName(TF::BOLD . TF::AQUA . "Vault " . TF::WHITE . "3");
            $lore = [
                "",
                TF::GRAY . "(Click to open)"
            ];
            $item->setLore($lore);
        } else {
            $item = StringToItemParser::getInstance()->parse("obsidian");
            $item->setCustomName(TF::RED . "This vault slot is locked.\n" . TF::GRAY . "To unlock more Vaults visit the\n" . TF::GRAY . "store or use a Vault Slot Token.");
        }
        $item->addEnchantment(GlowManager::$enchInst);
        return $item;
    }
    public function pv4($player): Item {
        $permission = DataManager::getInstance()->getPlayerData($player->getXuid(), "playervaults.vault.4");
        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->getNamedTag()->setInt("pv", 4);
        if($permission) {
            $item->setCustomName(TF::BOLD . TF::AQUA . "Vault " . TF::WHITE . "4");
            $lore = [
                "",
                TF::GRAY . "(Click to open)"
            ];
            $item->setLore($lore);
        } else {
            $item = StringToItemParser::getInstance()->parse("obsidian");
            $item->setCustomName(TF::RED . "This vault slot is locked.\n" . TF::GRAY . "To unlock more Vaults visit the\n" . TF::GRAY . "store or use a Vault Slot Token.");
        }
        $item->addEnchantment(GlowManager::$enchInst);
        return $item;
    }
    public function pv5($player): Item {
        $permission = DataManager::getInstance()->getPlayerData($player->getXuid(), "playervaults.vault.5");
        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->getNamedTag()->setInt("pv", 5);
        if($permission) {
            $item->setCustomName(TF::BOLD . TF::AQUA . "Vault " . TF::WHITE . "5");
            $lore = [
                "",
                TF::GRAY . "(Click to open)"
            ];
            $item->setLore($lore);
        } else {
            $item = StringToItemParser::getInstance()->parse("obsidian");
            $item->setCustomName(TF::RED . "This vault slot is locked.\n" . TF::GRAY . "To unlock more Vaults visit the\n" . TF::GRAY . "store or use a Vault Slot Token.");
        }
        $item->addEnchantment(GlowManager::$enchInst);
        return $item;
    }
    public function pv6($player): Item {
        $permission = DataManager::getInstance()->getPlayerData($player->getXuid(), "playervaults.vault.6");
        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->getNamedTag()->setInt("pv", 6);
        if($permission) {
            $item->setCustomName(TF::BOLD . TF::AQUA . "Vault " . TF::WHITE . "6");
            $lore = [
                "",
                TF::GRAY . "(Click to open)"
            ];
            $item->setLore($lore);
        } else {
            $item = StringToItemParser::getInstance()->parse("obsidian");
            $item->setCustomName(TF::RED . "This vault slot is locked.\n" . TF::GRAY . "To unlock more Vaults visit the\n" . TF::GRAY . "store or use a Vault Slot Token.");
        }
        $item->addEnchantment(GlowManager::$enchInst);
        return $item;
    }
    public function pv7($player): Item {
        $permission = DataManager::getInstance()->getPlayerData($player->getXuid(), "playervaults.vault.7");
        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->getNamedTag()->setInt("pv", 7);
        if($permission) {
            $item->setCustomName(TF::BOLD . TF::AQUA . "Vault " . TF::WHITE . "7");
            $lore = [
                "",
                TF::GRAY . "(Click to open)"
            ];
            $item->setLore($lore);
        } else {
            $item = StringToItemParser::getInstance()->parse("obsidian");
            $item->setCustomName(TF::RED . "This vault slot is locked.\n" . TF::GRAY . "To unlock more Vaults visit the\n" . TF::GRAY . "store or use a Vault Slot Token.");
        }
        $item->addEnchantment(GlowManager::$enchInst);
        return $item;
    }
    public function pv8($player): Item {
        $permission = DataManager::getInstance()->getPlayerData($player->getXuid(), "playervaults.vault.8");
        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->getNamedTag()->setInt("pv", 8);
        if($permission) {
            $item->setCustomName(TF::BOLD . TF::AQUA . "Vault " . TF::WHITE . "8");
            $lore = [
                "",
                TF::GRAY . "(Click to open)"
            ];
            $item->setLore($lore);
        } else {
            $item = StringToItemParser::getInstance()->parse("obsidian");
            $item->setCustomName(TF::RED . "This vault slot is locked.\n" . TF::GRAY . "To unlock more Vaults visit the\n" . TF::GRAY . "store or use a Vault Slot Token.");
        }
        $item->addEnchantment(GlowManager::$enchInst);
        return $item;
    }
    public function pv9($player): Item {
        $permission = DataManager::getInstance()->getPlayerData($player->getXuid(), "playervaults.vault.9");
        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->getNamedTag()->setInt("pv", 9);
        if($permission) {
            $item->setCustomName(TF::BOLD . TF::AQUA . "Vault " . TF::WHITE . "9");
            $lore = [
                "",
                TF::GRAY . "(Click to open)"
            ];
            $item->setLore($lore);
        } else {
            $item = StringToItemParser::getInstance()->parse("obsidian");
            $item->setCustomName(TF::RED . "This vault slot is locked.\n" . TF::GRAY . "To unlock more Vaults visit the\n" . TF::GRAY . "store or use a Vault Slot Token.");
        }
        $item->addEnchantment(GlowManager::$enchInst);
        return $item;
    }

    public function Form($player): void {

        $form = new SimpleForm(function (Player $player, $data) {
            $result = $data;
            if($result === null) {
                $player->broadcastSound(new EnderChestCloseSound(), [$player]);
                return;
            }
            /** @var PlayerVaults $vaults */
            $vaults = Server::getInstance()->getPluginManager()->getPlugin("PlayerVaults");
            switch ($result) {

                case 0:
                    $vaults->openVault($player, $player->getName(), 1);
                    break;

                case 1:
                    if(DataManager::getInstance()->getPlayerData($player->getXuid(), "playervaults.vault.2")) {
                        $vaults->openVault($player, $player->getName(), 1);
                    } else {
                        $player->sendMessage(TF::RED . "That Vault is locked, unlock with a Vault Token or Purchase from the store.");
                        $player->broadcastSound(new NoteSound(NoteInstrument::DOUBLE_BASS(), 12), [$player]);
                    }
                    break;

                case 2:
                    if(DataManager::getInstance()->getPlayerData($player->getXuid(), "playervaults.vault.3")) {
                        $vaults->openVault($player, $player->getName(), 1);
                    } else {
                        $player->sendMessage(TF::RED . "That Vault is locked, unlock with a Vault Token or Purchase from the store.");
                        $player->broadcastSound(new NoteSound(NoteInstrument::DOUBLE_BASS(), 12), [$player]);
                    }
                    break;

                case 3:
                    if(DataManager::getInstance()->getPlayerData($player->getXuid(), "playervaults.vault.4")) {
                        $vaults->openVault($player, $player->getName(), 1);
                    } else {
                        $player->sendMessage(TF::RED . "That Vault is locked, unlock with a Vault Token or Purchase from the store.");
                        $player->broadcastSound(new NoteSound(NoteInstrument::DOUBLE_BASS(), 12), [$player]);
                    }
                    break;

                case 4:
                    if(DataManager::getInstance()->getPlayerData($player->getXuid(), "playervaults.vault.5")) {
                        $vaults->openVault($player, $player->getName(), 1);
                    } else {
                        $player->sendMessage(TF::RED . "That Vault is locked, unlock with a Vault Token or Purchase from the store.");
                        $player->broadcastSound(new NoteSound(NoteInstrument::DOUBLE_BASS(), 12), [$player]);
                    }
                    break;

                case 5:
                    if(DataManager::getInstance()->getPlayerData($player->getXuid(), "playervaults.vault.6")) {
                        $vaults->openVault($player, $player->getName(), 1);
                    } else {
                        $player->sendMessage(TF::RED . "That Vault is locked, unlock with a Vault Token or Purchase from the store.");
                        $player->broadcastSound(new NoteSound(NoteInstrument::DOUBLE_BASS(), 12), [$player]);
                    }
                    break;

                case 6:
                    if(DataManager::getInstance()->getPlayerData($player->getXuid(), "playervaults.vault.7")) {
                        $vaults->openVault($player, $player->getName(), 1);
                    } else {
                        $player->sendMessage(TF::RED . "That Vault is locked, unlock with a Vault Token or Purchase from the store.");
                        $player->broadcastSound(new NoteSound(NoteInstrument::DOUBLE_BASS(), 12), [$player]);
                    }
                    break;

                case 7:
                    if(DataManager::getInstance()->getPlayerData($player->getXuid(), "playervaults.vault.8")) {
                        $vaults->openVault($player, $player->getName(), 1);
                    } else {
                        $player->sendMessage(TF::RED . "That Vault is locked, unlock with a Vault Token or Purchase from the store.");
                        $player->broadcastSound(new NoteSound(NoteInstrument::DOUBLE_BASS(), 12), [$player]);
                    }
                    break;

                case 8:
                    if(DataManager::getInstance()->getPlayerData($player->getXuid(), "playervaults.vault.9")) {
                        $vaults->openVault($player, $player->getName(), 1);
                    } else {
                        $player->sendMessage(TF::RED . "That Vault is locked, unlock with a Vault Token or Purchase from the store.");
                        $player->broadcastSound(new NoteSound(NoteInstrument::DOUBLE_BASS(), 12), [$player]);
                    }
                    break;
            }
        });
        $form->setTitle(TF::BOLD . "Vaults");

        for ($i = 1; $i <= 9; $i++) {
            if(DataManager::getInstance()->getPlayerData($player->getXuid(), "playervaults.vault.$i")) {
                $form->addButton(TF::AQUA . "Vault" . TF::WHITE . " $i");
                continue;
            }

            $form->addButton(TF::RED . "Locked Vault Slot");

        }

        $player->sendForm($form);

    } # END OF EXECUTE
}