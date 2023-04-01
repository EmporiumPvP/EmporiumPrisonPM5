<?php

namespace EmporiumCore\Listeners\Items;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\Managers\misc\Translator;
use EmporiumCore\EmporiumCore;
use EmporiumCore\Tasks\Utils\DelayedFireworks;
use EmporiumCore\Tasks\Utils\DespawnContrabandTask;
use EmporiumCore\Tasks\Utils\SpawnContrabandReward;
use EmporiumData\DataManager;
use pocketmine\block\VanillaBlocks;
use pocketmine\entity\Location;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\TotemUseSound;
use Tetro\EmporiumEnchants\EmporiumEnchants;

class ContrabandListener implements Listener {

    public function onOpenContraband(PlayerInteractEvent $event) {

        $player = $event->getPlayer();
        $item = $event->getItem();
        $count = $item->getCount();
        $block = $event->getBlock();
        $world = $block->getPosition()->getWorld();
        $x = $block->getPosition()->getX();
        $y = $block->getPosition()->getY();
        $z = $block->getPosition()->getZ();

        if($item->getNamedTag()->getTag("EliteContraband")) {

            # remove 1 from count
            $player->getInventory()->setItemInHand($item->setCount($count - 1));
            # send confirmation message
            $player->sendMessage(TF::BOLD . TF::GRAY . "Opening Contraband...");
            $player->broadcastSound(new TotemUseSound());
            # spawn block
            $world->setBlockAt($x, $y + 2, $z, VanillaBlocks::ENDER_CHEST());
            EmporiumCore::getInstance()->getScheduler()->scheduleDelayedTask(new DespawnContrabandTask($world, $x, $y, $z), 240);
            # send fireworks
            EmporiumCore::getInstance()->getScheduler()->scheduleDelayedTask(new DelayedFireworks($player), 160);
            # reward 1
            $number1 = mt_rand(1,24);
            $reward1 = $this->getEliteReward($player, $number1)[0];
            $reward1Name = $this->getEliteReward($player, $number1)[1];
            $reward1Location = new Location($x + 3, $y + 3, $z + 0.5, $world, 0, 0);
            EmporiumCore::getInstance()->getScheduler()->scheduleDelayedTask(new SpawnContrabandReward($player, $world, $reward1Location, $reward1, $reward1Name, 180), 60);

            # reward 2
            $number2 = mt_rand(1,24);
            $reward2 = $this->getEliteReward($player, $number2)[0];
            $reward2Name = $this->getEliteReward($player, $number2)[1];
            $reward2Location = new Location($x + 0.5, $y + 4, $z + 0.5, $world, 0, 0);
            EmporiumCore::getInstance()->getScheduler()->scheduleDelayedTask(new SpawnContrabandReward($player, $world, $reward2Location, $reward2, $reward2Name,140), 100);

            # reward 3
            $number3 = mt_rand(1,24);
            $reward3 = $this->getEliteReward($player, $number3)[0];
            $reward3Name = $this->getEliteReward($player, $number3)[1];
            $reward3Location = new Location($x - 2, $y + 3, $z + 0.5, $world, 0, 0);
            EmporiumCore::getInstance()->getScheduler()->scheduleDelayedTask(new SpawnContrabandReward($player, $world, $reward3Location, $reward3, $reward3Name,100), 140);

        }

        if($item->getNamedTag()->getTag("UltimateContraband")) {
            $player->getInventory()->setItemInHand($item->setCount($count - 1));

            $player->sendMessage(TF::BOLD . TF::GRAY . "Opening Contraband...");
            $player->broadcastSound(new TotemUseSound());
            # spawn block
            $world->setBlockAt($x, $y + 2, $z, VanillaBlocks::ENDER_CHEST());
            EmporiumCore::getInstance()->getScheduler()->scheduleDelayedTask(new DespawnContrabandTask($world, $x, $y, $z), 240);
            # send fireworks
            EmporiumCore::getInstance()->getScheduler()->scheduleDelayedTask(new DelayedFireworks($player), 160);
            # reward 1
            $number1 = mt_rand(1,24);
            $reward1 = $this->getUltimateReward($player, $number1)[0];
            $reward1Name = $this->getUltimateReward($player, $number1)[1];
            $reward1Location = new Location($x + 3, $y + 3, $z + 0.5, $world, 0, 0);
            EmporiumCore::getInstance()->getScheduler()->scheduleDelayedTask(new SpawnContrabandReward($player, $world, $reward1Location, $reward1, $reward1Name, 180), 60);

            # reward 2
            $number2 = mt_rand(1,24);
            $reward2 = $this->getUltimateReward($player, $number2)[0];
            $reward2Name = $this->getUltimateReward($player, $number2)[1];
            $reward2Location = new Location($x + 0.5, $y + 4, $z + 0.5, $world, 0, 0);
            EmporiumCore::getInstance()->getScheduler()->scheduleDelayedTask(new SpawnContrabandReward($player, $world, $reward2Location, $reward2, $reward2Name,140), 100);

            # reward 3
            $number3 = mt_rand(1,24);
            $reward3 = $this->getUltimateReward($player, $number3)[0];
            $reward3Name = $this->getUltimateReward($player, $number3)[1];
            $reward3Location = new Location($x - 2, $y + 3, $z + 0.5, $world, 0, 0);
            EmporiumCore::getInstance()->getScheduler()->scheduleDelayedTask(new SpawnContrabandReward($player, $world, $reward3Location, $reward3, $reward3Name,100), 140);
        }

        if($item->getNamedTag()->getTag("LegendaryContraband")) {
            $player->getInventory()->setItemInHand($item->setCount($count - 1));

            $player->sendMessage(TF::BOLD . TF::GRAY . "Opening Contraband...");
            $player->broadcastSound(new TotemUseSound());
            # spawn block
            $world->setBlockAt($x, $y + 2, $z, VanillaBlocks::ENDER_CHEST());
            EmporiumCore::getInstance()->getScheduler()->scheduleDelayedTask(new DespawnContrabandTask($world, $x, $y, $z), 240);
            # send fireworks
            EmporiumCore::getInstance()->getScheduler()->scheduleDelayedTask(new DelayedFireworks($player), 160);
            # reward 1
            $number1 = mt_rand(1,24);
            $reward1 = $this->getLegendaryReward($player, $number1)[0];
            $reward1Name = $this->getLegendaryReward($player, $number1)[1];
            $reward1Location = new Location($x + 3, $y + 3, $z + 0.5, $world, 0, 0);
            EmporiumCore::getInstance()->getScheduler()->scheduleDelayedTask(new SpawnContrabandReward($player, $world, $reward1Location, $reward1, $reward1Name, 180), 60);

            # reward 2
            $number2 = mt_rand(1,24);
            $reward2 = $this->getLegendaryReward($player, $number2)[0];
            $reward2Name = $this->getLegendaryReward($player, $number2)[1];
            $reward2Location = new Location($x + 0.5, $y + 4, $z + 0.5, $world, 0, 0);
            EmporiumCore::getInstance()->getScheduler()->scheduleDelayedTask(new SpawnContrabandReward($player, $world, $reward2Location, $reward2, $reward2Name,140), 100);

            # reward 3
            $number3 = mt_rand(1,24);
            $reward3 = $this->getLegendaryReward($player, $number3)[0];
            $reward3Name = $this->getLegendaryReward($player, $number3)[1];
            $reward3Location = new Location($x - 2, $y + 3, $z + 0.5, $world, 0, 0);
            EmporiumCore::getInstance()->getScheduler()->scheduleDelayedTask(new SpawnContrabandReward($player, $world, $reward3Location, $reward3, $reward3Name,100), 140);
        }

        if($item->getNamedTag()->getTag("GodlyContraband")) {
            $player->getInventory()->setItemInHand($item->setCount($count - 1));

            $player->sendMessage(TF::BOLD . TF::GRAY . "Opening Contraband...");
            $player->broadcastSound(new TotemUseSound());
            # spawn block
            $world->setBlockAt($x, $y + 2, $z, VanillaBlocks::ENDER_CHEST());
            EmporiumCore::getInstance()->getScheduler()->scheduleDelayedTask(new DespawnContrabandTask($world, $x, $y, $z), 240);
            # send fireworks
            EmporiumCore::getInstance()->getScheduler()->scheduleDelayedTask(new DelayedFireworks($player), 160);
            # reward 1
            $number1 = mt_rand(1,24);
            $reward1 = $this->getGodlyReward($player, $number1)[0];
            $reward1Name = $this->getGodlyReward($player, $number1)[1];
            $reward1Location = new Location($x + 3, $y + 3, $z + 0.5, $world, 0, 0);
            EmporiumCore::getInstance()->getScheduler()->scheduleDelayedTask(new SpawnContrabandReward($player, $world, $reward1Location, $reward1, $reward1Name, 180), 60);

            # reward 2
            $number2 = mt_rand(1,24);
            $reward2 = $this->getGodlyReward($player, $number2)[0];
            $reward2Name = $this->getGodlyReward($player, $number2)[1];
            $reward2Location = new Location($x + 0.5, $y + 4, $z + 0.5, $world, 0, 0);
            EmporiumCore::getInstance()->getScheduler()->scheduleDelayedTask(new SpawnContrabandReward($player, $world, $reward2Location, $reward2, $reward2Name,140), 100);

            # reward 3
            $number3 = mt_rand(1,24);
            $reward3 = $this->getGodlyReward($player, $number3)[0];
            $reward3Name = $this->getGodlyReward($player, $number3)[1];
            $reward3Location = new Location($x - 2, $y + 3, $z + 0.5, $world, 0, 0);
            EmporiumCore::getInstance()->getScheduler()->scheduleDelayedTask(new SpawnContrabandReward($player, $world, $reward3Location, $reward3, $reward3Name,100), 140);
        }

        if($item->getNamedTag()->getTag("HeroicContraband")) {
            $player->getInventory()->setItemInHand($item->setCount($count - 1));

            $player->sendMessage(TF::BOLD . TF::GRAY . "Opening Contraband...");
            $player->broadcastSound(new TotemUseSound());
            # spawn block
            $world->setBlockAt($x, $y + 2, $z, VanillaBlocks::ENDER_CHEST());
            EmporiumCore::getInstance()->getScheduler()->scheduleDelayedTask(new DespawnContrabandTask($world, $x, $y, $z), 240);
            # send fireworks
            EmporiumCore::getInstance()->getScheduler()->scheduleDelayedTask(new DelayedFireworks($player), 160);
            # reward 1
            $number1 = mt_rand(1,24);
            $reward1 = $this->getHeroicReward($player, $number1)[0];
            $reward1Name = $this->getHeroicReward($player, $number1)[1];
            $reward1Location = new Location($x + 3, $y + 3, $z + 0.5, $world, 0, 0);
            EmporiumCore::getInstance()->getScheduler()->scheduleDelayedTask(new SpawnContrabandReward($player, $world, $reward1Location, $reward1, $reward1Name, 180), 60);

            # reward 2
            $number2 = mt_rand(1,24);
            $reward2 = $this->getHeroicReward($player, $number2)[0];
            $reward2Name = $this->getHeroicReward($player, $number2)[1];
            $reward2Location = new Location($x + 0.5, $y + 4, $z + 0.5, $world, 0, 0);
            EmporiumCore::getInstance()->getScheduler()->scheduleDelayedTask(new SpawnContrabandReward($player, $world, $reward2Location, $reward2, $reward2Name,140), 100);

            # reward 3
            $number3 = mt_rand(1,24);
            $reward3 = $this->getHeroicReward($player, $number3)[0];
            $reward3Name = $this->getHeroicReward($player, $number3)[1];
            $reward3Location = new Location($x - 2, $y + 3, $z + 0.5, $world, 0, 0);
            EmporiumCore::getInstance()->getScheduler()->scheduleDelayedTask(new SpawnContrabandReward($player, $world, $reward3Location, $reward3, $reward3Name,100), 140);
        }
    }

