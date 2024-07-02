<?php

require_once("../app/libs/connection/connection.php");
// con el use llamamos a esas clases
use app\libs\connection\Connection;


try{

    $conexion=Connection::get();
    echo '<p> Conexión Establecida</p>';

    // $conexion->close();
    $sql="INSERT INTO perfiles VALUES (DEFAULT,'Administrador'),(DEFAULT,'Operador')";
    $result=$conexion->exec($sql);

    if(!$result){

        echo'<p>Error al Intentar insertar registros</p>';

    }
    print_r($result);
    $conexion->exec('commit');
}

catch(PDOException $ex){

    echo '<p> Conexión no Establecida: ' .$ex->getMessage().'</p>';


}