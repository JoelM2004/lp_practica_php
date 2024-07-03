<?php

namespace app\core\middleware;

use app\core\middleware\base\Middleware;
use app\core\middleware\base\MiddlewareInterface;
use app\libs\request\Request;
use app\libs\response\Response;

use app\core\model\dao\PerfilDAO;
use app\core\model\dao\UsuarioDAO;
use app\core\model\dao\ClienteDAO;

use app\libs\Connection\Connection;



final class IDMiddleware extends Middleware implements MiddlewareInterface {

    public function handler(Request $request, Response $response): void {
        // Obtener datos del request
        $id = $request->getId();
        $controlador = $request->getController();
        $accion = $request->getAction();
        
        // Verificar si es una acción de edición de perfil
        if ($controlador === "perfil" && $accion === "edit") {
            $conn = Connection::get();
            $daoPerfil = new PerfilDAO($conn);
            $comprobar= $daoPerfil->listID();    
            
            if (in_array($id, array_column($comprobar, 'id'))){
                $this->next($request, $response);
            }else header("refresh:0.1;url=" . APP_FRONT . "perfil/create");
        
        }

        if ($controlador === "usuario" && $accion === "edit") {
            $conn = Connection::get();
            $daoUsuario = new UsuarioDAO($conn);
            $comprobar= $daoUsuario->listID();    
            
            if (in_array($id, array_column($comprobar, 'id'))){
                $this->next($request, $response);
            }else header("refresh:0.1;url=" . APP_FRONT . "usuario/create");
        
        }

        if ($controlador === "cliente" && $accion === "edit") {
            $conn = Connection::get();
            $daoCliente = new ClienteDAO($conn);
            $comprobar= $daoCliente->listID();    
            
            if (in_array($id, array_column($comprobar, 'id'))){
                $this->next($request, $response);
            }else header("refresh:0.1;url=" . APP_FRONT . "cliente/create");
        
        }




        
        // Pasar el control al siguiente middleware si el ID es válido o no es necesario verificar
        $this->next($request, $response);
    
    }
}
