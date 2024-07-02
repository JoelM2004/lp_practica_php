<?php

namespace app\core\model\dao;

use app\core\model\base\InterfaceDAO;
use app\core\model\base\DAO;
use app\core\model\base\InterfaceDTO;
use app\core\model\dto\ProvinciaDTO;
use Exception;

final class ProvinciaDAO extends DAO implements InterfaceDAO
{
    public function __construct($conn)
    {
        parent::__construct($conn,'provincias');
    }


    public function save(InterfaceDTO $object):void{

        $this->validate($object);
        $this->validateName($object);

        $sql="INSERT INTO {$this->table} VALUES(DEFAULT,:nombre)";//:apellido, variable reemplazada por un dato, o una consulta preparada
        $stmt=$this->conn->prepare($sql);
        $data=$object->toArray();
        unset($data["id"]);
        $stmt->execute($data);

        $object->setId((int)$this->conn->lastInsertId());
        // $stmt->execute(["nombre"=>$object->getNombre()]);// esto es una forma...
        // $this->conn->exec($sql);
    }

    public function load($id):ProvinciaDTO{
        // $provincia= new ProvinciaDTO();
        $sql="SELECT id,nombre FROM {$this->table} WHERE id = :id";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(["id"=>$id]);

        if($stmt->rowCount()!==1){

            throw new \Exception("La provincia no se cargó correctamente");

        }

        return new ProvinciaDTO($stmt->fetch(\PDO::FETCH_ASSOC));//LO DEVUELVE EN UNA MATRIZ ASOCIATIVA

    }

    public function update(InterfaceDTO $object):void{
        $this->validate($object);
        $this->validateName($object);

        $sql="UPDATE {$this->table} SET nombre=:nombre WHERE id= :id";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute($object->toArray());

    }
    public function delete($id):void{

        $sql="DELETE FROM {$this->table} WHERE id= :id";
        $stmt=$this ->conn->prepare($sql);
        $stmt->execute([
            "id"=>$id
        ]);
    
    }

    public function list():array{

        $sql = "SELECT * FROM {$this->table}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

        
    }


    private function validate(ProvinciaDTO $object):void{

        if($object->getNombre()==""){
            throw new \Exception("El dato nombre de la provincia es obligatorio");
        }

    }

    private function validateName(ProvinciaDTO $object):void{

        $sql ="SELECT count(id) AS cantidad FROM {$this->table} WHERE nombre=:nombre AND id!=:id";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute($object->toArray());
        $result=$stmt->fetch(\PDO::FETCH_OBJ);//lo trae como un objeto a lo de arriba
        if($result->cantidad>0){

            throw new \Exception("El dato nombre ({$object->getNombre()}) ya existe en la base de datos");

        }
    }

}

