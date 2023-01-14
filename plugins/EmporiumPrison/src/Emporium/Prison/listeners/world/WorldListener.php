<?php

namespace Emporium\Prison\listeners\world;

use Emporium\Prison\Loader;
use Emporium\Prison\Managers\DataManager;
use Emporium\Prison\tasks\BedrockSpawnTask;
use Emporium\Prison\tasks\OreRegenTask;
use Emporium\Prison\Variables;

use JsonException;
use pocketmine\block\BlockLegacyIds;
use pocketmine\block\VanillaBlocks;

use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;

use pocketmine\item\Durable;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;

class WorldListener implements Listener {

    private array $buildProtectedWorlds = ["CoalMine", "IronMine", "LapisMine", "RedstoneMine", "GoldMine", "DiamondMine", "EmeraldMine", "TutorialMine"];
    private array $pvpProtectedWorlds = ["CoalMine", "IronMine", "LapisMine", "RedstoneMine", "GoldMine", "DiamondMine", "EmeraldMine", "TutorialMine"];
    private array $fallDamageProtectedWorlds = ["CoalMine", "IronMine", "LapisMine", "RedstoneMine", "GoldMine", "DiamondMine", "EmeraldMine", "TutorialMine"];
    private array $ores = [BlockLegacyIds::COAL_ORE, BlockLegacyIds::IRON_ORE, BlockLegacyIds::LAPIS_ORE, BlockLegacyIds::REDSTONE_ORE, BlockLegacyIds::LIT_REDSTONE_ORE, BlockLegacyIds::GOLD_ORE, BlockLegacyIds::DIAMOND_ORE, BlockLegacyIds::EMERALD_ORE];

    private Loader $plugin;

    public function __construct(Loader $plugin) {
        $this->plugin = $plugin;
    }