    private function getEliteReward(Player $player, int $reward): array {

        $item = null;

        switch($reward) {

            # rank crystal
            case 1:
                $item = EmporiumCore::getInstance()->getCrystals()->imperial();
                break;

            # rank kit
            case 2:
            case 3:
                $item = EmporiumCore::getInstance()->getRankKits()->imperial(1);
                break;

            # 250k energy
            case 4:
            case 5:
            case 6:
                $item = EmporiumPrison::getInstance()->getOrbs()->EnergyOrb(250000);
                break;

            # 250k-500k money
            case 7:
            case 8:
            case 9:
            case 10:
                $amount = mt_rand(250000, 500000);
                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money") + $amount);
                $item = VanillaItems::PAPER();
                $item->setCustomName(TF::BOLD . TF::GREEN . "$" . TF::WHITE . Translator::shortNumber($amount));
                break;

            # mystery elite enchants
            case 11:
            case 12:
            case 13:
            case 14:
            case 15:
                $item = EmporiumEnchants::getInstance()->getBooks()->Elite(2);
                break;

            # 100k energy
            case 16:
            case 17:
            case 18:
            case 19:
            case 20:
            case 21:
                $item = EmporiumPrison::getInstance()->getOrbs()->EnergyOrb(100000);
                break;

            # mystery gkit
            case 22:
            case 23:
            case 24:
            case 25:
            case 26:
            case 27:
            case 28:
                $reward = mt_rand(1,4);
                switch($reward) {
                    case 1: # heroic vulkarion
                        $item = EmporiumCore::getInstance()->getGkits()->heroicVulkarion(1);
                        break;

                    case 2: # heroic zenith
                        $item = EmporiumCore::getInstance()->getGkits()->heroicZenith(1);
                        break;

                    case 3: # heroic colossus
                        $item = EmporiumCore::getInstance()->getGkits()->heroicColossus(1);
                        break;

                    case 4: # heroic warlock
                        $item = EmporiumCore::getInstance()->getGkits()->heroicWarlock(1);
                        break;
                }
                break;

            # 50k energy
            case 29:
            case 30:
            case 31:
            case 32:
            case 33:
            case 34:
            case 35:
                $item = EmporiumPrison::getInstance()->getOrbs()->EnergyOrb(50000);
                break;
        }
        $itemName = $item->getCustomName();
        return [$item, $itemName];
    }

