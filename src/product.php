<?php

require_once('controller.php');

class Product extends controller{

    function __construct(){
        parent::__construct();
        
        // print_r($product);
    }

    function get($condition){
        
        switch($condition){
            case 'all':

                $product = $this->database->select("product","*");

                $res = [
                    "Status"=>"200",
                    "Message"=>"",
                    "Result"=>$product
                ];
                
                print_r(json_encode($res));
                return;
            default:
                echo "<br>default: ".$condition."<br>";
                break;
        }

    }
}


?>