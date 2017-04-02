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
        $testbot = new stdClass();
        $testbot->head = "283fa7";
        $testbot->torso = "3fe906";
        $testbot->bottom = "410d7e";
        $this->data['pagebody'] = 'test';
        $this->data['testmsg'] = $this->pandaapi->sellBot($testbot);
        $this->render(); 
    }
}
