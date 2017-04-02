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
        $part1 = new stdClass();
        $part2 = new stdClass();
        $part3 = new stdClass();
        $part4 = new stdClass();
        $part1->id = "115e25";
        $part2->id = "3170c5";
        $part3->id = "12d6f7";
        $part4->id = "1ed32a";
        $partArr = array($part1);
        $this->data['pagebody'] = 'test';
        $this->data['testmsg'] = $this->pandaapi->recycle($partArr);
        $this->render(); 
    }
}
