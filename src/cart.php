<?php
require_once('controller.php');

class Cart extends Controller{

    function __construct(){
        parent::__construct();
        
        // print_r($product);
    }


    // 查詢使用者購物車資料
    function get($condition){
        // print_r($condition);
        try {

            if(empty($condition)){
                throw new Exception("no user");
            }

            $ori_data = $this->database->query("
                select 
                cart.product_id as id,
                product.img as img,
                product.title as title,
                product.price as price
                from cart inner join product on cart.product_id = product.id
                where cart.user_id =".$condition
            )->fetchAll();

            if(empty($ori_data)){
                throw new Exception("no cart");
            }

            // print_r($ori_data);

            $res_data = [];
            for($i=0; $i< count($ori_data);$i++){
                $data = [
                    "id"=> $ori_data[$i]['id'],
                    "img"=> $ori_data[$i]['img'],
                    "title"=> $ori_data[$i]['title'],
                    "price"=> $ori_data[$i]['price']
                ];
                array_push($res_data,$data);
            }

            $this->res('200',$res_data);
        } catch (\Throwable $th) {
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

    //  新增購物車
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

            // print_r("\r\nexist: ".$existed);

            if($existed){
                // echo "\r\nexist";
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


    // 刪除購物車
    function delete(){
        // echo "in php delete\r\n";
        try{
            $url = explode("/shopBackend/route.php/cart/",$_SERVER['REQUEST_URI'])[1];

            $user_id = explode("/",$url)[0];
            $product_id = explode("/",$url)[1];

            $test_data = [
                "user"=> $user_id,
                "product"=>$product_id
            ];

            $delete = $this->database->query("
                delete from cart 
                where user_id=".$user_id." and product_id=".$product_id
            );

            $check = $this->database->has("cart",[
                "user_id"=>$user_id,
                "product_id"=>$product_id
            ]);

            if($check){
                throw new Exception("delete error");
            }

            $result = [
                "IsOK"=>true
            ];
            $this->res("200",$result);

        }catch(\Throwable $e){
            $res = [
                "Status"=>400,
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