<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PandaAPI {
    /*
        public function __construct()
        The constructor for PandaAPI
        Sets up initial variables
    */
    public function __construct() {
        $this->apikey = null;
    }
    
    /*
        public function getKey()
        Gets the key currently being used by PandaAPI
        
        Returns the key being used, or null if there is no key
    */
    public function getKey() {
        return $this->apikey;
    }
    
    /*
        public function genKey($team, $pass)
        Generates a key for the API
        
        $team -> The team to generate the key for
        $pass -> The "super secret" password for the team
        
        Returns the generated key on successfully generating a new key, null otherwise
    */
    private function genKey($team, $pass) {
        return "";
    }
    
    /*
        public function updateKey($team, $pass)
        Checks whether the key is invalid, and if it is generate a new key
        
        $team -> The team to generate the key for (if we need to generate a new one)
        $pass -> The "super secret" password for the team (if we need to generate a new one)
        
        Returns the new key if a new key was generated, the old key if the old one is still valid, null if something went wrong
    */
    private function refreshKey($team, $pass) {
        return $this->apikey;
    }
    
    /*
        public function buyPartBox()
        Purchase a part box from Panda
        Note: a box costs $100
        
        Returns an array of objects (the parts purchased) on success, null on failure
    */
    public function buyPartBox() {
        $response = file_get_contents('https://umbrella.jlparry.com/work/buybox?key=' . $this->getKey());
        $wordlist = explode(" ", $response);
        if ($response == false || $wordlist[0] == "Oops:") {
            return null;
        }
        return json_decode($response);
    }

    /*
        public function getBuiltParts()
        Gets any parts built by this factory since the last time built parts were retrieved
        A part is made every 10 seconds
        Panda will hold up to 10 parts at a time to be sent through this method.
        
        Returns an array of objects (the parts built) on success, null on failure
    */
    public function getBuiltParts() {
        $response = file_get_contents('https://umbrella.jlparry.com/work/mybuilds?key=' . $this->getKey());
        $wordlist = explode(" ", $response);
        if ($response == false || $wordlist[0] == "Oops:") {
            return null;
        }
        return json_decode($response);
    }
    
    /*
        public function sellBot(&$bot)
        Sells a robot to Panda.
        Note: On failure, the robot may still disappear. Check the robot's "sold" value afterward calling to determine this.
        
        &$bot -> The bot to sell
        
        Returns the amount of money received from selling the bot on success, null on failure
    */
    public function sellBot(&$bot) {
        $head = $bot->head;
        $torso = $bot->torso;
        $bottom = $bot->bottom;
        $response = file_get_contents('https://umbrella.jlparry.com/work/buymybot/'
                . $head . '/'
                . $torso . '/'
                . $bottom . '?key=' . $this->getKey());
        if ($response == false) {
            return null;
        }
        $bot->sold = true;
        $wordlist = explode(" ", $response);
        if ($wordlist[0] != "Ok") {
            return null;
        }
        
        return $wordlist[1];
    }

    /*
        public function reboot()
        Reboots this factory.
        This will reset this factory's settings to the starting settings. 
        
        Returns true on success, false on failure
    */
    public function reboot() {
        $response = file_get_contents('https://umbrella.jlparry.com/work/rebootme?key=' . $this->getKey());
        return $response == "Ok";
    }
    
    /*
        public function whoAmI()
        Checks who the currently used API key belongs to.
        
        Returns the name of the factory on success, null on failure.
    */
    public function whoAmI() {
        $response = file_get_contents('https://umbrella.jlparry.com/info/whoami?key=' . $this->getKey());
        $wordlist = explode(" ", $response);
        if ($response == false || $wordlist[0] == "Oops:") {
            return null;
        }
        return $response;
    }

    /*
        public function getPartInfo($cert)
        Gets the part info associated with a certificate.
        
        Returns an object containing the part info on success, null on failure
    */
    public function getPartInfo($cert) {
        $response = file_get_contents('https://umbrella.jlparry.com/info/verify/' . $cert);
        $wordlist = explode(" ", $response);
        if ($response == false || $wordlist[0] == "Oops:") {
            return null;
        }
        return json_decode($response);
    }

    /*
        public function recycle(&$parts)
        Recycles a number of parts for cash value.
        
        &$parts -> An array of parts objects, which require an id to be sold
        
        Returns the money received from recycling the parts
        Since under the covers this works in "chunks", the return value has no relation to the errors that may have occurred
    */
    public function recycle(&$parts) {
        $partBuf = array();
        $sales = 0;
        foreach($parts as &$part) {
            $partBuf[] = $part;
            if (count($partBuf) >= 3) {
                $sale = $this->recycleOnce($partBuf[0], $partBuf[1], $partBuf[2]);
                if (!is_null($sale)) {
                    $sales += $sale;
                }
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
    
    /*
        private function recycleOnce(&$part1, [&$part2, &$part3])
        Recycles up to three parts for cash falue
        
        &$part1 -> The first part to be sold
        &$part2 -> The second part to be sold
        &$part3 -> The third part to be sold
        
        Returns the money received from recycling the parts, or null on failure
    */
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
            return null;
        }
        $wordlist = explode(" ", $response);
        if ($wordlist[0] != "Ok") {
            return null;
        }
        return $wordlist[1];
    }

    /*
        public function endSession()
        Invalidates the currently used API key
        
        Returns true on success, false otherwise
    */
    public function endSession() {
        $response = file_get_contents('https://umbrella.jlparry.com/work/goodbye?key=' . $this->getKey());
        return $response == "Ok";
    }

    /*
        public functiong getBalance($team)
        Checks a particular team's balance
        
        $team -> The name of the team to check
        
        Returns the team's balance on success, null otherwise
    */
    public function getBalance($team) {
        $response = file_get_contents('https://umbrella.jlparry.com/info/balance/' . $team);
        $wordlist = explode(" ", $response);
        return $wordlist[0] != "Oops:" && $response != false ? $response : null;
    }

    /*
        public function getScoop($team)
        Gets the publicly known information on a team
        
        $team -> The name of the team to get the scoop on
        
        Returns the team's "scoop" on success (as an object), null otherwise
    */
    public function getScoop($team) {
        $response = file_get_contents('https://umbrella.jlparry.com/info/scoop/' . $team);
        $wordlist = explode(" ", $response);
        if ($response == false || $wordlist[0] == "Oops:") {
            return null;
        }
        return json_decode($response);
    }

    /*
        public function whoMakes($part)
        Check which factory makes a particular part
        
        $part -> The code of the part to check for, where the format is [model][piece]
            E.G. a1, b3, d2
        
        Returns the team that makes the part on success, null otherwise
    */
    public function whoMakes($part) {
        $response = file_get_contents('https://umbrella.jlparry.com/info/whomakes/' . $part);
        $wordlist = explode(" ", $response);
        if ($response == false || $wordlist[0] == "Oops:") {
            return null;
        }
        $response = preg_replace("/[\"\\[\\]]/", "", $response);
        return explode(",", $response);
    }

    /*
        public function getJob($team)
        Check what part a particular team produces
        
        $team -> The team to check the production of
        
        Returns the part that team produces, or null on failure
    */
    public function getJob($team) {
        $response = file_get_contents('https://umbrella.jlparry.com/info/job/' . $team);
        $wordlist = explode(" ", $response);
        return $wordlist[0] != "Oops:" && $response != false ? $response : null;
    }

    /*
        public function getTeams()
        Get all of the teams participating in this session
        
        Returns an array of team names on success, null otherwise
    */
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