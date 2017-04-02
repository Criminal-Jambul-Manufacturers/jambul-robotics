<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends Application
{
    public function __construct() {
        parent::__construct();
        $this->load->model('transaction');
        $this->load->model('robot');
        $this->load->model('part');
        $this->load->library('pandaapi');
    }
    
    public function index()
    {
        $this->data['pagebody'] = 'test';
        $this->data['testmsg'] = $this->pandaapi->buyPartBox()[0]->id;
        $this->render(); 
    }
}
