<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application
{
    public function __construct() {
        parent::__construct();
        $this->load->model('transaction');
        $this->load->model('robot');
        $this->load->model('part');
    }
    
    public function index()
    {
        $this->data['pagebody'] = 'welcome_message';
        $this->data['numparts'] = $this->part->numParts();
        $this->data['numrobots'] = $this->robot->numRobots();
        $this->data['moneyspent'] = $this->transaction->moneySpent();
        $this->data['revenue'] = $this->transaction->revenue();
        $this->render(); 
    }
}
