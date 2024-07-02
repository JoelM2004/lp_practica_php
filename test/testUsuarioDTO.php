<?php
require_once "../app/config/AppConfig.php";
require_once "../app/config/DBConfig.php";
require_once "../app/vendor/autoload.php";


use app\core\model\dao\UsuarioDAO;
use app\libs\connection\Connection;

$conexion = Connection::get();
    echo "Conexion establecida";
    echo "<br>";
    
    $dao = new UsuarioDAO($conexion);
    $provincia=$dao->load(64);
    print_r($provincia->toArray());

    $provincia->setHoraEntrada("14:00");
    echo "<br>";

try{

    // $dao->update($provincia);


    

}
catch(PDOException $ex){
    echo '<p>Error de conexión ' . $ex->getMessage() . '</p>';
}