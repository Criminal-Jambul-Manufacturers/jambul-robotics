<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Part is a model that has access to all of the robot parts currently owned by
 * Jambul Robotics. A part has a unique partID, a partCode to specify what type
 * and model it is, a certID which corresponds to a certificate of authenticity,
 * and the plant, data and time that it was made.
 *
 * @author Nathan Barber
 */
class Part extends CI_Model{
    /*
     * Mock data for the webapp to operate on for assignment one.
     */
    var $data = array(
        array('partID' => 1, 'partCode' => 'A1', 'partImg' => 'a1.jpeg', 'certID' => '000001', 'originPlany' => 'Houston',
            'dateBuilt' => '2/07/2017', 'timeBuilt' => '5:00pm'),
        array('partID' => 2, 'partCode' => 'A2', 'partImg' => 'a2.jpeg', 'certID' => '000002', 'originPlany' => 'Houston',
            'dateBuilt' => '2/07/2017', 'timeBuilt' => '5:01pm'),
        array('partID' => 3, 'partCode' => 'A3', 'partImg' => 'a3.jpeg', 'certID' => '000003', 'originPlany' => 'Houston',
            'dateBuilt' => '2/07/2017', 'timeBuilt' => '5:02pm'),
        array('partID' => 4, 'partCode' => 'B1', 'partImg' => 'b1.jpeg', 'certID' => '000004', 'originPlany' => 'Houston',
            'dateBuilt' => '2/07/2017', 'timeBuilt' => '5:03pm'),
        array('partID' => 5, 'partCode' => 'B2', 'partImg' => 'b2.jpeg', 'certID' => '000005', 'originPlany' => 'Houston',
            'dateBuilt' => '2/07/2017', 'timeBuilt' => '5:04pm'),
        array('partID' => 6, 'partCode' => 'C3', 'partImg' => 'c3.jpeg', 'certID' => '000006', 'originPlany' => 'Houston',
            'dateBuilt' => '2/07/2017', 'timeBuilt' => '5:05pm')
    );
    
    /*
     * Constructor for a part, calls the parent constructor.
     */
    public function __construct() {
        parent::__construct();
    }
    
    /*
     * Returns all the parts stored in the "database".
     * 
     * @return array - an array of parts which holds the info of all the parts
     * owned by Jambul Robotics
     */
    public function all() {
        return $this->data;
    }
    
    /*
     * Returns all the parts of one type stored in the "database".
     * 
     *@param $type The type of the parts to return: 1 for head, 2 for torso,
     * 3 for legs.
     * 
     * @return array - an array of parts  of the specified type which holds the
     * info of all the parts owned by Jambul Robotics
     */
    public function allOfType($type) {
        $parts = array();
        
        foreach($this->data as $part){
            if ($part['partCode'][1] == $type) {
                $parts[] = $part;
            }
        }
        
        return $parts;
    }
    
    /*
     * Returns the info of the part specified by partID.
     * 
     * @param int partID - the ID of the part to be returned.
     * 
     * @return array - An array representing a part and all of its data
     */
    public function getPartInfo($partID) {
        foreach ($this->data as $part) {
            if ($part['partID'] == $partID)
                return $part;
        }

        return null;
    }
    
    /*
     * Returns the number of parts currently held by Jambul Robotics.
     * 
     * @return int - the number of parts
     */
    public function numParts() {
        return count($this->data);
    }
}
