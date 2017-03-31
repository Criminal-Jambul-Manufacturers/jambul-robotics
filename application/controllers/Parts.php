<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Parts extends Application
{


        public function __construct() {
            parent::__construct();
            $this->load->model('part');
            //$this->load->database();
        }

	public function index()
	{
            //$this->load->model('part');
            $this->data['pagebody'] = 'part';
            $this->data['part'] = $this->part->all();
            $this->render(); 
	}
    

    // ONE PART.
    public function onePart($partID) {

        $this->data['pagebody'] = 'getPartInfo';
        $source = $this->part->getPartInfo($partID);
        $this->data['id'] = $source['partCode'];
        $this->data['img'] = $source['partImg'];
        $this->data['certID'] = $source['certID'];
        $this->data['plant'] = $source['originPlany'];
        $this->data['date'] = $source['dateBuilt'];
        $this->data['time'] = $source['timeBuilt'];

        $this->render();
    }
}