    private function getUltimateReward(Player $player, int $reward): array {

        $item = null;

        switch($reward) {

            # rank crystal
            case 1:
                $item = EmporiumCore::getInstance()->getCrystals()->supreme();
                break;

            # rank kit
            case 2:
            case 3:
                $item = EmporiumCore::getInstance()->getRankKits()->supreme(1);
                break;

            # 750k energy
            case 4:
            case 5:
            case 6:
                $item = EmporiumPrison::getInstance()->getOrbs()->EnergyOrb(750000);
                break;

            # 500k-1M money
            case 7:
            case 8:
            case 9:
            case 10:
                $amount = mt_rand(500000, 1000000);
                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money") + $amount);
                $item = VanillaItems::PAPER();
                $item->setCustomName(TF::BOLD . TF::GREEN . "$" . TF::WHITE . Translator::shortNumber($amount));
                break;

            # mystery ultimate enchants
            case 11:
            case 12:
            case 13:
            case 14:
            case 15:
                $item = EmporiumEnchants::getInstance()->getBooks()->Ultimate(2);
                break;

            # 500k energy
            case 16:
            case 17:
            case 18:
            case 19:
            case 20:
            case 21:
                $item = EmporiumPrison::getInstance()->getOrbs()->EnergyOrb(500000);
                break;

            # mystery gkit
            case 22:
            case 23:
            case 24:
            case 25:
            case 26:
            case 27:
            case 28:
                $reward = mt_rand(1,4);
                switch($reward) {
                    case 1: # heroic slaughter
                        $item = EmporiumCore::getInstance()->getGkits()->heroicSlaughter(1);
                        break;

                    case 2: # heroic enchanter
                        $item = EmporiumCore::getInstance()->getGkits()->heroicEnchanter(1);
                        break;

                    case 3: # heroic atheos
                        $item = EmporiumCore::getInstance()->getGkits()->heroicAtheos(1);
                        break;

                    case 4: # heroic warlock
                        $item = EmporiumCore::getInstance()->getGkits()->heroicIapetus(1);
                        break;
                }
                break;

            # 250k energy
            case 29:
            case 30:
            case 31:
            case 32:
            case 33:
            case 34:
            case 35:
                $item = EmporiumPrison::getInstance()->getOrbs()->EnergyOrb(250000);
                break;
        }
        $itemName = $item->getCustomName();
        return [$item, $itemName];
    }