    /**
     * @throws JsonException
     */
    public function onBlockBreak(BlockBreakEvent $event) {

        # world protection
        $world = $event->getPlayer()->getWorld()->getFolderName();
        $player = $event->getPlayer();
        $blockId = $event->getBlock()->getId();

        if(in_array($world, $this->buildProtectedWorlds)) {
            if(!in_array($blockId, $this->ores)) {
                $event->cancel();
                $player->sendMessage(Variables::ERROR_PREFIX . "You can not do that!");
            }
        }

        # ore regen
        $block = $event->getBlock();
        $blockId = $block->getId();
        $blockPosition = $block->getPosition();
        $placeHolder = VanillaBlocks::BEDROCK();
        $playerLevel = DataManager::getData($player, "Players", "level");
        $item = $event->getPlayer()->getInventory()->getItemInHand();
        $itemUsed = $event->getPlayer()->getInventory()->getItemInHand()->getId();
        $woodenPickaxe = 270;
        $stonePickaxe = 274;
        $ironPickaxe = 257;
        $diamondPickaxe = 278;

        if(in_array($blockId, $this->ores)) {
            if($event->isCancelled()) {
                return;
            }
            switch($blockId) {

                case BlockLegacyIds::COAL_ORE: # 16 (wooden pickaxe required to break)
                    if($itemUsed != $woodenPickaxe) {
                        $event->cancel();
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "You can only use a" . TF::GREEN . " Wooden Pickaxe" . TF::RED . " here!");
                        $event->setDrops([]);
                        $event->setXpDropAmount(0);
                    } else {
                        $this->plugin->getScheduler()->scheduleDelayedTask(new BedrockSpawnTask($block, $placeHolder, $blockPosition), 1);
                        $this->plugin->getScheduler()->scheduleDelayedTask(new OreRegenTask($block, $blockPosition), 20 * 60);
                        DataManager::addData($player, "Players", "xp", 2);
                        DataManager::addData($player, "Players", "coal-ore-mined", 1);
                        $player->sendTip("+1 xp");
                        # auto pickup (block)
                        foreach ($event->getDrops() as $drop) {
                            if($player->getInventory()->canAddItem($drop)) {
                                if($event->isCancelled()) {
                                    $event->setDrops([]);
                                    return;
                                } else {
                                    $event->setDrops([]);
                                    $event->getPlayer()->getInventory()->addItem($drop);
                                }
                            } else {
                                $event->setDrops([]);
                                $player->sendTitle(TF::DARK_RED . "Inventory Full!");
                            }
                        }
                        # auto pickup (xp)
                        $player->getXpManager()->addXp($event->getXpDropAmount());
                        $event->setXpDropAmount(0);
                    }
                    break;

                case BlockLegacyIds::IRON_ORE: # 15 (stone pickaxe required to break)
                    if($itemUsed != $stonePickaxe) {
                        $event->cancel();
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "You can only use a" . TF::GREEN . " Stone Pickaxe" . TF::RED . " here!");
                        $event->setDrops([]);
                        $event->setXpDropAmount(0);
                    } else {
                        if($playerLevel < 5) {
                            $event->cancel();
                            $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your player" . TF::GOLD . " /level" . TF::RED . " is too low!");
                        } else {
                            $this->plugin->getScheduler()->scheduleDelayedTask(new BedrockSpawnTask($block, $placeHolder, $blockPosition), 1);
                            $this->plugin->getScheduler()->scheduleDelayedTask(new OreRegenTask($block, $blockPosition), 20 * 60);
                            DataManager::addData($player, "Players", "xp", 2);
                            DataManager::addData($player, "Players", "iron-ore-mined", 1);
                            $player->sendTip("+2 xp");
                            # auto pickup (blocks)
                            foreach ($event->getDrops() as $drop) {
                                if($player->getInventory()->canAddItem($drop)) {
                                    if($event->isCancelled()) {
                                        $event->setDrops([]);
                                        return;
                                    } else {
                                        $event->setDrops([]);
                                        $event->getPlayer()->getInventory()->addItem($drop);
                                    }
                                } else {
                                    $event->setDrops([]);
                                    $player->sendTitle(TF::DARK_RED . "Inventory Full!");
                                }
                            }
                            # auto pickup (xp)
                            $player->getXpManager()->addXp($event->getXpDropAmount());
                            $event->setXpDropAmount(0);
                        }
                    }
                    break;

                case BlockLegacyIds::REDSTONE_ORE: # 73
                case BlockLegacyIds::LIT_REDSTONE_ORE: # 74 (stone pickaxe required to break)
                    if($itemUsed != $stonePickaxe) {
                        $event->cancel();
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "You can only use a" . TF::GREEN . " Stone Pickaxe" . TF::RED . " here!");
                        $event->setDrops([]);
                        $event->setXpDropAmount(0);
                    } else {
                        if($playerLevel < 10) {
                            $event->cancel();
                            $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your player" . TF::GOLD . " /level" . TF::RED . " is too low!");
                        } else {
                            $this->plugin->getScheduler()->scheduleDelayedTask(new BedrockSpawnTask($block, $placeHolder, $blockPosition), 1);
                            $this->plugin->getScheduler()->scheduleDelayedTask(new OreRegenTask($block, $blockPosition), 20 * 60);
                            DataManager::addData($player, "Players", "xp", 3);
                            DataManager::addData($player, "Players", "redstone-ore-mined", 1);
                            $player->sendTip("+3 xp");
                            # auto pickup (blocks)
                            foreach ($event->getDrops() as $drop) {
                                if($player->getInventory()->canAddItem($drop)) {
                                    if($event->isCancelled()) {
                                        $event->setDrops([]);
                                        return;
                                    } else {
                                        $event->setDrops([]);
                                        $event->getPlayer()->getInventory()->addItem($drop);
                                    }
                                } else {
                                    $event->setDrops([]);
                                    $player->sendTitle(TF::DARK_RED . "Inventory Full!");
                                }
                            }
                            # auto pickup (xp)
                            $player->getXpManager()->addXp($event->getXpDropAmount());
                            $event->setXpDropAmount(0);
                        }
                    }
                    break;

