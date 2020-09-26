<?php
// ini_set("display_errors","On");
// error_reporting(E_ALL);
require 'vendor/autoload.php';
require 'src/product.php';
require 'src/user.php';

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
        "/product/:string" => "Product",
        "/user/create" => "UserCreate",
        "/user/login" => "UserLogin"
    ));
} catch (\Throwable $e) {
    echo "toro catch error<br>";
    print_r($e);
}



?>