    private function getLegendaryReward(Player $player, int $reward): array {

        $item = null;

        switch($reward) {

            # rank crystal
            case 1:
                $item = EmporiumCore::getInstance()->getCrystals()->majesty();
                break;

            # rank kit
            case 2:
            case 3:
                $item = EmporiumCore::getInstance()->getRankKits()->majesty(1);
                break;

            # 1,250m energy
            case 4:
            case 5:
            case 6:
                $item = EmporiumPrison::getInstance()->getOrbs()->EnergyOrb(1250000);
                break;

            # 500k-1M money
            case 7:
            case 8:
            case 9:
            case 10:
                $amount = mt_rand(1000000, 2000000);
                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money") + $amount);
                $item = VanillaItems::PAPER();
                $item->setCustomName(TF::BOLD . TF::GREEN . "$" . TF::WHITE . Translator::shortNumber($amount));
                break;

            # mystery legendary enchants
            case 11:
            case 12:
            case 13:
            case 14:
            case 15:
                $item = EmporiumEnchants::getInstance()->getBooks()->Legendary(2);
                break;

            # 1m energy
            case 16:
            case 17:
            case 18:
            case 19:
            case 20:
            case 21:
                $item = EmporiumPrison::getInstance()->getOrbs()->EnergyOrb(1000000);
                break;

            # mystery gkit
            case 22:
            case 23:
            case 24:
            case 25:
            case 26:
            case 27:
            case 28:
                $reward = mt_rand(1,4);
                switch($reward) {
                    case 1: # heroic slaughter
                        $item = EmporiumCore::getInstance()->getGkits()->heroicBroteas(1);
                        break;

                    case 2: # heroic enchanter
                        $item = EmporiumCore::getInstance()->getGkits()->heroicAres(1);
                        break;

                    case 3: # heroic atheos
                        $item = EmporiumCore::getInstance()->getGkits()->heroicGrimReaper(1);
                        break;

                    case 4: # heroic warlock
                        $item = EmporiumCore::getInstance()->getGkits()->heroicExecutioner(1);
                        break;
                }
                break;

            # 750k energy
            case 29:
            case 30:
            case 31:
            case 32:
            case 33:
            case 34:
            case 35:
                $item = EmporiumPrison::getInstance()->getOrbs()->EnergyOrb(750000);
                break;
        }
        $itemName = $item->getCustomName();
        return [$item, $itemName];
    }

