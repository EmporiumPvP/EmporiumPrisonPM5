<?php

namespace Emporium\Prison\Menus;

use customiesdevs\customies\item\CustomiesItemFactory;

use Emporium\Prison\Managers\misc\Translator;
use Emporium\Prison\Managers\misc\Utils;

use EmporiumCore\EmporiumCore;
use EmporiumData\ServerManager;

use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\DeterministicInvMenuTransaction;
use muqsit\invmenu\type\InvMenuTypeIds;

use pocketmine\block\utils\MobHeadType;
use pocketmine\block\VanillaBlocks;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use pocketmine\scheduler\ClosureTask;
use pocketmine\utils\TextFormat as TF;

class Events
{

    private int $oneHour = 3600;

    public function Menu(Player $player): void
    {

        $menu = InvMenu::create(InvMenuTypeIds::TYPE_CHEST);

        $menu->setName("Events");
        $menu->setListener(InvMenu::readonly(function (DeterministicInvMenuTransaction $transaction) {

        }));
        $this->evaluateItems($menu, $player);

        # send inventory
        $menu->send($player);

        $task = new ClosureTask(function () use ($menu, $player) {
            $this->evaluateItems($menu, $player);
        });

        $menu->setInventoryCloseListener(function (Player $player, Inventory $inventory) use ($task) {
            if (!is_null($task->getHandler())) $task->getHandler()->cancel();
        });

        EmporiumCore::getInstance()->getScheduler()->scheduleRepeatingTask($task, 3);
    }

    private function meteorEventItem(): Item
    {
        $item = VanillaBlocks::NETHER_QUARTZ_ORE()->asItem();

        $timer = ($this->oneHour / 2) - ServerManager::getInstance()->getData("events.meteor");

        $item->setCustomName(TF::BOLD . TF::RED . "Meteors");
        $lore = [
            TF::EOL,
            TF::GRAY . "Meteors are special world",
            TF::GRAY . "events that happen every 30",
            TF::GRAY . "minutes!",
            TF::GRAY . "When a meteor spawns the location",
            TF::GRAY . "will be broadcasted in chat",
            TF::EOL,
            TF::GRAY . "Meteors are filled with XP and",
            TF::GRAY . "can drop Contraband",
            TF::EOL,
            TF::BOLD . TF::RED . "NEXT EVENT IN:",
            TF::WHITE . Translator::timeConvert($timer)
        ];
        $item->setLore($lore);
        return $item;
    }

    private function eliteBanditItem(): Item
    {

        $item = VanillaItems::IRON_SWORD();

        $timer = ($this->oneHour) - ServerManager::getInstance()->getData("events.bandit_spawn");

        $item->setCustomName(TF::BOLD . TF::YELLOW . "Elite Bandits");
        $lore = [
            TF::EOL,
            TF::GRAY . "Elite bandits are roaming NPC's",
            TF::GRAY . "that spawn in the overworld and",
            TF::GRAY . "are based on the tiered zone",
            TF::GRAY . "they in E.G: Chain",
            TF::GRAY . "Bandits spawn in the Chain Zone",
            TF::GRAY . "only! Kill them to be",
            TF::GRAY . "guaranteed some cash",
            TF::GRAY . "and energy and a chance",
            TF::GRAY . "at some extra rare loot!",
            TF::EOL,
            TF::BOLD . TF::YELLOW . "NEXT EVENT IN:",
            TF::WHITE . Translator::timeConvert($timer)
        ];
        $item->setLore($lore);
        return $item;
    }

    private function kothItem(): Item
    {
        $item = VanillaItems::DIAMOND_SWORD();

        $timer = 57473;

        $item->setCustomName(TF::BOLD . TF::LIGHT_PURPLE . "KOTH");
        $lore = [
            TF::EOL,
            TF::GRAY . "** Emporium Prison KOTH is held",
            TF::GRAY . "at set times every day of the",
            TF::GRAY . "week. KOTH, or ''King of",
            TF::GRAY . "the Hill'' is a popular",
            TF::GRAY . "factions minigame where players",
            TF::GRAY . "compete for control of a",
            TF::GRAY . "central capturable region. If",
            TF::GRAY . "you can keep control of the",
            TF::GRAY . "region for 15 minutes,",
            TF::GRAY . "you will be rewarded with some",
            TF::GRAY . "of the best loot",
            TF::GRAY . "available in the",
            TF::GRAY . "Universe. Use /koth loot",
            TF::GRAY . "to view an example reward.",
            TF::EOL,
            TF::BOLD . TF::LIGHT_PURPLE . "NEXT EVENT IN:",
            TF::WHITE . Translator::timeConvert($timer)
        ];
        $item->setLore($lore);
        return $item;
    }

