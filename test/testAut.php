<?php
require_once "../app/config/AppConfig.php";
require_once "../app/config/DBConfig.php";
require_once "../app/vendor/autoload.php";

use app\libs\autentication\Autentication;

try{
Autentication::login("hola12221211","locuras1234");

}

catch(Exception $ex){

    echo $ex->getMessage();

}