<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Manage extends Application
{
    public function __construct() {
        parent::__construct();
    }

    public function index()
    {
        $role = $this->session->userdata('userrole');
        if ($role != ROLE_BOSS)
        {
            redirect($_SERVER['HTTP_REFERER']);// Go back to the page that we came from
        }
        else
        {
            $this->data['pagebody'] = 'manage';
		    $this->data['pagetitle'] = 'Manage ('. $role . ')';
            //$this->data['robot'] = $this->robot->all();

            // build all the bots. 
            $bots = array();
            $botList = $this->robot->all();  //array of robot objects.
            foreach($botList as $bot)
            {
                $imgHead =  $bot['model'].$bot['headID'].".jpeg";
                $imgTorso = $bot['model'].$bot['torsoID'].".jpeg";
                $imgBottom = $bot['model'].$bot['bottomID'].".jpeg";

                $bots[] = array('BOT_ID'=>$bot['robotID'] , 'HEAD_ID'=>$bot['headID'], 'TORSO_ID' => $bot['torsoID'], 
                    'BOTTOM_ID' => $bot['bottomID'], 'IMG_HEAD' => $imgHead, 'IMG_TORSO' => $imgTorso, 
                    'IMG_BOTTOM' => $imgBottom);
            }
            
            $this->data['robot'] = $robot;


            $this->render();
        }
    }

    // Resets app.  Called by Manage View button.
    function reboot() {

    }


    // Resets app. Uses the Manage View input box forms.
    function register() {
        $inputData = $this->input->post();
		$team =   $this->input->post("name");  //plant name
		$token =  $this->input->post("secret"); //token password.

        //......  To be continued with API stuff.

    }


    //sell a robot. Called by Manage View button.
    function sellRobot($botID) {

    }






}
