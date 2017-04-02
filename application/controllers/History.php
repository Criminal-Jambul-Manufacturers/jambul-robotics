<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class History extends Application
{


    public function __construct() {
        parent::__construct();
        $this->load->model('transaction');
    }

    public function index()
    {
            error_reporting(E_ALL ^ E_WARNING);
            $this->data['pagebody'] = 'history';
            $this->data['history'] = $this->transaction->all();
            $this->render(); 
    }
}