    private function getGodlyReward(Player $player, int $reward): array {

        $item = null;

        switch($reward) {

            # rank crystal
            case 1:
                $item = EmporiumCore::getInstance()->getCrystals()->emperor();
                break;

            # rank kit
            case 2:
            case 3:
                $item = EmporiumCore::getInstance()->getRankKits()->emperor(1);
                break;

            # 1,750m energy
            case 4:
            case 5:
            case 6:
                $item = EmporiumPrison::getInstance()->getOrbs()->EnergyOrb(1750000);
                break;

            # 2-4M money
            case 7:
            case 8:
            case 9:
            case 10:
                $amount = mt_rand(2000000, 4000000);
                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money") + $amount);
                $item = VanillaItems::PAPER();
                $item->setCustomName(TF::BOLD . TF::GREEN . "$" . TF::WHITE . Translator::shortNumber($amount));
                break;

            # mystery godly enchants
            case 11:
            case 12:
            case 13:
            case 14:
            case 15:
                $item = EmporiumEnchants::getInstance()->getBooks()->Godly(2);
                break;

            # 1.5m energy
            case 16:
            case 17:
            case 18:
            case 19:
            case 20:
            case 21:
                $item = EmporiumPrison::getInstance()->getOrbs()->EnergyOrb(1500000);
                break;

            # mystery gkit
            case 22:
            case 23:
            case 24:
            case 25:
            case 26:
            case 27:
            case 28:
                $reward = mt_rand(1,4);
                switch($reward) {
                    case 1: # heroic slaughter
                        $item = EmporiumCore::getInstance()->getGkits()->Blacksmith(1);
                        break;

                    case 2: # heroic enchanter
                        $item = EmporiumCore::getInstance()->getGkits()->Hero(1);
                        break;

                    case 3: # heroic atheos
                        $item = EmporiumCore::getInstance()->getGkits()->Cyborg(1);
                        break;

                    case 4: # heroic warlock
                        $item = EmporiumCore::getInstance()->getGkits()->Crucible(1);
                        break;
                }
                break;

            # 1.250k energy
            case 29:
            case 30:
            case 31:
            case 32:
            case 33:
            case 34:
            case 35:
                $item = EmporiumPrison::getInstance()->getOrbs()->EnergyOrb(1250000);
                break;
        }
        $itemName = $item->getCustomName();
        return [$item, $itemName];
    }

