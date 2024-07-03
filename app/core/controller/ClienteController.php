<?php

namespace app\core\controller;

use app\libs\request\Request;
use app\libs\response\Response;
use app\core\controller\base\Controller;
use app\core\controller\base\ControllerInterface;
use app\core\service\ClienteService;


final class ClienteController extends Controller implements ControllerInterface{

    public function __construct()
    {
        parent::__construct([
            "app/js/cliente/clienteController.js",
             "app/js/cliente/clienteService.js",
             "app/js/provincia/provinciaService.js",
             "app/js/provincia/provinciaController.js"
        ]);
    }

    public function pdf():void{
        require_once('C:\\xampp\\htdocs\\lp_practica_php\\app\\reports\\testReport.php');
        // $this->view = "cliente/pdf.php";
    }


    public function index():void{
        
        $this->view = "cliente/index.php";
        $titulo="Menú Principal Cliente";

        $breadcrumbActual="";
        $breadcrumbLink=APP_FRONT."usuario/index";
        $breadcrumbPasada="Menu Principal";

        require_once APP_TEMPLATE."template.php";
    
    }
    
    /*
    *Gestiona los servicios correspondientes, para la busqueda de una entidad existente en el sistema, se debe enviar el id en la petición del cliente de la petición
    */
    public function load(Request $request, Response $response):void{
        
        $service = new ClienteService();
        $info = $service->load($request->getId());
        $info=$info->toArray();
        $response->setResult($info);
        $response->setMessage("El Cliente se cargó correctamente");

        $response->send();
    }

    /*
    *Invoca la vista correspondientem para el alta de una nueva entidad
    *@param int id parametro opcional que permite la conación del registro
     */
    public function create($id):void{
        $this->view="cliente/alta.php";
        $titulo="Crear Cliente";

        $breadcrumbActual="Crear Cliente";
        $breadcrumbLink=APP_FRONT."usuario/index";
        $breadcrumbPasada="Inicio";

        require_once APP_TEMPLATE."template.php";

    }


    /*
    *Gestiona los servicios correspondientes, para el alta de una nueva entidad en el sistema
    */
    public function save(Request $request, Response $response):void{
        $service = new ClienteService();
        $service->save($request->getData());
        $response->setMessage("El Cliente se registró correctamente");
        $response->send();


    }

    /*
    Invoca la vista corerspondiente para poder modificar los datos de una entidad existente
    */
    public function edit($id):void{

        $this->view="cliente/modificar.php";
        $titulo="Modificar Cliente";

        $breadcrumbActual="Modificar Cliente";
        $breadcrumbLink=APP_FRONT."cliente/create";
        $breadcrumbPasada="Crear Cliente";
        
        require_once APP_TEMPLATE."template.php";
    }

    /*
    Gestiona los servicios correspondietes apra la actualización de datos de una entidad existente
    */
    public function update(Request $request, Response $response):void{
        $service = new ClienteService();

        $data= $request->getData();
        
        $info = $service->load($data["id"]);

        $info=$info->toArray();
        // var_dump($data);
        $service->update($data);
        $response->setMessage("El Cliente se actualizó correctamente");
        $response->send();
    
    }

    /*
    Gestiona los servicios correspondietes, para la eliminación fisica de la entidad
    */
    public function delete(Request $request, Response $response):void{
        $service = new ClienteService();
        $info=$request->getData();
        $service->delete($info["id"]);
        $response->setMessage("El Cliente se eliminó con éxito");
        $response->send();

    }   

    public function list(Request $request, Response $response):void{

        $service = new ClienteService();
        $response->setResult($service->list());
        $response->setMessage("La Cliente se listó correctamente");
        $response->send();


    }

}