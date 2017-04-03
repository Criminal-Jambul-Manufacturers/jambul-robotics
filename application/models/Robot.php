<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Robot is a model that has access to all of the robots currently owned by
 * Jambul Robotics that have yet to be shipped off. A robot has a unique 
 * robotID, a headID which is the partID of the robots head, a torsoID which is
 * the partID of the robots torso, a bottomID which is the partID of the robots
 * legs, and the model of the robot: household, butler, companion or motley.
 *
 * @author Nathan Barber
 */
class Robot extends MY_Model{
   
   /*
     * Constructor for a robot, calls the parent constructor.
     */
   public function __construct() {
       parent::__construct('robot', 'robotID');
   }

  
}
