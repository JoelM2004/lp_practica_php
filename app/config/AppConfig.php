<?php

define("APP_URI", $_SERVER["DOCUMENT_ROOT"]."/lp_practica_php/app/");

define("APP_URL", $_SERVER["DOCUMENT_ROOT"]."/lp_practica_php/public/");

define("APP_FRONT","http://localhost/lp_practica_php/public/");

define("APP_TEMPLATE", APP_URI."resources/template/");

define("APP_VIEWS",APP_URI. "resources/views/");

define("APP_CONTROLLERS",APP_URI. "core/controller/");

CONST APP_TOKEN="CLAVE_SECRETA";

CONST APP_DEFAULT_CONTROLLER = "inicio";

CONST APP_DEFAULT_ACTION = "index";