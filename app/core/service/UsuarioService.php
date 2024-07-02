<?php

namespace app\core\service;

use app\core\service\base\InterfaceService;
use app\core\model\dto\UsuarioDTO;
use app\core\model\dao\UsuarioDAO;
use app\core\service\base\Service;
use app\libs\connection\Connection;

final class UsuarioService  extends Service implements InterfaceService {

    public function __construct()
    {
        parent::__construct();
    }

    public function save(array $object):void{
        $conn= Connection::get();
        $dao= new UsuarioDAO($conn);
        $dao->save(new UsuarioDTO($object));
    }

    public function load($id):UsuarioDTO{
        $conn= Connection::get();
        $dao= new UsuarioDAO($conn);
        return $dao->load($id);
    }

    public function enable(array $object):void{
        $conn= Connection::get();
        $dao= new UsuarioDAO($conn);
        $dao->enable(new UsuarioDTO($object));
    }

    public function disable(array $object):void{
        $conn= Connection::get();
        $dao= new UsuarioDAO($conn);
        $dao->disable(new UsuarioDTO($object));
    }

    public function reset(array $object):void{
        $conn= Connection::get();
        $dao= new UsuarioDAO($conn);
        $dao->reset(new UsuarioDTO($object));
    }

    public function changePassword(array $object):void{
        $conn= Connection::get();
        $dao= new UsuarioDAO($conn);
        $dao->changePassword(new UsuarioDTO($object));
    }

    public function update(array $object):void{
        $conn= Connection::get();
        $dao= new UsuarioDAO($conn);
        $dao->update(new UsuarioDTO($object));
    }

    public function delete($id):void{

        $conn= Connection::get();
        $dao= new UsuarioDAO($conn);
        $dao->delete($id);

    }

    public function list():array{
        $conn= Connection::get();
        $dao= new UsuarioDAO($conn);
        return $dao->list();
    }

   
}

