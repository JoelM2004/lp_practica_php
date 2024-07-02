<?php
require_once "../app/config/DBConfig.php";
require_once "../app/vendor/autoload.php";

use app\core\model\dao\ProvinciaDAO;
use app\libs\connection\Connection;

try{
    $conexion = Connection::get();
    echo "Conexion establecida";
    echo "<br>";

    
    $dao = new ProvinciaDAO($conexion);
    $provincia=$dao->load(8);
    print_r($provincia->toArray());

    $provincia->setNombre("");

    try{
        $dao->update($provincia);
        }
        catch(Exception $ex){
    
            print_r($ex->getMessage());
            echo "<br>";
        }


    print_r("ID => ". $provincia->getId());
}
catch(PDOException $ex){
    echo '<p>Error de conexión ' . $ex->getMessage() . '</p>';
}