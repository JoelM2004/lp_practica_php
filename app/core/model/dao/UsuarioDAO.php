<?php

namespace app\core\model\dao;

use app\core\model\base\InterfaceDAO;
use app\core\model\base\DAO;
use app\core\model\base\InterfaceDTO;
use app\core\model\dto\PerfilDTO;
use app\core\model\dto\UsuarioDTO;

final class UsuarioDAO extends DAO implements InterfaceDAO{

    public function __construct($conn)
    {
        parent::__construct($conn,"usuarios");
    }


    public function save(InterfaceDTO $object):void{

        $this->validate($object);
        $clave=password_hash($object->getClave(),PASSWORD_DEFAULT);
        $this->validateCuenta($object);
        $this->validateCorreo($object);

        $sql="INSERT INTO {$this->table} VALUES(DEFAULT,:apellido,:nombres,:cuenta,:clave,:correo,:perfilId,1,:horaEntrada,:horaSalida,NOW(),0)";//:apellido, variable reemplazada por un dato, o una consulta preparada
        $stmt=$this->conn->prepare($sql);
        $data=$object->toArray();
        unset($data["id"]);
        unset($data["estado"]);
        unset($data["resetear"]);
        unset($data["fechaAlta"]);
        $data["clave"]=$clave;
        $stmt->execute($data);

        $object->setId((int)$this->conn->lastInsertId());

        // $this->conn->exec($sql);
    }

    public function listID():array{
        $sql = "SELECT id FROM {$this->table}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function load($id):UsuarioDTO{

        $sql="SELECT id,apellido,nombres,cuenta,clave,correo,perfilId,estado,horaEntrada,horaSalida,fechaAlta,resetear FROM {$this->table} WHERE id = :id";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(["id"=>$id]);

        if($stmt->rowCount()!==1){

            throw new \Exception("El perfil no se cargó correctamente");

        }

        return new UsuarioDTO($stmt->fetch(\PDO::FETCH_ASSOC));//LO DEVUELVE EN UNA MATRIZ ASOCIATIVA


    }

    public function update(InterfaceDTO $object): void {
        $this->validate($object);
        $this->validateCorreo($object);
        
        // $object =parse_ini_file(UsuarioDTO,$object);

        $sql = "UPDATE {$this->table} 
                SET nombres = :nombres, 
                    apellido = :apellido, 
                    cuenta = :cuenta, 
                    correo = :correo, 
                    perfilId = :perfilId, 
                    horaEntrada = :horaEntrada, 
                    horaSalida = :horaSalida 
                WHERE id = :id";
    
        $stmt = $this->conn->prepare($sql);
    
        $stmt->execute([
            ':nombres' => $object->getNombres(),
            ':apellido' => $object->getApellido(),
            ':cuenta' => $object->getCuenta(),
            ':correo' => $object->getCorreo(),
            ':perfilId' => $object->getPerfilId(),
            ':horaEntrada' => $object->getHoraEntrada(),
            ':horaSalida' => $object->getHoraSalida(),
            ':id' => $object->getId()
        ]);
    }
    
    public function enable(InterfaceDTO $object): void {
    $sql = "UPDATE {$this->table} SET estado = :estado WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([
        ':estado' => $object->getEstado(),
        ':id' => $object->getId()
    ]);
}

    public function disable(InterfaceDTO $object): void {
    $sql = "UPDATE {$this->table} SET estado = :estado WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([
        ':estado' => $object->getEstado(),
        ':id' => $object->getId()
    ]);
}



public function changePassword(InterfaceDTO $object): void {

    $clave=password_hash($object->getClave(),PASSWORD_DEFAULT);
    
    $sql = "UPDATE {$this->table} SET clave = :clave WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([
        ':clave' => $clave,
        ':id' => $object->getId()
    ]);
}




    public function reset(InterfaceDTO $object):void{
        $sql = "UPDATE {$this->table} SET resetear = :resetear WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
        ':resetear' => $object->getResetear(),
        ':id' => $object->getId()
    ]);
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





    
        private function validate(UsuarioDTO $object): void
{
    // Lista de métodos a verificar
    $atributos = [
        'getNombres',
        'getApellido',
        'getCuenta',
        'getClave',
        // 'getFechaAlta',
        'getEstado',
        'getCorreo',
        'getPerfilId',
        'getHoraEntrada',
        'getHoraSalida',
        'getResetear'
    ];

    foreach ($atributos as $atributo) {
        if (method_exists($object, $atributo) && $object->{$atributo}() === "") {
            throw new \Exception("El dato del usuario es obligatorio: " . $atributo);
        }
    }
}

    private function validateCorreo(UsuarioDTO $object): void
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

    private function validateCuenta(UsuarioDTO $object): void
    {
        $sql = "SELECT count(id) AS cantidad FROM {$this->table} WHERE cuenta = :cuenta AND id != :id";
        $stmt = $this->conn->prepare($sql);

        // Asumiendo que el método toArray() del objeto ClienteDTO devuelve un array asociativo con las claves 'correo' e 'id'
        $params = [
            ':cuenta' => $object->getCuenta(),
            ':id' => $object->getId()
        ];

        $stmt->execute($params);
        $result = $stmt->fetch(\PDO::FETCH_OBJ); // lo trae como un objeto a lo de arriba

        if ($result->cantidad > 0) {
            throw new \Exception("El dato cuenta ({$object->getCuenta()}) ya existe en la base de datos");
        }
    }


}


