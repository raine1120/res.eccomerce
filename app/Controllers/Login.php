<?php

namespace App\Controllers;

use Core\Controller;




class Login extends Controller
{

    function __construct()
    {

        parent::__construct();

    }

    public function Main($params = array())
    {

        $generalFunctions = new Index();

        $this->view->setValues(array(
            0 => '{{Host}}',
            6 => '{{HearderMenu}}'
        ), array(
            0 => HOST,
            6 => $generalFunctions->getHeaderMenu()

        ));

        return $this->view->setView(
            array(
                'View.Header',
                'Login/View.Body',
                'Login/View.Footer'
            )
        );

    }

    public function Signin(){
        $generalFunctions = new Index();

        $params = array(
            "filterByFormula" => "AND( {email} = '".$_POST['email']."', {Password} = '".md5($_POST['password'])."' )",
            "maxRecords" => 1
        );

        $data = $generalFunctions->getAirData('Users',$params);

        if (count($data) > 0 ){
            session_start();
            foreach ($data as $key => $value){
                $_SESSION['userName']   = $value->fields->username;
                $_SESSION['firstName']  = $value->fields->{'First Name'};
                $_SESSION['lastName']   = $value->fields->{'Last Name'};
                $_SESSION['email']      = $value->fields->email;
            }
        }
        if (count($data) > 0) {
            return 'success';
            header('location:'.HOST);
        }else {
            return 'fail';
        }

        //header('location:'.HOST.'Login');

    }
}


