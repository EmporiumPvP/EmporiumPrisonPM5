<?php

namespace Tetro\EPTutorial\Managers;

use DialogueUIAPI\Yanoox\DialogueUIAPI\DialogueAPI;
use DialogueUIAPI\Yanoox\DialogueUIAPI\element\DialogueButton;
use Emporium\Prison\Managers\DataManager;
use JsonException;
use pocketmine\event\Listener;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\BlazeShootSound;

# particles
# sounds

class TutorialManager implements Listener {

    public function checkPlayerTutorialComplete(Player $player): bool {
        return DataManager::getData($player, "Players", "tutorial-complete");
    }

    public function getPlayerTutorialProgress(Player $player): int {
        return DataManager::getData($player, "Players", "tutorial-progress");
    }

    public function getPlayerTutorialBlocksMined(Player $player): int {
        return DataManager::getData($player, "Players", "tutorial-blocks-mined");
    }

    public function tutorialComplete(Player $player): bool {
        return DataManager::getData($player, "Players", "tutorial-complete");
    }

    /**
     * @throws JsonException
     */
    public function startTutorial(Player $player): void {
        switch($this->getPlayerTutorialProgress($player)) {

            case 0: # tour guide
                $dialogue = DialogueAPI::create(
                    "TourGuideQuest1",
                    "Tour Guide",
                    "Hello " . $player->getName() . " Welcome to Emporium Prison!" . TF::EOL . TF::EOL .
                    "You are in the training area, in this area you will learn about how things work in Emporium Prison." . TF::EOL . TF::EOL .
                    "To get started get your pickaxe from the Tour Guide he can be found at the bottom of the stairs",
                    [DialogueButton::create("Next")
                        ->setHandler(function (Player $player, string $buttonName): void {
                            return;
                    })]);
                $dialogue->displayTo([$player]);
                break;

            case 1: # mining
                $dialogue = DialogueAPI::create(
                    "TourGuideQuest2",
                    "Tour Guide",
                    "You have your pickaxe great! Now the real fun can start." . TF::EOL . TF::EOL .
                            "head down to the mines and start mining, i have a lot of information to share with you",
                    [DialogueButton::create("Next")
                        ->setHandler(function (Player $player, string $buttonName): void {
                            return;
                        })]);
                $dialogue->displayTo([$player]);
                break;

            case 2: # ore exchanger
                $dialogue = DialogueAPI::create(
                    "TourGuideQuest3",
                    "Tour Guide",
                    "When your inventory gets full of ores, you can sell them to the Ore Exchanger at /spawn, /balance shows you how much money you have" . TF::EOL . TF::EOL .
                            "Now i need you to go talk to the Ore Exchanger, you can find him to the right of spawn",
                    [DialogueButton::create("Next")
                        ->setHandler(function (Player $player, string $buttonName): void {
                            return;
                        })]);
                $dialogue->displayTo([$player]);
                break;

            case 3: # fill pickaxe energy
                $dialogue = DialogueAPI::create(
                    "TourGuideQuest4",
                    "Tour Guide",
                    "You will need to save up your money in order to purchase upgrades and other items in the future." . TF::EOL . TF::EOL .
                            " Now i need you to go back to the mine and fill your pickaxes' Energy. When you have done that i will have another Task for you to complete",
                    [DialogueButton::create("Next")
                        ->setHandler(function (Player $player, string $buttonName): void {
                            return;
                        })]);
                $dialogue->displayTo([$player]);
                break;

            case 4: # worm hole
                $dialogue = DialogueAPI::create(
                    "TourGuideQuest5",
                    "Tour Guide",
                    "Great you have filled up your Pickaxes' energy, Energy is used to level up and enchant your pickaxe." . TF::EOL . TF::EOL .
                            "For more Information on Enchanting, make sure to run /help" . TF::EOL . TF::EOL .
                            "I need you to go to the Wormhole and Drop your pickaxe to start forging it, you can find the Wormhole just to the left of spawn",
                    [DialogueButton::create("Next")
                        ->setHandler(function (Player $player, string $buttonName): void {
                            return;
                        })]);
                $dialogue->displayTo([$player]);
                break;

            case 5: # tutorial complete
                $dialogue = DialogueAPI::create(
                    "TourGuideQuest6",
                    "Tour Guide",
                    "Congrats! You have completed the tutorial, to gain access to the Space Shuttle you will need to reach Level 10." . TF::EOL . TF::EOL .
                            "If you want to learn more about Emporium Prison while you are still here make sure to run /help",
                    [DialogueButton::create("Next")
                        ->setHandler(function (Player $player, string $buttonName): void {
                            return;
                        })]);
                $dialogue->displayTo([$player]);
                break;

            case 6:
                $playerLevel = DataManager::getData($player, "Players", "level");
                # set player tutorial complete if Data is correct
                if($playerLevel === 10) {
                    DataManager::setData($player, "Players", "tutorial-complete", true);
                    $dialogue = DialogueAPI::create(
                        "TourGuideQuest7",
                        "Tour Guide",
                        "You have reached Level 10, and now have access to the Space Station" . TF::EOL . TF::EOL .
                                "To travel to the Yard, speak to the Ship Captain. He can be found to the left of spawn next to the Ship",
                        [DialogueButton::create("Next")
                            ->setHandler(function (Player $player, string $buttonName): void {
                                return;
                            })]);
                    $dialogue->displayTo([$player]);
                }
                break;
        }
        $player->broadcastSound(new BlazeShootSound());
    }
}