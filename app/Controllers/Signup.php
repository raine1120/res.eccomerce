<?php

namespace App\Controllers;

use Core\Controller;


class Signup extends Controller
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
                'Signup/View.Body',
                'Signup/View.Footer'
            )
        );

    }

    public function saveUser(){
        $generalFunctions = new Index();


        $params = array(
            "filterByFormula" => "AND( {email} = '".$_POST['email']."')",
            "maxRecords" => 1
        );

        $data = $generalFunctions->getAirData('Users',$params);
        //print_r($data);
        if (count($data) > 0){
            return '300';//THE USER EXIST
        }else{

            $params = array(
                'First Name'        =>  $_POST['firstName'],
                'Last Name'         =>  $_POST['lastName'],
                'username'          =>  $_POST['userName'],
                'email'             =>  $_POST['email'],
                'Password'          => md5($_POST['password'])
            );

            $res = $generalFunctions->saveAirData('Users',$params);
            //echo var_dump($res);
            return 'success';
            //header('location:'.HOST);
        }


    }
}


