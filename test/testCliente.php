<?php
require_once "../app/config/DBConfig.php";
require_once "../app/vendor/autoload.php";

use app\libs\connection\Connection;
use app\core\model\dao\ClienteDAO;
use app\core\model\dto\ClienteDTO;
use app\core\model\dto\ProvinciaDTO;
use app\core\model\dao\ProvinciaDAO;

try{
    $conexion = Connection::get();
    echo "Conexion establecida";

    $dataPerfil =[
        "id"=>4,
        "nombre"=>"Lol Mercado"

    ];

    try{
    $perfil= new ProvinciaDTO($dataPerfil);
    $daoPerfil= new ProvinciaDAO($conexion);
    // $daoPerfil->save($perfil);
    $perfilCargado=$daoPerfil->load(3);
    }catch(PDOException $ex){
        echo '<p>Error de conexión ' . $ex->getMessage() . '</p>';
    }



    $data=[
        "id"=>4,
        "apellido"=>"Mercado",
        "nombre"=>"Joel",
        "dni"=>"45383612",
        "cuit"=>"1234569",
        "tipo" => "Persona",
        "provinciaId" => $perfilCargado->getId(),
        "localidad" => "Caleta Olivia",
        "telefono" => "1231315",
        "correo" => "joel2122222@gmail.com"
    ]
    ;


    $usuario = new ClienteDTO($data);
    print_r($usuario->toArray());

    $dao = new ClienteDAO($conexion);
    // print_r($usuario->toArray());
    echo "<br>";
    echo "<br>";
    // print_r($dao->load(46)->toArray());

    $usuario2=$dao->load(9);

    $usuario2->setApellido("NUEVOAPELLIDO");
    $usuario2->setDNI("45383612");
    try{
        // $dao->save($usuario);
        // $dao->delete(42);
        $dao->update($usuario2);
    }

    catch(Exception $ex){
        print_r($ex->getMessage());
        echo "<br>";
    }
}
catch(PDOException $ex){
    echo '<p>Error de conexión ' . $ex->getMessage() . '</p>';
}
