<?php

namespace app\core\controller;
use app\libs\request\Request;
use app\libs\response\Response;
use app\core\controller\base\Controller;
use app\core\controller\base\ControllerInterface;
use app\core\service\ProvinciaService;

final class ProvinciaController extends Controller implements ControllerInterface{

    public function __construct()
    {
        parent::__construct([
            "app/js/provincia/provinciaController.js",
             "app/js/provincia/provinciaService.js"
        ]);
    }

    public function index():void{
        $this->view = "provincia/index.php";
        $titulo="Menú Principal provincia";

        $breadcrumbActual="";
        $breadcrumbLink=APP_FRONT."usuario/index";
        $breadcrumbPasada="Menu Principal";

        
        require_once APP_TEMPLATE."template.php";
    }
    
    /*
    *Gestiona los servicios correspondientes, para la busqueda de una entidad existente en el sistema, se debe enviar el id en la petición del cliente de la petición
    */
    public function load(Request $request, Response $response):void{
        
        $service = new ProvinciaService();
        $info = $service->load($request->getId());
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
        $this->view="provincia/alta.php";
        $titulo="Crear provincia";

        $breadcrumbActual="Crear Provincia";
        $breadcrumbLink=APP_FRONT."usuario/index";
        $breadcrumbPasada="Inicio";
        
        require_once APP_TEMPLATE."template.php";
    }


    /*
    *Gestiona los servicios correspondientes, para el alta de una nueva entidad en el sistema
    */
    public function save(Request $request, Response $response):void{
        
        $service = new ProvinciaService();
        $service->save($request->getData());
        $response->setMessage("La cuenta se registró correctamente");
        $response->send();
    
    }

    /*
    Invoca la vista corerspondiente para poder modificar los datos de una entidad existente
    */
    public function edit($id):void{

        $this->view="provincia/modificar.php";
        $titulo="Modificar provincia";
        $breadcrumbActual="Modificar Provincia";
        $breadcrumbLink=APP_FRONT."provincia/create";
        $breadcrumbPasada="Crear Provincia";
        require_once APP_TEMPLATE."template.php";
    }

    /*
    Gestiona los servicios correspondietes apra la actualización de datos de una entidad existente
    */
    public function update(Request $request, Response $response):void{
        
        $service=new ProvinciaService();

        $data= $request->getData();
        
        $info = $service->load($data["id"]);

        $info=$info->toArray();
        // var_dump($data);
        $service->update($data);
        $response->setMessage("La provincia se actualizó correctamente");
        $response->send();
    }

    /*
    Gestiona los servicios correspondietes, para la eliminación fisica de la entidad
    */
    public function delete(Request $request, Response $response):void{

        $service = new ProvinciaService();
        $info=$request->getData();
        $service->delete($info["id"]);
        $response->setMessage("El Perfil se eliminó con éxito");
        $response->send();



    }

    public function list(Request $request, Response $response): void
    {
        $service = new ProvinciaService();
        $response->setResult($service->list());
        $response->setMessage("La cuenta se listó correctamente");
        $response->send();
    }
}