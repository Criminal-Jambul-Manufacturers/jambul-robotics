<?php

class Roles extends Application
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function choose($role = ROLE_GUEST)
    {
        $this->session->set_userdata('userrole',$role);
        redirect($_SERVER['HTTP_REFERER']);
    }
}