    private function getHeroicReward(Player $player, int $reward): array {

        $item = null;

        switch($reward) {

            # rank crystal
            case 1:
                $item = EmporiumCore::getInstance()->getCrystals()->president();
                break;

            # rank kit
            case 2:
            case 3:
                $item = EmporiumCore::getInstance()->getRankKits()->president(1);
                break;

            # 2,250m energy
            case 4:
            case 5:
            case 6:
                $item = EmporiumPrison::getInstance()->getOrbs()->EnergyOrb(2250000);
                break;

            # 4-6M money
            case 7:
            case 8:
            case 9:
            case 10:
                $amount = mt_rand(4000000, 6000000);
                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money") + $amount);
                $item = VanillaItems::PAPER();
                $item->setCustomName(TF::BOLD . TF::GREEN . "$" . TF::WHITE . Translator::shortNumber($amount));
                break;

            # mystery heroic enchants
            case 11:
            case 12:
            case 13:
            case 14:
            case 15:
                $item = EmporiumEnchants::getInstance()->getBooks()->Heroic(2);
                break;

            # 2m energy
            case 16:
            case 17:
            case 18:
            case 19:
            case 20:
            case 21:
                $item = EmporiumPrison::getInstance()->getOrbs()->EnergyOrb(2000000);
                break;

            # mystery gkit
            case 22:
            case 23:
            case 24:
            case 25:
            case 26:
            case 27:
            case 28:
                $reward = mt_rand(1, 2);
                switch($reward) {
                    case 1: # heroic slaughter
                        $item = EmporiumCore::getInstance()->getGkits()->Hunter(1);
                        break;

                    case 2: # heroic enchanter
                        $item = EmporiumCore::getInstance()->getGkits()->Crucible(1);
                        break;
                }
                break;

            # 1,750k energy
            case 29:
            case 30:
            case 31:
            case 32:
            case 33:
            case 34:
            case 35:
                $item = EmporiumPrison::getInstance()->getOrbs()->EnergyOrb(1750000);
                break;
        }
        $itemName = $item->getCustomName();
        return [$item, $itemName];
    }
}