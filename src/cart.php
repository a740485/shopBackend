<?php
require_once('controller.php');

class Cart extends Controller{

    function __construct(){
        parent::__construct();
        
        // print_r($product);
    }

    function get(){
        echo "get";
        
    }

    function post(){
        try{
        
            $data = [
                "user_id" => $_POST["user_id"],
                "product_id" => $_POST["product_id"],
            ];
    
            if(empty($data["user_id"]) || empty($data["product_id"])){
                
                throw new Exception("user_id or product_id is empty");
            }

            $existed = $this->database->has("cart", [
                "user_id" => $data["user_id"],
                "product_id" => $data["product_id"]
            ]);

            print_r("\r\nexist: ".$existed);

            if($existed){
                echo "\r\nexist";
                $this->res("400",null,"cart exist");
                return;
            }
            
            $this->database->insert("cart",[
                "user_id" => $data["user_id"],
                "product_id" => $data["product_id"]
            ]);

            $check = $this->database->has("cart", [
                "user_id" => $data["user_id"],
                "product_id" => $data["product_id"]
            ]);

            
            if(!$check){
                throw new Exception("create Failed");
            }

            $this->res("200",[
                "IsOK"=> True
            ]);

        }catch(\Throwable $e){
            $res = [
                "Status"=>200,
                "Message"=> $e->getMessage(),
                "Result"=>[
                    "IsOK"=>false
                ]
            ];
            print_r(json_encode($res));
        }

        
        
    }

    function delete(){
        
        try{
            $url = explode("/shopBackend/route.php/cart/",$_SERVER['REQUEST_URI'])[1];

            $user_id = explode("/",$url)[0];
            $product_id = explode("/",$url)[1];

            echo("user: ".$user_id);
            echo("product: ".$product_id);




        }catch(\Throwable $e){
            $res = [
                "Status"=>200,
                "Message"=> $e->getMessage(),
                "Result"=>[
                    "IsOK"=>false
                ]
            ];
            print_r(json_encode($res));
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