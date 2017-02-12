<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * History is a model with access to all the transactions of Jambul Robotics
 * since opening/reopening. A transaction has a unique transactionID, a
 * transactionType: Purchase, Assembly or Shipment,a description, a cost, and a
 * date when the transaction occurred. 
 *
 * @author chach
 */
class History extends CI_Model{
    /*
     * Mock data for the use of assignment 1.
     */
    var $data = array(
        array('transactionID' => 1, 'transactionType' => 'Purchase',
            'description' => 'Purchased box of 10 parts', 'cost' => 100.00,
            'date' => '2/11/2017', 'time' => '7:00pm')
    );
    
    /*
     * Constructor for a History, calls the parent constructor.
     */
    public function __construct() {
        parent::__construct();
    }
    
    /*
     * Returns all of the transaction made by Jambul robotics since opening/
     * reopening.
     * 
     * @return array - An array of transactions that have occurred since
     * opening/reopening
     */
    public function all() {
        return $this->data;
    }
    
    /*
     * Retutns all of the transactions of the specified type.
     * 
     * @param string $type - The type of transaction to return either Purchase,
     * Assembly or Shipment
     * 
     * @return array - An array of all the transactions of the specified type.
     */
    public function allOfType($type) {
        $records = array();
        foreach ($this->data as $record) {
            if ($record['transctionType'] == $type) {
                $records[] = $record;
            }
        }
        return $records;
    }
    
    /*
     * Returns the amount of money spent since opening/reopening.
     * 
     * @return float - The amount of money spent.
     */
    public function moneySpent() {
        $spent = 0.0;
        
        foreach ($this->data as $record) {
            if ($record['transactionType'] == 'Purchase') {
                $spent += $record['cost'];
            }
        }
        return $spent;
    }
    
    /*
     * Returns the amount of money received from selling robots or parts since
     * opening/reopening
     * 
     * @return float - The amount of money made.
     */
    public function revenue() {
        $revenue = 0.0;
        
        foreach ($this->data as $record) {
            if ($record['transactionType'] == 'Shipment') {
                $revenue += $record['cost'];
            }
        }
        return $revenue;
    } 
}
