<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PandaAPI {
    public function __construct() {
        // Todo: Get the API key from the model, if it exists
        $this->apikey = null;
    }
    private function getKey() {
        if (is_null($this->apikey)) {
            // Todo: Get the API key from the server
            $this->apikey = $this->genNewKey();
        }
        return $this->apikey;
    }
    private function genNewKey() {
        return "";
    }
    // Purchase a box
    // Returns an array of "part" objects, or null on failure
    public function buyPartBox() {
        $response = file_get_contents('https://umbrella.jlparry.com/work/buybox?key=' . $this->getKey());
        $wordlist = explode(" ", $response);
        if ($response == false || $wordlist[0] == "Oops:") {
            return null;
        }
        return json_decode($response);
    }
    // Get any built parts
    // Returns an array of "part" objects
    public function getBuiltParts() {
        $response = file_get_contents('https://umbrella.jlparry.com/work/mybuilds?key=' . $this->getKey());
        $wordlist = explode(" ", $response);
        if ($response == false || $wordlist[0] == "Oops:") {
            return null;
        }
        return json_decode($response);
    }
    // Sell a bot
    // Pass in the robot object
    // Returns the money received if the bot is successfully sold, 0 if it wasn't
    public function sellBot(&$bot) {
        $head = $bot->head;
        $torso = $bot->torso;
        $bottom = $bot->bottom;
        $response = file_get_contents('https://umbrella.jlparry.com/work/buymybot/'
                . $head . '/'
                . $torso . '/'
                . $bottom . '?key=' . $this->getKey());
        if ($response == false) {
            return 0;
        }
        $bot->sold = true;
        $wordlist = explode(" ", $response);
        if ($wordlist[0] != "Ok") {
            return 0;
        }
        
        return $wordlist[1];
    }
    // Reboots the plant
    // Returns true on success, false on failure
    public function reboot() {
        $response = file_get_contents('https://umbrella.jlparry.com/work/rebootme?key=' . $this->getKey());
        return $response == "Ok";
    }
    // Checks who the user is
    // Returns the name of the plant, null on failure
    public function whoAmI() {
        $response = file_get_contents('https://umbrella.jlparry.com/info/whoami?key=' . $this->getKey());
        $wordlist = explode(" ", $response);
        if ($response == false || $wordlist[0] == "Oops:") {
            return null;
        }
        return $response;
    }
    // Gets part info based on the passed in certificate
    // Returns null on failure
    public function getPartInfo($cert) {
        $response = file_get_contents('https://umbrella.jlparry.com/info/verify/' . $cert);
        $wordlist = explode(" ", $response);
        if ($response == false || $wordlist[0] == "Oops:") {
            return null;
        }
        return json_decode($response);
    }
    // Recycles the passed in array of parts objects
    // Returns the money made on success, 0 on failure
    public function recycle(&$parts) {
        $partBuf = array();
        $sales = 0;
        foreach($parts as &$part) {
            $partBuf[] = $part;
            if (count($partBuf) >= 3) {
                $sales += $this->recycleOnce($partBuf[0], $partBuf[1], $partBuf[2]);
                $partBuf = array();
            }
        }
        if (count($partBuf) == 2) {
            $sales += $this->recycleOnce($partBuf[0], $partBuf[1]);
        }
        else if (count($partBuf) == 1) {
            $sales += $this->recycleOnce($partBuf[0]);
        }
        
        return $sales;
    }
    private function recycleOnce(&$part1, &$part2 = null, &$part3 = null) {
        $recStr = $part1->id;
        $part1->used = true;
        if (!is_null($part2)) {
            $recStr .= '/' . $part2->id;
            $part2->used = true;
        }
        if (!is_null($part3)) {
            $recStr .= '/' . $part3->id;
            $part3->used = true;
        }
        $response = file_get_contents('https://umbrella.jlparry.com/work/recycle/' . $recStr . '?key=' . $this->getKey());
        if ($response == false) {
            return 0;
        }
        $wordlist = explode(" ", $response);
        if ($wordlist[0] != "Ok") {
            return 0;
        }
        return $wordlist[1];
    }
    // Invalidates the API key
    public function endSession() {
        $response = file_get_contents('https://umbrella.jlparry.com/work/goodbye?key=' . $this->getKey());
        return $response == "Ok";
    }
    // Gets a team's balance
    // Returns null on failure
    public function getBalance($team) {
        $response = file_get_contents('https://umbrella.jlparry.com/info/balance/' . $team);
        $wordlist = explode(" ", $response);
        return $wordlist[0] != "Oops:" && $response != false ? $response : null;
    }
    // Gets the scoop on a team (in an object)
    // Returns null on failure, an object on success
    public function getScoop($team) {
        $response = file_get_contents('https://umbrella.jlparry.com/info/scoop/' . $team);
        $wordlist = explode(" ", $response);
        if ($response == false || $wordlist[0] == "Oops:") {
            return null;
        }
        return json_decode($response);
    }
    // Get who makes a particular part type
    // Returns null on failure, array of strings on success
    public function whoMakes($part) {
        $response = file_get_contents('https://umbrella.jlparry.com/info/whomakes/' . $part);
        $wordlist = explode(" ", $response);
        if ($response == false || $wordlist[0] == "Oops:") {
            return null;
        }
        $response = preg_replace("/[\"\\[\\]]/", "", $response);
        return explode(",", $response);
    }
    // Gets the job of a particular factory
    // Returns null on failure, string on success
    public function getJob($team) {
        $response = file_get_contents('https://umbrella.jlparry.com/info/job/' . $team);
        $wordlist = explode(" ", $response);
        return $wordlist[0] != "Oops:" && $response != false ? $response : null;
    }
    // Get all of the teams participating
    // Returns an array of team names on success, null on failure
    public function getTeams() {
        $response = file_get_contents('https://umbrella.jlparry.com/info/teams');
        $wordlist = explode(" ", $response);
        if ($response == false || $wordlist[0] == "Oops:") {
            return null;
        }
        $response = preg_replace("/[\"\\[\\]]/", "", $response);
        return explode(",", $response);
    }
}