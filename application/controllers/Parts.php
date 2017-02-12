<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Parts extends Application
{


        public function __construct() {
            parent::__construct();
            $this->load->model('part');
            //$this->load->database();
        }

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
	public function index()
	{
		//$this->load->model('part');
		$this->data['pagebody'] = 'part';
		$source = $this->part->all();
		$this->data['part'] = $this->part->all ();
		$this->render(); 
	}
    

	// ONE PART.
    public function  onePart($partID) {

        $this->data['pagebody'] = 'getPartInfo';
		$source = $this->part->getPartInfo($partID);
		$this->data['id'] = $source['partCode'];
        $this->data['certID'] = $source['certID'];
        $this->data['plant'] = $source['originPlany'];
        $this->data['date'] = $source['dateBuilt'];
        $this->data['time'] = $source['timeBuilt'];

        $this->render();
    }
}
