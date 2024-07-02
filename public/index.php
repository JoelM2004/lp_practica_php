<?php
use app\App;

require_once "../app/config/AppConfig.php";
require_once "../app/config/DBConfig.php";
require_once "../app/vendor/autoload.php";


$titulo = "Menu Principal";
$breadcrumb = "";
$direccion = "";

App::run();

// // echo $_SERVER["DOCUMENT_ROOT"];

// // include_once "../app/resources/template/template.php";

// require_once APP_CONTROLLERS . "base/ControllerInterface.php";
// require_once APP_CONTROLLERS . "UsuariosController.php";
// require_once APP_CONTROLLERS . "ClienteController.php"; // consultar

// use app\core\controller\AutenticacionController;
// use app\core\controller\UsuarioController;
// use app\core\controller\ClienteController;
// use app\core\controller\PerfilController;
// use app\core\controller\ProvinciaController;


// $controller;

// session_start();

// // switch(session_status()){
// //   case PHP_SESSION_ACTIVE: echo'Sesión habilidatada y existente';break;
// //   case PHP_SESSION_DISABLED: echo'Sesión deshabilitada';break;
// //   case PHP_SESSION_NONE: echo 'Sesión habilitada pero no existe';break;
// //   default:break;
// // }

// if (isset($_SESSION["token"]) && $_SESSION["token"] == APP_TOKEN) {

//   $controller = $_GET["controller"];
// } else {

//   $controller = "autenticacion";
// }

// switch ($controller) {
//   case "usuario":
//     $controller = new UsuarioController();
//     usuarios($controller);
//     break;

//   case "cliente":
//     $controller = new ClienteController();
//     clientes($controller);
//     break;

//   case "provincia":
//     $controller = new ProvinciaController();
//     provincias($controller);
//     break;

//   case "perfil":
//     $controller = new PerfilController();
//     perfiles($controller);
//     break;

//   case "autenticacion":

//     // Autentication::login("joelMercado","dads");
//     $controller = new AutenticacionController();
//     autenticacion($controller);

//     break;

//   default:
//     break;
// }

// function autenticacion($controller): void
// {

//   switch ($_GET["action"]) {

//     case "index":
//       $controller->index();
//       break;

//     case "logout":
//       $controller->logout();
//       break;

//     case "login":
//       $controller->login();
//       break;
//   }
// }



// function usuarios($controller): void
// {
//   switch ($_GET["action"]) {

//     case "index":
//       $controller->index();
//       break;

//     case "load":
//       $controller->load($_GET["id"]);
//       break;

//     case "create":
//       $controller->create($_GET["id"]);
//       break;

//     case "save":
//       $controller->save();
//       break;

//     case "edit":
//       $controller->edit($_GET["id"]);
//       break;

//     case "update":
//       $controller->update();
//       break;

//     case "delete":
//       $controller->delete();
//       break;

//       case "list":
//         $controller->list();
//         break; 
//   }
// }

// function clientes($controller): void
// {
//   switch ($_GET["action"]) {

//     case "index":
//       $controller->index();
//       break;

//     case "load":
//       $controller->load($_GET["id"]);
//       break;

//     case "create":
//       $controller->create($_GET["id"]);
//       break;

//     case "save":
//       $controller->save();
//       break;

//     case "edit":
//       $controller->edit($_GET["id"]);
//       break;

//     case "update":
//       $controller->update();
//       break;

//     case "delete":
//       $controller->delete();
//       break;

//       case "list":
//         $controller->list();
//         break; 
//   }
// }

// function perfiles($controller): void
// {
//   switch ($_GET["action"]) {

//     case "index":
//       $controller->index();
//       break;

//     case "load":
//       $controller->load($_GET["id"]);
//       break;

//     case "create":
//       $controller->create($_GET["id"]);
//       break;

//     case "save":
//       $controller->save();
//       break;

//     case "edit":
//       $controller->edit($_GET["id"]);
//       break;

//     case "update":
//       $controller->update();
//       break;

//     case "delete":
//       $controller->delete();
//       break;

//     case "list":
//       $controller->list();
//       break;  
//   }
// }

// function provincias($controller): void
// {
//   switch ($_GET["action"]) {

//     case "index":
//       $controller->index();
//       break;

//     case "load":
//       $controller->load($_GET["id"]);
//       break;

//     case "create":
//       $controller->create($_GET["id"]);
//       break;

//     case "save":
//       $controller->save();
//       break;

//     case "edit":
//       $controller->edit($_GET["id"]);
//       break;

//     case "update":
//       $controller->update();
//       break;

//     case "delete":
//       $controller->delete();
//       break;

//       case "list":
//         $controller->list();
//         break; 
//   }
// }
