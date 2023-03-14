<?php

namespace Emporium\Prison\Menus;

use Emporium\Prison\library\formapi\SimpleForm;

use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\DeterministicInvMenuTransaction;
use muqsit\invmenu\type\InvMenuTypeIds;

use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\item\StringToItemParser;

use pocketmine\network\mcpe\protocol\types\DeviceOS;
use pocketmine\player\Player;

use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\EnderChestOpenSound;

class Help extends Menu {
    # main form menu
    public function Form(Player $player): void {

        $form = new SimpleForm(function($player, $data) {
            if(is_null($data)) {
                return;
            }

            $player->broadcastSound(new EnderChestOpenSound(), [$player]);

            switch($data) {
                case 0: # warps
                    $this->warpsForm($player);
                    break;
                case 1: # player level
                    $playerLevel = new PlayerLevel();
                    $playerLevel->Form($player);
                    break;
                case 2: # pickaxe level
                    $this->pickaxeLevelsForm($player);
                    break;
                case 3: # player levels
                    $this->playerPrestigeForm($player);
                    break;
                case 4: # player prestige
                    $this->pickaxePrestigeForm($player);
                    break;
                case 5: # energy
                    $this->energyForm($player);
                    break;
                case 6: # events
                    $this->eventsForm($player);
                    break;
                case 7: # gangs
                    $this->gangsForm($player);
                    break;
                case 8: # bandits
                    $this->banditsForm($player);
                    break;
                case 9: # bosses
                    $this->bossesForm($player);
                    break;
                case 10: # kits
                    $this->kitsForm($player);
                    break;
                case 11: # wormhole
                    $this->wormholeForm($player);
                    break;
                case 12: # enchants
                    $this->enchantsForm($player);
                    break;
                case 13: # bank
                    $this->bankForm($player);
                    break;
                case 14: # tinkerer
                    $this->tinkererForm($player);
                    break;
                case 15: # mining
                    $this->miningForm($player);
                    break;
                case 16: # vaults
                    $this->vaultsForm($player);
                    break;
                case 17: # meteors
                    $this->meteorsForm($player);
                    break;
                case 18: # merchants
                    $this->merchantsForm($player);
                    break;
            }
        });
        $form->setTitle("Help Menu");
        $form->addButton("Warps");
        $form->addButton("Player Levels");
        $form->addButton("Pickaxe Levels");
        $form->addButton("Player Prestige");
        $form->addButton("Pickaxe Prestige");
        $form->addButton("Energy");
        $form->addButton("Events");
        $form->addButton("Gangs");
        $form->addButton("Bandits");
        $form->addButton("Bosses");
        $form->addButton("Kits");
        $form->addButton("Wormhole");
        $form->addButton("Enchants");
        $form->addButton("Bank");
        $form->addButton("Tinkerer");
        $form->addButton("Mining");
        $form->addButton("Vaults");
        $form->addButton("Meteors");
        $form->addButton("Merchants");
        $form->addButton(TF::RED . "Exit");
        $player->sendForm($form);
    }
    # help form sub menus
    public function warpsForm(Player $player): void {

        $form = new SimpleForm(function($player, $data) {
            $this->open($player);
        });
        $form->setTitle(TF::BOLD . "Warps");
        $form->setContent(TF::GRAY . "Emporium Prison has many warps, to access them at any time run /warps, each warp has its own requirements you need to meet to have access to it.\n\nFor detailed information about each run /warpinfo [warpname] | example: /warpinfo coalmine");
        $form->addButton(TF::BOLD . "Back");
        $player->sendForm($form);
    }
    public function pickaxeLevelsForm(Player $player): void {

        $form = new SimpleForm(function($player, $data) {
            $this->open($player);
        });
        $form->setTitle("Pickaxe Levels");
        $form->setContent(TF::BOLD . TF::GOLD . "Pickaxe Levels\n\n" . TF::RESET . TF::AQUA . "As you advance through the levels you will gain the ability to use higher tiers of pickaxes! (Note: You can access the level requirements at any time through " . TF::GOLD . "/levels" . TF::AQUA . ")\nWooden Pickaxe: Level 1-29\nStone Pickaxe: Level 30-49\nGolden Pickaxe: Level 50-69\nIron Pickaxe: Level 70-89\nDiamond Pickaxe: Level 90+");
        $form->addButton("Back");
        $player->sendForm($form);

    }
    public function playerPrestigeForm(Player $player): void {

        $form = new SimpleForm(function($player, $data) {
            $this->open($player);
        });
        $form->setTitle("Player Levels");
        $form->setContent(TF::BOLD . TF::GOLD . "Player Prestige\n\n" . TF::RESET . TF::AQUA . "Prestiging unlocks the ability for you to grind to a higher level each time you do so!\n\nWhen you first start out you will be able to mine up level 100 at which point you will be capped out and you will unlock the ability to prestige!\n\nPrestiging will reset you to level 1 but will also give you the ability to mine up to level 101!\n\nEach time you prestige you will unlock the ability to cap out 1 level higher than the previous prestige!");
        $form->addButton("Back");
        $player->sendForm($form);
    }
    public function pickaxePrestigeForm(Player $player): void {

        $form = new SimpleForm(function($player, $data) {
            $this->open($player);
        });
        $form->setTitle("Pickaxe Levels");
        $form->setContent(TF::BOLD . TF::GOLD . "Pickaxe Prestige\n\n" . TF::RESET . TF::AQUA . "You can prestige your pickaxe in exchange for some " . TF::GOLD . "OP" . TF::AQUA . " permanent buffs to the Pick! Be warned though! Prestiging the pickaxe will cause it to lose all enchants! The level of the pick required to prestige it can be viewed by visiting the Prestige NPC at spawn!");
        $form->addButton("Back");
        $player->sendForm($form);

    }
    public function energyForm(Player $player): void {

        $form = new SimpleForm(function($player, $data) {
            $this->open($player);
        });
        $form->setTitle("Energy");
        $form->setContent(TF::BOLD . TF::GOLD . "Energy\n\n" . TF::RESET . TF::AQUA . "When mining you gain Energy on your Pickaxe! Energy is used to enchant your gear, you can extract energy off your pickaxe to use on your gear by using the command " . TF::GOLD . "/extract" . TF::AQUA . "! Be warned though when extracting energy you will lose 10% of the energy!");
        $form->addButton("Back");
        $player->sendForm($form);

    }
    public function eventsForm(Player $player): void {

        $form = new SimpleForm(function($player, $data) {
            $this->open($player);
        });
        $form->setTitle(TF::BOLD . "Events");
        $form->setContent("");
        $form->addButton("Back");
        $player->sendForm($form);

    }
    public function gangsForm(Player $player): void {

        $form = new SimpleForm(function($player, $data) {
            $this->open($player);
        });
        $form->setTitle(TF::BOLD . "Gangs");
        $form->setContent("");
        $form->addButton("Back");
        $player->sendForm($form);

    }
    public function banditsForm(Player $player): void {

        $form = new SimpleForm(function($player, $data) {
            $this->open($player);
        });
        $form->setTitle(TF::BOLD . "Bandits");
        $form->setContent(TF::BOLD . TF::GOLD . "Bandits\n\n" . TF::RESET . TF::AQUA . "Bandits are roaming NPC's that spawn in the overworld and are based on what tiered zone they spawn in. For example: Chain bandits spawn in the Chain Zone. Kill them to be guaranteed a drop of some cash and energy\n\nBandit Bosses have a chance to spawn on the death of a regular bandit. They have increased health and damage compared to regular bandits! Kill them for a chance at some really OP loot!");
        $form->addButton("Back");
        $player->sendForm($form);

    }
    public function bossesForm(Player $player): void {

        $form = new SimpleForm(function($player, $data) {
            $this->open($player);
        });
        $form->setTitle(TF::BOLD . "Bosses");
        $form->setContent(TF::BOLD . TF::GOLD . "Bosses\n\n" . TF::RESET . TF::AQUA . "Bosses are the ultimate PvE battles on Prisons!\nPrisoners can join to fight the boss in a special arena through /boss! Boss difficulty scales depending on the Type of Boss\n\n" . TF::GOLD . "Bosses:\n" . " * " . TF::WHITE . "King Slime\n" . TF::GOLD . " * " . TF::WHITE . "Prince Blaze\n" . TF::GOLD . " * " . TF::WHITE . "Guardian Golem\n" . TF::GOLD . " * " . TF::WHITE . "Verdai, The Dark Architect\n" . TF::GOLD . " * " . TF::WHITE . "???");
        $form->addButton("Back");
        $player->sendForm($form);

    }
    public function kitsForm(Player $player): void {

        $form = new SimpleForm(function($player, $data) {
            $this->open($player);
        });
        $form->setTitle(TF::BOLD . "Kits");
        $form->setContent("");
        $form->addButton("Back");
        $player->sendForm($form);

    }
    public function wormholeForm(Player $player): void {

        $form = new SimpleForm(function($player, $data) {
            $this->open($player);
        });
        $form->setTitle(TF::BOLD . "Wormhole");
        $form->setContent(TF::BOLD . TF::GOLD . "Wormhole\n\n" . TF::RESET . TF::AQUA . "The Wormhole is where you go to enchant your pickaxe, and is located at " . TF::GOLD . "/spawn" . TF::AQUA . ". Simply drop your pickaxe that is full of Energy into the wormhole and a selection of enchants will appear from the wormhole. Click on the enchant you would like.");
        $form->addButton("Back");
        $player->sendForm($form);

    }
    public function enchantsForm(Player $player): void {

        $form = new SimpleForm(function($player, $data) {
            $this->open($player);
        });
        $form->setTitle(TF::BOLD . "Enchants");
        $form->setContent("");
        $form->addButton("Back");
        $player->sendForm($form);

    }
    public function bankForm(Player $player): void {

        $form = new SimpleForm(function($player, $data) { $this->open($player); });
        $form->setTitle(TF::BOLD . "Bank");
        $form->setContent(TF::BOLD . TF::GOLD . "Bank\n\n" . TF::RESET . TF::AQUA . "The bank is here for you to invest your hard earned cash!\n\nYou can deposit " . TF::GOLD . "/bank deposit" . TF::AQUA . " up to " . TF::GOLD . "$50,000" . TF::AQUA . " and this limit will increase every time you level up!\n\nOnce you have deposited some money, it will gain " . TF::GOLD . "+3.25%%% " . TF::AQUA . "interest each time you level up!\n\n" . TF::BOLD . TF::GREEN . "BONUS\n\n" . TF::RESET . TF::AQUA . "Players who support the Emporium Bank by maxing out their prospective investments before reaching level milestones will receive a bonus reward from the Bank!\n" . TF::BOLD . TF::WHITE . "Next Reward Milestone: " . TF::RESET . TF::GREEN . "Level 45\n\n" . TF::BOLD . TF::RED . "PENALTY\n" . TF::RESET . TF::RED . "However, players who are under Level 100 will have to pay a " . TF::BOLD . TF::WHITE . "25% Withdrawal Fee" . TF::RESET . TF::RED . " for using /bb withdraw too early!\n\n" . TF::GRAY . "NOTE\n * Your money is automatically extracted when you prestige!\n * You can only gain interest the first time you hit a level every prestige. Extracting xp and re-leveling will not incur interest!");
        $form->addButton("Back");
        $player->sendForm($form);

    }
    public function tinkererForm(Player $player): void {

        $form = new SimpleForm(function($player, $data) {
            $this->open($player);
        });
        $form->setTitle(TF::BOLD . "Tinkerer");
        $form->setContent(TF::BOLD . TF::GOLD . "Tinkerer\n\n" . TF::RESET . TF::AQUA . "The tinkerer gives you the ability to recycle unwanted gear and enchants in return for more valuable items! Gear can be recycled in return for Energy");
        $form->addButton("Back");
        $player->sendForm($form);

    }
    public function miningForm(Player $player): void {

        $form = new SimpleForm(function($player, $data) {
            $this->open($player);
        });
        $form->setTitle(TF::BOLD . "Mining");
        $form->setContent(TF::BOLD . TF::GOLD . "Mining\n\n" . TF::RESET . TF::AQUA . "When you start on Prisons you will begin by mining coal at the Starter Mine! The starter mine is always located near " . TF::GOLD . "/spawn\n\n" . TF::GRAY . "Click a category to get more information.");
        $form->addButton("Ores");
        $form->addButton("Energy");
        $form->addButton("Pickaxes");
        $player->sendForm($form);

    }
    public function vaultsForm(Player $player): void {

        $form = new SimpleForm(function($player, $data) {
            $this->open($player);
        });
        $form->setTitle(TF::BOLD . "Vaults");
        $form->setContent(TF::BOLD . TF::GOLD . "Vaults\n\n" . TF::RESET . TF::GOLD . "Player Vaults " . TF::AQUA . "are your own secure storage area that only you can access! You can open them via Enderchests which are placed around " . TF::GOLD. "/spawn " . TF::AQUA . "(Ranked players have more Vaults and can access the through the command " . TF::GOLD . "/pv " . TF::AQUA . "anytime!");
        $form->addButton("Back");
        $player->sendForm($form);

    }
    public function meteorsForm(Player $player): void {

        $form = new SimpleForm(function($player, $data) {
            $this->open($player);
        });
        $form->setTitle(TF::BOLD . "Meteors");
        $form->setContent(TF::BOLD . TF::GOLD . "Meteors\n\n" . TF::RESET . TF::AQUA . "There are 4 types of Meteors on Prisons: Meteors, Meteorites, Enchant Meteorites and Contraband Meteorites\n\n" . TF::YELLOW . "Click a category for more information");
        $form->addButton("Meteors");
        $form->addButton("Meteorites");
        $form->addButton("Enchant Meteorites");
        $form->addButton("Contraband Meteorites");
        $player->sendForm($form);

    }
    public function merchantsForm(Player $player): void {

        $form = new SimpleForm(function($player, $data) {
            $this->open($player);
        });
        $form->setTitle(TF::BOLD . "Merchants");
        $form->setContent("");
        $form->addButton("Back");
        $player->sendForm($form);

    }

