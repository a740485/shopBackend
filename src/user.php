<?php
require_once('controller.php');
class UserCreate extends controller{

    function __construct(){
        parent::__construct();
        
    }

    public function post(){      
        // $json_string = file_get_contents('php://input');// php 接收資料流
        try{
            $data = [
                "username" => $_POST["username"],
                "password" => $_POST["password"],
                "phone" => $_POST["phone"],
                "email" => $_POST["email"],
                "address" => $_POST["address"]
            ];

            if(empty($data["username"]) || empty($data["password"])){
                
                throw new Exception("username or password is empty");
            }

            $this->insertUser($data);


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


    private function insertUser($data){
        // Authorization
        // print_r($data);
        $hadUser = $this->database->has("user", [
            "username" => $data["username"],
        ]);
        if($hadUser){
            throw new Exception("user had exist");
        }

        $this->database->insert("user",$data);

        $success = $this->database->has("user", [
            "username" => $data["username"],
        ]);

        if(!$success){
            throw new Exception("save error");
        }

        $res = [
            "Status"=>200,
            "Message"=> "",
            "Result"=>[
                "IsOK"=>true
            ]
        ];

        print_r(json_encode($res));
    }
}

class UserLogin extends controller{
    function __construct(){
        parent::__construct();

        // $header = apache_request_headers();
        // print_r($header["Authorization"]);
    }

    function get(){
        try {

            if(empty($_GET["username"]) || empty($_GET["password"])){
                throw new Exception("Error");
            }

            $data = [
                "username" => $_GET["username"],
                "password" => $_GET["password"],
            ];

            $access = $this->database->has("user",[
                
                    "username" => $data["username"],
                    "password" => $data["password"],
            ]);

            if(!$access){
                throw new Exception("Error");
            }

            $res = [
                "Status"=>200,
                "Message"=> "",
                "Result"=>[
                    "IsOK"=>true
                ]
            ];
            print_r(json_encode($res));
            
        } catch (\Throwable $err) {
            $res = [
                "Status"=>400,
                "Message"=> "Login Failed",
                "Result"=> null
            ];
            print_r(json_encode($res));
        }
    }
}


?>