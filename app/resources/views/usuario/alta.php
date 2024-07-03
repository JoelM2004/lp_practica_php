<div class="container-fluid row">

  <form id="formUsuario" class="col-4">

    <div class="input-group mb-3">
      <button class="btn btn-primary" type="button" id="btnUsuarioLoad">Buscar</button>
      <input id="buscarUsuario" type="number" class="form-control" placeholder="Escriba el ID de un Usuario" aria-label="Example text with button addon" aria-describedby="button-addon1">
    </div>


    <div class="input-group mb-3">
      <button id="btnUsuarioListar" type="button" class="btn btn-primary mt-3">Listar todos los usuarios</button>
    </div>



    <div class="mb-3">
      <label for="nombreUsuario" class="form-label">Nombre del Usuario</label>
      <input type="text" class="form-control" id="nombreUsuario">
    </div>



    <div class="mb-3">
      <label for="apellidoUsuario" class="form-label">Apellido del Usuario</label>
      <input type="text" class="form-control" id="apellidoUsuario">
    </div>

    <div class="mb-3">
      <label for="cuentaUsuario" class="form-label">Cuenta del Usuario</label>
      <input type="text" class="form-control" id="cuentaUsuario">
    </div>

    <div class="mb-3">
      <label for="emailUsuario" class="form-label">Email del Usuario</label>
      <input type="email" class="form-control" id="emailUsuario" aria-describedby="emailHelp">
    </div>

    <div class="mb-3">
      <label for="claveUsuario" class="form-label">Clave del Usuario</label>
      <input type="password" class="form-control" id="claveUsuario">
    </div>

    <!-- <div class="mb-3">
      <label for="perfilId" class="form-label">Perfil del Usuario</label>
      <input type="text" class="form-control" id="perfilId">
    </div> -->

    <?php

    use app\core\model\dao\PerfilDAO;
    use app\libs\Connection\Connection;

    $conn = Connection::get();

    $daoPerfil = new PerfilDAO($conn);
    $datosPerfiles = $daoPerfil->list();


    ?>

    <div class="mb-3">
      <label for="perfilId" class="form-label">Perfil del Usuario</label>
      <select name="perfilId" class="form-select" id="perfilId" aria-label="Seleccione...">

        <?php
        $txt = ''; // Inicializar $txt antes del bucle

        foreach ($datosPerfiles as $elemento) {
          $txt .= '<option value="' . $elemento['id'] . '">' . $elemento['nombre'] . '</option>';
        }

        echo $txt;
        ?>

      </select>

    </div>




    <div class="mb-3">
      <label for="horaEntrada" class="form-label">Hora de Entrada del Usuario</label>
      <input type="time" class="form-control" id="horaEntrada">
    </div>

    <div class="mb-3">
      <label for="horaSalida" class="form-label"> Hora de Salida del Usuario</label>
      <input type="time" class="form-control" id="horaSalida">
    </div>

    <!-- <div class="mb-3">
      <label for="fechaAlta" class="form-label">Fecha de Alta del Usuario</label>
      <input type="date" class="form-control" id="fechaAlta">
    </div> -->


    <button id="btnUsuarioAlta" type="button" class="btn btn-primary">Registrar Usuario</button>

  </form>

  <div class="col-1 p-10">
    <table id="tablaUsuario" class="table table-dark">
      <thead>
        <tr>
          <th colspan="9">
            Listado de Usuarios
          </th>

          <th colspan="2">
          <button type="button" id="imprimirUsuarios" class="btn btn-success" > PDF Usuarios</button>
            <!-- <a target="_blank" href="<?= APP_FRONT . "usuario/pdf" ?>">Generar PDF</a> -->
          </th>


        </tr>
        <tr>
          <th scope="col">id</th>
          <th scope="col">Apellido</th>
          <th scope="col">Nombre</th>
          <th scope="col">Cuenta</th>
          <th scope="col">Correo</th>
          <th scope="col">Perfil</th>
          <th scope="col">Estado</th>
          <th scope="col">hora de Entrada</th>
          <th scope="col">hora de Salida</th>
          <th scope="col">Fecha Alta</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody id="tbodyUsuario">



      </tbody>
    </table>
  </div>
</div>