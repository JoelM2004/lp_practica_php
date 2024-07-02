<div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="text-center">
            <h1>Bienvenido a Nuestra Página</h1>
            <a href=<?php

                if ($_SESSION["perfil"]=="Administrador") {
                   echo APP_FRONT."usuario/index";
                }else{
                   echo APP_FRONT."cliente/index";
                }
            
            ?> class="btn btn-primary btn-lg mt-3">Comenzar</a>
        </div>
    </div>