    # main inventory menu
    public function Inventory(Player $player): void {

        $menu = InvMenu::create(InvMenuTypeIds::TYPE_CHEST);
        $menu->setName(TF::BOLD . "Help Menu");
        $menu->setListener(InvMenu::readonly(function(DeterministicInvMenuTransaction $transaction) {

            $itemClicked = $transaction->getItemClicked();
            $itemClickedMeta = $transaction->getItemClicked()->getMeta();
            $transaction->getPlayer()->removeCurrentWindow();
            # warps
            if($itemClicked->getId() === 120) {
                $transaction->getPlayer()->removeCurrentWindow();
                $transaction->then(function (Player $player): void {
                    $this->warpsForm($player);
                });
            }
            # bandits | bosses | player levels
            if($itemClicked->getId() === 397) {
                # zombie head

                switch ($itemClickedMeta) {
                    case 2:
                        $transaction->getPlayer()->removeCurrentWindow();
                        $transaction->then(function (Player $player): void {
                            $this->banditsForm($player);
                        });
                        break;
                    case 3:
                        $transaction->getPlayer()->removeCurrentWindow();

                        $transaction->then(function (Player $player): void {
                            $playerLevel = new PlayerLevel();
                            $playerLevel->open($player);
                        });
                        break;
                    case 5:
                        $transaction->getPlayer()->removeCurrentWindow();
                        $transaction->then(function (Player $player): void {
                            $this->bossesForm($player);
                        });
                        break;
                }
            }

            switch ($itemClicked->getId()) {
                case 311: # events
                    $transaction->getPlayer()->removeCurrentWindow();
                    $transaction->then(function (Player $player): void {
                        $this->eventsForm($player);
                    });
                    break;
                case 101: # gangs
                    $transaction->getPlayer()->removeCurrentWindow();
                    $transaction->then(function (Player $player): void {
                        $this->gangsForm($player);
                    });
                    break;
                case 138: # kits
                    $transaction->getPlayer()->removeCurrentWindow();
                    $transaction->then(function (Player $player): void {
                        $this->kitsForm($player);
                    });
                    break;
                case 270: # wormhole
                    $transaction->getPlayer()->removeCurrentWindow();
                    $transaction->then(function (Player $player): void {
                        $this->wormholeForm($player);
                    });
                    break;
                case 340: # enchants
                    $transaction->getPlayer()->removeCurrentWindow();
                    $transaction->then(function (Player $player): void {
                        $this->enchantsForm($player);
                    });
                    break;
                case 384: # player prestige
                    $transaction->getPlayer()->removeCurrentWindow();
                    $transaction->then(function (Player $player): void {
                        $this->playerPrestigeForm($player);
                    });
                    break;
                case 274: # pickaxe prestige
                    $transaction->getPlayer()->removeCurrentWindow();
                    $transaction->then(function (Player $player): void {
                        $this->pickaxePrestigeForm($player);
                    });
                    break;
                case 57: # bank
                    $transaction->getPlayer()->removeCurrentWindow();
                    $transaction->then(function (Player $player): void {
                        $this->bankForm($player);
                    });
                    break;
                case 403: # tinkerer
                    $transaction->getPlayer()->removeCurrentWindow();
                    $transaction->then(function (Player $player): void {
                        $this->tinkererForm($player);
                    });
                    break;
                case 15: # mining
                    $transaction->getPlayer()->removeCurrentWindow();
                    $transaction->then(function (Player $player): void {
                        $this->miningForm($player);
                    });
                    break;
                case 130: # vaults
                    $transaction->getPlayer()->removeCurrentWindow();
                    $transaction->then(function (Player $player): void {
                        $this->vaultsForm($player);
                    });
                    break;
                case 153: # meteors
                    $transaction->getPlayer()->removeCurrentWindow();
                    $transaction->then(function (Player $player): void {
                        $this->meteorsForm($player);
                    });
                    break;
                case 264: # merchants
                    $transaction->getPlayer()->removeCurrentWindow();
                    $transaction->then(function (Player $player): void {
                        $this->merchantsForm($player);
                    });
                    break;
            }
        }));
        $inventory = $menu->getInventory();
        $inventory->setItem(0, $this->warps());
        $inventory->setItem(1, $this->playerLevels());
        $inventory->setItem(2, $this->events());
        $inventory->setItem(3, $this->gangs());
        $inventory->setItem(4, $this->Bandits());
        $inventory->setItem(5, $this->bosses());
        $inventory->setItem(6, $this->kits());
        $inventory->setItem(7, $this->wormhole());
        $inventory->setItem(8, $this->enchantments());
        $inventory->setItem(9, $this->playerPrestige());
        $inventory->setItem(10, $this->pickaxePrestige());
        $inventory->setItem(11, $this->bank());
        $inventory->setItem(12, $this->tinkerer());
        $inventory->setItem(13, $this->mining());
        $inventory->setItem(14, $this->vaults());
        $inventory->setItem(15, $this->meteors());
        $inventory->setItem(16, $this->merchants());

        $menu->send($player);
    }
    # help inventory items
    public function warps(): Item {
        $item = StringToItemParser::getInstance()->parse("end_portal_frame");
        $item->setCustomName(TF::BOLD . TF::RED . "Warps");
        $lore = [
            "§r",
            TF::GRAY . "Click for information on " . TF::BOLD . TF::RED . "Warps"
        ];
        $item->setLore($lore);
        return $item;
    }
    public function playerLevels(): Item {
        $item = StringToItemParser::getInstance()->parse("player_head");
        $item->setCustomName(TF::BOLD . TF::GOLD . "Player Levels");
        $lore = [
            "§r",
            TF::GRAY . "Click for information on " . TF::BOLD . TF::GOLD . "Player Levels"
        ];
        $item->setLore($lore);
        return $item;
    }
    public function events(): Item {
        $item = StringToItemParser::getInstance()->parse("diamond_chestplate");
        $item->setCustomName(TF::BOLD . TF::YELLOW . "Events");
        $lore = [
            "§r",
            TF::GRAY . "Click for information on " . TF::BOLD . TF::YELLOW . "Events"
        ];
        $item->setLore($lore);
        return $item;
    }
    public function gangs(): Item {
        $item = StringToItemParser::getInstance()->parse("iron_bars");
        $item->setCustomName(TF::BOLD . TF::GREEN . "Gangs");
        $lore = [
            "§r",
            TF::GRAY . "Click for information on " . TF::BOLD . TF::GREEN . "Gangs"
        ];
        $item->setLore($lore);
        return $item;
    }
    public function bandits(): Item {
        $item = StringToItemParser::getInstance()->parse("zombie_head");
        $item->setCustomName(TF::BOLD . TF::AQUA . "Bandits");
        $lore = [
            "§r",
            TF::GRAY . "Click for information on " . TF::BOLD . TF::AQUA . "Bandits"
        ];
        $item->setLore($lore);
        return $item;
    }
    public function bosses(): Item {
        $item = StringToItemParser::getInstance()->parse("dragon_head");
        $item->setCustomName(TF::BOLD . TF::BLUE . "Bosses");
        $lore = [
            "§r",
            TF::GRAY . "Click for information on " . TF::BOLD . TF::BLUE . "Bosses"
        ];
        $item->setLore($lore);
        return $item;
    }
    public function kits(): Item {
        $item = StringToItemParser::getInstance()->parse("beacon");
        $item->setCustomName(TF::BOLD . TF::DARK_PURPLE . "Kits");
        $lore = [
            "§r",
            TF::GRAY . "Click for information on " . TF::BOLD . TF::DARK_PURPLE . "Kits"
        ];
        $item->setLore($lore);
        return $item;
    }
    public function wormhole(): Item {
        $item = StringToItemParser::getInstance()->parse("wooden_pickaxe");
        $item->setCustomName(TF::BOLD . TF::LIGHT_PURPLE . "Wormhole");
        $lore = [
            "§r",
            TF::GRAY . "Click for information on " . TF::BOLD . TF::LIGHT_PURPLE . "Wormhole"
        ];
        $item->setLore($lore);
        return $item;
    }
    public function enchantments(): Item {
        $item = StringToItemParser::getInstance()->parse("book");
        $item->setCustomName(TF::BOLD . TF::RED . "Enchantments");
        $lore = [
            "§r",
            TF::GRAY . "Click for information on " . TF::BOLD . TF::RED . "Enchantments"
        ];
        $item->setLore($lore);
        return $item;
    }
    public function playerPrestige(): Item {
        $item = StringToItemParser::getInstance()->parse("experience_bottle");
        $item->setCustomName(TF::BOLD . TF::GOLD . "Player Prestige");
        $lore = [
            "§r",
            TF::GRAY . "Click for information on " . TF::BOLD . TF::GOLD . "Player Prestige"
        ];
        $item->setLore($lore);
        return $item;
    }
    public function pickaxePrestige(): Item {
        $item = StringToItemParser::getInstance()->parse("stone_pickaxe");
        $item->setCustomName(TF::BOLD . TF::YELLOW . "Pickaxe Prestige");
        $lore = [
            "§r",
            TF::GRAY . "Click for information on " . TF::BOLD . TF::YELLOW . "Pickaxe Prestige"
        ];
        $item->setLore($lore);
        return $item;
    }
    public function bank(): Item {
        $item = StringToItemParser::getInstance()->parse("diamond_block");
        $item->setCustomName(TF::BOLD . TF::AQUA . "Bank");
        $lore = [
            "§r",
            TF::GRAY . "Click for information on " . TF::BOLD . TF::AQUA . "Bank"
        ];
        $item->setLore($lore);
        return $item;
    }
    public function tinkerer(): Item {
        $item = ItemFactory::getInstance()->get(403);
        $item->setCustomName(TF::BOLD . TF::DARK_AQUA . "Tinkerer");
        $lore = [
            "§r",
            TF::GRAY . "Click for information on " . TF::BOLD . TF::DARK_AQUA . "Tinkerer"
        ];
        $item->setLore($lore);
        return $item;
    }
    public function mining(): Item {
        $item = StringToItemParser::getInstance()->parse("iron_ore");
        $item->setCustomName(TF::BOLD . TF::BLUE . "Mining");
        $lore = [
            "§r",
            TF::GRAY . "Click for information on " . TF::BOLD . TF::BLUE . "Mining"
        ];
        $item->setLore($lore);
        return $item;
    }
    public function vaults(): Item {
        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::DARK_PURPLE . "Vaults");
        $lore = [
            "§r",
            TF::GRAY . "Click for information on " . TF::BOLD . TF::DARK_PURPLE . "Vaults"
        ];
        $item->setLore($lore);
        return $item;
    }
    public function meteors(): Item {
        $item = StringToItemParser::getInstance()->parse("nether_quartz_ore");
        $item->setCustomName(TF::BOLD . TF::LIGHT_PURPLE . "Meteors");
        $lore = [
            "§r",
            TF::GRAY . "Click for information on " . TF::BOLD . TF::LIGHT_PURPLE . "Meteors"
        ];
        $item->setLore($lore);
        return $item;
    }
    public function merchants(): Item {
        $item = StringToItemParser::getInstance()->parse("diamond");
        $item->setCustomName(TF::BOLD . TF::RED . "Merchants");
        $lore = [
            "§r",
            TF::GRAY . "Click for information on " . TF::BOLD . TF::RED . "Merchants"
        ];
        $item->setLore($lore);
        return $item;
    }
}