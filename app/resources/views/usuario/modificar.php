<?php

use app\core\model\dao\PerfilDAO;
use app\core\model\dao\UsuarioDAO;
use app\libs\Connection\Connection;

$id = $_GET['id'];
$conn = Connection::get();
$dao = new UsuarioDAO($conn);
$datos = $dao->load($id);

$daoPerfil = new PerfilDAO($conn);
$datosPerfiles = $daoPerfil->list();

?>

<div class="container-fluid row">

  <form class="col-4" id="formActualizarUsuario">
    <div class="mb-3">
      <label for="nombreUsuarioMod" class="form-label">Nombre del Usuario</label>
      <input type="text" class="form-control" id="nombreUsuarioMod" value=<?= $datos->getNombres() ?>>
    </div>

    <div class="mb-3">
      <label for="apellidoUsuarioMod" class="form-label">Apellido del Usuario</label>
      <input type="text" class="form-control" id="apellidoUsuarioMod" value=<?= $datos->getApellido() ?>>
    </div>

    <div class="mb-3">
      <label for="cuentaUsuarioMod" class="form-label">Cuenta del Usuario</label>
      <input type="text" class="form-control" id="cuentaUsuarioMod" value=<?= $datos->getCuenta() ?>>
    </div>

    <div class="mb-3">
      <label for="emailUsuarioMod" class="form-label">Email del Usuario</label>
      <input type="email" class="form-control" id="emailUsuarioMod" aria-describedby="emailHelp" value=<?= $datos->getCorreo() ?>>
    </div>

    <!-- <div class="mb-3">
      <label for="claveUsuarioMod" class="form-label">Clave del Usuario</label>
      <input type="password" class="form-control" id="claveUsuarioMod">
    </div> -->

    <div class="mb-3">
      <label for="perfilIdMod" class="form-label">Perfil del Usuario</label>
      <select name="perfilIdMod" class="form-select" id="perfilIdMod" aria-label="Seleccione...">
        <?php
        foreach ($datosPerfiles as $elemento) {
          $selected = $datos->getPerfilId() == $elemento['id'] ? 'selected' : '';
          echo '<option value="' . $elemento['id'] . '" ' . $selected . '>' . $elemento['nombre'] . '</option>';
        }
        ?>
      </select>
    </div>

    <!-- <div class="mb-3">
      <label for="estadoUsuarioMod" class="form-label">Estado del Usuario</label>
      <input type="text" class="form-control" id="estadoUsuarioMod">
    </div> -->

    <div class="mb-3">
      <label for="horaEntradaMod" class="form-label">Hora de Entrada del Usuario</label>
      <input type="time" class="form-control" id="horaEntradaMod" value=<?= $datos->getHoraEntrada() ?>>
    </div>

    <div class="mb-3">
      <label for="horaSalidaMod" class="form-label"> Hora de Salida del Usuario</label>
      <input type="time" class="form-control" id="horaSalidaMod" value=<?= $datos->getHoraSalida() ?>>
    </div>

    <!-- <div class="mb-3">
      <label for="fechaAltaMod" class="form-label">Fecha de Alta del Usuario</label>
      <input type="date" class="form-control" id="fechaAltaMod">
    </div> -->


    <button type="button" id="modificarUsuario" class="btn btn-primary">Modificar Usuario</button>

  </form>

  <div class="col-8 p-4">
    <table class="table table-light">
      <thead>
        <tr>
          <th colspan="11">
            Datos de Usuario
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
      <tbody>

        <tr id="filaModificarUsuario" data-id=<?= $datos->getId() ?>>
          <th><?= $datos->getId() ?></th>
          <td><?= $datos->getApellido() ?></td>
          <td><?= $datos->getNombres() ?></td>
          <td><?= $datos->getCuenta() ?></td>
          <td><?= $datos->getCorreo() ?></td>
          <td>
            <?php
               $datosPerfil=$daoPerfil->load($datos->getPerfilId());
               echo $datosPerfil->getNombre()
            ?>
          </td>
          <td><?php

              if ($datos->getEstado() == 1) {
                echo '<i class="fas fa-circle text-success"></i>';
              } else echo '<i class="fas fa-circle text-danger"></i>'
              ?>

          </td>



          <td><?= $datos->getHoraEntrada() ?></td>
          <td><?= $datos->getHoraSalida() ?></td>
          <td><?= $datos->getFechaAlta() ?></td>
          <td>

            <a id="btnEliminarUsuarios" href="<?= APP_FRONT . "usuario/create/0" ?>" class="btn btn-sm btn-danger">
              <i class="fas fa-trash"></i>
            </a>

          </td>
        </tr>


      </tbody>
    </table>
    <button id="deshabilitarUsuario" type="button" class="btn btn-danger">Deshabilitar Cuenta</button>
    <button id="habilitarUsuario" type="button" class="btn btn-success">Habilitar Cuenta</button>
    <button id="resetearUsuario" type="button" class="btn btn-warning">Resetear Cuenta</button>

  </div>
</div>