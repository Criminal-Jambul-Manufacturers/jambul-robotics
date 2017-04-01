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
class Transaction extends MY_Model{
    
    /*
     * Constructor for a History, calls the parent constructor.
     */
    public function __construct() {
        parent::__construct('transaction', 'transactionID');
    }
    
    /*
     * Returns the amount of money spent since opening/reopening.
     * 
     * @return float - The amount of money spent.
     */
    public function moneySpent() {
        $spent = 0.0;
        
        $purchases = $this->some('transactionType', 'Purchase');
        
        foreach ($purchases as $record) {
            $spent += $record->cost;
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
        
        $shipments = $this->some('transactionType', 'Shipment');
        $returns = $this->some('transactionType', 'return');
        
        foreach ($shipments as $record) {
            $revenue += $record->cost;
        }
        
        foreach ($returns as $record) {
            $revenue += $record->cost;
        }
        
        return $revenue;
    } 
}
