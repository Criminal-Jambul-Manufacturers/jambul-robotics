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
class Part extends MY_Model{
    /*
     * Constructor for a part, calls the parent constructor.
     */
    public function __construct() {
        parent::__construct('part','partID');
    }
}
