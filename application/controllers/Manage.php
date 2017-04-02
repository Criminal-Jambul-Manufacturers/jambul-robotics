<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Manage extends Application
{
    public function __construct() {
        parent::__construct();
        $this->load->model('robot');
        $this->load->model('part');
        $this->load->model('transaction');
        $this->load->library('pandaapi');
        $this->load->model('config');

    }

    public function index()
    {
        $secretPass = $this->config->just1('superSecretPass');
        $this->pandaapi->updateKey('jambul', $secretPass->configValue);

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
                $head = $this->part->just1($bot->headID);
                $torso = $this->part->just1($bot->torsoID);
                $bottom = $this->part->just1($bot->bottom);

                $imgHead =  $head->model.$head->piece.'.jpeg';
                $imgTorso = $torso->model.$torso->piece.'.jpeg';
                $imgBottom = $bottom->model.$bottom->piece.'.jpeg';;

                $bots[] = array('BOT_ID'=>$bot->robotID , 'HEAD_ID'=>$bot->headID, 'TORSO_ID' =>$bot->torsoID, 
                    'BOTTOM_ID' => $bot->bottomID, 'IMG_HEAD' => $imgHead, 'IMG_TORSO' => $imgTorso, 
                    'IMG_BOTTOM' => $imgBottom, 'BOT_OBJECT'=>$bot);
            }
            
            $this->data['robot'] = $bots;


            $this->render();
        }
    }




    // Resets app.  Called by Manage View button.
    function reboot() {
        $secretPass = $this->config->just1('superSecretPass');
        $this->pandaapi->updateKey('jambul', $secretPass->configValue);
        $response = $this->pandaapi->reboot();

        if ($response == 'Ok') {
            $this->part->truncate();
            $this->robot->truncate();
            $this->transaction->truncate();
        }

        redirect($_SERVER['HTTP_REFERER']);// Go back to the page that we came from

    }






    // Resets app. Uses the Manage View input box forms.
    function register() {
        $inputData = $this->input->post();
		$team =   $this->input->post("name");  //plant name
		$token =  $this->input->post("secret"); //token password.
        $secretPass = $this->config->just1('superSecretPass');
        $this->pandaapi->updateKey('jambul', $secretPass->configValue);
        //If entered password is the same as their old password
        if($token == $secretPass->configValue) {  
            //let them make a new password
            $this->pandaapi->genKey($team, $token);
        }
        else {
            $this->pandaapi->updateKey('jambul', $secretPass->configValue);
        }

    }


    //sell a robot. Called by Manage View button.
    function sellRobot($bot) {
        $secretPass = $this->config->just1('superSecretPass');
        $this->pandaapi->updateKey('jambul', $secretPass->configValue);


        $profit = $this->pandaapi->sellRobot($bot);  //how much we get for a bot.
        echo "You sold this robot for". $profit . " dollars!";


    }






}
