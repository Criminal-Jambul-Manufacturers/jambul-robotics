<?php

class Control extends MY_Model{
    
    /*
     * Constructor for a Config, calls the parent constructor.
     */
    public function __construct() {
        parent::__construct('config', 'configKey');
    }
}
