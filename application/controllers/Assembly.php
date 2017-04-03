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
        $this->load->model('control');
    }

    public function index()
    {
        error_reporting(E_ALL ^ E_WARNING);
        if($this->session->userdata('userrole') != ROLE_SUPERVISOR)
        {
            redirect($_SERVER['HTTP_REFERER']);
        }
        else
        {
            $this->data['pagebody'] = 'assembly';
            $this->data['assembly'] = $this->robot->all();
            $this->data['head'] = $this->part->allOfType(1);
            $this->data['torso'] = $this->part->allOfType(2);
            $this->data['bottom'] = $this->part->allOfType(3);

            $robots = $this->robot->all();
            foreach($robots as &$robot) {
                $robot['head'] = $this->part->just1($robot->headId)->partCode;
                $robot['headImg'] = $this->part->just1($robot->headId)->partImg;
                $robot['torso'] = $this->part->just1($robot->torsoID)->partCode;
                $robot['torsoImg'] = $this->part->just1($robot->torsoID)->partImg;
                $robot['bottom'] = $this->part->just1($robot->bottomID)->partCode;
                $robot['bottomImg'] = $this->part->just1($robot->bottomID)->partImg;
            }
            $this->data['robots'] = $robots;

            $this->render();
        }
    }

    /*
     * Validate the selected parts, to make sure there
     * is one of each needed for a complete bot
     * Adds a record to your "robots" table, with the chosen parts
     * Removes the parts from the "parts" table
     * Updates the history table
     */
    public function assemble()
    {
        $headID = $this->input->post("headDropdown");
        $torsoID = $this->input->post("torsoDropdown");
        $bottomID = $this->input->post("bottomDropdown");
        
        if($this->part->exists($headPart) && $this->part->exists($torsoPart)
                && $this->part->exists($bottomPart))
        {
            $headPart = $this->part->get($headID);
            $torsoPart = $this->part->get($torsoID);
            $bottomPart = $this->part->get($bottomID);
            
            if($headPart->model == $torsoPart->model
                    && $headPart->model == $bottomPart->model)
            {
                if($headPart->model <= 'l')
                {
                    $botModel = "household";
                }
                else if($headPart->model >= 'w')
                {
                    $botModel = "companion";
                }
                else
                {
                    $botModel = "butler";
                }
            }
            else
            {
                $botModel = "motley";
            }
            
            $myRobot = array(
                'robotID' => NULL,
                'headID' => $headID,
                'torsoID' => $torsoID,
                'bottomID' => $bottomID,
                'model' => $botModel,
                'sold' => 0
            );

            $this->robot->add($myRobot);
            
            $this->part->delete($headID);
            $this->part->delete($torsoID);
            $this->part->delete($bottomID);
            
            $transaction = array(
                'transactionID' => NULL,
                'description' => 'Built a new robot',
                'cost' => 0,
                'time' => mktime(year,month,day,hour,minute,second),
                'transactionType' => 'Build',
                'robot' => NULL
            );

            $this->transaction->add($transaction);
        }
        
        $this->index();
    }
}
