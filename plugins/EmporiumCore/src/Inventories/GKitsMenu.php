<?php

namespace Inventories;

use EmporiumCore\Managers\Data\DataManager;
use Items\GKits;
use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\DeterministicInvMenuTransaction;
use muqsit\invmenu\type\InvMenuTypeIds;


class GKitsMenu {

    public function MainMenu($sender): void {

        $prefix = "§l§bEmporium §8>> ";
        # GET KIT COOLDOWNS
        $championKitCooldown = DataManager::getData($sender, "Cooldowns", "KitChampion");
        $legendKitCooldown = DataManager::getData($sender, "Cooldowns", "KitLegend");
        $overlordKitCooldown = DataManager::getData($sender, "Cooldowns", "KitOverlord");
        $mythKitCooldown = DataManager::getData($sender, "Cooldowns", "KitMyth");
        $immortalKitCooldown = DataManager::getData($sender, "Cooldowns", "KitImmortal");

        $menu = InvMenu::create(InvMenuTypeIds::TYPE_CHEST);
        $menu->setName("GKits");

        # MENU LISTENER
        $menu->setListener(InvMenu::readonly(function(DeterministicInvMenuTransaction $transaction) use ($prefix, $sender): void {
            $player = $transaction->getPlayer();
            $itemClicked = $transaction->getItemClicked();

            # GIVE CHAMPION KIT
            if($itemClicked->getNamedTag()->getTag("ChampionClaimKit")) {

                $cooldown = DataManager::getData($player, "Cooldowns", "KitChampion");
                # CONVERT COOLDOWN INTO HOURS:MINUTES:SECONDS
                $seconds = $cooldown % 60;
                $minutes = floor($cooldown / 60);
                $hours = floor($minutes / 60);
                $minutes = $minutes % 60;
                $cooldownMessage = $hours . ":" . $minutes . ":" . $seconds;

                if($cooldown >= 1) {
                    $player->removeCurrentWindow();
                    $player->sendMessage($prefix . "§r§7Kit is on cooldown §c" . $cooldownMessage . " §7remaining");
                } else {
                    if($player->getInventory()->canAddItem((new GKits)->ChampionScroll())) {
                        $player->getInventory()->addItem((new GKits)->ChampionScroll());
                        DataManager::setData($player, "Cooldowns", "ChampionKit", 43200);
                    } else {
                        $player->removeCurrentWindow();
                        $player->sendTitle("§l§cInventory Full");
                    }
                }
            }
            # PREVIEW CHAMPION KIT
            if($itemClicked->getNamedTag()->getTag("ChampionPreviewKit")) {
                $this->ChampionPreview($sender);
            }

            # GIVE LEGEND KIT
            if($itemClicked->getNamedTag()->getTag("LegendClaimKit")) {

                $cooldown = DataManager::getData($player, "Cooldowns", "KitLegend");
                # CONVERT COOLDOWN INTO HOURS:MINUTES:SECONDS
                $seconds = $cooldown % 60;
                $minutes = floor($cooldown / 60);
                $hours = floor($minutes / 60);
                $minutes = $minutes % 60;
                $cooldownMessage = $hours . ":" . $minutes . ":" . $seconds;

                if($cooldown >= 1) {
                    $player->removeCurrentWindow();
                    $player->sendMessage($prefix . "§r§7Kit is on cooldown §c" . $cooldownMessage . " §7remaining");
                } else {
                    if($player->getInventory()->canAddItem((new GKits)->LegendScroll())) {
                        $player->getInventory()->addItem((new GKits)->LegendScroll());
                        DataManager::setData($player, "Cooldowns", "LegendKit", 43200);
                    } else {
                        $player->removeCurrentWindow();
                        $player->sendTitle("§l§cInventory Full");
                    }
                }

            }
            # PREVIEW LEGEND KIT
            if($itemClicked->getNamedTag()->getTag("LegendPreviewKit")) {
                $this->LegendPreview($sender);
            }

            # GIVE OVERLORD KIT
            if($itemClicked->getNamedTag()->getTag("OverlordClaimKit")) {

                $cooldown = DataManager::getData($player, "Cooldowns", "KitOverlord");
                # CONVERT COOLDOWN INTO HOURS:MINUTES:SECONDS
                $seconds = $cooldown % 60;
                $minutes = floor($cooldown / 60);
                $hours = floor($minutes / 60);
                $minutes = $minutes % 60;
                $cooldownMessage = $hours . ":" . $minutes . ":" . $seconds;

                if($cooldown >= 1) {
                    $player->removeCurrentWindow();
                    $player->sendMessage($prefix . "§r§7Kit is on cooldown §c" . $cooldownMessage . " §7remaining");
                } else {
                    if($player->getInventory()->canAddItem((new GKits)->OverlordScroll())) {
                        $player->getInventory()->addItem((new GKits)->OverlordScroll());
                        DataManager::setData($player, "Cooldowns", "OverlordKit", 43200);
                    } else {
                        $player->removeCurrentWindow();
                        $player->sendTitle("§l§cInventory Full");
                    }
                }

            }
            # PREVIEW OVERLORD KIT
            if($itemClicked->getNamedTag()->getTag("OverlordPreviewKit")) {
                $this->OverlordPreview($sender);
            }

            # GIVE MYTH KIT
            if($itemClicked->getNamedTag()->getTag("MythClaimKit")) {

                $cooldown = DataManager::getData($player, "Cooldowns", "KitMyth");
                # CONVERT COOLDOWN INTO HOURS:MINUTES:SECONDS
                $seconds = $cooldown % 60;
                $minutes = floor($cooldown / 60);
                $hours = floor($minutes / 60);
                $minutes = $minutes % 60;
                $cooldownMessage = $hours . ":" . $minutes . ":" . $seconds;

                if($cooldown >= 1) {
                    $player->removeCurrentWindow();
                    $player->sendMessage($prefix . "§r§7Kit is on cooldown §c" . $cooldownMessage . " §7remaining");
                } else {
                    if($player->getInventory()->canAddItem((new GKits)->MythScroll())) {
                        $player->getInventory()->addItem((new GKits)->MythScroll());
                        DataManager::setData($player, "Cooldowns", "MythKit", 43200);
                    } else {
                        $player->removeCurrentWindow();
                        $player->sendTitle("§l§cInventory Full");
                    }
                }

            }
            # PREVIEW MYTH KIT
            if($itemClicked->getNamedTag()->getTag("MythPreviewKit")) {
                $this->MythPreview($sender);
            }

            # GIVE IMMORTAL KIT
            if($itemClicked->getNamedTag()->getTag("ImmortalClaimKit")) {

                $cooldown = DataManager::getData($player, "Cooldowns", "KitImmortal");
                # CONVERT COOLDOWN INTO HOURS:MINUTES:SECONDS
                $seconds = $cooldown % 60;
                $minutes = floor($cooldown / 60);
                $hours = floor($minutes / 60);
                $minutes = $minutes % 60;
                $cooldownMessage = $hours . ":" . $minutes . ":" . $seconds;

                if($cooldown >= 1) {
                    $player->removeCurrentWindow();
                    $player->sendMessage($prefix . "§r§7Kit is on cooldown §c" . $cooldownMessage . " §7remaining");
                } else {
                    if($player->getInventory()->canAddItem((new GKits)->ImmortalScroll())) {
                        $player->getInventory()->addItem((new GKits)->ImmortalScroll());
                        DataManager::setData($player, "Cooldowns", "ImmortalKit", 43200);
                    } else {
                        $player->removeCurrentWindow();
                        $player->sendTitle("§l§cInventory Full");
                    }
                }

            }
            # PREVIEW IMMORTAL KIT
            if($itemClicked->getNamedTag()->getTag("ImmortalPreviewKit")) {
                $this->ImmortalPreview($sender);
            }

        }));

        # ITEMS
        $inventory = $menu->getInventory();

        if($sender->hasPermission("emporiumcore.gkit.champion")) {
            if($championKitCooldown >= 1) {
                $inventory->setItem(11, (new GKits)->ChampionScrollCooldown($sender));
            } else {
                $inventory->setItem(11, (new GKits)->ChampionScrollClaim());
            }
        } else {
            $inventory->setItem(11, (new GKits)->ChampionScrollPreview());
        }

        if($sender->hasPermission("emporiumcore.gkit.legend")) {
            if($legendKitCooldown >= 1) {
                $inventory->setItem(12, (new GKits)->LegendScrollCooldown($sender));
            } else {
                $inventory->setItem(12, (new GKits)->LegendScrollClaim());
            }
        } else {
            $inventory->setItem(12, (new GKits)->LegendScrollPreview());
        }

        if($sender->hasPermission("emporiumcore.gkit.overlord")) {
            if($overlordKitCooldown >= 1) {
                $inventory->setItem(13, (new GKits)->OverlordScrollCooldown($sender));
            } else {
                $inventory->setItem(13, (new GKits)->OverlordScrollClaim());
            }
        } else {
            $inventory->setItem(13, (new GKits)->OverlordScrollPreview());
        }

        if($sender->hasPermission("emporiumcore.gkit.myth")) {
            if($mythKitCooldown >= 1) {
                $inventory->setItem(14, (new GKits)->MythScrollCooldown($sender));
            } else {
                $inventory->setItem(14, (new GKits)->MythScrollClaim());
            }
        } else {
            $inventory->setItem(14, (new GKits)->MythScrollPreview());
        }

        if($sender->hasPermission("emporiumcore.gkit.immortal")) {
            if($immortalKitCooldown >= 1) {
                $inventory->setItem(15, (new GKits)->ImmortalScrollCooldown($sender));
            } else {
                $inventory->setItem(15, (new GKits)->ImmortalScrollClaim());
            }
        } else {
            $inventory->setItem(15, (new GKits)->ImmortalScrollPreview());
        }

        $menu->send($sender);

    }

