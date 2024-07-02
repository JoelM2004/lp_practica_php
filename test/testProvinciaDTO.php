<?php
require_once "../app/config/DBConfig.php";
require_once "../app/vendor/autoload.php";

use app\core\model\dao\ProvinciaDAO;
use app\libs\connection\Connection;
use app\core\model\dao\UsuarioDAO;
use app\core\model\dto\ProvinciaDTO;

try{
    $conexion = Connection::get();
    echo "Conexion establecida";
    echo "<br>";

    $data = [
        "id" => "0",
        "nombre" => "Catamarca"

    ];

    $usuario = new ProvinciaDTO($data);
    $dao = new ProvinciaDAO($conexion);

    try{
    $dao->save($usuario);
    }
    catch(Exception $ex){
        echo "<br>";
        print_r($ex->getMessage());

    }
}
catch(PDOException $ex){
    echo '<p>Error de conexión ' . $ex->getMessage() . '</p>';
}