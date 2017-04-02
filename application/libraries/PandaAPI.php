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
        if ($response == false || $response == "Oops: you can't afford that!") {
            return null;
        }
        return json_decode($response);
    }
    // Get any built parts
    // Returns an array of "part" objects
    public function getBuiltParts() {
        $response = file_get_contents('https://umbrella.jlparry.com/work/mybuilds?key=' . $this->getKey());
        if ($response == false) {
            return null;
        }
        return json_decode($response);
    }
    // Sell a bot
    // Pass in the robot object
    // Returns true if the bot is successfully sold, false if it wasn't
    public function sellBot() {
        return true;
    }
    // Reboots the plant
    // Returns true on success, false on failure
    public function reboot() {
        $response = file_get_contents('https://umbrella.jlparry.com/work/rebootme?key=' . $this->getKey());
        return $response == "Ok";
    }
    // Checks who the user is
    // Returns the name of the plant
    public function whoAmI() {
        return "not done yet";
    }
    // Gets part info based on the passed in certificate
    // Returns null on failure
    public function getPartInfo($cert) {
        return null;
    }
    // Recycles the passed in array of parts objects
    // Returns true on success, false otherwise
    public function recycle($parts) {
        return false;
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
        return $response != "Oops: invalid team name given." && $response != false ? $response : null;
    }
    // Gets the scoop on a team (in an object)
    // Returns null on failure, an object on success
    public function getScoop($team) {
        $response = file_get_contents('https://umbrella.jlparry.com/info/scoop/' . $team);
        if ($response == false || $response == "Oops: invalid team name given.") {
            return null;
        }
        return json_decode($response);
    }
    // Get who makes a particular part type
    // Returns null on failure, array of strings on success
    public function whoMakes($part) {
        $response = file_get_contents('https://umbrella.jlparry.com/info/whomakes/' . $part);
        if ($response == false || $response == "Oops: no factory is making the specified part.") {
            return null;
        }
        $response = preg_replace("/[\"\\[\\]]/", "", $response);
        return explode(",", $response);
    }
    // Gets the job of a particular factory
    // Returns null on failure, string on success
    public function getJob($team) {
        $response = file_get_contents('https://umbrella.jlparry.com/info/job/' . $team);
        return $response != "Oops: invalid team name given." && $response != false ? $response : null;
    }
    // Get all of the teams participating
    // Returns an array of team names on success, null on failure
    public function getTeams() {
        $response = file_get_contents('https://umbrella.jlparry.com/info/teams');
        if ($response == false) {
            return null;
        }
        $response = preg_replace("/[\"\\[\\]]/", "", $response);
        return explode(",", $response);
    }
}