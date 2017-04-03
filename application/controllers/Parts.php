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
                $this->data['pagebody'] = 'partpage';
                $this->data['part'] = $this->part->all();
                $this->render();
            }
	}
    

    // ONE PART.
    public function onePart($partID)
    {
        $this->data['pagebody'] = 'getPartInfo';
        $source = $this->part->just1($partID);
        $this->data['partModel'] = $source['model'];
        $this->data['partPiece'] = $source['piece'];
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
        error_reporting(E_ALL ^ E_WARNING);
        $this->data['pagebody'] = 'part';
        $secretPass = $this->control->get('superSecretPass')->configValue;
        $this->pandaapi->updateKey('jambul', $secretPass);
        
        $builtParts = $this->pandaapi->getBuiltParts();
        
        foreach($builtParts as $myPart)
        {
            $this->part->add($myPart);
        }
        
        $transaction = array(
            'transactionID' => NULL,
            'description' => 'Got the built parts',
            'cost' => 0,
            'time' => mktime(year,month,day,hour,minute,second),
            'transactionType' => 'Build',
            'robot' => NULL
        );
        
        $this->transaction->add($transaction);
        
        $this->index();
    }
    
    /*
     * Request a box of random parts for you to use,
     * which returns an array of parts certificates
     * Adds each of these to your parts table
     * Updates the appropriate history table
     */
    public function buyParts()
    {
        error_reporting(E_ALL ^ E_WARNING);
        $secretPass = $this->control->get('superSecretPass')->configValue;
        $this->pandaapi->updateKey('jambul', $secretPass);
        
        $boughtParts = $this->pandaapi->buyPartBox();
        
        foreach($boughtParts as $jlpPart)
        {
            $myPart = array(
                'partID' => NULL,
                'model' => $jlpPart->model,
                'piece' => $jlpPart->piece,
                'stamp' => $jlpPart->stamp,
                'id' => $jlpPart->id,
                'plant' => $jlpPart->plant
            );
            $this->part->add($myPart);
        }
        
        $transaction = array(
            'transactionID' => NULL,
            'description' => 'Got a box parts',
            'cost' => 100,
            'time' => NULL,
            'transactionType' => 'Purchase',
            'robot' => NULL
        );
        
        $this->transaction->add($transaction);
        
        $this->index();
    }
}
