<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Parts extends Application
{


        public function __construct()
        {
            parent::__construct();
            $this->load->model('part');
            $this->load->model('control');
            $this->load->model('transaction');
            $this->load->library('pandaapi');
        }

	public function index()
	{
            error_reporting(E_ALL ^ E_WARNING);
            if($this->session->userdata('userrole') != ROLE_WORKER)
            {
                redirect($_SERVER['HTTP_REFERER']);
            }
            else
            {
                $this->data['pagebody'] = 'part';
                $this->data['part'] = $this->part->all();
                $this->render();
            }
	}
    

    // ONE PART.
    public function onePart($partID)
    {
        $this->data['pagebody'] = 'getPartInfo';
        $source = $this->part->just1($partID);
        $this->data['id'] = $source['partCode'];
        $this->data['img'] = $source['partImg'];
        $this->data['certID'] = $source['certID'];
        $this->data['plant'] = $source['originPlant'];
        $this->data['date'] = $source['dateBuilt'];
        $this->data['time'] = $source['timeBuilt'];

        $this->render();
    }
    
    /*
     * Request any newly built parts for this factory
     * Adds each of these to your parts table
     * Updates the appropriate history table
     */
    public function buildParts()
    {
        $secretPass = $this->control->just1('superSecretPass')->configValue;
        $this->pandaapi->updateKey('jambul', $secretPass);
        
        $builtParts = $this->pandaapi->getBuiltParts();
        
        foreach($builtParts as $myPart)
        {
            $this->part->add($myPart);
        }
        
        $transaction = array(
            'description' => 'Got the built parts',
            'cost' => 0,
            'time' => time(),
            'transactionType' => 'Build',
            'robot' => NULL
        );
        
        $this->transaction->add($transaction);
    }
    
    /*
     * Request a box of random parts for you to use,
     * which returns an array of parts certificates
     * Adds each of these to your parts table
     * Updates the appropriate history table
     */
    public function buyParts()
    {
        $secretPass = $this->control->just1('superSecretPass')->configValue;
        $this->pandaapi->updateKey('jambul', $secretPass);
        
        $boughtParts = $this->pandaapi->buyPartBox();
        
        foreach($boughtParts as $myPart)
        {
            $this->part->add($myPart);
        }
        
        $transaction = array(
            'description' => 'Got a box parts',
            'cost' => 100,
            'time' => time(),
            'transactionType' => 'Purchase',
            'robot' => NULL
        );
        
        $this->transaction->add($transaction);
    }
}
