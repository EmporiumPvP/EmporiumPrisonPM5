<?php

# Namespace
namespace Tetro\EmporiumEnchants\Commands\subcommands;

# Pocketmine API
use pocketmine\command\{CommandSender};

# Used Files
use Emporium\Prison\library\formapi\SimpleForm;
use Emporium\Prison\Managers\misc\Translator;
use pocketmine\player\Player;
use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\Core\CustomEnchantManager;
use CortexPE\Commando\BaseSubCommand;
use Tetro\EmporiumEnchants\Utils\Utils;

class InfoSubCommand extends BaseSubCommand {

    public function onRun(CommandSender $sender, string $aliasUsed, array $args): void {

        if (!$this->testPermissionSilent($sender)) {
            $sender->sendMessage("§cYou do not have permission to use this command.");
            return;
        }

        if (!$sender instanceof Player) {
            $sender->sendMessage("§cYou may only run this command in-game!");
            return;
        }

        $this->sendTypesForm($sender);
    }

    public function getEnchantmentsByType(): array {
        $enchantmentsByType = [];
        foreach (CustomEnchantManager::getEnchantments() as $enchantment) {
            if (!isset($enchantmentsByType[$enchantment->getItemType()])) $enchantmentsByType[$enchantment->getItemType()] = [];
            $enchantmentsByType[$enchantment->getItemType()][] = $enchantment;
        }
        return array_map(function (array $typeEnchants) {
            uasort($typeEnchants, function (CustomEnchant $a, CustomEnchant $b) {
                return strcmp($a->getDisplayName(), $b->getDisplayName());
            });
            return $typeEnchants;
        }, $enchantmentsByType);
    }

    public function sendTypesForm(Player $player): void {
        $enchantmentsByType = $this->getEnchantmentsByType();
        $form = new SimpleForm(function (Player $player, ?int $data) use ($enchantmentsByType): void {
            if ($data === null) {
                return;
            }
            if ($data === count($enchantmentsByType)) {
                return;
            }
            $type = array_keys($enchantmentsByType)[$data];
            $this->sendEnchantsForm($player, $type);
        });
        $form->setTitle("Custom Enchants Info");
        foreach ($enchantmentsByType as $type => $enchantments) {
            $form->addButton(Utils::TYPE_NAMES[$type]);
        }
        $form->addButton("§4Close");
        $player->sendForm($form);
    }

    public function sendEnchantsForm(Player $player, int $type): void {
        $enchantmentsByType = $this->getEnchantmentsByType();
        $enchantForm = new SimpleForm(function (Player $player, ?int $data) use ($type, $enchantmentsByType): void {
            if ($data === null) {
                return;
            }
            if ($data === count($enchantmentsByType[$type])) {
                $this->sendTypesForm($player);
                return;
            }
            $form = new SimpleForm(function (Player $player, ?int $data) use ($type): void {
                if ($data === null) {
                    return;
                }
                $this->sendEnchantsForm($player, $type);
            });
            /** @var CustomEnchant $selectedEnchantment */
            $enchant = array_values($enchantmentsByType[$type])[$data];
            // Create CE Stuff
            $information = (
                "§l§b" . Utils::getColorFromRarity($enchant->getRarity()) . $enchant->getDisplayName() .
                "\n§r§7" . $enchant->getDescription() .
                "\n" .
                "\n§l§8* §r§7Rarity: " . Utils::getColorFromRarity($enchant->getRarity()) . Utils::RARITY_NAMES[$enchant->getRarity()] .
                "\n§l§8* §r§7Maximum Enchant Level: §f" . Translator::romanNumber($enchant->getMaxLevel()) .
                "\n§l§8* §r§7Works on: §f" . Utils::TYPE_NAMES[$enchant->getItemType()]
            );
            // Form Stuff
            $form->setTitle("Custom Enchants Info");
            $form->setContent($information);
            $form->addButton("§cBack");
            $player->sendForm($form);
        });
        $enchantForm->setTitle("Custom Enchants Info");
        foreach ($enchantmentsByType[$type] as $enchantment) {
            $enchantForm->addButton("{$enchantment->getDisplayName()}");
        }
        $enchantForm->addButton("§cBack");
        $player->sendForm($enchantForm);
    }

    protected function prepare(): void
    {
        $this->setPermission("emporiumenchants.command.info");
    }

    public function getPermission()
    {
        // TODO: Implement getPermission() method.
    }
}