<?php
// ini_set("display_errors","On");
// error_reporting(E_ALL);
require 'vendor/autoload.php';
require 'src/product.php';
require 'src/user.php';
require 'src/cart.php';

// phpinfo();

class HelloHandler{
    function __construct(){
        echo "construct\r\n";
    }

    function get(){
        echo "get hello";
    }
}

class test{
    function get($test){
        echo "get";
    }
}

try {

    ToroHook::add("404",  function() {
        echo "<br>toro 404 not found";
    });

    ToroHook::add("500",  function() {
        echo "<br>toro 500 Server Error";
    });
    
    ToroHook::add("502", function(){
        echo "<br>toro 502 Bad Gateway";
    });//預設502頁面

    Toro::serve(array(//掛載路由
        "/test" => "controller",
        "/product/([a-zA-Z0-9-_]+)" => "Product",
        "/user/create" => "UserCreate",
        "/user/login" => "UserLogin",
        "/cart" => "Cart",  // 新增購物車
        "/cart/:number/:number" => "Cart", //購物車單項刪除
        "/cart/:number"=> "Cart",   //查詢用者購物車資料
    ));
} catch (\Throwable $e) {
    echo "toro catch error<br>";
    print_r($e);
}



?>