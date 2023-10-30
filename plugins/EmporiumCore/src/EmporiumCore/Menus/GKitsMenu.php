<?php

namespace EmporiumCore\Menus;

use Emporium\Prison\library\formapi\SimpleForm;
use Emporium\Prison\Managers\misc\GlowManager;
use Emporium\Prison\Managers\misc\Translator;

use Emporium\Prison\Variables;
use EmporiumCore\EmporiumCore;

use EmporiumData\DataManager;
use EmporiumData\PermissionsManager;

use Items\GKits;

use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\DeterministicInvMenuTransaction;
use muqsit\invmenu\type\InvMenuTypeIds;

use pocketmine\item\Item;
use pocketmine\item\StringToItemParser;
use pocketmine\player\Player;
use pocketmine\scheduler\ClosureTask;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\EnderChestCloseSound;
use pocketmine\world\sound\ItemFrameAddItemSound;

class GKitsMenu extends Menu {

    private array $gkits = [
        "heroic_vulkarion", "heroic_zenith", "heroic_colossus", "heroic_warlock",
        "heroic_slaughter", "heroic_enchanter", "heroic_atheos", "heroic_iapetus",
        "heroic_broteas", "heroic_ares", "heroic_grim_reaper", "heroic_executioner",
        "blacksmith", "hero", "cyborg", "crucible", "hunter"
    ];

    public function Form(Player $player): void {

        $form = new SimpleForm(function (Player $player, $data) {
            if($data === null || $data == "exit") {
                $player->broadcastSound(new EnderChestCloseSound());
                return;
            }

            # Is kit locked check
            if($data === "locked") {
                $player->sendMessage(Variables::PREFIX . "That kit is locked");
                return;
            }

            // Cooldown check
            if (DataManager::getInstance()->getPlayerData($player->getXuid(), "cooldown.gkit_$data") > 0) {
                $player->sendMessage("That kit is on Cooldown");
                return;
            }

            $kit = $this->getKit($data);

            // Players inventory is full check
            if (!$player->getInventory()->canAddItem($kit)) {
                $player->getWorld()->dropItem($player->getPosition(), $kit);
                return;
            }

            // Give the player the kit
            $player->getInventory()->addItem($kit);
        });
        $form->setTitle("GKits");
        $form->setContent("§7Select a kit to use it.");
        foreach ($this->gkits as $gkit) {
            $buttonName = TF::BOLD . TF::DARK_GRAY . $this->format(str_replace("_", " ", $gkit));
            if(!PermissionsManager::getInstance()->checkPermission($player->getXuid(), ["emporiumcore.gkit.$gkit"])) {
                $form->addButton($buttonName . TF::EOL . TF::RED . "LOCKED", -1, "", "locked");
            } else {
                if(DataManager::getInstance()->getPlayerData($player->getXuid(), "cooldowns.gkit_$gkit") > 0) {
                    $form->addButton($buttonName . TF::EOL . TF::RED . "On Cooldown " . Translator::timeConvert(DataManager::getInstance()->getPlayerData($player->getXuid(), "cooldowns.gkit_$gkit")),-1, "", $gkit);
                } else {
                    $form->addButton($buttonName . TF::EOL . TF::GREEN . "Available",  -1, "", $gkit);
                }
            }
        }
        $form->addButton("§cEXIT", -1, "", "exit");
        $player->sendForm($form);
    }

    public function format (string $name) : string
    {
        $words = explode(" ", $name);
        foreach ($words as $index => $word) $words[$index] = ucwords($word);
        return implode(" ", $words);
    }

    public function getKit (string $name, int $amount = 1) : Item
    {
        $gkits = new GKits();
        return match ($name) {
            "heroic_vulkarion" => $gkits->heroicVulkarion($amount),
            "heroic_zenith" => $gkits->heroicZenith($amount),
            "heroic_colossus" => $gkits->heroicColossus($amount),
            "heroic_warlock" => $gkits->heroicWarlock($amount),
            "heroic_slaughter" => $gkits->heroicSlaughter($amount),
            "heroic_enchanter" => $gkits->heroicEnchanter($amount),
            "heroic_atheos" => $gkits->heroicAtheos($amount),
            "heroic_iapetus" => $gkits->heroicIapetus($amount),
            "heroic_broteas" => $gkits->heroicBroteas($amount),
            "heroic_ares" => $gkits->heroicAres($amount),
            "heroic_grim_reaper" => $gkits->heroicGrimReaper($amount),
            "heroic_executioner" => $gkits->heroicExecutioner($amount),
            "blacksmith" => $gkits->Blacksmith($amount),
            "hero" => $gkits->Hero($amount),
            "cyborg" => $gkits->Cyborg($amount),
            "crucible" => $gkits->Crucible($amount),
            "hunter" => $gkits->Hunter($amount),
        };
    }

