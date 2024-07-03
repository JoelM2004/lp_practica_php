<?php
        use app\core\model\dao\PerfilDAO;
        use app\libs\Connection\Connection;
        
        $id = $_GET['id'];
        $conn = Connection::get();
        $dao= new PerfilDAO($conn);
        $datos=$dao->load($id)?>

<div class="container-fluid row">

  <form class="col-4">
    <div class="mb-3">
      <label for="nombrePerfil" class="form-label">Nombre del Perfil</label>
      <input type="text" class="form-control" id="nombrePerfil" value=<?=$datos->getNombre()?>>
    </div>


    <button id="btnmodificarPerfil" type="submit" class="btn btn-primary">Modificar Perfil</button>

  </form>
  <div class="col-8 p-4">
    <table class="table table-light">
      <thead>
      <tr>
          <th colspan="11">
            Datos de Perfil
          </th>
        </tr>
        <tr>
          <th scope="col">id</th>
          <th scope="col">Apellido</th>
          <th> </th>
        </tr>
      </thead>
      <tbody>

          <tr id="filaModificarPerfil" data-id=<?= $datos->getId() ?>>
            <th><?= $datos->getId()?></th>
            <td><?= $datos->getNombre()?></td>
            <td>
              <a id="btnEliminarPerfiles" href=<?= APP_FRONT.'perfil/create/0' ?> class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
            </td>
          </tr>


      </tbody>
  </table>
</div>
</div>