                case BlockLegacyIds::LAPIS_ORE: # 21 (iron pickaxe required to break)
                    if($itemUsed != $ironPickaxe) {
                        $event->cancel();
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "You can only use a" . TF::GREEN . " Iron Pickaxe" . TF::RED . " here!");
                        $event->setDrops([]);
                        $event->setXpDropAmount(0);
                    } else {
                        if($playerLevel < 15) {
                            $event->cancel();
                            $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your player" . TF::GOLD . " /level" . TF::RED . " is too low!");
                        } else {
                            $this->plugin->getScheduler()->scheduleDelayedTask(new BedrockSpawnTask($block, $placeHolder, $blockPosition), 1);
                            $this->plugin->getScheduler()->scheduleDelayedTask(new OreRegenTask($block, $blockPosition), 20 * 60);
                            DataManager::addData($player, "Players", "xp", 4);
                            DataManager::addData($player, "Players", "lapis-ore-mined", 1);
                            $player->sendTip("+4 xp");
                            # auto pickup (blocks)
                            foreach ($event->getDrops() as $drop) {
                                if($player->getInventory()->canAddItem($drop)) {
                                    if($event->isCancelled()) {
                                        $event->setDrops([]);
                                        return;
                                    } else {
                                        $event->setDrops([]);
                                        $event->getPlayer()->getInventory()->addItem($drop);
                                    }
                                } else {
                                    $event->setDrops([]);
                                    $player->sendTitle(TF::DARK_RED . "Inventory Full!");
                                }
                            }
                            # auto pickup (blocks)
                            $player->getXpManager()->addXp($event->getXpDropAmount());
                            $event->setXpDropAmount(0);
                        }
                    }
                    break;

                case BlockLegacyIds::GOLD_ORE: # 14 (iron pickaxe required to break)
                    if($itemUsed != $ironPickaxe) {
                        $event->cancel();
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "You can only use a" . TF::GREEN . " Iron Pickaxe" . TF::RED . " here!");
                        $event->setDrops([]);
                        $event->setXpDropAmount(0);
                    } else {
                        if($playerLevel < 20) {
                            $event->cancel();
                            $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your player" . TF::GOLD . " /level" . TF::RED . " is too low!");
                        } else {
                            $this->plugin->getScheduler()->scheduleDelayedTask(new BedrockSpawnTask($block, $placeHolder, $blockPosition), 1);
                            $this->plugin->getScheduler()->scheduleDelayedTask(new OreRegenTask($block, $blockPosition), 20 * 120);
                            DataManager::addData($player, "Players", "xp", 5);
                            DataManager::addData($player, "Players", "gold-ore-mined", 1);
                            $player->sendTip("+5 xp");
                            # auto pickup (blocks)
                            foreach ($event->getDrops() as $drop) {
                                if($player->getInventory()->canAddItem($drop)) {
                                    if($event->isCancelled()) {
                                        $event->setDrops([]);
                                        return;
                                    } else {
                                        $event->setDrops([]);
                                        $event->getPlayer()->getInventory()->addItem($drop);
                                    }
                                } else {
                                    $event->setDrops([]);
                                    $player->sendTitle(TF::DARK_RED . "Inventory Full!");
                                }
                            }
                            # auto pickup (xp)
                            $player->getXpManager()->addXp($event->getXpDropAmount());
                            $event->setXpDropAmount(0);
                        }
                    }
                    break;

                case BlockLegacyIds::DIAMOND_ORE: # 56 (diamond pickaxe required to break)
                    if($itemUsed != $diamondPickaxe) {
                        $event->cancel();
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "You can only use a" . TF::GREEN . " Diamond Pickaxe" . TF::RED . " here!");
                        $event->setDrops([]);
                        $event->setXpDropAmount(0);
                    } else {
                        if($playerLevel < 25) {
                            $event->cancel();
                            $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your player" . TF::GOLD . " /level" . TF::RED . " is too low!");
                        } else {
                            $this->plugin->getScheduler()->scheduleDelayedTask(new BedrockSpawnTask($block, $placeHolder, $blockPosition), 1);
                            $this->plugin->getScheduler()->scheduleDelayedTask(new OreRegenTask($block, $blockPosition), 20 * 120);
                            DataManager::addData($player, "Players", "xp", 6);
                            DataManager::addData($player, "Players", "diamond-ore-mined", 1);
                            $player->sendTip("+6 xp");
                            # auto pickup (blocks)
                            foreach ($event->getDrops() as $drop) {
                                if($player->getInventory()->canAddItem($drop)) {
                                    if($event->isCancelled()) {
                                        $event->setDrops([]);
                                        return;
                                    } else {
                                        $event->setDrops([]);
                                        $event->getPlayer()->getInventory()->addItem($drop);
                                    }
                                } else {
                                    $event->setDrops([]);
                                    $player->sendTitle(TF::DARK_RED . "Inventory Full!");
                                }
                            }
                            # auto pickup (xp)
                            $player->getXpManager()->addXp($event->getXpDropAmount());
                            $event->setXpDropAmount(0);
                        }
                    }
                    break;

                case BlockLegacyIds::EMERALD_ORE: # 129 (diamond pickaxe required to break)
                    if($itemUsed != $diamondPickaxe) {
                        $event->cancel();
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "You can only use a" . TF::GREEN . " Diamond Pickaxe" . TF::RED . " here!");
                        $event->setDrops([]);
                        $event->setXpDropAmount(0);
                    } else {
                        if($playerLevel < 30) {
                            $event->cancel();
                            $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your player" . TF::GOLD . " /level" . TF::RED . " is too low!");
                        } else {
                            $this->plugin->getScheduler()->scheduleDelayedTask(new BedrockSpawnTask($block, $placeHolder, $blockPosition), 1);
                            $this->plugin->getScheduler()->scheduleDelayedTask(new OreRegenTask($block, $blockPosition), 20 * 120);
                            DataManager::addData($player, "Players", "xp", 7);
                            DataManager::addData($player, "Players", "emerald-ore-mined", 1);
                            $player->sendTip("+7 xp");
                            # auto pickup (blocks)
                            foreach ($event->getDrops() as $drop) {
                                if($player->getInventory()->canAddItem($drop)) {
                                    if($event->isCancelled()) {
                                        $event->setDrops([]);
                                        return;
                                    } else {
                                        $event->setDrops([]);
                                        $event->getPlayer()->getInventory()->addItem($drop);
                                    }
                                } else {
                                    $event->setDrops([]);
                                    $player->sendTitle(TF::DARK_RED . "Inventory Full!");
                                }
                            }
                            # auto pickup (xp)
                            $player->getXpManager()->addXp($event->getXpDropAmount());
                            $event->setXpDropAmount(0);
                        }
                    }
                    break;
            }
            # fix item
            if($item instanceof Durable) {
                $item->setDamage(0);
                $player->getInventory()->setItemInHand($item);
            }
        }
    }

    public function onBlockPlace(BlockPlaceEvent $event) {

        $world = $event->getPlayer()->getWorld();
        $player = $event->getPlayer();

        if(in_array($world->getFolderName(), $this->buildProtectedWorlds)) {
            $event->cancel();
            $player->sendMessage(Variables::ERROR_PREFIX . "You can not do that!");
        }
    }

    public function onAttack(EntityDamageByEntityEvent $event) {

        $entity = $event->getEntity();
        $world = $entity->getWorld();

        if($entity instanceof Player) {
            $player = $entity;
            if(in_array($world->getFolderName(), $this->pvpProtectedWorlds)) {
                $event->cancel();
                $player->sendMessage(Variables::ERROR_PREFIX . "You can not do that!");
            }
        }
    }

    public function onFallDamage(EntityDamageEvent $event) {

        $entity = $event->getEntity();
        $world = $entity->getWorld();
        $cause = $event->getCause();

        if($entity instanceof Player) {
            if($cause === EntityDamageEvent::CAUSE_FALL) {
                if(in_array($world->getFolderName(), $this->fallDamageProtectedWorlds)) {
                    $event->cancel();
                }
            }
        }
    }
}