    public function Inventory($player): void {

        # create inventory
        $menu = InvMenu::create(InvMenuTypeIds::TYPE_CHEST);
        $menu->setName("GKits");
        # menu listener
        $menu->setListener(InvMenu::readonly(function(DeterministicInvMenuTransaction $transaction) use ($player, $menu): void {

            # inventory variables
            $player = $transaction->getPlayer();
            $itemClicked = $transaction->getItemClicked();

            # heroic vulkarion
            if($itemClicked->getNamedTag()->getTag("HeroicVulkarion")) {
                if($player->getInventory()->canAddItem((new GKits)->heroicVulkarion(1))) {
                    $player->getInventory()->addItem((new GKits)->heroicVulkarion(1));
                    DataManager::getInstance()->setPlayerData($player->getXuid(),"cooldown.gkit_heroic_vulkarion", 259200); # 3 day cooldown
                    $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::DARK_RED . "Vulkarion Gkit");
                    $this->evaluateItems($menu, $player);
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Inventory Full");
                }
            } elseif($itemClicked->getNamedTag()->getTag("LockedHeroicVulkarion")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
            }
            # cooldown
            if($itemClicked->getNamedTag()->getTag("HeroicVulkarionCooldown")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                $player->sendMessage(TF::BOLD . TF::RED . "That Kit is on Cooldown");
            }

            # heroic zenith
            if($itemClicked->getNamedTag()->getTag("HeroicZenith")) {
                if($player->getInventory()->canAddItem((new GKits)->heroicZenith(1))) {
                    $player->getInventory()->addItem((new GKits)->heroicZenith(1));
                    DataManager::getInstance()->setPlayerData($player->getXuid(),"cooldown.gkit_heroic_zenith", 259200); # 3 day cooldown
                    $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::GOLD . "Zenith Gkit");
                    $this->evaluateItems($menu, $player);
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Inventory Full");
                }
            } elseif($itemClicked->getNamedTag()->getTag("LockedHeroicZenith")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
            }
            # cooldown
            if($itemClicked->getNamedTag()->getTag("HeroicZenithCooldown")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                $player->sendMessage(TF::BOLD . TF::RED . "That Kit is on Cooldown");
            }

            # heroic colossus
            if($itemClicked->getNamedTag()->getTag("HeroicColossus")) {
                if($player->getInventory()->canAddItem((new GKits)->heroicColossus(1))) {
                    $player->getInventory()->addItem((new GKits)->heroicColossus(1));
                    DataManager::getInstance()->setPlayerData($player->getXuid(),"cooldown.gkit_heroic_colossus", 259200); # 3 day cooldown
                    $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::WHITE . "Colossus Gkit");
                    $this->evaluateItems($menu, $player);
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Inventory Full");
                }
            } elseif($itemClicked->getNamedTag()->getTag("LockedHeroicColossus")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
            }
            # cooldown
            if($itemClicked->getNamedTag()->getTag("HeroicColossusCooldown")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                $player->sendMessage(TF::BOLD . TF::RED . "That Kit is on Cooldown");
            }

            # heroic warlock
            if($itemClicked->getNamedTag()->getTag("HeroicWarlock")) {
                if($player->getInventory()->canAddItem((new GKits)->heroicWarlock(1))) {
                    $player->getInventory()->addItem((new GKits)->heroicWarlock(1));
                    DataManager::getInstance()->setPlayerData($player->getXuid(),"cooldown.gkit_heroic_warlock", 259200); # 3 day cooldown
                    $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::DARK_PURPLE . "Warlock Gkit");
                    $this->evaluateItems($menu, $player);
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Inventory Full");
                }
            } elseif($itemClicked->getNamedTag()->getTag("LockedHeroicWarlock")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
            }
            # cooldown
            if($itemClicked->getNamedTag()->getTag("HeroicWarlockCooldown")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                $player->sendMessage(TF::BOLD . TF::RED . "That Kit is on Cooldown");
            }

