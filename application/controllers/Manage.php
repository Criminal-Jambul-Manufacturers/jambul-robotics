<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Parts extends Application
{
    public function __construct() {
        parent::__construct();
    }

    public function index()
    {
        /*if($this->session->userdata('userrole') != ROLE_BOSS)
        {
            redirect($_SERVER['HTTP_REFERER']);
        }
        else
        {
            $this->data['pagebody'] = 'manage';
            $this->data['manage'] = ;
            $this->render();
        }*/
    }
}