    public function ChampionPreview($sender): void {

        $menu = InvMenu::create(InvMenuTypeIds::TYPE_CHEST);
        $menu->setName("Champion GKit");
        $menu->setListener(InvMenu::readonly(function (DeterministicInvMenuTransaction $transaction) : void {

        }));
        $inventory = $menu->getInventory();

        $inventory->setItem(10, (new GKits)->ChampionHelmet());
        $inventory->setItem(11, (new GKits)->ChampionChestplate());
        $inventory->setItem(12, (new GKits)->ChampionLeggings());
        $inventory->setItem(13, (new GKits)->ChampionBoots());
        $inventory->setItem(14, (new GKits)->ChampionSword());
        $inventory->setItem(15, (new GKits)->ChampionPickaxe());

        $menu->send($sender);

    } # END OF MENU

    public function LegendPreview($sender): void {

        $menu = InvMenu::create(InvMenuTypeIds::TYPE_CHEST);
        $menu->setName("Legend GKit");
        $menu->setListener(InvMenu::readonly(function (DeterministicInvMenuTransaction $transaction): void {

        }));
        $inventory = $menu->getInventory();

        $inventory->setItem(10, (new GKits)->LegendHelmet());
        $inventory->setItem(11, (new GKits)->LegendChestplate());
        $inventory->setItem(12, (new GKits)->LegendLeggings());
        $inventory->setItem(13, (new GKits)->LegendBoots());
        $inventory->setItem(14, (new GKits)->LegendSword());
        $inventory->setItem(15, (new GKits)->LegendPickaxe());

        $menu->send($sender);
    }

