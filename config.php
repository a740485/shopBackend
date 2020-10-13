<?php

$Is_Apple = false;

if($Is_Apple){
	$config = [
		"database"=> [
			"host"=>"127.0.0.1",
			"port"=>8889,
			"user"=>"root",
			"password"=>"root",
			"db_name"=>"shop"
		],
	];
}else{
	$config = [
		"database"=> [
			"host"=>"127.0.0.1",
			"port"=> null,
			"user"=>"root",
			"password"=>"",
			"db_name"=>"shop"
		],
	];
}


?>