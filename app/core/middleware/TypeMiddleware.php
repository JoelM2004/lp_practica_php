<?php

namespace app\core\middleware;

use app\core\middleware\base\Middleware;
use app\core\middleware\base\MiddlewareInterface;
use app\libs\request\Request;
use app\libs\response\Response;

final class TypeMiddleware extends Middleware implements MiddlewareInterface {

    public function handler(Request $request, Response $response): void {
        // Verificar si la variable de sesión 'perfilId' existe
        if (isset($_SESSION["perfil"])) {
            $id = $_SESSION["perfil"];
        } else {
            $this->next($request, $response);
            return;
        }

        // Establecer el tipo de usuario en el request
        $request->setTipoUsuario($_SESSION["perfil"]);
        // Obtener la ruta actual
        $ruta = $request->getController() . '/' . $request->getAction();

        if ((isset($_SESSION["token"]) || $_SESSION["token"]===APP_TOKEN)&&$request->getController()=="autenticacion"){
            header("refresh:0.1;url=" . APP_FRONT . "inicio/index");
       }

        // Verificar si el usuario tiene permisos para la ruta específica
        if ($this->tienePermiso($_SESSION["perfil"], $ruta)) {
            // Pasar el control al siguiente middleware
            $this->next($request, $response);
        } else {
            // Si no tiene permiso, devolver una respuesta de error
            header("refresh:0.1;url=" . APP_FRONT . "inicio/index");

        }
    }


    private function tienePermiso(string $tipoUsuario, string $ruta): bool {
        $permisos = [
            'Administrador' => ['*'], // El administrador tiene acceso a todas las rutas
            'Operador' => ["inicio/index","autenticacion/login","autenticacion/logout","autenticacion/index","cliente/save","cliente/list","cliente/load",'cliente/edit', 'cliente/index', 'cliente/create',"cliente/delete","cliente/update", 'usuario/datos',"cliente/pdf","usuario/changePassword","autenticacion/reset", "provincia/load"] // Definir rutas permitidas para el operador
            
        ];

        if($tipoUsuario!="Administrador"&&$tipoUsuario!="Operador"){
             $tipoUsuario="Operador";
         }

        if (isset($permisos[$tipoUsuario])) {
            return in_array('*', $permisos[$tipoUsuario]) || in_array($ruta, $permisos[$tipoUsuario]);
        }
    
        return false;
    
    }
}
