<?php

namespace app\core\controller;
use app\libs\request\Request;
use app\libs\response\Response;
use app\core\controller\base\Controller;
use app\core\controller\base\ControllerInterface;
use app\core\service\UsuarioService;

final class UsuarioController extends Controller implements ControllerInterface{

    public function __construct()
    {
        parent::__construct([
            "app/js/usuario/usuarioController.js",
             "app/js/usuario/usuarioService.js",
             "app/js/perfil/perfilService.js",
             "app/js/perfil/perfilController.js"
        ]);
    }

    public function datos():void{

        $this->view = "usuario/datos.php";

        $titulo="Menú Principal Usuario";
        $breadcrumbActual="Datos del Usuario";
        $breadcrumbLink=APP_FRONT."usuario/index";
        $breadcrumbPasada="Menu Principal";

        require_once APP_TEMPLATE."template.php";

    }

    public function pdf():void{
        $this->view = "usuario/pdf.php";
        $titulo="Listado Usuarios";

        $breadcrumbActual="";
        $breadcrumbLink=APP_FRONT."";
        $breadcrumbPasada="";

        require_once APP_TEMPLATE."template.php";
    }

    public function index():void{
        
        $this->view = "usuario/index.php";

        $titulo="Menú Principal Usuario";
        $breadcrumbActual="";
        $breadcrumbLink=APP_FRONT."usuario/index";
        $breadcrumbPasada="Menu Principal";


        require_once APP_TEMPLATE."template.php";
    
    }
    
    /*
    *Gestiona los servicios correspondientes, para la busqueda de una entidad existente en el sistema, se debe enviar el id en la petición del cliente de la petición
    */
    public function load(Request $request, Response $response):void{

        $service = new UsuarioService();
        $info = $service->load($request->getId());
        $info->toArray();
        $info=$info->toArray();
        $response->setResult($info);
        $response->setMessage("La cuenta se cargó correctamente");

        $response->send();
    
}

    /*
    *Invoca la vista correspondientem para el alta de una nueva entidad
    *@param int id parametro opcional que permite la conación del registro
     */
    public function create($id):void{
        $this->view="usuario/alta.php";

        $titulo="Crear Usuario";
        $breadcrumbActual="Crear Usuario";
        $breadcrumbLink=APP_FRONT."usuario/index";
        $breadcrumbPasada="Inicio";

        require_once APP_TEMPLATE."template.php";

    }


    /*
    *Gestiona los servicios correspondientes, para el alta de una nueva entidad en el sistema
    */
    public function save(Request $request, Response $response):void{
        
        //post lo manda todo como un formulario...
        $service = new UsuarioService();
        $service->save($request->getData());
        $response->setMessage("El usuario se registró correctamente");
        $response->send();
    
        
    
    }

    /*
    Invoca la vista corerspondiente para poder modificar los datos de una entidad existente
    */
    public function edit($id):void{


        $this->view="usuario/modificar.php";
        $titulo="Modificar Usuario";
        $breadcrumbActual="Modificar Usuario";
        $breadcrumbLink=APP_FRONT."usuario/create";
        $breadcrumbPasada="Crear Usuario";
        require_once APP_TEMPLATE."template.php";
    }

    /*
    Gestiona los servicios correspondietes apra la actualización de datos de una entidad existente
    */
    public function update(Request $request, Response $response):void{
        $service = new UsuarioService();

        $data= $request->getData();
        $info = $service->load($data["id"]);

        $info=$info->toArray();
        // var_dump($data);
        $service->update($data);
        $response->setMessage("El Usuario se actualizó correctamente");
        $response->send();
    }

    public function enable(Request $request, Response $response):void{

        $service = new UsuarioService();
        $data= $request->getData();
        $info = $service->load($data["id"]);
        $info=$info->toArray();
        // var_dump($data);
        $service->enable($data);
        $response->setMessage("El usuario se habilitó correctamente");
        $response->send();


    }

    public function disable(Request $request, Response $response):void{

        $service = new UsuarioService();
        $data= $request->getData();
        $info = $service->load($data["id"]);
        $info=$info->toArray();
        // var_dump($data);
        $service->disable($data);
        $response->setMessage("El usuario se deshabilitó correctamente");
        $response->send();


    }

    public function reset(Request $request, Response $response):void{

        $service = new UsuarioService();
        $data= $request->getData();
        $info = $service->load($data["id"]);
        $info=$info->toArray();
        // var_dump($data);
        $service->reset($data);
        $response->setMessage("El usuario se reseteo correctamente");
        $response->send();


    }

    public function changePassword(Request $request, Response $response):void{

        $service = new UsuarioService();
        $data= $request->getData();
        $info = $service->load($data["id"]);
        $info=$info->toArray();
        // var_dump($data);
        $service->changePassword($data);
        $response->setMessage("La contraseña se cambió correctamente");
        $response->send();

    }

    /*
    Gestiona los servicios correspondietes, para la eliminación fisica de la entidad
    */
    public function delete(Request $request, Response $response):void{
        $service = new UsuarioService();
        $info=$request->getData();
        $service->delete($info["id"]);
        $response->setMessage("El Usuario se eliminó con éxito");
        $response->send();




    }

    public function list(Request $request, Response $response): void {
        $service = new UsuarioService();
        $response->setResult($service->list());
        $response->setMessage("El usuario se listó correctamente");
        $response->send();
    }


}
