<?php

namespace app\core\model\dao;

use app\core\model\base\InterfaceDAO;
use app\core\model\base\DAO;
use app\core\model\base\InterfaceDTO;
use app\core\model\dto\ClienteDTO;

final class ClienteDAO extends DAO implements InterfaceDAO
{

    public function __construct($conn)
    {
        parent::__construct($conn, "clientes");
    }


    public function save(InterfaceDTO $object): void
    {

        $this->validate($object);
        $this->validateDNI($object);
        $this->validateCorreo($object);
        $this->validateCUIT($object);

        $sql = "INSERT INTO {$this->table} VALUES(DEFAULT,:apellido,:nombre,:dni,:cuit,:tipo,:provinciaId,:localidad,:telefono,:correo)"; //:apellido, variable reemplazada por un dato, o una consulta preparada
        $stmt = $this->conn->prepare($sql);
        $data = $object->toArray();
        unset($data["id"]);
        $stmt->execute($data);

        $object->setId((int)$this->conn->lastInsertId());

        // $this->conn->exec($sql);
    }

    public function load($id): ClienteDTO
    {

        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["id" => $id]);

        if($stmt->rowCount()!==1){

            throw new \Exception("El Cliente no se cargó correctamente");

        }

        return new ClienteDTO($stmt->fetch(\PDO::FETCH_ASSOC)); //LO DEVUELVE EN UNA MATRIZ ASOCIATIVA


    }

    public function update(InterfaceDTO $object): void
    {
        
        $this->validate($object);
        $this->validateDNI($object);
        $this->validateCorreo($object);
        $this->validateCUIT($object);

        $sql = "UPDATE {$this->table} SET apellido=:apellido,nombre=:nombre,dni=:dni,cuit=:cuit,tipo=:tipo,provinciaId=:provinciaId,localidad=:localidad,telefono=:telefono,correo=:correo WHERE id= :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($object->toArray());

    }
    public function delete($id): void
    {

        $sql = "DELETE FROM {$this->table} WHERE id= :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([

            "id" => $id

        ]);
    }

    public function list():array{

        $sql = "SELECT * FROM {$this->table}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

        
    }

    

    private function validate(ClienteDTO $object): void
{
    // Lista de métodos a verificar
    $atributos = [
        'getNombre',
        'getApellido',
        'getTelefono',
        'getTipo',
        // 'getFechaAlta',
        'getLocalidad',
        'getCorreo',
        'getProvinciaId',
        'getDNI',
        'getCuit'
        
    ];

    foreach ($atributos as $atributo) {
        if (method_exists($object, $atributo) && $object->{$atributo}() === "") {
            throw new \Exception("El dato del cliente es obligatorio: " . $atributo. ", Revise si se pasó del limite o está usando caracteres no permitidos");
        }
    }
}


    private function validateCorreo(ClienteDTO $object): void
    {
        $sql = "SELECT count(id) AS cantidad FROM {$this->table} WHERE correo = :correo AND id != :id";
        $stmt = $this->conn->prepare($sql);

        // Asumiendo que el método toArray() del objeto ClienteDTO devuelve un array asociativo con las claves 'correo' e 'id'
        $params = [
            ':correo' => $object->getCorreo(),
            ':id' => $object->getId()
        ];

        $stmt->execute($params);
        $result = $stmt->fetch(\PDO::FETCH_OBJ); // lo trae como un objeto a lo de arriba

        if ($result->cantidad > 0) {
            throw new \Exception("El dato correo ({$object->getCorreo()}) ya existe en la base de datos");
        }
    }

    private function validateDNI(ClienteDTO $object): void
    {
        $sql = "SELECT count(id) AS cantidad FROM {$this->table} WHERE dni = :dni AND id != :id";
        $stmt = $this->conn->prepare($sql);

        // Asumiendo que el método toArray() del objeto ClienteDTO devuelve un array asociativo con las claves 'dni' e 'id'
        $params = [
            ':dni' => $object->getDNI(),
            ':id' => $object->getId()
        ];

        $stmt->execute($params);
        $result = $stmt->fetch(\PDO::FETCH_OBJ); // lo trae como un objeto a lo de arriba

        if ($result->cantidad > 0) {
            throw new \Exception("El dato DNI ({$object->getDNI()}) ya existe en la base de datos");
        }
    }

    private function validateCUIT(ClienteDTO $object): void
    {
        $sql = "SELECT count(id) AS cantidad FROM {$this->table} WHERE cuit = :cuit AND id != :id";
        $stmt = $this->conn->prepare($sql);

        // Asumiendo que el método toArray() del objeto ClienteDTO devuelve un array asociativo con las claves 'dni' e 'id'
        $params = [
            ':cuit' => $object->getCuit(),
            ':id' => $object->getId()
        ];

        $stmt->execute($params);
        $result = $stmt->fetch(\PDO::FETCH_OBJ); // lo trae como un objeto a lo de arriba

        if ($result->cantidad > 0) {
            throw new \Exception("El dato CUIT ({$object->getCuit()}) ya existe en la base de datos");
        }
    }
}
