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
class Robot extends CI_Model{
    /*
     * Mock data for the webapp to operate on for assignment one.
     */
   var $robots = array(
       array('robotID' => 1, 'headID' => 1, 'torsoID' => 2,
           'bottomID' => 3, 'model' => 'Household'),
       array('robotID' => 2, 'headID' => 4, 'torsoID' => 5,
           'bottomID' => 6, 'model' => 'Household'),
       array('robotID' => 3, 'headID' => 1, 'torsoID' => 2,
           'bottomID' => 6, 'model' => 'Household'),
       array('robotID' => 4, 'headID' => 1, 'torsoID' => 5,
           'bottomID' => 3, 'model' => 'Household'),
       array('robotID' => 5, 'headID' => 4, 'torsoID' => 2,
           'bottomID' => 3, 'model' => 'Household'),
       array('robotID' => 6, 'headID' => 4, 'torsoID' => 5,
           'bottomID' => 3, 'model' => 'Household')
   );
   
   /*
     * Constructor for a robot, calls the parent constructor.
     */
   public function __construct() {
       parent::__construct();
   }
   
   /*
     * Returns all the robots owned by Jambul Robotics which have not yet been
    * shipped off.
    * 
     * @return array - an array of robots which holds the info of all the robots
     * owned by Jambul Robotics
     */
   public function all() {
       return $this->robots;
   }
   
   /*
    * Returns the robot specified by the robotID parameter.
    * 
    * @param int $robotID - The ID of the robot to be returned.
    * 
    * @return aeeay - the robot with the passed in ID.
    */
   public function getRobot($robotID) {
       foreach($this->robots as $robot)
           if($robot['robotID'] == $robotID)
               return $robot;
   }
   
   /*
    * Returns the number of robots owned by Jambul Robotics that have not yet
    * been shipprd off.
    * 
    * @return int - returns the number of robots owned by Jambul Robotics
    */
   public function numRobots() {
       return count($this->robots);
   }
}
