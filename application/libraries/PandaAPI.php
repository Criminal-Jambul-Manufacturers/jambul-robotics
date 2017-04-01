<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PandaAPI {
    public function __construct() {
        // Todo: Get the API key from the model, if it exists
    }
    // Purchase a box
    // Returns an array of "part" objects, or null on failure
    public function buyPartBox() {
        return null;
    }
    // Get any built parts
    // Returns an array of "part" objects
    public function getBuiltParts() {
        return array();
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
        return false;
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
    }
    // Gets a team's balance
    // Returns null on failure
    public function getBalance($team) {
        return null;
    }
    // Gets the scoop on a team (in an object)
    // Returns null on failure, an object on success
    public function getScoop($team) {
        return null;
    }
    // Get who makes a particular part type
    // Returns null on failure, string on success
    public function whoMakes($part) {
        return null;
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