            # heroic slaughter
            if($itemClicked->getNamedTag()->getTag("HeroicSlaughter")) {
                if($player->getInventory()->canAddItem((new GKits)->heroicSlaughter(1))) {
                    $player->getInventory()->addItem((new GKits)->heroicSlaughter(1));
                    DataManager::getInstance()->setPlayerData($player->getXuid(),"cooldown.gkit_heroic_slaughter", 259200); # 3 day cooldown
                    $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::RED . "Slaughter Gkit");
                    $this->evaluateItems($menu, $player);
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Inventory Full");
                }
            } elseif($itemClicked->getNamedTag()->getTag("LockedHeroicSlaughter")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
            }
            # cooldown
            if($itemClicked->getNamedTag()->getTag("HeroicSlaughterCooldown")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                $player->sendMessage(TF::BOLD . TF::RED . "That Kit is on Cooldown");
            }

            # heroic Enchanter
            if($itemClicked->getNamedTag()->getTag("HeroicEnchanter")) {
                if($player->getInventory()->canAddItem((new GKits)->heroicEnchanter(1))) {
                    $player->getInventory()->addItem((new GKits)->heroicEnchanter(1));
                    DataManager::getInstance()->setPlayerData($player->getXuid(),"cooldown.gkit_heroic_enchanter", 259200); # 3 day cooldown
                    $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::AQUA . "Enchanter Gkit");
                    $this->evaluateItems($menu, $player);
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Inventory Full");
                }
            } elseif($itemClicked->getNamedTag()->getTag("LockedHeroicEnchanter")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
            }
            # cooldown
            if($itemClicked->getNamedTag()->getTag("HeroicEnchanterCooldown")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                $player->sendMessage(TF::BOLD . TF::RED . "That Kit is on Cooldown");
            }

            # heroic atheos
            if($itemClicked->getNamedTag()->getTag("HeroicAtheos")) {
                if($player->getInventory()->canAddItem((new GKits)->heroicAtheos(1))) {
                    $player->getInventory()->addItem((new GKits)->heroicAtheos(1));
                    DataManager::getInstance()->setPlayerData($player->getXuid(),"cooldown.gkit_heroic_atheos", 259200); # 3 day cooldown
                    $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::GRAY . "Atheos Gkit");
                    $this->evaluateItems($menu, $player);
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Inventory Full");
                }
            } elseif($itemClicked->getNamedTag()->getTag("LockedHeroicAtheos")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
            }
            # cooldown
            if($itemClicked->getNamedTag()->getTag("HeroicAtheosCooldown")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                $player->sendMessage(TF::BOLD . TF::RED . "That Kit is on Cooldown");
            }

            # heroic iapetus
            if($itemClicked->getNamedTag()->getTag("HeroicIapetus")) {
                if($player->getInventory()->canAddItem((new GKits)->heroicIapetus(1))) {
                    $player->getInventory()->addItem((new GKits)->heroicIapetus(1));
                    DataManager::getInstance()->setPlayerData($player->getXuid(),"cooldown.gkit_heroic_iapetus", 259200); # 3 day cooldown
                    $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::BLUE . "Iapetus Gkit");
                    $this->evaluateItems($menu, $player);
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Inventory Full");
                }
            } elseif($itemClicked->getNamedTag()->getTag("LockedHeroicIapetus")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
            }
            # cooldown
            if($itemClicked->getNamedTag()->getTag("HeroicIapetusCooldown")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                $player->sendMessage(TF::BOLD . TF::RED . "That Kit is on Cooldown");
            }

            # heroic broteas
            if($itemClicked->getNamedTag()->getTag("HeroicBroteas")) {
                if($player->getInventory()->canAddItem((new GKits)->heroicBroteas(1))) {
                    $player->getInventory()->addItem((new GKits)->heroicBroteas(1));
                    DataManager::getInstance()->setPlayerData($player->getXuid(),"cooldown.gkit_heroic_broteas", 259200); # 3 day cooldown
                    $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::GREEN . "Broteas Gkit");
                    $this->evaluateItems($menu, $player);
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Inventory Full");
                }
            } elseif($itemClicked->getNamedTag()->getTag("LockedHeroicBroteas")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
            }
            # cooldown
            if($itemClicked->getNamedTag()->getTag("HeroicBroteasCooldown")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                $player->sendMessage(TF::BOLD . TF::RED . "That Kit is on Cooldown");
            }

            # heroic ares
            if($itemClicked->getNamedTag()->getTag("HeroicAres")) {
                if($player->getInventory()->canAddItem((new GKits)->heroicAres(1))) {
                    $player->getInventory()->addItem((new GKits)->heroicAres(1));
                    DataManager::getInstance()->setPlayerData($player->getXuid(),"cooldown.gkit_heroic_ares", 259200); # 3 day cooldown
                    $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::GOLD . "Ares Gkit");
                    $this->evaluateItems($menu, $player);
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Inventory Full");
                }
            } elseif($itemClicked->getNamedTag()->getTag("LockedHeroicAres")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
            }
            # cooldown
            if($itemClicked->getNamedTag()->getTag("HeroicAresCooldown")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                $player->sendMessage(TF::BOLD . TF::RED . "That Kit is on Cooldown");
            }

            # heroic grim reaper
            if($itemClicked->getNamedTag()->getTag("HeroicGrimReaper")) {
                if($player->getInventory()->canAddItem((new GKits)->heroicGrimReaper(1))) {
                    $player->getInventory()->addItem((new GKits)->heroicGrimReaper(1));
                    DataManager::getInstance()->setPlayerData($player->getXuid(),"cooldown.gkit_heroic_grim_reaper", 259200); # 3 day cooldown
                    $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::RED . "Grim Reaper Gkit");
                    $this->evaluateItems($menu, $player);
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Inventory Full");
                }
            } elseif($itemClicked->getNamedTag()->getTag("LockedHeroicGrimReaper")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
            }
            # cooldown
            if($itemClicked->getNamedTag()->getTag("HeroicGrimReaperCooldown")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                $player->sendMessage(TF::BOLD . TF::RED . "That Kit is on Cooldown");
            }

            # heroic executioner
            if($itemClicked->getNamedTag()->getTag("HeroicExecutioner")) {
                if($player->getInventory()->canAddItem((new GKits)->heroicExecutioner(1))) {
                    $player->getInventory()->addItem((new GKits)->heroicExecutioner(1));
                    DataManager::getInstance()->setPlayerData($player->getXuid(),"cooldown.gkit_heroic_executioner", 259200); # 3 day cooldown
                    $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::DARK_RED . "Executioner Gkit");
                    $this->evaluateItems($menu, $player);
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Inventory Full");
                }
            } elseif($itemClicked->getNamedTag()->getTag("LockedHeroicExecutioner")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
            }
            # cooldown
            if($itemClicked->getNamedTag()->getTag("HeroicExecutionerCooldown")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                $player->sendMessage(TF::BOLD . TF::RED . "That Kit is on Cooldown");
            }

            # blacksmith
            if($itemClicked->getNamedTag()->getTag("Blacksmith")) {
                if($player->getInventory()->canAddItem((new GKits)->Blacksmith(1))) {
                    $player->getInventory()->addItem((new GKits)->Blacksmith(1));
                    DataManager::getInstance()->setPlayerData($player->getXuid(),"cooldown.gkit_blacksmith", 259200); # 3 day cooldown
                    $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::DARK_GRAY . "Blacksmith Gkit");
                    $this->evaluateItems($menu, $player);
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Inventory Full");
                }
            } elseif($itemClicked->getNamedTag()->getTag("LockedBlacksmith")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
            }
            # cooldown
            if($itemClicked->getNamedTag()->getTag("BlacksmithCooldown")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                $player->sendMessage(TF::BOLD . TF::RED . "That Kit is on Cooldown");
            }

            # hero
            if($itemClicked->getNamedTag()->getTag("Hero")) {
                if($player->getInventory()->canAddItem((new GKits)->Hero(1))) {
                    $player->getInventory()->addItem((new GKits)->Hero(1));
                    DataManager::getInstance()->setPlayerData($player->getXuid(),"cooldown.gkit_hero", 259200); # 3 day cooldown
                    $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::WHITE . "Hero Gkit");
                    $this->evaluateItems($menu, $player);
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Inventory Full");
                }
            } elseif($itemClicked->getNamedTag()->getTag("LockedHero")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
            }
            # cooldown
            if($itemClicked->getNamedTag()->getTag("HeroCooldown")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                $player->sendMessage(TF::BOLD . TF::RED . "That Kit is on Cooldown");
            }

            # cyborg
            if($itemClicked->getNamedTag()->getTag("Cyborg")) {
                if($player->getInventory()->canAddItem((new GKits)->Cyborg(1))) {
                    $player->getInventory()->addItem((new GKits)->Cyborg(1));
                    DataManager::getInstance()->setPlayerData($player->getXuid(),"cooldown.gkit_cyborg", 259200); # 3 day cooldown
                    $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::DARK_AQUA . "Cyborg Gkit");
                    $this->evaluateItems($menu, $player);
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Inventory Full");
                }
            } elseif($itemClicked->getNamedTag()->getTag("LockedCyborg")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
            }
            # cooldown
            if($itemClicked->getNamedTag()->getTag("CyborgCooldown")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                $player->sendMessage(TF::BOLD . TF::RED . "That Kit is on Cooldown");
            }

            # crucible
            if($itemClicked->getNamedTag()->getTag("Crucible")) {
                if($player->getInventory()->canAddItem((new GKits)->Crucible(1))) {
                    $player->getInventory()->addItem((new GKits)->Crucible(1));
                    DataManager::getInstance()->setPlayerData($player->getXuid(),"cooldown.gkit_crucible", 259200); # 3 day cooldown
                    $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::YELLOW . "Crucible Gkit");
                    $this->evaluateItems($menu, $player);
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Inventory Full");
                }
            } elseif($itemClicked->getNamedTag()->getTag("LockedCrucible")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
            }
            # cooldown
            if($itemClicked->getNamedTag()->getTag("CrucibleCooldown")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                $player->sendMessage(TF::BOLD . TF::RED . "That Kit is on Cooldown");
            }

            # hunter
            if($itemClicked->getNamedTag()->getTag("Hunter")) {
                if($player->getInventory()->canAddItem((new GKits)->Hunter(1))) {
                    $player->getInventory()->addItem((new GKits)->Hunter(1));
                    DataManager::getInstance()->setPlayerData($player->getXuid(),"cooldown.gkit_hunter", 259200); # 3 day cooldown
                    $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::AQUA . "Hunter Gkit");
                    $this->evaluateItems($menu, $player);
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Inventory Full");
                }
            } elseif($itemClicked->getNamedTag()->getTag("LockedHunter")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
            }
            # cooldown
            if($itemClicked->getNamedTag()->getTag("HunterCooldown")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                $player->sendMessage(TF::BOLD . TF::RED . "That Kit is on Cooldown");
            }

        }));

        $this->evaluateItems($menu, $player);
        # send inventory
        $menu->send($player);

        $task = new ClosureTask(function () use ($menu, $player) {
            $this->evaluateItems($menu, $player);
        });

        $menu->setInventoryCloseListener(function () use ($task) {
            $task->getHandler()->cancel();
        });

        EmporiumCore::getInstance()->getScheduler()->scheduleRepeatingTask($task, 4);
    }

    public function evaluateItems (InvMenu $menu, Player $player) : void
    {
        # inventory
        $inventory = $menu->getInventory();
        # add items
        $inventory->setItem(0, $this->heroicVulkarionItem($player));
        $inventory->setItem(1, $this->heroicZenithItem($player));
        $inventory->setItem(2, $this->heroicColossusItem($player));
        $inventory->setItem(3, $this->heroicWarlockItem($player));
        $inventory->setItem(4, $this->HeroicSlaughterItem($player));
        $inventory->setItem(5, $this->heroicEnchanterItem($player));
        $inventory->setItem(6, $this->heroicAtheosItem($player));
        $inventory->setItem(7, $this->heroicIapetusItem($player));
        $inventory->setItem(8, $this->heroicBroteasItem($player));
        $inventory->setItem(9, $this->heroicAresItem($player));
        $inventory->setItem(10, $this->heroicGrimReaperItem($player));
        $inventory->setItem(11, $this->heroicExecutionerItem($player));
        $inventory->setItem(12, $this->blacksmithItem($player));
        $inventory->setItem(13, $this->heroItem($player));
        $inventory->setItem(14, $this->CyborgItem($player));
        $inventory->setItem(15, $this->crucibleItem($player));
        $inventory->setItem(16, $this->hunterItem($player));
    }

    # heroic vulkarion
    public function heroicVulkarionItem($player): Item {

        $heroicVulkarionCooldown = (int) DataManager::getInstance()->getPlayerData($player->getXuid(),"cooldown.gkit_heroic_vulkarion");
        $permission = PermissionsManager::getInstance()->checkPermission($player->getXuid(), ["emporiumcore.gkit.heroicvulkarion"]);

        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::DARK_RED . "Heroic Vulkarion " . TF::RESET . TF::DARK_RED . "GKit");

        if($permission) {
            if($heroicVulkarionCooldown > 0) {
                # kit on cooldown
                $lore = [
                    "§r",
                    TF::BOLD . TF::RED . "ON COOLDOWN " . TF::WHITE . Translator::timeConvert($heroicVulkarionCooldown)
                ];
                $item->getNamedTag()->setString("HeroicVulkarionCooldown", 1);
            } else {
                # kit available
                $lore = [
                    "§r",
                    TF::BOLD . TF::GREEN . "AVAILABLE NOW " . TF::GRAY . "(Click)"
                ];
                $item->getNamedTag()->setString("HeroicVulkarion", 1);
            }
        } else {
            # kit locked
            $lore = [
                "§r",
                TF::BOLD . TF::RED . "LOCKED "
            ];
            $item->getNamedTag()->setString("LockedHeroicVulkarion", 1);
        }
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    # heroic zenith
    public function heroicZenithItem($player): Item {

        $heroicZenithCooldown = (int) DataManager::getInstance()->getPlayerData($player->getXuid(),"cooldown.gkit_heroic_zenith");
        $permission = PermissionsManager::getInstance()->checkPermission($player->getXuid(), ["emporiumcore.gkit.heroiczenith"]);

        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::GOLD . "Heroic Zenith " . TF::RESET . TF::GOLD . "GKit");
        if($permission) {
            if($heroicZenithCooldown > 0) {
                # kit on cooldown
                $lore = [
                    "§r",
                    TF::BOLD . TF::RED . "ON COOLDOWN " . TF::WHITE . Translator::timeConvert($heroicZenithCooldown)
                ];
                $item->getNamedTag()->setString("HeroicZenithCooldown", 1);
            } else {
                # kit available
                $lore = [
                    "§r",
                    TF::BOLD . TF::GREEN . "AVAILABLE NOW " . TF::GRAY . "(Click)"
                ];
                $item->getNamedTag()->setString("HeroicZenith", 1);
            }
        } else {
            # kit locked
            $lore = [
                "§r",
                TF::BOLD . TF::RED . "LOCKED "
            ];
            $item->getNamedTag()->setString("LockedHeroicZenith", 1);
        }
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    # heroic colossus
    public function heroicColossusItem($player): Item {

        $heroicColossusCooldown = (int) DataManager::getInstance()->getPlayerData($player->getXuid(),"cooldown.gkit_heroic_colossus");
        $permission = PermissionsManager::getInstance()->checkPermission($player->getXuid(), ["emporiumcore.gkit.heroiccolossus"]);

        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::WHITE . "Heroic Colossus " . TF::RESET . TF::WHITE . "GKit");

        if($permission) {
            if($heroicColossusCooldown > 0) {
                # kit on cooldown
                $lore = [
                    "§r",
                    TF::BOLD . TF::RED . "ON COOLDOWN " . TF::WHITE . Translator::timeConvert($heroicColossusCooldown)
                ];
                $item->getNamedTag()->setString("HeroicColossusCooldown", 1);
            } else {
                # kit available
                $lore = [
                    "§r",
                    TF::BOLD . TF::GREEN . "AVAILABLE NOW " . TF::GRAY . "(Click)"
                ];
                $item->getNamedTag()->setString("HeroicColossus", 1);
            }
        } else {
            # kit locked
            $lore = [
                "§r",
                TF::BOLD . TF::RED . "LOCKED "
            ];
            $item->getNamedTag()->setString("LockedHeroicColossus", 1);
        }
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    # heroic warlock
    public function heroicWarlockItem($player): Item {

        $heroicWarlockCooldown = (int) DataManager::getInstance()->getPlayerData($player->getXuid(),"cooldown.gkit_heroic_warlock");
        $permission = PermissionsManager::getInstance()->checkPermission($player->getXuid(), ["emporiumcore.gkit.heroicwarlock"]);

        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::DARK_PURPLE . "Heroic Warlock " . TF::RESET . TF::DARK_PURPLE . "GKit");
        if($permission) {
            if($heroicWarlockCooldown > 0) {
                # kit on cooldown
                $lore = [
                    "§r",
                    TF::BOLD . TF::RED . "ON COOLDOWN " . TF::WHITE . Translator::timeConvert($heroicWarlockCooldown)
                ];
                $item->getNamedTag()->setString("HeroicWarlockCooldown", 1);
            } else {
                # kit available
                $lore = [
                    "§r",
                    TF::BOLD . TF::GREEN . "AVAILABLE NOW " . TF::GRAY . "(Click)"
                ];
                $item->getNamedTag()->setString("HeroicWarlock", 1);
            }
        } else {
            # kit locked
            $lore = [
                "§r",
                TF::BOLD . TF::RED . "LOCKED "
            ];
            $item->getNamedTag()->setString("LockedHeroicWarlock", 1);
        }
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    # heroic slaughter
    public function heroicSlaughterItem($player): Item {

        $heroicSlaughterCooldown = (int) DataManager::getInstance()->getPlayerData($player->getXuid(),"cooldown.gkit_heroic_slaughter");
        $permission = PermissionsManager::getInstance()->checkPermission($player->getXuid(), ["emporiumcore.gkit.heroicslaughter"]);

        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::RED . "Heroic Slaughter " . TF::RESET . TF::RED . "GKit");

        if($permission) {
            if($heroicSlaughterCooldown > 0) {
                # kit on cooldown
                $lore = [
                    "§r",
                    TF::BOLD . TF::RED . "ON COOLDOWN " . TF::WHITE . Translator::timeConvert($heroicSlaughterCooldown)
                ];
                $item->getNamedTag()->setString("HeroicSlaughterCooldown", 1);
            } else {
                # kit available
                $lore = [
                    "§r",
                    TF::BOLD . TF::GREEN . "AVAILABLE NOW " . TF::GRAY . "(Click)"
                ];
                $item->getNamedTag()->setString("HeroicSlaughter", 1);
            }
        } else {
            # kit locked
            $lore = [
                "§r",
                TF::BOLD . TF::RED . "LOCKED "
            ];
            $item->getNamedTag()->setString("LockedHeroicSlaughter", 1);
        }
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    # heroic enchanter
    public function heroicEnchanterItem($player): Item {

        $heroicEnchanterCooldown = (int) DataManager::getInstance()->getPlayerData($player->getXuid(),"cooldown.gkit_heroic_enchanter");
        $permission = PermissionsManager::getInstance()->checkPermission($player->getXuid(), ["emporiumcore.gkit.heroicenchanter"]);

        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::AQUA . "Heroic Enchanter " . TF::RESET . TF::AQUA . "GKit");

        if($permission) {
            if($heroicEnchanterCooldown > 0) {
                # kit on cooldown
                $lore = [
                    "§r",
                    TF::BOLD . TF::RED . "ON COOLDOWN " . TF::WHITE . Translator::timeConvert($heroicEnchanterCooldown)
                ];
                $item->getNamedTag()->setString("HeroicEnchanterCooldown", 1);
            } else {
                # kit available
                $lore = [
                    "§r",
                    TF::BOLD . TF::GREEN . "AVAILABLE NOW " . TF::GRAY . "(Click)"
                ];
                $item->getNamedTag()->setString("HeroicEnchanter", 1);
            }
        } else {
            # kit locked
            $lore = [
                "§r",
                TF::BOLD . TF::RED . "LOCKED "
            ];
            $item->getNamedTag()->setString("LockedHeroicEnchanter", 1);
        }
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    # heroic atheos
    public function heroicAtheosItem($player): Item {

        $heroicAtheosCooldown = (int) DataManager::getInstance()->getPlayerData($player->getXuid(),"cooldown.gkit_heroic_atheos");
        $permission = PermissionsManager::getInstance()->checkPermission($player->getXuid(), ["emporiumcore.gkit.heroicatheos"]);

        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::GRAY . "Heroic Atheos " . TF::RESET . TF::GRAY . "GKit");

        if($permission) {
            if($heroicAtheosCooldown > 0) {
                # kit on cooldown
                $lore = [
                    "§r",
                    TF::BOLD . TF::RED . "ON COOLDOWN " . TF::WHITE . Translator::timeConvert($heroicAtheosCooldown)
                ];
                $item->getNamedTag()->setString("HeroicAtheosCooldown", 1);
            } else {
                # kit available
                $lore = [
                    "§r",
                    TF::BOLD . TF::GREEN . "AVAILABLE NOW " . TF::GRAY . "(Click)"
                ];
                $item->getNamedTag()->setString("HeroicAtheos", 1);
            }
        } else {
            # kit locked
            $lore = [
                "§r",
                TF::BOLD . TF::RED . "LOCKED "
            ];
            $item->getNamedTag()->setString("LockedHeroicAtheos", 1);
        }
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    # heroic iapetus
    public function heroicIapetusItem($player): Item {

        $heroicIapetusCooldown = (int) DataManager::getInstance()->getPlayerData($player->getXuid(),"cooldown.gkit_heroic_iapetus");
        $permission = PermissionsManager::getInstance()->checkPermission($player->getXuid(), ["emporiumcore.gkit.heroiciapetus"]);

        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::BLUE . "Heroic Iapetus " . TF::RESET . TF::BLUE . "GKit");

        if($permission) {
            if($heroicIapetusCooldown > 0) {
                # kit on cooldown
                $lore = [
                    "§r",
                    TF::BOLD . TF::RED . "ON COOLDOWN " . TF::WHITE . Translator::timeConvert($heroicIapetusCooldown)
                ];
                $item->getNamedTag()->setString("HeroicIapetusCooldown", 1);
            } else {
                # kit available
                $lore = [
                    "§r",
                    TF::BOLD . TF::GREEN . "AVAILABLE NOW " . TF::GRAY . "(Click)"
                ];
                $item->getNamedTag()->setString("HeroicIapetus", 1);
            }
        } else {
            # kit locked
            $lore = [
                "§r",
                TF::BOLD . TF::RED . "LOCKED "
            ];
            $item->getNamedTag()->setString("LockedHeroicIapetus", 1);
        }
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    # heroic broteas
    public function heroicBroteasItem($player): Item {

        $heroicBroteasCooldown = (int) DataManager::getInstance()->getPlayerData($player->getXuid(),"cooldown.gkit_heroic_broteas");
        $permission = PermissionsManager::getInstance()->checkPermission($player->getXuid(), ["emporiumcore.gkit.heroicbroteas"]);

        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::GREEN . "Heroic Broteas " . TF::RESET . TF::GREEN . "GKit");

        if($permission) {
            if($heroicBroteasCooldown > 0) {
                # kit on cooldown
                $lore = [
                    "§r",
                    TF::BOLD . TF::RED . "ON COOLDOWN " . TF::WHITE . Translator::timeConvert($heroicBroteasCooldown)
                ];
                $item->getNamedTag()->setString("HeroicBroteasCooldown", 1);
            } else {
                # kit available
                $lore = [
                    "§r",
                    TF::BOLD . TF::GREEN . "AVAILABLE NOW " . TF::GRAY . "(Click)"
                ];
                $item->getNamedTag()->setString("HeroicBroteas", 1);
            }
        } else {
            # kit locked
            $lore = [
                "§r",
                TF::BOLD . TF::RED . "LOCKED "
            ];
            $item->getNamedTag()->setString("LockedHeroicBroteas", 1);
        }
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    # heroic ares
    public function heroicAresItem($player): Item {

        $heroicAresCooldown = (int) DataManager::getInstance()->getPlayerData($player->getXuid(),"cooldown.gkit_heroic_ares");
        $permission = PermissionsManager::getInstance()->checkPermission($player->getXuid(), ["emporiumcore.gkit.heroicares"]);

        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::GOLD . "Heroic Ares " . TF::RESET . TF::GOLD . "GKit");

        if($permission) {
            if($heroicAresCooldown > 0) {
                # kit on cooldown
                $lore = [
                    "§r",
                    TF::BOLD . TF::RED . "ON COOLDOWN " . TF::WHITE . Translator::timeConvert($heroicAresCooldown)
                ];
                $item->getNamedTag()->setString("HeroicAresCooldown", 1);
            } else {
                # kit available
                $lore = [
                    "§r",
                    TF::BOLD . TF::GREEN . "AVAILABLE NOW " . TF::GRAY . "(Click)"
                ];
                $item->getNamedTag()->setString("HeroicAres", 1);
            }
        } else {
            # kit locked
            $lore = [
                "§r",
                TF::BOLD . TF::RED . "LOCKED "
            ];
            $item->getNamedTag()->setString("LockedHeroicAres", 1);
        }
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    # heroic grim reaper
    public function heroicGrimReaperItem($player): Item {

        $heroicGrimReaperCooldown = (int) DataManager::getInstance()->getPlayerData($player->getXuid(),"cooldown.gkit_heroic_grim_reaper");
        $permission = PermissionsManager::getInstance()->checkPermission($player->getXuid(), ["emporiumcore.gkit.heroicgrimreaper"]);

        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::RED . "Heroic Grim Reaper " . TF::RESET . TF::RED . "GKit");

        if($permission) {
            if($heroicGrimReaperCooldown > 0) {
                # kit on cooldown
                $lore = [
                    "§r",
                    TF::BOLD . TF::RED . "ON COOLDOWN " . TF::WHITE . Translator::timeConvert($heroicGrimReaperCooldown)
                ];
                $item->getNamedTag()->setString("HeroicGrimReaperCooldown", 1);
            } else {
                # kit available
                $lore = [
                    "§r",
                    TF::BOLD . TF::GREEN . "AVAILABLE NOW " . TF::GRAY . "(Click)"
                ];
                $item->getNamedTag()->setString("HeroicGrimReaper", 1);
            }
        } else {
            # kit locked
            $lore = [
                "§r",
                TF::BOLD . TF::RED . "LOCKED "
            ];
            $item->getNamedTag()->setString("LockedHeroicGrimReaper", 1);
        }
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    # heroic executioner
    public function heroicExecutionerItem($player): Item {

        $heroicExecutionerCooldown = (int) DataManager::getInstance()->getPlayerData($player->getXuid(),"cooldown.gkit_heroic_executioner");
        $permission = PermissionsManager::getInstance()->checkPermission($player->getXuid(), ["emporiumcore.gkit.heroicexecutioner"]);

        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::DARK_RED . "Heroic Executioner " . TF::RESET . TF::DARK_RED . "GKit");

        if($permission) {
            if($heroicExecutionerCooldown > 0) {
                # kit on cooldown
                $lore = [
                    "§r",
                    TF::BOLD . TF::RED . "ON COOLDOWN " . TF::WHITE . Translator::timeConvert($heroicExecutionerCooldown)
                ];
                $item->getNamedTag()->setString("HeroicExecutionerCooldown", 1);
            } else {
                # kit available
                $lore = [
                    "§r",
                    TF::BOLD . TF::GREEN . "AVAILABLE NOW " . TF::GRAY . "(Click)"
                ];
                $item->getNamedTag()->setString("HeroicExecutioner", 1);
            }
        } else {
            # kit locked
            $lore = [
                "§r",
                TF::BOLD . TF::RED . "LOCKED "
            ];
            $item->getNamedTag()->setString("LockedHeroicExecutioner", 1);
        }
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    # blacksmith
    public function blacksmithItem($player): Item {

        $blacksmithCooldown = (int) DataManager::getInstance()->getPlayerData($player->getXuid(),"cooldown.gkit_blacksmith");
        $permission = PermissionsManager::getInstance()->checkPermission($player->getXuid(), ["emporiumcore.gkit.blacksmith"]);

        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::DARK_GRAY . "Blacksmith " . TF::RESET . TF::DARK_GRAY . "GKit");

        if($permission) {
            if($blacksmithCooldown > 0) {
                # kit on cooldown
                $lore = [
                    "§r",
                    TF::BOLD . TF::RED . "ON COOLDOWN " . TF::WHITE . Translator::timeConvert($blacksmithCooldown)
                ];
                $item->getNamedTag()->setString("BlacksmithCooldown", 1);
            } else {
                # kit available
                $lore = [
                    "§r",
                    TF::BOLD . TF::GREEN . "AVAILABLE NOW " . TF::GRAY . "(Click)"
                ];
                $item->getNamedTag()->setString("Blacksmith", 1);
            }
        } else {
            # kit locked
            $lore = [
                "§r",
                TF::BOLD . TF::RED . "LOCKED "
            ];
            $item->getNamedTag()->setString("LockedBlacksmith", 1);
        }
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    # hero
    public function heroItem($player): Item {

        $heroCooldown = (int) DataManager::getInstance()->getPlayerData($player->getXuid(),"cooldown.gkit_hero");
        $permission = PermissionsManager::getInstance()->checkPermission($player->getXuid(), ["emporiumcore.gkit.hero"]);

        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::WHITE . "Hero " . TF::RESET . TF::WHITE . "GKit");

        if($permission) {
            if($heroCooldown > 0) {
                # kit on cooldown
                $lore = [
                    "§r",
                    TF::BOLD . TF::RED . "ON COOLDOWN " . TF::WHITE . Translator::timeConvert($heroCooldown)
                ];
                $item->getNamedTag()->setString("HeroCooldown", 1);
            } else {
                # kit available
                $lore = [
                    "§r",
                    TF::BOLD . TF::GREEN . "AVAILABLE NOW " . TF::GRAY . "(Click)"
                ];
                $item->getNamedTag()->setString("Hero", 1);
            }
        } else {
            # kit locked
            $lore = [
                "§r",
                TF::BOLD . TF::RED . "LOCKED "
            ];
            $item->getNamedTag()->setString("LockedHero", 1);
        }
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    # cyborg
    public function cyborgItem($player): Item {

        $cyborgCooldown = (int) DataManager::getInstance()->getPlayerData($player->getXuid(),"cooldown.gkit_cyborg");
        $permission = PermissionsManager::getInstance()->checkPermission($player->getXuid(), ["emporiumcore.gkit.hero"]);

        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::DARK_AQUA . "Cyborg " . TF::RESET . TF::DARK_AQUA . "GKit");

        if($permission) {
            if($cyborgCooldown > 0) {
                # kit on cooldown
                $lore = [
                    "§r",
                    TF::BOLD . TF::RED . "ON COOLDOWN " . TF::WHITE . Translator::timeConvert($cyborgCooldown)
                ];
                $item->getNamedTag()->setString("CyborgCooldown", 1);
            } else {
                # kit available
                $lore = [
                    "§r",
                    TF::BOLD . TF::GREEN . "AVAILABLE NOW " . TF::GRAY . "(Click)"
                ];
                $item->getNamedTag()->setString("Cyborg", 1);
            }
        } else {
            # kit locked
            $lore = [
                "§r",
                TF::BOLD . TF::RED . "LOCKED "
            ];
            $item->getNamedTag()->setString("LockedCyborg", 1);
        }
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    # crucible
    public function crucibleItem($player): Item {

        $crucibleCooldown = (int) DataManager::getInstance()->getPlayerData($player->getXuid(),"cooldown.gkit_crucible");
        $permission = PermissionsManager::getInstance()->checkPermission($player->getXuid(), ["emporiumcore.gkit.crucible"]);

        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::YELLOW . "Crucible " . TF::RESET . TF::YELLOW . "GKit");

        if($permission) {
            if($crucibleCooldown > 0) {
                # kit on cooldown
                $lore = [
                    "§r",
                    TF::BOLD . TF::RED . "ON COOLDOWN " . TF::WHITE . Translator::timeConvert($crucibleCooldown)
                ];
                $item->getNamedTag()->setString("CrucibleCooldown", 1);
            } else {
                # kit available
                $lore = [
                    "§r",
                    TF::BOLD . TF::GREEN . "AVAILABLE NOW " . TF::GRAY . "(Click)"
                ];
                $item->getNamedTag()->setString("Crucible", 1);
            }
        } else {
            # kit locked
            $lore = [
                "§r",
                TF::BOLD . TF::RED . "LOCKED "
            ];
            $item->getNamedTag()->setString("LockedCrucible", 1);
        }
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    # hunter
    public function hunterItem($player): Item {

        $hunterCooldown = (int) DataManager::getInstance()->getPlayerData($player->getXuid(),"cooldown.gkit_hunter");
        $permission = PermissionsManager::getInstance()->checkPermission($player->getXuid(), ["emporiumcore.gkit.hunter"]);

        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::AQUA . "Hunter " . TF::RESET . TF::AQUA . "GKit");

        if($permission) {
            if($hunterCooldown > 0) {
                # kit on cooldown
                $lore = [
                    "§r",
                    TF::BOLD . TF::RED . "ON COOLDOWN " . TF::WHITE . Translator::timeConvert($hunterCooldown)
                ];
                $item->getNamedTag()->setString("HunterCooldown", 1);
            } else {
                # kit available
                $lore = [
                    "§r",
                    TF::BOLD . TF::GREEN . "AVAILABLE NOW " . TF::GRAY . "(Click)"
                ];
                $item->getNamedTag()->setString("Hunter", 1);
            }
        } else {
            # kit locked
            $lore = [
                "§r",
                TF::BOLD . TF::RED . "LOCKED "
            ];
            $item->getNamedTag()->setString("LockedHunter", 1);
        }
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }
}