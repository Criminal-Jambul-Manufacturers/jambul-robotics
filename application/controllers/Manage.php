<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Manage extends Application
{
    public function __construct() {
        parent::__construct();
    }

    public function index()
    {
        if($this->session->userdata('userrole') != ROLE_BOSS)
        {
            redirect($_SERVER['HTTP_REFERER']);
        }
        else
        {
            $this->data['pagebody'] = 'manage';
            $this->render();
        }
    }
}
