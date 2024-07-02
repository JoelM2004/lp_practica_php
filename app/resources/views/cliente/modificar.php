<?php
        use app\core\model\dao\ProvinciaDAO;
        use app\core\model\dao\ClienteDAO;
        use app\libs\Connection\Connection;
        
        $id = $_GET['id'];
        $conn = Connection::get();
        $dao= new ClienteDAO($conn);
        $datos=$dao->load($id);
        
        $daoProvincia = new ProvinciaDAO($conn);
        $datosProvincia = $daoProvincia->list();  
        $datosProv=$daoProvincia->load($datos->getProvinciaId())

?>


<div class="container-fluid row">

  <form class="col-4 p-3" autocomplete="off" id="formModificarCliente">

    <h4 class="text-center text-secondary">Registro de Clientes</h4>
    <div class="mb-3">
      <label for="nombreClienteMOD" class="form-label">Nombre del Cliente</label>
      <input type="text" class="form-control" id="nombreClienteMOD" value=<?=$datos->getNombre()?>>
    </div>

    <div class="mb-3">
      <label for="apellidoClienteMOD" class="form-label">Apellido del Cliente</label>
      <input type="text" class="form-control" id="apellidoClienteMOD" value=<?=$datos->getApellido()?>>
    </div>

    <div class="mb-3">
      <label for="dniClienteMOD" class="form-label">DNI del Cliente</label>
      <input type="number" class="form-control" id="dniClienteMOD" value=<?=$datos->getDNI()?>>
    </div>

    <div class="mb-3">
      <label for="cuitClienteMOD" class="form-label">CUIT del Cliente</label>
      <input type="number" class="form-control" id="cuitClienteMOD" value=<?=$datos->getCuit()?>>
    </div>


    <div class="mb-3">
    <label class="form-label">Tipo de Cliente</label>
    <select id="tipoClienteMOD" class="form-select" aria-label="Seleccione...">
      <option value="Empresa">Empresa</option>
      <option value="Persona">Persona</option>
    </select>
    </div>
    


    <div class="mb-3">
    <label for="provinciaClienteMOD" class="form-label">Id de la Provincia</label>
    <select name="provinciaClienteMOD" class="form-select" id="provinciaClienteMOD" aria-label="Seleccione...">
        
    <?php
    $txt = ''; // Inicializar $txt antes del bucle

    foreach ($datosProvincia as $elemento) {
      $txt .= '<option value="' . $elemento['id'] . '">' . $elemento['nombre'] . '</option>';
    }

    echo $txt;
    ?>

    </select>

  </div>




    <div class="mb-3">
      <label for="localidadClienteMOD" class="form-label">Localidad del Cliente</label>
      <input type="text" class="form-control" id="localidadClienteMOD" value=<?=$datos->getLocalidad()?>>
    </div>

    <div class="mb-3">
      <label for="telefonoClienteMOD" class="form-label">Telefono del Cliente</label>
      <input type="number" class="form-control" id="telefonoClienteMOD" value=<?=$datos->getTelefono()?>>
    </div>

    <div class="mb-3">
      <label for="emailClienteMOD" class="form-label">Email del Cliente</label>
      <input type="email" class="form-control" id="emailClienteMOD" aria-describedby="emailHelp" value=<?=$datos->getCorreo()?>>
    </div>

    <button type="button" id="btnModificarCliente" class="btn btn-primary">Actualizar Cliente</button>

  </form>
  <div class="col-8 p-4">
    <table class="table table-dark">
      <thead >
      <tr>
          <th colspan="11">
            Datos del Cliente
          </th>
        </tr>
        <tr>
          <th scope="col">id</th>
          <th scope="col">apellido</th>
          <th scope="col">nombre</th>
          <th scope="col">dni</th>
          <th scope="col">cuit</th>
          <th scope="col">tipo</th>
          <th scope="col">provinciaId</th>
          <th scope="col">localidad</th>
          <th scope="col">telefono</th>
          <th scope="col">correo</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>

    <tr id="filaModificarCliente" data-id=<?= $datos->getId() ?>>
    <th><?= $datos->getId()?></th>
    <td><?= $datos->getApellido()?></td>
    <td><?= $datos->getNombre()?></td>
    <td><?= $datos->getDNI()?></td>
    <td><?= $datos->getCuit()?></td>
    <td><?= $datos->getTipo()?></td>

    <td><?= $datosProv->getNombre()?></td>
    
    
    <td><?= $datos->getLocalidad()?></td>
    <td><?= $datos->getTelefono()?></td>
    <td><?= $datos->getCorreo()?></td>
    <td>

      <a id="btnEliminarClientes" href=<?= APP_FRONT."cliente/create/0" ?> class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
    </td>
  </tr>

      </tbody>
    </table>


  </div>

</div>