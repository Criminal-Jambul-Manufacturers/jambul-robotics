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
                
                $parts = $this->part->all();
                $formattedParts = array();
                
                foreach($parts as $part) {
                    $formattedParts[] = array(
                        'partID' => $part->partID,
                        'partImg' => $part->model . $part->piece . '.jpeg',
                        'partCode' => $part->model . $part->piece,
                        'certID' => $part->id
                    );
                }
                
                $this->data['part'] = $formattedParts;
                $this->render();
            }
	}
    

    // ONE PART.
    public function onePart($partID)
    {
        $this->data['pagebody'] = 'getPartInfo';
        $part = $this->part->get($partID);
        $this->data['id'] = $part->model . $part->piece;
        $this->data['partImg'] = $part->model . $part->piece . '.jpeg';
        $this->data['certID'] = $part->id;
        $this->data['plant'] = $part->plant;
        $this->data['time'] = $part->stamp;

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
