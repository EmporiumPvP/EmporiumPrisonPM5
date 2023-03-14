<?php

namespace EmporiumCore\Listeners\Items;

use Emporium\Prison\items\Scrolls;

use Items\GKitsItems\Blacksmith;
use Items\GKitsItems\Crucible;
use Items\GKitsItems\Cyborg;
use Items\GKitsItems\Hero;
use Items\GKitsItems\HeroicAres;
use Items\GKitsItems\HeroicAtheos;
use Items\GKitsItems\HeroicBroteas;
use Items\GKitsItems\HeroicColossus;
use Items\GKitsItems\HeroicEnchanter;
use Items\GKitsItems\HeroicExecutioner;
use Items\GKitsItems\HeroicGrimReaper;
use Items\GKitsItems\HeroicIapetus;
use Items\GKitsItems\HeroicSlaughter;
use Items\GKitsItems\HeroicVulkarion;
use Items\GKitsItems\HeroicWarlock;
use Items\GKitsItems\HeroicZenith;
use Items\GKitsItems\Hunter;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerItemUseEvent;

use pocketmine\utils\TextFormat as TF;

use pocketmine\world\sound\BlazeShootSound;

class GKitListener implements Listener {

    public function onClaimKitAir(PlayerItemUseEvent $event) {

        $player = $event->getPlayer();
        $item = $event->getItem();
        $count = $item->getCount();

        if($item->getNamedTag()->getTag("HeroicVulkarionGKit") !== null) {
            $item = $player->getInventory()->getItemInHand()->setCount($count - 1);
            $player->getInventory()->setItemInHand($item);
            $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::DARK_RED . "Heroic Vulkarion GKit");
            if($player->getInventory()->canAddItem((new HeroicVulkarion())->helmet()) && $player->getInventory()->canAddItem((new HeroicVulkarion())->chestplate()) && $player->getInventory()->canAddItem((new HeroicVulkarion())->leggings()) && $player->getInventory()->canAddItem((new HeroicVulkarion())->boots()) && $player->getInventory()->canAddItem((new HeroicVulkarion())->sword())) {
                $player->getInventory()->addItem((new HeroicVulkarion())->helmet());
                $player->getInventory()->addItem((new HeroicVulkarion())->chestplate());
                $player->getInventory()->addItem((new HeroicVulkarion())->leggings());
                $player->getInventory()->addItem((new HeroicVulkarion())->boots());
                $player->getInventory()->addItem((new HeroicVulkarion())->sword());
            } else {
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicVulkarion())->helmet());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicVulkarion())->chestplate());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicVulkarion())->leggings());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicVulkarion())->boots());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicVulkarion())->sword());
            }
            $player->broadcastSound(new BlazeShootSound(), [$player]);
        }

        if($item->getNamedTag()->getTag("HeroicZenithGKit") !== null) {
            $item = $player->getInventory()->getItemInHand()->setCount($count - 1);
            $player->getInventory()->setItemInHand($item);
            $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::GOLD . " Heroic Zenith GKit");
            if($player->getInventory()->canAddItem((new HeroicZenith())->leggings()) && $player->getInventory()->canAddItem((new HeroicZenith())->pickaxe($player))) {
                $player->getInventory()->addItem((new HeroicZenith())->leggings());
                $player->getInventory()->addItem((new HeroicZenith())->pickaxe($player));
            } else {
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicZenith())->leggings());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicZenith())->pickaxe($player));
            }
            $player->broadcastSound(new BlazeShootSound(), [$player]);
        }

        if($item->getNamedTag()->getTag("HeroicColossusGKit") !== null) {
            $item = $player->getInventory()->getItemInHand()->setCount($count - 1);
            $player->getInventory()->setItemInHand($item);
            $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::WHITE . " Heroic Colossus GKit");
            if($player->getInventory()->canAddItem((new HeroicColossus())->boots()) && $player->getInventory()->canAddItem((new HeroicColossus())->sword())) {
                $player->getInventory()->addItem((new HeroicColossus())->boots());
                $player->getInventory()->addItem((new HeroicColossus())->sword());
            } else {
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicColossus())->boots());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicColossus())->sword());
            }
            $player->broadcastSound(new BlazeShootSound(), [$player]);
        }

        if($item->getNamedTag()->getTag("HeroicWarlockGKit") !== null) {
            $item = $player->getInventory()->getItemInHand()->setCount($count - 1);
            $player->getInventory()->setItemInHand($item);
            $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::DARK_PURPLE . " Heroic Warlock GKit");
            if($player->getInventory()->canAddItem((new HeroicWarlock())->energy()) && $player->getInventory()->canAddItem((new HeroicWarlock())->mysteryEliteEnchants()) && $player->getInventory()->canAddItem((new HeroicWarlock())->mysteryUltimateEnchants()) && $player->getInventory()->canAddItem((new HeroicWarlock())->mysteryLegendaryEnchants()) && $player->getInventory()->canAddItem((new HeroicWarlock())->mysteryGodlyEnchants()) && $player->getInventory()->canAddItem((new HeroicWarlock())->mysteryHeroicEnchants())) {
                $player->getInventory()->addItem((new HeroicWarlock())->energy());
                $player->getInventory()->addItem((new HeroicWarlock())->mysteryEliteEnchants());
                $player->getInventory()->addItem((new HeroicWarlock())->mysteryUltimateEnchants());
                $player->getInventory()->addItem((new HeroicWarlock())->mysteryLegendaryEnchants());
                $player->getInventory()->addItem((new HeroicWarlock())->mysteryGodlyEnchants());
                $player->getInventory()->addItem((new HeroicWarlock())->mysteryHeroicEnchants());
            } else {
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicWarlock())->energy());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicWarlock())->mysteryEliteEnchants());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicWarlock())->mysteryUltimateEnchants());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicWarlock())->mysteryLegendaryEnchants());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicWarlock())->mysteryGodlyEnchants());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicWarlock())->mysteryHeroicEnchants());
            }
            $player->broadcastSound(new BlazeShootSound(), [$player]);
        }

        if($item->getNamedTag()->getTag("HeroicSlaughterGKit") !== null) {
            $item = $player->getInventory()->getItemInHand()->setCount($count - 1);
            $player->getInventory()->setItemInHand($item);
            $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::RED . " Heroic Slaughter GKit");
            if($player->getInventory()->canAddItem((new HeroicSlaughter())->chestplate()) && $player->getInventory()->canAddItem((new HeroicSlaughter())->axe())) {
                $player->getInventory()->addItem((new HeroicSlaughter())->chestplate());
                $player->getInventory()->addItem((new HeroicSlaughter())->axe());
            } else {
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicSlaughter())->chestplate());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicSlaughter())->axe());
            }
            $player->broadcastSound(new BlazeShootSound(), [$player]);
        }

        if($item->getNamedTag()->getTag("HeroicEnchanterGKit") !== null) {
            $item = $player->getInventory()->getItemInHand()->setCount($count - 1);
            $player->getInventory()->setItemInHand($item);
            $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::AQUA . " Heroic Enchanter GKit");
            if($player->getInventory()->canAddItem((new HeroicEnchanter())->energy()) && $player->getInventory()->canAddItem((new HeroicEnchanter())->mysteryEliteEnchants()) && $player->getInventory()->canAddItem((new HeroicEnchanter())->mysteryUltimateEnchants()) && $player->getInventory()->canAddItem((new HeroicEnchanter())->mysteryLegendaryEnchants()) && $player->getInventory()->canAddItem((new HeroicEnchanter())->mysteryHeroicEnchants()) && $player->getInventory()->canAddItem((new HeroicEnchanter())->mysteryGodlyEnchants()) && $player->getInventory()->canAddItem((new HeroicEnchanter())->mysteryHeroicEnchants())) {
                $player->getInventory()->addItem((new HeroicEnchanter())->energy());
                $player->getInventory()->addItem((new HeroicEnchanter())->mysteryEliteEnchants());
                $player->getInventory()->addItem((new HeroicEnchanter())->mysteryUltimateEnchants());
                $player->getInventory()->addItem((new HeroicEnchanter())->mysteryLegendaryEnchants());
                $player->getInventory()->addItem((new HeroicEnchanter())->mysteryGodlyEnchants());
                $player->getInventory()->addItem((new HeroicEnchanter())->mysteryHeroicEnchants());
                $player->getInventory()->addItem((new Scrolls())->whiteScroll());
            } else {
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicEnchanter())->energy());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicEnchanter())->mysteryEliteEnchants());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicEnchanter())->mysteryUltimateEnchants());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicEnchanter())->mysteryLegendaryEnchants());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicEnchanter())->mysteryGodlyEnchants());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicEnchanter())->mysteryHeroicEnchants());
                $player->getWorld()->dropItem($player->getLocation(), (new Scrolls())->whiteScroll());
            }
            $player->broadcastSound(new BlazeShootSound(), [$player]);
        }

        if($item->getNamedTag()->getTag("HeroicAtheosGKit") !== null) {
            $item = $player->getInventory()->getItemInHand()->setCount($count - 1);
            $player->getInventory()->setItemInHand($item);
            $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::GRAY . " Heroic Atheos GKit");
            if($player->getInventory()->canAddItem((new HeroicAtheos())->helmet()) && $player->getInventory()->canAddItem((new HeroicAtheos())->sword())) {
                $player->getInventory()->addItem((new HeroicAtheos())->helmet());
                $player->getInventory()->addItem((new HeroicAtheos())->sword());
            } else {
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicAtheos())->helmet());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicAtheos())->sword());
            }
            $player->broadcastSound(new BlazeShootSound(), [$player]);
        }

        if($item->getNamedTag()->getTag("HeroicIapetusGKit") !== null) {
            $item = $player->getInventory()->getItemInHand()->setCount($count - 1);
            $player->getInventory()->setItemInHand($item);
            $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::BLUE . " Heroic Iapetus GKit");
            if($player->getInventory()->canAddItem((new HeroicIapetus())->axe()) && $player->getInventory()->canAddItem((new HeroicIapetus())->energy())) {
                $player->getInventory()->addItem((new HeroicIapetus())->axe());
                $player->getInventory()->addItem((new HeroicIapetus())->energy());
            } else {
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicIapetus())->axe());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicIapetus())->energy());
            }
            $player->broadcastSound(new BlazeShootSound(), [$player]);
        }

        if($item->getNamedTag()->getTag("HeroicBroteasGKit") !== null) {
            $item = $player->getInventory()->getItemInHand()->setCount($count - 1);
            $player->getInventory()->setItemInHand($item);
            $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::GREEN . " Heroic Broteas GKit");
            if($player->getInventory()->canAddItem((new HeroicBroteas())->axe()) && $player->getInventory()->canAddItem((new HeroicBroteas())->pickaxe()) && $player->getInventory()->canAddItem((new HeroicBroteas())->energy())) {
                $player->getInventory()->addItem((new HeroicBroteas())->axe());
                $player->getInventory()->addItem((new HeroicBroteas())->pickaxe());
                $player->getInventory()->addItem((new HeroicBroteas())->energy());
            } else {
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicBroteas())->axe());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicBroteas())->pickaxe());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicBroteas())->energy());
            }
            $player->broadcastSound(new BlazeShootSound(), [$player]);
        }

        if($item->getNamedTag()->getTag("HeroicAresGKit") !== null) {
            $item = $player->getInventory()->getItemInHand()->setCount($count - 1);
            $player->getInventory()->setItemInHand($item);
            $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::GOLD . " Heroic Ares GKit");
            if($player->getInventory()->canAddItem((new HeroicAres())->helmet()) && $player->getInventory()->canAddItem((new HeroicAres())->chestplate()) && $player->getInventory()->canAddItem((new HeroicAres())->leggings()) && $player->getInventory()->canAddItem((new HeroicAres())->boots()) && $player->getInventory()->canAddItem((new HeroicAres())->sword())) {
                $player->getInventory()->addItem((new HeroicAres())->helmet());
                $player->getInventory()->addItem((new HeroicAres())->chestplate());
                $player->getInventory()->addItem((new HeroicAres())->leggings());
                $player->getInventory()->addItem((new HeroicAres())->boots());
                $player->getInventory()->addItem((new HeroicAres())->sword());
            } else {
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicAres())->helmet());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicAres())->chestplate());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicAres())->leggings());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicAres())->boots());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicAres())->sword());
            }
            $player->broadcastSound(new BlazeShootSound(), [$player]);
        }

        if($item->getNamedTag()->getTag("HeroicGrimReaperGKit") !== null) {
            $item = $player->getInventory()->getItemInHand()->setCount($count - 1);
            $player->getInventory()->setItemInHand($item);
            $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::RED . " Heroic Grim Reaper GKit");
            if($player->getInventory()->canAddItem((new HeroicGrimReaper())->helmet()) && $player->getInventory()->canAddItem((new HeroicGrimReaper())->chestplate()) && $player->getInventory()->canAddItem((new HeroicGrimReaper())->leggings()) && $player->getInventory()->canAddItem((new HeroicGrimReaper())->boots()) && $player->getInventory()->canAddItem((new HeroicGrimReaper())->sword())) {
                $player->getInventory()->addItem((new HeroicGrimReaper())->helmet());
                $player->getInventory()->addItem((new HeroicGrimReaper())->chestplate());
                $player->getInventory()->addItem((new HeroicGrimReaper())->leggings());
                $player->getInventory()->addItem((new HeroicGrimReaper())->boots());
                $player->getInventory()->addItem((new HeroicGrimReaper())->sword());
            } else {
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicGrimReaper())->helmet());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicGrimReaper())->chestplate());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicGrimReaper())->leggings());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicGrimReaper())->boots());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicGrimReaper())->sword());
            }
            $player->broadcastSound(new BlazeShootSound(), [$player]);
        }

        if($item->getNamedTag()->getTag("HeroicExecutionerGKit") !== null) {
            $item = $player->getInventory()->getItemInHand()->setCount($count - 1);
            $player->getInventory()->setItemInHand($item);
            $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::DARK_RED . " Heroic Executioner GKit");
            if($player->getInventory()->canAddItem((new HeroicExecutioner())->helmet()) && $player->getInventory()->canAddItem((new HeroicExecutioner())->chestplate()) && $player->getInventory()->canAddItem((new HeroicExecutioner())->leggings()) && $player->getInventory()->canAddItem((new HeroicExecutioner())->boots()) && $player->getInventory()->canAddItem((new HeroicExecutioner())->axe())) {
                $player->getInventory()->addItem((new HeroicExecutioner())->helmet());
                $player->getInventory()->addItem((new HeroicExecutioner())->chestplate());
                $player->getInventory()->addItem((new HeroicExecutioner())->leggings());
                $player->getInventory()->addItem((new HeroicExecutioner())->boots());
                $player->getInventory()->addItem((new HeroicExecutioner())->axe());
            } else {
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicExecutioner())->helmet());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicExecutioner())->chestplate());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicExecutioner())->leggings());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicExecutioner())->boots());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicExecutioner())->axe());
            }
            $player->broadcastSound(new BlazeShootSound(), [$player]);
        }

        if($item->getNamedTag()->getTag("BlacksmithGKit") !== null) {
            $item = $player->getInventory()->getItemInHand()->setCount($count - 1);
            $player->getInventory()->setItemInHand($item);
            $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::DARK_GRAY . " Blacksmith GKit");
            if($player->getInventory()->canAddItem((new BlackSmith())->energy()) && $player->getInventory()->canAddItem((new Blacksmith())->whiteScroll()) && $player->getInventory()->canAddItem((new Blacksmith())->mysteryEliteEnchants()) && $player->getInventory()->canAddItem((new Blacksmith())->mysteryUltimateEnchants()) && $player->getInventory()->canAddItem((new Blacksmith())->mysteryLegendaryEnchants()) && $player->getInventory()->canAddItem((new Blacksmith())->mysteryGodlyEnchants()) && $player->getInventory()->canAddItem((new Blacksmith())->mysteryHeroicEnchants())) {
                $player->getInventory()->addItem((new Blacksmith())->energy());
                $player->getInventory()->addItem((new Blacksmith())->whiteScroll());
                $player->getInventory()->addItem((new Blacksmith())->mysteryEliteEnchants());
                $player->getInventory()->addItem((new Blacksmith())->mysteryUltimateEnchants());
                $player->getInventory()->addItem((new Blacksmith())->mysteryLegendaryEnchants());
                $player->getInventory()->addItem((new Blacksmith())->mysteryGodlyEnchants());
                $player->getInventory()->addItem((new Blacksmith())->mysteryHeroicEnchants());
            } else {
                $player->getWorld()->dropItem($player->getLocation(), (new Blacksmith())->energy());
                $player->getWorld()->dropItem($player->getLocation(), (new Blacksmith())->whiteScroll());
                $player->getWorld()->dropItem($player->getLocation(), (new Blacksmith())->mysteryEliteEnchants());
                $player->getWorld()->dropItem($player->getLocation(), (new Blacksmith())->mysteryUltimateEnchants());
                $player->getWorld()->dropItem($player->getLocation(), (new Blacksmith())->mysteryLegendaryEnchants());
                $player->getWorld()->dropItem($player->getLocation(), (new Blacksmith())->mysteryGodlyEnchants());
                $player->getWorld()->dropItem($player->getLocation(), (new Blacksmith())->mysteryHeroicEnchants());
            }
            $player->broadcastSound(new BlazeShootSound(), [$player]);
        }

        if($item->getNamedTag()->getTag("HeroGKit") !== null) {
            $item = $player->getInventory()->getItemInHand()->setCount($count - 1);
            $player->getInventory()->setItemInHand($item);
            $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::WHITE . " Hero GKit");
            if($player->getInventory()->canAddItem((new Hero())->helmet()) && $player->getInventory()->canAddItem((new Hero())->chestplate()) && $player->getInventory()->canAddItem((new Hero())->leggings()) && $player->getInventory()->canAddItem((new Hero())->boots()) && $player->getInventory()->canAddItem((new Hero())->sword())) {
                $player->getInventory()->addItem((new Hero())->helmet());
                $player->getInventory()->addItem((new Hero())->chestplate());
                $player->getInventory()->addItem((new Hero())->leggings());
                $player->getInventory()->addItem((new Hero())->boots());
                $player->getInventory()->addItem((new Hero())->sword());
            } else {
                $player->getWorld()->dropItem($player->getLocation(), (new Hero())->helmet());
                $player->getWorld()->dropItem($player->getLocation(), (new Hero())->chestplate());
                $player->getWorld()->dropItem($player->getLocation(), (new Hero())->leggings());
                $player->getWorld()->dropItem($player->getLocation(), (new Hero())->boots());
                $player->getWorld()->dropItem($player->getLocation(), (new Hero())->sword());
            }
            $player->broadcastSound(new BlazeShootSound(), [$player]);
        }

        if($item->getNamedTag()->getTag("CyborgGKit") !== null) {
            $item = $player->getInventory()->getItemInHand()->setCount($count - 1);
            $player->getInventory()->setItemInHand($item);
            $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::DARK_AQUA . " Cyborg GKit");
            if($player->getInventory()->canAddItem((new Cyborg())->helmet()) && $player->getInventory()->canAddItem((new Cyborg())->chestplate()) && $player->getInventory()->canAddItem((new Cyborg())->leggings()) && $player->getInventory()->canAddItem((new Cyborg())->boots()) && $player->getInventory()->canAddItem((new Cyborg())->sword())) {
                $player->getInventory()->addItem((new Cyborg())->helmet());
                $player->getInventory()->addItem((new Cyborg())->chestplate());
                $player->getInventory()->addItem((new Cyborg())->leggings());
                $player->getInventory()->addItem((new Cyborg())->boots());
                $player->getInventory()->addItem((new Cyborg())->sword());
            } else {
                $player->getWorld()->dropItem($player->getLocation(), (new Cyborg())->helmet());
                $player->getWorld()->dropItem($player->getLocation(), (new Cyborg())->chestplate());
                $player->getWorld()->dropItem($player->getLocation(), (new Cyborg())->leggings());
                $player->getWorld()->dropItem($player->getLocation(), (new Cyborg())->boots());
                $player->getWorld()->dropItem($player->getLocation(), (new Cyborg())->sword());
            }
            $player->broadcastSound(new BlazeShootSound(), [$player]);
        }

        if($item->getNamedTag()->getTag("CrucibleGKit") !== null) {
            $item = $player->getInventory()->getItemInHand()->setCount($count - 1);
            $player->getInventory()->setItemInHand($item);
            $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::YELLOW . " Crucible GKit");
            if( $player->getInventory()->canAddItem((new Crucible())->chestplate()) && $player->getInventory()->canAddItem((new Crucible())->leggings()) && $player->getInventory()->canAddItem((new Crucible())->pickaxe($player))) {
                $player->getInventory()->addItem((new Crucible())->chestplate());
                $player->getInventory()->addItem((new Crucible())->leggings());
                $player->getInventory()->addItem((new Crucible())->pickaxe($player));
            } else {
                $player->getWorld()->dropItem($player->getLocation(), (new Crucible())->chestplate());
                $player->getWorld()->dropItem($player->getLocation(), (new Crucible())->leggings());
                $player->getWorld()->dropItem($player->getLocation(), (new Crucible())->pickaxe($player));
            }
            $player->broadcastSound(new BlazeShootSound(), [$player]);
        }

        if($item->getNamedTag()->getTag("HunterGKit") !== null) {
            $item = $player->getInventory()->getItemInHand()->setCount($count - 1);
            $player->getInventory()->setItemInHand($item);
            $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::AQUA . " Hunter GKit");
            if($player->getInventory()->canAddItem((new Hunter())->helmet()) && $player->getInventory()->canAddItem((new Hunter())->chestplate()) && $player->getInventory()->canAddItem((new Hunter())->leggings()) && $player->getInventory()->canAddItem((new Hunter())->boots()) && $player->getInventory()->canAddItem((new Hunter())->sword())) {
                $player->getInventory()->addItem((new Hunter())->helmet());
                $player->getInventory()->addItem((new Hunter())->chestplate());
                $player->getInventory()->addItem((new Hunter())->leggings());
                $player->getInventory()->addItem((new Hunter())->boots());
                $player->getInventory()->addItem((new Hunter())->sword());
            } else {
                $player->getWorld()->dropItem($player->getLocation(), (new Hunter())->helmet());
                $player->getWorld()->dropItem($player->getLocation(), (new Hunter())->chestplate());
                $player->getWorld()->dropItem($player->getLocation(), (new Hunter())->leggings());
                $player->getWorld()->dropItem($player->getLocation(), (new Hunter())->boots());
                $player->getWorld()->dropItem($player->getLocation(), (new Hunter())->sword());
            }
            $player->broadcastSound(new BlazeShootSound(), [$player]);
        }
    }

    public function onClaimKitBlock(PlayerInteractEvent $event) {

        $item = $event->getItem();
        $player = $event->getPlayer();
        $count = $item->getCount();

        if($item->getNamedTag()->getTag("HeroicVulkarionGKit") !== null) {
            $item = $player->getInventory()->getItemInHand()->setCount($count - 1);
            $player->getInventory()->setItemInHand($item);
            $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::DARK_RED . "Heroic Vulkarion GKit");
            if($player->getInventory()->canAddItem((new HeroicVulkarion())->helmet()) && $player->getInventory()->canAddItem((new HeroicVulkarion())->chestplate()) && $player->getInventory()->canAddItem((new HeroicVulkarion())->leggings()) && $player->getInventory()->canAddItem((new HeroicVulkarion())->boots()) && $player->getInventory()->canAddItem((new HeroicVulkarion())->sword())) {
                $player->getInventory()->addItem((new HeroicVulkarion())->helmet());
                $player->getInventory()->addItem((new HeroicVulkarion())->chestplate());
                $player->getInventory()->addItem((new HeroicVulkarion())->leggings());
                $player->getInventory()->addItem((new HeroicVulkarion())->boots());
                $player->getInventory()->addItem((new HeroicVulkarion())->sword());
            } else {
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicVulkarion())->helmet());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicVulkarion())->chestplate());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicVulkarion())->leggings());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicVulkarion())->boots());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicVulkarion())->sword());
            }
            $player->broadcastSound(new BlazeShootSound(), [$player]);
        }

        if($item->getNamedTag()->getTag("HeroicZenithGKit") !== null) {
            $item = $player->getInventory()->getItemInHand()->setCount($count - 1);
            $player->getInventory()->setItemInHand($item);
            $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::GOLD . " Heroic Zenith GKit");
            if($player->getInventory()->canAddItem((new HeroicZenith())->leggings()) && $player->getInventory()->canAddItem((new HeroicZenith())->pickaxe($player))) {
                $player->getInventory()->addItem((new HeroicZenith())->leggings());
                $player->getInventory()->addItem((new HeroicZenith())->pickaxe($player));
            } else {
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicZenith())->leggings());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicZenith())->pickaxe($player));
            }
            $player->broadcastSound(new BlazeShootSound(), [$player]);
        }

        if($item->getNamedTag()->getTag("HeroicColossusGKit") !== null) {
            $item = $player->getInventory()->getItemInHand()->setCount($count - 1);
            $player->getInventory()->setItemInHand($item);
            $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::WHITE . " Heroic Colossus GKit");
            if($player->getInventory()->canAddItem((new HeroicColossus())->boots()) && $player->getInventory()->canAddItem((new HeroicColossus())->sword())) {
                $player->getInventory()->addItem((new HeroicColossus())->boots());
                $player->getInventory()->addItem((new HeroicColossus())->sword());
            } else {
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicColossus())->boots());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicColossus())->sword());
            }
            $player->broadcastSound(new BlazeShootSound(), [$player]);
        }

        if($item->getNamedTag()->getTag("HeroicWarlockGKit") !== null) {
            $item = $player->getInventory()->getItemInHand()->setCount($count - 1);
            $player->getInventory()->setItemInHand($item);
            $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::DARK_PURPLE . " Heroic Warlock GKit");
            if($player->getInventory()->canAddItem((new HeroicWarlock())->energy()) && $player->getInventory()->canAddItem((new HeroicWarlock())->mysteryEliteEnchants()) && $player->getInventory()->canAddItem((new HeroicWarlock())->mysteryUltimateEnchants()) && $player->getInventory()->canAddItem((new HeroicWarlock())->mysteryLegendaryEnchants()) && $player->getInventory()->canAddItem((new HeroicWarlock())->mysteryGodlyEnchants()) && $player->getInventory()->canAddItem((new HeroicWarlock())->mysteryHeroicEnchants())) {
                $player->getInventory()->addItem((new HeroicWarlock())->energy());
                $player->getInventory()->addItem((new HeroicWarlock())->mysteryEliteEnchants());
                $player->getInventory()->addItem((new HeroicWarlock())->mysteryUltimateEnchants());
                $player->getInventory()->addItem((new HeroicWarlock())->mysteryLegendaryEnchants());
                $player->getInventory()->addItem((new HeroicWarlock())->mysteryGodlyEnchants());
                $player->getInventory()->addItem((new HeroicWarlock())->mysteryHeroicEnchants());
            } else {
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicWarlock())->energy());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicWarlock())->mysteryEliteEnchants());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicWarlock())->mysteryUltimateEnchants());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicWarlock())->mysteryLegendaryEnchants());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicWarlock())->mysteryGodlyEnchants());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicWarlock())->mysteryHeroicEnchants());
            }
            $player->broadcastSound(new BlazeShootSound(), [$player]);
        }

        if($item->getNamedTag()->getTag("HeroicSlaughterGKit") !== null) {
            $item = $player->getInventory()->getItemInHand()->setCount($count - 1);
            $player->getInventory()->setItemInHand($item);
            $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::RED . " Heroic Slaughter GKit");
            if($player->getInventory()->canAddItem((new HeroicSlaughter())->chestplate()) && $player->getInventory()->canAddItem((new HeroicSlaughter())->axe())) {
                $player->getInventory()->addItem((new HeroicSlaughter())->chestplate());
                $player->getInventory()->addItem((new HeroicSlaughter())->axe());
            } else {
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicSlaughter())->chestplate());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicSlaughter())->axe());
            }
            $player->broadcastSound(new BlazeShootSound(), [$player]);
        }

        if($item->getNamedTag()->getTag("HeroicEnchanterGKit") !== null) {
            $item = $player->getInventory()->getItemInHand()->setCount($count - 1);
            $player->getInventory()->setItemInHand($item);
            $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::AQUA . " Heroic Enchanter GKit");
            if($player->getInventory()->canAddItem((new HeroicEnchanter())->energy()) && $player->getInventory()->canAddItem((new HeroicEnchanter())->mysteryEliteEnchants()) && $player->getInventory()->canAddItem((new HeroicEnchanter())->mysteryUltimateEnchants()) && $player->getInventory()->canAddItem((new HeroicEnchanter())->mysteryLegendaryEnchants()) && $player->getInventory()->canAddItem((new HeroicEnchanter())->mysteryHeroicEnchants()) && $player->getInventory()->canAddItem((new HeroicEnchanter())->mysteryGodlyEnchants()) && $player->getInventory()->canAddItem((new HeroicEnchanter())->mysteryHeroicEnchants())) {
                $player->getInventory()->addItem((new HeroicEnchanter())->energy());
                $player->getInventory()->addItem((new HeroicEnchanter())->mysteryEliteEnchants());
                $player->getInventory()->addItem((new HeroicEnchanter())->mysteryUltimateEnchants());
                $player->getInventory()->addItem((new HeroicEnchanter())->mysteryLegendaryEnchants());
                $player->getInventory()->addItem((new HeroicEnchanter())->mysteryGodlyEnchants());
                $player->getInventory()->addItem((new HeroicEnchanter())->mysteryHeroicEnchants());
                $player->getInventory()->addItem((new Scrolls())->whiteScroll());
            } else {
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicEnchanter())->energy());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicEnchanter())->mysteryEliteEnchants());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicEnchanter())->mysteryUltimateEnchants());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicEnchanter())->mysteryLegendaryEnchants());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicEnchanter())->mysteryGodlyEnchants());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicEnchanter())->mysteryHeroicEnchants());
                $player->getWorld()->dropItem($player->getLocation(), (new Scrolls())->whiteScroll());
            }
            $player->broadcastSound(new BlazeShootSound(), [$player]);
        }

        if($item->getNamedTag()->getTag("HeroicAtheosGKit") !== null) {
            $item = $player->getInventory()->getItemInHand()->setCount($count - 1);
            $player->getInventory()->setItemInHand($item);
            $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::GRAY . " Heroic Atheos GKit");
            if($player->getInventory()->canAddItem((new HeroicAtheos())->helmet()) && $player->getInventory()->canAddItem((new HeroicAtheos())->sword())) {
                $player->getInventory()->addItem((new HeroicAtheos())->helmet());
                $player->getInventory()->addItem((new HeroicAtheos())->sword());
            } else {
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicAtheos())->helmet());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicAtheos())->sword());
            }
            $player->broadcastSound(new BlazeShootSound(), [$player]);
        }

        if($item->getNamedTag()->getTag("HeroicIapetusGKit") !== null) {
            $item = $player->getInventory()->getItemInHand()->setCount($count - 1);
            $player->getInventory()->setItemInHand($item);
            $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::BLUE . " Heroic Iapetus GKit");
            if($player->getInventory()->canAddItem((new HeroicIapetus())->axe()) && $player->getInventory()->canAddItem((new HeroicIapetus())->energy())) {
                $player->getInventory()->addItem((new HeroicIapetus())->axe());
                $player->getInventory()->addItem((new HeroicIapetus())->energy());
            } else {
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicIapetus())->axe());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicIapetus())->energy());
            }
            $player->broadcastSound(new BlazeShootSound(), [$player]);
        }

        if($item->getNamedTag()->getTag("HeroicBroteasGKit") !== null) {
            $item = $player->getInventory()->getItemInHand()->setCount($count - 1);
            $player->getInventory()->setItemInHand($item);
            $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::GREEN . " Heroic Broteas GKit");
            if($player->getInventory()->canAddItem((new HeroicBroteas())->axe()) && $player->getInventory()->canAddItem((new HeroicBroteas())->pickaxe()) && $player->getInventory()->canAddItem((new HeroicBroteas())->energy())) {
                $player->getInventory()->addItem((new HeroicBroteas())->axe());
                $player->getInventory()->addItem((new HeroicBroteas())->pickaxe());
                $player->getInventory()->addItem((new HeroicBroteas())->energy());
            } else {
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicBroteas())->axe());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicBroteas())->pickaxe());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicBroteas())->energy());
            }
            $player->broadcastSound(new BlazeShootSound(), [$player]);
        }

        if($item->getNamedTag()->getTag("HeroicAresGKit") !== null) {
            $item = $player->getInventory()->getItemInHand()->setCount($count - 1);
            $player->getInventory()->setItemInHand($item);
            $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::GOLD . " Heroic Ares GKit");
            if($player->getInventory()->canAddItem((new HeroicAres())->helmet()) && $player->getInventory()->canAddItem((new HeroicAres())->chestplate()) && $player->getInventory()->canAddItem((new HeroicAres())->leggings()) && $player->getInventory()->canAddItem((new HeroicAres())->boots()) && $player->getInventory()->canAddItem((new HeroicAres())->sword())) {
                $player->getInventory()->addItem((new HeroicAres())->helmet());
                $player->getInventory()->addItem((new HeroicAres())->chestplate());
                $player->getInventory()->addItem((new HeroicAres())->leggings());
                $player->getInventory()->addItem((new HeroicAres())->boots());
                $player->getInventory()->addItem((new HeroicAres())->sword());
            } else {
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicAres())->helmet());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicAres())->chestplate());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicAres())->leggings());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicAres())->boots());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicAres())->sword());
            }
            $player->broadcastSound(new BlazeShootSound(), [$player]);
        }

        if($item->getNamedTag()->getTag("HeroicGrimReaperGKit") !== null) {
            $item = $player->getInventory()->getItemInHand()->setCount($count - 1);
            $player->getInventory()->setItemInHand($item);
            $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::RED . " Heroic Grim Reaper GKit");
            if($player->getInventory()->canAddItem((new HeroicGrimReaper())->helmet()) && $player->getInventory()->canAddItem((new HeroicGrimReaper())->chestplate()) && $player->getInventory()->canAddItem((new HeroicGrimReaper())->leggings()) && $player->getInventory()->canAddItem((new HeroicGrimReaper())->boots()) && $player->getInventory()->canAddItem((new HeroicGrimReaper())->sword())) {
                $player->getInventory()->addItem((new HeroicGrimReaper())->helmet());
                $player->getInventory()->addItem((new HeroicGrimReaper())->chestplate());
                $player->getInventory()->addItem((new HeroicGrimReaper())->leggings());
                $player->getInventory()->addItem((new HeroicGrimReaper())->boots());
                $player->getInventory()->addItem((new HeroicGrimReaper())->sword());
            } else {
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicGrimReaper())->helmet());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicGrimReaper())->chestplate());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicGrimReaper())->leggings());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicGrimReaper())->boots());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicGrimReaper())->sword());
            }
            $player->broadcastSound(new BlazeShootSound(), [$player]);
        }

        if($item->getNamedTag()->getTag("HeroicExecutionerGKit") !== null) {
            $item = $player->getInventory()->getItemInHand()->setCount($count - 1);
            $player->getInventory()->setItemInHand($item);
            $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::DARK_RED . " Heroic Executioner GKit");
            if($player->getInventory()->canAddItem((new HeroicExecutioner())->helmet()) && $player->getInventory()->canAddItem((new HeroicExecutioner())->chestplate()) && $player->getInventory()->canAddItem((new HeroicExecutioner())->leggings()) && $player->getInventory()->canAddItem((new HeroicExecutioner())->boots()) && $player->getInventory()->canAddItem((new HeroicExecutioner())->axe())) {
                $player->getInventory()->addItem((new HeroicExecutioner())->helmet());
                $player->getInventory()->addItem((new HeroicExecutioner())->chestplate());
                $player->getInventory()->addItem((new HeroicExecutioner())->leggings());
                $player->getInventory()->addItem((new HeroicExecutioner())->boots());
                $player->getInventory()->addItem((new HeroicExecutioner())->axe());
            } else {
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicExecutioner())->helmet());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicExecutioner())->chestplate());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicExecutioner())->leggings());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicExecutioner())->boots());
                $player->getWorld()->dropItem($player->getLocation(), (new HeroicExecutioner())->axe());
            }
            $player->broadcastSound(new BlazeShootSound(), [$player]);
        }

        if($item->getNamedTag()->getTag("BlacksmithGKit") !== null) {
            $item = $player->getInventory()->getItemInHand()->setCount($count - 1);
            $player->getInventory()->setItemInHand($item);
            $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::DARK_GRAY . " Blacksmith GKit");
            if($player->getInventory()->canAddItem((new BlackSmith())->energy()) && $player->getInventory()->canAddItem((new Blacksmith())->whiteScroll()) && $player->getInventory()->canAddItem((new Blacksmith())->mysteryEliteEnchants()) && $player->getInventory()->canAddItem((new Blacksmith())->mysteryUltimateEnchants()) && $player->getInventory()->canAddItem((new Blacksmith())->mysteryLegendaryEnchants()) && $player->getInventory()->canAddItem((new Blacksmith())->mysteryGodlyEnchants()) && $player->getInventory()->canAddItem((new Blacksmith())->mysteryHeroicEnchants())) {
                $player->getInventory()->addItem((new Blacksmith())->energy());
                $player->getInventory()->addItem((new Blacksmith())->whiteScroll());
                $player->getInventory()->addItem((new Blacksmith())->mysteryEliteEnchants());
                $player->getInventory()->addItem((new Blacksmith())->mysteryUltimateEnchants());
                $player->getInventory()->addItem((new Blacksmith())->mysteryLegendaryEnchants());
                $player->getInventory()->addItem((new Blacksmith())->mysteryGodlyEnchants());
                $player->getInventory()->addItem((new Blacksmith())->mysteryHeroicEnchants());
            } else {
                $player->getWorld()->dropItem($player->getLocation(), (new Blacksmith())->energy());
                $player->getWorld()->dropItem($player->getLocation(), (new Blacksmith())->whiteScroll());
                $player->getWorld()->dropItem($player->getLocation(), (new Blacksmith())->mysteryEliteEnchants());
                $player->getWorld()->dropItem($player->getLocation(), (new Blacksmith())->mysteryUltimateEnchants());
                $player->getWorld()->dropItem($player->getLocation(), (new Blacksmith())->mysteryLegendaryEnchants());
                $player->getWorld()->dropItem($player->getLocation(), (new Blacksmith())->mysteryGodlyEnchants());
                $player->getWorld()->dropItem($player->getLocation(), (new Blacksmith())->mysteryHeroicEnchants());
            }
            $player->broadcastSound(new BlazeShootSound(), [$player]);
        }

        if($item->getNamedTag()->getTag("HeroGKit") !== null) {
            $item = $player->getInventory()->getItemInHand()->setCount($count - 1);
            $player->getInventory()->setItemInHand($item);
            $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::WHITE . " Hero GKit");
            if($player->getInventory()->canAddItem((new Hero())->helmet()) && $player->getInventory()->canAddItem((new Hero())->chestplate()) && $player->getInventory()->canAddItem((new Hero())->leggings()) && $player->getInventory()->canAddItem((new Hero())->boots()) && $player->getInventory()->canAddItem((new Hero())->sword())) {
                $player->getInventory()->addItem((new Hero())->helmet());
                $player->getInventory()->addItem((new Hero())->chestplate());
                $player->getInventory()->addItem((new Hero())->leggings());
                $player->getInventory()->addItem((new Hero())->boots());
                $player->getInventory()->addItem((new Hero())->sword());
            } else {
                $player->getWorld()->dropItem($player->getLocation(), (new Hero())->helmet());
                $player->getWorld()->dropItem($player->getLocation(), (new Hero())->chestplate());
                $player->getWorld()->dropItem($player->getLocation(), (new Hero())->leggings());
                $player->getWorld()->dropItem($player->getLocation(), (new Hero())->boots());
                $player->getWorld()->dropItem($player->getLocation(), (new Hero())->sword());
            }
            $player->broadcastSound(new BlazeShootSound(), [$player]);
        }

        if($item->getNamedTag()->getTag("CyborgGKit") !== null) {
            $item = $player->getInventory()->getItemInHand()->setCount($count - 1);
            $player->getInventory()->setItemInHand($item);
            $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::DARK_AQUA . " Cyborg GKit");
            if($player->getInventory()->canAddItem((new Cyborg())->helmet()) && $player->getInventory()->canAddItem((new Cyborg())->chestplate()) && $player->getInventory()->canAddItem((new Cyborg())->leggings()) && $player->getInventory()->canAddItem((new Cyborg())->boots()) && $player->getInventory()->canAddItem((new Cyborg())->sword())) {
                $player->getInventory()->addItem((new Cyborg())->helmet());
                $player->getInventory()->addItem((new Cyborg())->chestplate());
                $player->getInventory()->addItem((new Cyborg())->leggings());
                $player->getInventory()->addItem((new Cyborg())->boots());
                $player->getInventory()->addItem((new Cyborg())->sword());
            } else {
                $player->getWorld()->dropItem($player->getLocation(), (new Cyborg())->helmet());
                $player->getWorld()->dropItem($player->getLocation(), (new Cyborg())->chestplate());
                $player->getWorld()->dropItem($player->getLocation(), (new Cyborg())->leggings());
                $player->getWorld()->dropItem($player->getLocation(), (new Cyborg())->boots());
                $player->getWorld()->dropItem($player->getLocation(), (new Cyborg())->sword());
            }
            $player->broadcastSound(new BlazeShootSound(), [$player]);
        }

        if($item->getNamedTag()->getTag("CrucibleGKit") !== null) {
            $item = $player->getInventory()->getItemInHand()->setCount($count - 1);
            $player->getInventory()->setItemInHand($item);
            $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::YELLOW . " Crucible GKit");
            if( $player->getInventory()->canAddItem((new Crucible())->chestplate()) && $player->getInventory()->canAddItem((new Crucible())->leggings()) && $player->getInventory()->canAddItem((new Crucible())->pickaxe($player))) {
                $player->getInventory()->addItem((new Crucible())->chestplate());
                $player->getInventory()->addItem((new Crucible())->leggings());
                $player->getInventory()->addItem((new Crucible())->pickaxe($player));
            } else {
                $player->getWorld()->dropItem($player->getLocation(), (new Crucible())->chestplate());
                $player->getWorld()->dropItem($player->getLocation(), (new Crucible())->leggings());
                $player->getWorld()->dropItem($player->getLocation(), (new Crucible())->pickaxe($player));
            }
            $player->broadcastSound(new BlazeShootSound(), [$player]);
        }

        if($item->getNamedTag()->getTag("HunterGKit") !== null) {
            $item = $player->getInventory()->getItemInHand()->setCount($count - 1);
            $player->getInventory()->setItemInHand($item);
            $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::AQUA . " Hunter GKit");
            if($player->getInventory()->canAddItem((new Hunter())->helmet()) && $player->getInventory()->canAddItem((new Hunter())->chestplate()) && $player->getInventory()->canAddItem((new Hunter())->leggings()) && $player->getInventory()->canAddItem((new Hunter())->boots()) && $player->getInventory()->canAddItem((new Hunter())->sword())) {
                $player->getInventory()->addItem((new Hunter())->helmet());
                $player->getInventory()->addItem((new Hunter())->chestplate());
                $player->getInventory()->addItem((new Hunter())->leggings());
                $player->getInventory()->addItem((new Hunter())->boots());
                $player->getInventory()->addItem((new Hunter())->sword());
            } else {
                $player->getWorld()->dropItem($player->getLocation(), (new Hunter())->helmet());
                $player->getWorld()->dropItem($player->getLocation(), (new Hunter())->chestplate());
                $player->getWorld()->dropItem($player->getLocation(), (new Hunter())->leggings());
                $player->getWorld()->dropItem($player->getLocation(), (new Hunter())->boots());
                $player->getWorld()->dropItem($player->getLocation(), (new Hunter())->sword());
            }
            $player->broadcastSound(new BlazeShootSound(), [$player]);
        }
    }

}