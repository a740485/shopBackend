<?php

require_once('controller.php');

class Product extends controller{

    function __construct(){
        parent::__construct();
        
        // print_r($product);
    }

    function get($condition){

        
        if((int)$condition != 0){
            $id =  (int)$condition;
           
            $product = $this->database->select("product",[
                "title",
                "img",
                "price"
            ],[
                "id" => $id,
            ])[0];
            if(empty($product)){
                $this->res("400",null,"no product");
                return;
            }
            $this->res("200",$product);
            return;
        }

        switch($condition){
            case 'all':
                $product = $this->database->select("product","*");

                $this->res("200",$product);
                return ;

            case 'register':
                header("location: http://127.0.0.1:5500/register/");
            default:
                echo "<br>default: ".$condition."<br>";
                break;
        }

    }

    private function res($status, $result, $message=""){
        $res = [
            "Status"=> $status,
            "Message"=> $message,
            "Result"=> $result
        ];
        
        print_r(json_encode($res));
    }
}


?>