    private function prisonBreakItem(): Item
    {
        $item = VanillaItems::DIAMOND_PICKAXE();

        $timer = ($this->oneHour * 3) - ServerManager::getInstance()->getData("events.prison_break");

        $item->setCustomName(TF::BOLD . TF::GREEN . "Prison Break");
        $lore = [
            TF::EOL,
            TF::GRAY . "Prison break goes back to the",
            TF::GRAY . "basics of Prisons! Mine blocks",
            TF::GRAY . "with a bonus XP Buff and",
            TF::GRAY . "compete with other Prisoners in",
            TF::GRAY . "a PvP disabled mine for the top",
            TF::GRAY . "spot!",
            TF::EOL,
            TF::BOLD . TF::GREEN . "NEXT EVENT IN:",
            TF::WHITE . Translator::timeConvert($timer)
        ];
        $item->setLore($lore);
        return $item;
    }

    private function alienInvasionItem(): Item
    {
        $item = VanillaBlocks::SLIME()->asItem();

        $timer = 49248948;

        $item->setCustomName(TF::BOLD . TF::GOLD . "Alien Invasion");
        $lore = [
            TF::EOL,
            TF::GRAY . "Alien invasions is a world wide",
            TF::GRAY . "event that occurs every 6",
            TF::GRAY . "hours! Just before the Invasion",
            TF::GRAY . "begins you will see an",
            TF::GRAY . "announcement in the chat",
            TF::GRAY . "telling you what tier of",
            TF::GRAY . "invasion is about to happen and",
            TF::GRAY . "the coords, Kill all the waves",
            TF::GRAY . "of Aliens to cause the Ship to",
            TF::GRAY . "crash and its GODLY",
            TF::GRAY . "treasures to spill around",
            TF::GRAY . "you to be looted!",
            TF::EOL,
            TF::BOLD . TF::GOLD . "NEXT EVENT IN:",
            TF::WHITE . Translator::timeConvert($timer)
        ];
        $item->setLore($lore);
        return $item;
    }

    private function bossItem(): Item
    {
        $item = VanillaBlocks::MOB_HEAD()->setMobHeadType(MobHeadType::DRAGON())->asItem();

        $timer = ($this->oneHour * 6) - ServerManager::getInstance()->getData("events.boss_spawn");

        $item->setCustomName(TF::BOLD . TF::GOLD . "Bosses");
        $lore = [
            TF::EOL,
            TF::GRAY . "A random boss will spawn",
            TF::GRAY . "every 6 hours",
            TF::EOL,
            TF::BOLD . TF::GOLD . "NEXT EVENT IN:",
            TF::WHITE . Translator::timeConvert($timer)
        ];
        $item->setLore($lore);
        return $item;
    }

    private function filler(): Item
    {
        $item = CustomiesItemFactory::getInstance()->get("2dglasspanes:pane_lightgrey");
        $item->setCustomName("§r");
        return $item;
    }

    public function evaluateItems(InvMenu $menu, Player $player): void
    {
        # inventory
        $inventory = $menu->getInventory();

        # so getNextCenteredSlot doesnt throw an error (slot is null)
        $inventory->clearAll();

        # add items
        $inventory->setItem(Utils::getNextCenteredSlot($inventory), $this->meteorEventItem());
        $inventory->setItem(Utils::getNextCenteredSlot($inventory), $this->eliteBanditItem());
        $inventory->setItem(Utils::getNextCenteredSlot($inventory), $this->kothItem());
        $inventory->setItem(Utils::getNextCenteredSlot($inventory), $this->prisonBreakItem());
        $inventory->setItem(Utils::getNextCenteredSlot($inventory), $this->alienInvasionItem());
        $inventory->setItem(Utils::getNextCenteredSlot($inventory), $this->bossItem());

        for ($i = 0; $i <= 26; $i++) {
            if ($inventory->isSlotEmpty($i)) {
                $inventory->setItem($i, $this->filler());
            }
        }
    }
}