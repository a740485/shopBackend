<?php
use Medoo\Medoo;
require(__DIR__.'../../config.php');

$database = new Medoo([
    'database_type' => 'mysql',
    'server' => $config['database']['host'],
    'username' => $config['database']['user'],
    'password' => $config['database']['password'],
    'port'=> $config['database']['port'],
    'database_name' => $config['database']['db_name'],
    'charset' => 'utf8',
]);


?>