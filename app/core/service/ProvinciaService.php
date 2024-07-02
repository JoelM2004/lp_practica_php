<?php

namespace app\core\service;

use app\core\service\base\InterfaceService;
use app\core\model\dto\ProvinciaDTO;
use app\core\model\dao\ProvinciaDAO;
use app\core\service\base\Service;
use app\libs\Connection\Connection;

final class ProvinciaService  extends Service implements InterfaceService {

    public function __construct()
    {
        parent::__construct();
    }

    public function save(array $object):void{
        $conn= Connection::get();
        $dao= new ProvinciaDAO($conn);
        $dao->save(new ProvinciaDTO($object));
    }

    public function load($id):ProvinciaDTO{
        $conn= Connection::get();
        $dao= new ProvinciaDAO($conn);
        $dto=$dao->load($id);
        return $dto;
        
    }

    public function update(array $object):void{
        $conn= Connection::get();
        $dao= new ProvinciaDAO($conn);
        $dao->update(new ProvinciaDTO($object));
    }

    public function delete($id):void{

        $conn= Connection::get();
        $dao= new ProvinciaDAO($conn);

        $dao->delete($id);

    }

    public function list():array{
        $conn=Connection::get();
        $dao= new ProvinciaDAO($conn);
        return $dao->list();
    }

   
}