    public function OverlordPreview($sender): void {

        $menu = InvMenu::create(InvMenuTypeIds::TYPE_CHEST);
        $menu->setName("Overlord GKit");
        $menu->setListener(InvMenu::readonly(function (DeterministicInvMenuTransaction $transaction) : void {

        }));
        $inventory = $menu->getInventory();

        $inventory->setItem(10, (new GKits)->OverlordHelmet());
        $inventory->setItem(11, (new GKits)->OverlordChestplate());
        $inventory->setItem(12, (new GKits)->OverlordLeggings());
        $inventory->setItem(13, (new GKits)->OverlordBoots());
        $inventory->setItem(14, (new GKits)->OverlordSword());
        $inventory->setItem(15, (new GKits)->OverlordPickaxe());

        $menu->send($sender);
    }

    public function MythPreview($sender): void {

        $menu = InvMenu::create(InvMenuTypeIds::TYPE_CHEST);
        $menu->setName("Myth GKit");
        $menu->setListener(InvMenu::readonly(function (DeterministicInvMenuTransaction $transaction) : void {

        }));
        $inventory = $menu->getInventory();

        $inventory->setItem(10, (new GKits)->MythHelmet());
        $inventory->setItem(11, (new GKits)->MythChestplate());
        $inventory->setItem(12, (new GKits)->MythLeggings());
        $inventory->setItem(13, (new GKits)->MythBoots());
        $inventory->setItem(14, (new GKits)->MythSword());
        $inventory->setItem(15, (new GKits)->MythPickaxe());

        $menu->send($sender);
    }

    public function ImmortalPreview($sender): void {

        $menu = InvMenu::create(InvMenuTypeIds::TYPE_CHEST);
        $menu->setName("Immortal GKit");
        $menu->setListener(InvMenu::readonly(function (DeterministicInvMenuTransaction $transaction) : void {

        }));
        $inventory = $menu->getInventory();

        $inventory->setItem(10, (new GKits)->ImmortalHelmet());
        $inventory->setItem(11, (new GKits)->ImmortalChestplate());
        $inventory->setItem(12, (new GKits)->ImmortalLeggings());
        $inventory->setItem(13, (new GKits)->ImmortalBoots());
        $inventory->setItem(14, (new GKits)->ImmortalSword());
        $inventory->setItem(15, (new GKits)->ImmortalPickaxe());

        $menu->send($sender);
    }

}