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
            $this->load->model('assembly');
        }
    
	public function index()
	{
            $this->data['pagebody'] = 'assembly';
            $this->render(); 
	}


	// Not sure if you guys want to use this. But I was thinking for passing in an array of combined parts
	// the user has selected.
	public function assemble($chosenParts)
	{
            $this->data['pagebody'] = 'assembly';
            $source = $this->parts->get($chosenParts);
            $this->data['assembly'] = $this->assembly->all();
            $this->render(); 
	}
    
}
