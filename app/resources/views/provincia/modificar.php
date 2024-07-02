<div class="container-fluid row">

  <form id="formProvinciaModificar" class="col-4">
    <div class="mb-3">
      <label for="nombreProvModificar" class="form-label">Nombre de la Provincia</label>
      <input type="text" class="form-control" id="nombreProvModificar">
    </div>


    <button id="btnModificarProvincia" type="submit" class="btn btn-primary">Modificar Provincia</button>

  </form>

  <div class="col-8 p-4">
    <table class="table table-dark">
      <thead>
        <tr>
          <th scope="col">id</th>
          <th scope="col">Nombre</th>
          <th>Borrar</th>
        </tr>
      </thead>

      <tbody>

      <?php
        use app\core\model\dao\ProvinciaDAO;
        use app\libs\Connection\Connection;
        
        $id = $_GET['id'];
        $conn = Connection::get();
        $dao= new ProvinciaDAO($conn);
        $datos=$dao->load($id)?>

          <tr id="filaModificarProvincia" data-id=<?= $datos->getId() ?>>
            <th><?= $datos->getId()?></th>
            <td><?= $datos->getNombre()?></td>
            <td>
              <a id="btnEliminarProvincia" href=<?= APP_FRONT."provincia/create/0" ?> class="btn btn-small btn-danger"><i class="fa-solid fa-trash"></i></a>
            </td>
          </tr>

      </tbody>
    </table>
  </div>
</div>