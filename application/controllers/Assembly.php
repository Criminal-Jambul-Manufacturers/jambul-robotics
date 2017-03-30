<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Assembly extends Application
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/
	 * 	- or -
	 * 		http://example.com/welcome/index
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    
        public function __construct() {
            parent::__construct();
            $this->load->model('part');
	  		$this->load->model('robot');
        }
    
	public function index()
	{
            $this->data['pagebody'] = 'assembly';
		    $this->data['assembly'] = $this->robot->all();
			$this->data['head'] = $this->part->allOfType(1);
		    $this->data['torso'] = $this->part->allOfType(2);
			$this->data['legs'] = $this->part->allOfType(3);

			$robots = $this->robot->all();
			foreach($robots as &$robot) {
                $robot['head'] = $this->part->getPartInfo($robot['headID'])['partCode'];
                $robot['headImg'] = $this->part->getPartInfo($robot['headID'])['partImg'];
                $robot['torso'] = $this->part->getPartInfo($robot['torsoID'])['partCode'];
                $robot['torsoImg'] = $this->part->getPartInfo($robot['torsoID'])['partImg'];
                $robot['bottom'] = $this->part->getPartInfo($robot['bottomID'])['partCode'];
                $robot['bottomImg'] = $this->part->getPartInfo($robot['bottomID'])['partImg'];
			}
			$this->data['robots'] = $robots;

            $this->render(); 
	}


	// Not sure if you guys want to use this. But I was thinking for passing in an array of combined parts
	// the user has selected.
	public function assemble($chosenParts)
	{
            $source = $this->parts->get($chosenParts);
            $this->render(); 
	}
    
}
