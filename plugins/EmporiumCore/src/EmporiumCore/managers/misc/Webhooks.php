<?php

namespace EmporiumCore\Managers\Misc;

use pocketmine\scheduler\AsyncTask;

class Webhooks extends AsyncTask {

    private $player, $webhook, $curlopts;

    public function __construct($player, $webhook, $curlopts) {
        $this->player = $player;
        $this->webhook = $webhook;
        $this->curlopts = $curlopts;
    }

    # Webhook Send Task
    public function onRun(): void {

        # Initiate Send
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->webhook);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(unserialize($this->curlopts)));
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($curl);
        $curlerror = curl_error($curl);

        # Create Response
        $responsejson = json_decode($response, true);
        $success = false;
        $error = '';

        # Final Results
        if($curlerror != ""){
            $error = "An unknown error occurred.";
        } elseif (curl_getinfo($curl, CURLINFO_HTTP_CODE) != 204) {
            $error = $responsejson['message'];
        } elseif (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 204 OR $response === ""){
            $success = true;
        }
        $result = ["Response" => $response, "Error" => $error, "success" => $success];
        $this->setResult($result);
    }

}