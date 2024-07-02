<div class="container-fluid row">

  <form id="formCliente" class="col-4 p-3" autocomplete="off">

    <div class="input-group mb-3">
      <button class="btn btn-primary" type="button" id="btnClienteLoad">Buscar</button>
      <input id="buscarCliente" type="text" class="form-control" placeholder="Escriba el ID del Perfil" aria-label="Example text with button addon" aria-describedby="button-addon1">
    </div>


    <div class="mb-3">
      <button id="btnClienteListar" type="button" class="btn btn-primary mt-3">Listar todos los clientes</button>
    </div>

    <h4 class="text-center text-secondary">Registro de Clientes</h4>
    <div class="mb-3">
      <label for="nombreCliente" class="form-label">Nombre del Cliente</label>
      <input type="text" class="form-control" id="nombreCliente">
    </div>

    <div class="mb-3">
      <label for="apellidoCliente" class="form-label">Apellido del Cliente</label>
      <input type="text" class="form-control" id="apellidoCliente">
    </div>

    <div class="mb-3">
      <label for="dniCliente" class="form-label">DNI del Cliente</label>
      <input type="number" class="form-control" id="dniCliente">
    </div>

    <div class="mb-3">
      <label for="cuitCliente" class="form-label">CUIT del Cliente</label>
      <input type="number" class="form-control" id="cuitCliente">
    </div>


    <div class="mb-3">
      <label class="form-label">Tipo de Cliente</label>
      <select id="tipoCliente" class="form-select" aria-label="Default select example">
        <option value="Empresa">Empresa</option>
        <option value="Persona">Persona</option>
      </select>
    </div>

    <?php

    use app\core\model\dao\ProvinciaDAO;
    use app\libs\Connection\Connection;

    $conn = Connection::get();
    $daoProvincia = new ProvinciaDAO($conn);
    $datosProvincia = $daoProvincia->list();

    ?>

    <div class="mb-3">
      <label for="provinciaCliente" class="form-label">Id de la Provincia</label>
      <select name="provinciaCliente" class="form-select" id="provinciaCliente" aria-label="Seleccione...">
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
      <label for="localidadCliente" class="form-label">Localidad del Cliente</label>
      <input type="text" class="form-control" id="localidadCliente">
    </div>

    <div class="mb-3">
      <label for="telefonoCliente" class="form-label">Telefono del Cliente</label>
      <input type="number" class="form-control" id="telefonoCliente">
    </div>

    <div class="mb-3">
      <label for="emailCliente" class="form-label">Email del Cliente</label>
      <input type="email" class="form-control" id="emailCliente" aria-describedby="emailHelp">
    </div>

    <button type="button" id="btnGuardarCliente" class="btn btn-primary">Cargar Cliente</button>

  </form>
  <div class="col-8 p-4">
    <table id="tablaCliente" class="table table-dark">
      <thead>

        <tr>
          <th colspan="9">
            Listado de Clientes
          </th>

          <th colspan="2">
            
            <button type="button" id="imprimirClientes"> Imprimir clientes</button>
            <a target="_blank" href="<?= APP_FRONT . "cliente/pdf" ?>">Generar PDF</a>

          </th>


        </tr>

        <tr>
          <th scope="col">id</th>
          <th scope="col">apellido</th>
          <th scope="col">nombre</th>
          <th scope="col">dni</th>
          <th scope="col">cuit</th>
          <th scope="col">tipo</th>
          <th scope="col">provincia</th>
          <th scope="col">localidad</th>
          <th scope="col">telefono</th>
          <th scope="col">correo</th>
          <th scope="col">opciones</th>
        </tr>
      </thead>
      <tbody id="tbodyCliente">

      </tbody>
    </table>


  </div>

</div>