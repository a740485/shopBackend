<?php

require_once('controller.php');
class Backstage extends Controller{

    function __construct(){
        parent::__construct();
    }

    function get($condiction){

        try {
            $search = $this->database->query("
            select 
            id, title, img, price, amount
            from product
            where
            user_id=".$condiction
            )->fetchAll();

            foreach ($search as $key => $value) {
                $data[] = [
                    "id"=> $value["id"],
                    "title"=> $value["title"],
                    "img"=>$value["img"],
                    "price"=>$value["price"],
                    "amount"=>$value["amount"]
                ];
            }
            $this->res("200",$data);

        } catch (\Throwable $err) {
            $res = [
                "Status"=> "400",
                "Message"=> "Search Failed: ".$err,
                "Result"=> null
            ];
            print_r($res);
        }
    }

    // 新增
    function post(){
        // 圖片上傳暫時未處理
        try {
            
            if(!isset($_POST["user_id"]) || !isset($_POST["title"]) || !isset($_POST["price"]) || !isset($_POST["amount"])
            ){
                throw new Exception("get post data error");
            }

            $data = [
                "user_id"=> $_POST["user_id"],
                "title" => $_POST["title"],
                "price" => $_POST["price"],
                "amount" => $_POST["amount"]
            ];

            $this->database->insert("product",[
                "user_id"=> $data["user_id"],
                "title" => $data["title"],
                "img" => "",
                "price" => $data["price"],
                "amount" => $data["amount"]
            ]);

            $check = $this->database->has("product",[
                "user_id"=> $data["user_id"],
                "title" => $data["title"],
                "img" => "",
                "price" => $data["price"],
                "amount" => $data["amount"]
            ]);

            if(!$check){
                throw new Exception("create error");
                
            }

            $this->res("400",$data);

        } catch (\Throwable $err) {
            $res = [
                "Status"=> "400",
                "Message"=> "Create Failed: ".$err->getMessage(),
                "Result"=> null
            ];
            print_r(json_encode($res));
        }
    }

    function patch(){
        // 圖片上傳暫時未處理
        try {
            parse_str(file_get_contents('php://input'), $_PATCH);
            if(!isset($_PATCH["id"]) || !isset($_PATCH["title"]) || !isset($_PATCH["price"]) || !isset($_PATCH["amount"])
            ){
                throw new Exception("get patch data error");
            }

            $data = [
                "id"=> $_PATCH["id"],
                "title" => $_PATCH["title"],
                "img" => "",
                "price" => $_PATCH["price"],
                "amount" => $_PATCH["amount"]
            ];

            $this->database->update("product",[
                "title" => $data["title"],
                "price" => $data["price"],
                "amount" => $data["amount"]
            ],[
                "id"=>$data["id"]
            ]);

            $check = $this->database->has("product",[
                "id"=> $data["id"],
                "title" => $data["title"],
                "img" => $data["img"],
                "price" => $data["price"],
                "amount" => $data["amount"]
            ]);

            if(!$check){
                throw new Exception("Update error");
                
            }

            $this->res("400",$data);

        } catch (\Throwable $err) {
            $res = [
                "Status"=> "400",
                "Message"=> "Update Failed: ".$err->getMessage(),
                "Result"=> null
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