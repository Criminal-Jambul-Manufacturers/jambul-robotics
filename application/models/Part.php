<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Part
 *
 * @author chach
 */
class Part extends CI_Model{
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
