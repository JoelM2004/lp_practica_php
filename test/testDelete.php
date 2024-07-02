<?php

require_once "../app/vendor/autoload.php";

use app\core\model\dao\ProvinciaDAO;
use app\libs\connection\Connection;

try{
    $conexion = Connection::get();
    echo "Conexion establecida";
    echo "<br>";
    
    $dao = new ProvinciaDAO($conexion);
    $provincia=$dao->load(4);
    print_r($provincia->toArray());

    $provincia->setNombre("Juancarlos");
    $dao->update($provincia);

    $dao->delete(5);
}
catch(PDOException $ex){
    echo '<p>Error de conexión ' . $ex->getMessage() . '</p>';
}