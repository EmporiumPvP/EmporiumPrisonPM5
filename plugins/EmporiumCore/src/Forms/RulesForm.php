<?php

namespace Forms;

use Emporium\Prison\library\formapi\SimpleForm;
use pocketmine\player\Player;
use pocketmine\world\sound\EnderChestCloseSound;

class RulesForm {

    public function Form($sender): bool {

        $form = new SimpleForm(function (Player $sender, $data) {
            $result = $data;
            if($result === null) {
                $sender->broadcastSound(new EnderChestCloseSound());
                return true;
            }
            if($result == 0) { # EXIT
                $sender->broadcastSound(new EnderChestCloseSound());
            }
            return true;
        });
        $form->setTitle("RulesForms");
        $form->setContent("§7Welcome to Emporium Skyblock.\n§7By joining and playing our server you hereby accept all of these rules and it's punishments.\n§7If you break any of these rules listed below, you will be punished.\n\n§l§cRule 1\n§r§7No duping or attempted duping.\n§l§cRule 2\n§r§7No using any clients or 3rd party software including cheat, hack and pvp clients.\n§l§cRule 3\n§r§7No chat flooding or spamming in chat.\n§l§cRule 4\n§r§7No scamming in trades that use irl items or money.\n§l§cRule 5\n§r§7No begging staff for items, ranks or anything else.\n§l§cRule 6\n§r§7No disrespecting staff.\n§l§cRule 7\n§r§7No abusing bugs, exploits or glitches.\n§l§cRule 8\n§r§7No clicking above 20 cps.\n§l§cRule 9\n§r§7No excessive swearing, cussing or toxicity.\n§l§cRule 10\n§r§7No racism or sexism.\n§l§cRule 11\n§r§7No threatening players including blackmail, ddos threats, ddox threats, etc.\n§l§cRule 12\n§r§7No using alts for redeeming and other similar purposes.\n§l§cRule 13\n§r§7No lying to staff members.");
        $form->addButton("Exit");
        $sender->sendForm($form);
        return true;

    } # END OF EXECUTE

}