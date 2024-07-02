<?php

namespace app\core\service;

use app\core\service\base\InterfaceService;
use app\core\model\dto\ClienteDTO;
use app\core\model\dao\ClienteDAO;
use app\core\service\base\Service;
use app\libs\Connection\Connection;

final class ClienteService  extends Service implements InterfaceService {

    public function __construct()
    {
        parent::__construct();
    }

    public function save(array $object):void{
        $conn= Connection::get();
        $dao= new ClienteDAO($conn);
        $dao->save(new ClienteDTO($object));
    }

    public function load($id):ClienteDTO{
        $conn= Connection::get();
        $dao= new ClienteDAO($conn);  
        return $dao->load($id); 
    }

    public function update(array $object):void{
        $conn= Connection::get();
        $dao= new ClienteDAO($conn);
        $dao->update(new ClienteDTO($object));
    }

    public function delete($id):void{
        $conn= Connection::get();
        $dao= new ClienteDAO($conn);
        $dao->delete($id);
    }


    public function list():array{
        $conn= Connection::get();
        $dao= new ClienteDAO($conn);
        return $dao->list();
    }

   
}

