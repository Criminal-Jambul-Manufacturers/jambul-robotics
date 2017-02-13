<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class History extends Application
{


    public function __construct() {
        parent::__construct();
        $this->load->model('transaction');
        //$this->load->database();
    }

    public function index()
    {
            //$this->load->model('history');
            $this->data['pagebody'] = 'history';
            $this->data['history'] = $this->transaction->all ();
            $this->render(); 
    }
}
