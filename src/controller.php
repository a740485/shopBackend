<?php

class controller{
    public $database = 'no';

    function __construct(){
        require_once(__DIR__."./../libs/db.php");

        $this->database = $database;

        header('Access-Control-Allow-Methods: POST, GET, DELETE, PATCH');
        header('Access-Control-Allow-Origin: *');
        $method = $_SERVER['REQUEST_METHOD'];
        switch($method){
            case "POST":
                header('Content-Type: application/json; charset=utf-8');
                

            default:
                header('Content-Type: application/json; charset=utf-8');
                
        }
        
    }


    // function get($condition){
    //     switch($condition){
    //         case 'all':
    //             echo "<br>all<br>";
    //             // print_r(t::database);
    //             // $data = parent::database->select("product","*");

    //             // print_r($data);
    //             break;
    //         default:
    //             echo "<br>default: ".$condition."<br>";
    //             break;
    //     }
    // }


}

?>