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
        array('partID' => '1', 'partCode' => 'A1', 'certID' => '000001', 'originPlany' => 'Houston',
            'dateBuilt' => '2/07/2017', 'timeBuilt' => '5:00pm'),
        array('partID' => '2', 'partCode' => 'A2', 'certID' => '000002', 'originPlany' => 'Houston',
            'dateBuilt' => '2/07/2017', 'timeBuilt' => '5:01pm'),
        array('partID' => '3', 'partCode' => 'A3', 'certID' => '000003', 'originPlany' => 'Houston',
            'dateBuilt' => '2/07/2017', 'timeBuilt' => '5:02pm'),
        array('partID' => '4', 'partCode' => 'B1', 'certID' => '000004', 'originPlany' => 'Houston',
            'dateBuilt' => '2/07/2017', 'timeBuilt' => '5:03pm'),
        array('partID' => '5', 'partCode' => 'B2', 'certID' => '000005', 'originPlany' => 'Houston',
            'dateBuilt' => '2/07/2017', 'timeBuilt' => '5:04pm'),
        array('partID' => '6', 'partCode' => 'C3', 'certID' => '000006', 'originPlany' => 'Houston',
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
     * @return array - an array of parts which holds the info of all the parts
     * owned by Jambul Robotics
     */
    public function all() {
        return $this->data;
    }
    
    /*
     * Returns the info of the
     */
    public function getPartInfo($partID) {
        foreach($this->data as $part)
            if($part['partID'] == $partID)
                return $part;
            
        return null;
    }
}
